<?php
declare(strict_types=1);

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
$allowed = in_array($path, $pages, true) || $path === 'assets/js/tailwind-config.php';

if (str_starts_with($path, 'admin/')) {
    http_response_code(503);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><meta charset="utf-8"><title>Administration</title><body style="font-family:sans-serif;max-width:40rem;margin:4rem auto;padding:0 1rem">'
        . "<h1>Administration indisponible ici</h1><p>L'espace d'administration enregistre ses modifications dans des fichiers, ce que Vercel ne permet pas (stockage en lecture seule).</p>"
        . "<p>Modifiez le site en local (Laragon), puis publiez : <code>git push</code> redéploie automatiquement cette version en ligne.</p></body>";
    exit;
}

if (!$allowed || !is_file($root . '/' . $path)) {
    http_response_code(404);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><meta charset="utf-8"><title>Page introuvable</title><body style="font-family:sans-serif;max-width:40rem;margin:4rem auto;padding:0 1rem"><h1>Page introuvable</h1><p><a href="/">Retour à l\'accueil</a></p></body>';
    exit;
}

chdir($root);
$_SERVER['SCRIPT_NAME'] = '/' . $path;
require $root . '/' . $path;
