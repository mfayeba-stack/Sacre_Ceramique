<?php
declare(strict_types=1);
require __DIR__ . '/_boot.php';
require __DIR__ . '/../inc/cms.php';
require __DIR__ . '/../inc/media.php';

header('Content-Type: application/json; charset=utf-8');

function out(array $data, int $code = 200): never
{
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

if (admin_hash() === null || empty($_SESSION['admin'])) {
    out(['ok' => false, 'error' => 'Non connecté.'], 401);
}

$action = (string)($_GET['action'] ?? '');

if ($action === 'media_list' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    out(['ok' => true, 'images' => media_library()]);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    out(['ok' => false, 'error' => 'Méthode invalide.'], 405);
}
$csrfExpected = (string)($_SESSION['csrf'] ?? '');
$csrfSent = (string)($_SERVER['HTTP_X_CSRF_TOKEN'] ?? '');
if ($csrfExpected === '' || $csrfSent === '' || !hash_equals($csrfExpected, $csrfSent)) {
    out(['ok' => false, 'error' => 'Session expirée, rechargez la page.'], 400);
}

if ($action === 'media_upload') {
    $err = '';
    $path = upload_image($_FILES['image'] ?? [], $err);
    if ($path === null) {
        out(['ok' => false, 'error' => $err ?: 'Aucun fichier reçu.'], 400);
    }
    out(['ok' => true, 'path' => $path]);
}

$body = json_decode((string)file_get_contents('php://input'), true);
if (!is_array($body)) {
    out(['ok' => false, 'error' => 'Requête invalide.'], 400);
}
$page = (string)($body['page'] ?? '');
if (!isset(CMS_PAGES[$page])) {
    out(['ok' => false, 'error' => 'Page inconnue.'], 400);
}

if ($action === 'save_page') {
    $clean = cms_sanitize_overrides((array)($body['ov'] ?? []));
    if (!cms_save_overrides($page, $clean)) {
        out(['ok' => false, 'error' => "Écriture impossible : vérifiez les droits du dossier data/pages."], 500);
    }
    out(['ok' => true, 'counts' => array_map('count', $clean)]);
}

if ($action === 'reset_page') {
    if (!cms_save_overrides($page, cms_empty_overrides())) {
        out(['ok' => false, 'error' => 'Réinitialisation impossible.'], 500);
    }
    out(['ok' => true]);
}

out(['ok' => false, 'error' => 'Action inconnue.'], 400);
