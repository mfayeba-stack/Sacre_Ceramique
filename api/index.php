<?php
declare(strict_types=1);

ini_set('display_errors', '0');
error_reporting(E_ALL & ~E_DEPRECATED);

/**
 * Point d'entrée Vercel (runtime vercel-php) : route toutes les requêtes vers les pages PHP du site.
 * Utilisé uniquement sur Vercel ; en local, Apache/Laragon sert directement les fichiers.
 */

$root = dirname(__DIR__);
$path = trim((string)parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');

if ($path === '') {
    $path = 'index.php';
}
// anciennes adresses (.html) et adresses sans extension
$path = preg_replace('/\.html$/', '.php', $path);
if (!str_ends_with($path, '.php') && is_file($root . '/' . $path . '.php')) {
    $path .= '.php';
}

$pages = ['index.php', 'notre-histoire.php', 'nos-produits.php', 'commander.php', 'contact.php'];
$adminPages = ['admin/index.php', 'admin/catalogue.php', 'admin/login.php', 'admin/logout.php', 'admin/api.php'];
$storeOn = (string)getenv('BLOB_READ_WRITE_TOKEN') !== '';

// Photos téléversées depuis l'administration : servies depuis le stockage Vercel Blob
if (preg_match('#^assets/img/uploads/([a-f0-9]{20})\.(jpg|png|webp)$#', $path, $m) && $storeOn) {
    require_once $root . '/inc/storage.php';
    $bin = store_get('media/' . $m[1] . '.' . $m[2]);
    if ($bin === null) {
        http_response_code(404);
        exit;
    }
    header('Content-Type: ' . ['jpg' => 'image/jpeg', 'png' => 'image/png', 'webp' => 'image/webp'][$m[2]]);
    header('Cache-Control: public, max-age=31536000, immutable');
    header('X-Content-Type-Options: nosniff');
    echo $bin;
    exit;
}

if (str_starts_with($path, 'admin/') && !($storeOn && in_array($path, $adminPages, true))) {
    http_response_code(503);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><meta charset="utf-8"><title>Administration</title><body style="font-family:sans-serif;max-width:40rem;margin:4rem auto;padding:0 1rem">'
        . "<h1>Administration indisponible</h1><p>Le stockage persistant (Vercel Blob) n'est pas configuré sur ce déploiement.</p></body>";
    exit;
}

$allowed = in_array($path, $pages, true) || $path === 'assets/js/tailwind-config.php' || ($storeOn && in_array($path, $adminPages, true));

if (!$allowed || !is_file($root . '/' . $path)) {
    http_response_code(404);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><meta charset="utf-8"><title>Page introuvable</title><body style="font-family:sans-serif;max-width:40rem;margin:4rem auto;padding:0 1rem"><h1>Page introuvable</h1><p><a href="/">Retour à l&#39;accueil</a></p></body>';
    exit;
}

chdir($root);
$_SERVER['SCRIPT_NAME'] = '/' . $path;
$_SERVER['PHP_SELF'] = '/' . $path;
require $root . '/' . $path;
