<?php
declare(strict_types=1);

// En production (Vercel) : jamais d'erreurs affichées dans la page (elles empêchent l'envoi des en-têtes et des sessions).
if (getenv('VERCEL')) {
    ini_set('display_errors', '0');
    error_reporting(E_ALL & ~E_DEPRECATED);
}

define('ROOT', dirname(__DIR__));
define('DATA_DIR', ROOT . '/data');

function e(mixed $v): string
{
    return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

require_once __DIR__ . '/storage.php';

if (store_enabled()) {
    session_set_save_handler(new BlobSessionHandler(), true);
}

/** Lit data/<nom>.json : depuis le store (Vercel) puis, à défaut, depuis le fichier versionné (valeurs initiales). */
function load_json(string $name, array $default = []): array
{
    static $cache = [];
    if (store_enabled()) {
        if (!array_key_exists($name, $cache)) {
            $raw = store_get('data/' . $name . '.json');
            $cache[$name] = $raw !== null ? json_decode($raw, true) : null;
        }
        if (is_array($cache[$name])) {
            return $cache[$name];
        }
    }
    $file = DATA_DIR . '/' . $name . '.json';
    if (!is_file($file)) {
        return $default;
    }
    $data = json_decode((string)file_get_contents($file), true);
    return is_array($data) ? $data : $default;
}

/** Écrit data/<nom>.json : dans le store (Vercel) ou sur le disque (local), de façon atomique. */
function save_json(string $name, array|object $data): bool
{
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($json === false) {
        return false;
    }
    if (store_enabled()) {
        return store_put('data/' . $name . '.json', $json, 'application/json');
    }
    $file = DATA_DIR . '/' . $name . '.json';
    if (!is_dir(dirname($file))) {
        mkdir(dirname($file), 0755, true);
    }
    $tmp = $file . '.' . bin2hex(random_bytes(4)) . '.tmp';
    if (file_put_contents($tmp, $json, LOCK_EX) === false) {
        return false;
    }
    return rename($tmp, $file);
}

function delete_json(string $name): bool
{
    if (store_enabled()) {
        return store_delete('data/' . $name . '.json');
    }
    $file = DATA_DIR . '/' . $name . '.json';
    return !is_file($file) || unlink($file);
}

function default_settings(): array
{
    return [
        'whatsapp' => '221789462361',
        'phone_display' => '+221 78 946 23 61',
        'eur_rate' => 655.957,
        'announcement' => ['enabled' => false, 'text' => 'Édition limitée : nouveaux encensoirs disponibles', 'link_label' => 'Commander par WhatsApp'],
        'hero' => [
            'tagline' => "L'authenticité du fait main, la beauté du naturel.",
            'title1' => "L'âme de la terre",
            'title2' => 'au cœur de vos rituels.',
            'subtitle' => "Plus qu'un objet, une tradition séculaire. Nos encensoirs en terre cuite et pots à thiouraye sont façonnés individuellement par nos maîtres potiers pour sublimer vos résines, écorces précieuses et parfums d’intérieur.",
        ],
        'sections' => ['testimonials' => true],
        'hours' => [
            ['Lundi – Vendredi', '09h00 – 19h00'],
            ['Samedi', '10h00 – 18h30'],
            ['Dimanche', 'Sur rendez-vous'],
        ],
        'categories' => [
            ['traditionnel', 'Encensoirs Traditionnels'],
            ['coupes', 'Coupes sur pied'],
            ['hors-serie', 'Éditions Hors Série'],
            ['metallise', 'Finitions Métallisées & Dorées'],
        ],
    ];
}

function load_settings(): array
{
    $saved = load_json('settings');
    $s = array_replace_recursive(default_settings(), $saved);
    // les listes se remplacent entièrement (pas de fusion par index)
    foreach (['hours', 'categories'] as $k) {
        if (isset($saved[$k]) && is_array($saved[$k])) {
            $s[$k] = $saved[$k];
        }
    }
    return $s;
}

function load_products(): array
{
    return load_json('products');
}

function fcfa(int $n): string
{
    return number_format($n, 0, ',', ' ') . ' FCFA';
}

function eur(int $n, float $rate): string
{
    return '~ ' . number_format((int)round($n / max($rate, 0.0001)), 0, ',', ' ') . ' €';
}

// Sur Vercel, le CDN met en cache les pages publiques 30 s (les pages admin / édition envoient no-store).
if (getenv('VERCEL') && !headers_sent()) {
    header('Cache-Control: public, max-age=0, s-maxage=30, stale-while-revalidate=300');
}

$S = load_settings();
