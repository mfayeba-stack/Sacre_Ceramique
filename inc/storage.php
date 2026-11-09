<?php
declare(strict_types=1);

/**
 * Stockage persistant via Vercel Blob (store privé), sans SDK : HTTP brut.
 * Actif uniquement si BLOB_READ_WRITE_TOKEN est défini (Vercel). En local, les fichiers du disque sont utilisés.
 *
 * Organisation du store :
 *   data/<nom>.json      données du site (produits, réglages, pages, admin…)
 *   media/<fichier>      photos téléversées
 *   sessions/<id>        sessions de l'administration
 */

function store_token(): string
{
    return (string)(getenv('BLOB_READ_WRITE_TOKEN') ?: '');
}

function store_enabled(): bool
{
    return store_token() !== '';
}

function store_api_base(): string
{
    return rtrim((string)(getenv('VERCEL_BLOB_API_URL') ?: 'https://vercel.com/api/blob'), '/');
}

function store_read_base(): string
{
    $o = (string)(getenv('BLOB_STORE_BASE_URL') ?: '');
    if ($o !== '') {
        return rtrim($o, '/');
    }
    // jeton : vercel_blob_rw_<storeId>_<secret>
    $id = strtolower(explode('_', store_token())[3] ?? '');
    return 'https://' . $id . '.private.blob.vercel-storage.com';
}

function store_encode_path(string $path): string
{
    return implode('/', array_map('rawurlencode', explode('/', $path)));
}

/** @return array{0:int,1:string} [code HTTP, corps] ; code 0 en cas d'échec réseau */
function store_request(string $method, string $url, array $headers, ?string $body = null): array
{
    $h = [];
    foreach ($headers as $k => $v) {
        $h[] = $k . ': ' . $v;
    }
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $h,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CONNECTTIMEOUT => 6,
        ]);
        if ($body !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        $res = curl_exec($ch);
        $code = (int)curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        return [$code, $res === false ? '' : (string)$res];
    }
    $ctx = stream_context_create(['http' => [
        'method' => $method, 'header' => implode("\r\n", $h), 'content' => $body ?? '',
        'timeout' => 20, 'ignore_errors' => true,
    ]]);
    $res = @file_get_contents($url, false, $ctx);
    $code = 0;
    if (isset($http_response_header[0]) && preg_match('#\s(\d{3})\s#', $http_response_header[0], $m)) {
        $code = (int)$m[1];
    }
    return [$code, $res === false ? '' : $res];
}

function store_auth(): array
{
    return ['authorization' => 'Bearer ' . store_token(), 'x-api-version' => (string)(getenv('VERCEL_BLOB_API_VERSION') ?: '13')];
}

function store_get(string $path): ?string
{
    [$code, $body] = store_request('GET', store_read_base() . '/' . store_encode_path($path) . '?cache=0', store_auth());
    if ($code === 200) {
        return $body;
    }
    if ($code !== 404) {
        error_log("[store] GET $path -> $code");
    }
    return null;
}

function store_put(string $path, string $content, string $contentType = 'application/octet-stream'): bool
{
    $headers = store_auth() + [
        'x-vercel-blob-access' => 'private',
        'x-allow-overwrite' => '1',
        'x-add-random-suffix' => '0',
        'x-content-type' => $contentType,
        'content-type' => $contentType,
    ];
    [$code, $body] = store_request('PUT', store_api_base() . '/?pathname=' . rawurlencode($path), $headers, $content);
    if ($code < 200 || $code >= 300) {
        error_log("[store] PUT $path -> $code " . substr($body, 0, 200));
        return false;
    }
    return true;
}

function store_delete(string $path): bool
{
    $url = store_read_base() . '/' . store_encode_path($path);
    [$code, $body] = store_request('POST', store_api_base() . '/delete', store_auth() + ['content-type' => 'application/json'], (string)json_encode(['urls' => [$url]]));
    if ($code < 200 || $code >= 300) {
        error_log("[store] DELETE $path -> $code " . substr($body, 0, 200));
        return false;
    }
    return true;
}

/** @return string[] chemins (pathname) commençant par $prefix */
function store_list(string $prefix): array
{
    [$code, $body] = store_request('GET', store_api_base() . '?prefix=' . rawurlencode($prefix) . '&limit=1000', store_auth());
    if ($code !== 200) {
        error_log("[store] LIST $prefix -> $code");
        return [];
    }
    $d = json_decode($body, true);
    return is_array($d['blobs'] ?? null) ? array_values(array_map(fn($b) => (string)($b['pathname'] ?? ''), $d['blobs'])) : [];
}

/** Sessions PHP stockées dans le store (les fonctions Vercel n'ont pas de disque persistant). */
final class BlobSessionHandler implements SessionHandlerInterface
{
    private function key(string $id): ?string
    {
        return preg_match('/^[A-Za-z0-9,-]{16,128}$/', $id) ? 'sessions/' . $id : null;
    }

    public function open(string $path, string $name): bool
    {
        return true;
    }

    public function close(): bool
    {
        return true;
    }

    public function read(string $id): string|false
    {
        $k = $this->key($id);
        $raw = $k ? store_get($k) : null;
        $d = $raw ? json_decode($raw, true) : null;
        if (!is_array($d) || ($d['t'] ?? 0) < time() - 86400) {
            return '';
        }
        return (string)($d['d'] ?? '');
    }

    public function write(string $id, string $data): bool
    {
        $k = $this->key($id);
        return $k ? store_put($k, (string)json_encode(['t' => time(), 'd' => $data]), 'application/json') : false;
    }

    public function destroy(string $id): bool
    {
        $k = $this->key($id);
        return $k ? store_delete($k) : true;
    }

    public function gc(int $max_lifetime): int|false
    {
        return 0;
    }
}
