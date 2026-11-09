<?php
declare(strict_types=1);

require __DIR__ . '/../inc/bootstrap.php';

header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: same-origin');
header('Cache-Control: no-store');

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax',
    'secure' => !empty($_SERVER['HTTPS']),
]);
session_name('sc_admin');
session_start();

function admin_hash(): ?string
{
    $a = load_json('admin');
    return isset($a['hash']) && is_string($a['hash']) && $a['hash'] !== '' ? $a['hash'] : null;
}

function require_login(): void
{
    if (admin_hash() === null || empty($_SESSION['admin'])) {
        header('Location: login.php');
        exit;
    }
}

function csrf(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf()) . '">';
}

function check_csrf(): void
{
    $sent = (string)($_POST['csrf'] ?? '');
    $expected = (string)($_SESSION['csrf'] ?? '');
    if ($expected === '' || $sent === '' || !hash_equals($expected, $sent)) {
        http_response_code(400);
        exit('Session expirée ou jeton invalide. Rechargez la page.');
    }
}

function flash(?string $msg = null, string $type = 'ok'): ?array
{
    if ($msg !== null) {
        $_SESSION['flash'] = [$msg, $type];
        return null;
    }
    $f = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $f;
}

function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}

/** Limite les tentatives de connexion : 5 échecs / 15 minutes par IP. */
function login_blocked(): bool
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? '?';
    $all = load_json('login_attempts');
    $recent = array_filter($all[$ip] ?? [], fn($t) => $t > time() - 900);
    return count($recent) >= 5;
}

function login_failed(): void
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? '?';
    $all = load_json('login_attempts');
    foreach ($all as $k => $list) {
        $all[$k] = array_values(array_filter($list, fn($t) => $t > time() - 900));
        if (!$all[$k]) {
            unset($all[$k]);
        }
    }
    $all[$ip][] = time();
    save_json('login_attempts', $all);
}

const INPUT = 'w-full px-3 py-2.5 rounded-lg bg-surface-container-lowest border border-outline-variant focus:border-primary focus:ring-2 focus:ring-primary/15 outline-none font-body-md text-body-md';
const LABEL = 'block font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1';
const BTN = 'inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-primary text-on-primary font-label-lg text-label-lg hover:bg-primary-container transition-colors';
const BTN2 = 'inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-surface-container-high text-on-surface font-label-lg text-label-lg hover:bg-surface-container-highest transition-colors';

function admin_head(string $title, string $active = ''): void
{
    $nav = [
        'studio' => ['index.php', 'dashboard_customize', 'Studio éditeur'],
        'catalogue' => ['catalogue.php', 'inventory_2', 'Catalogue & tarifs'],
    ];
    ?><!DOCTYPE html>
<html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow"><title><?= e($title) ?> — Administration Le Sacré Céramique</title>
<link rel="icon" href="../assets/img/logo.png">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:wght@300..800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script><script src="../assets/js/tailwind-config.js"></script>
</head><body class="bg-surface font-body-md text-on-surface antialiased">
<div class="min-h-screen lg:flex">
<aside class="lg:w-64 lg:min-h-screen shrink-0 bg-surface-container-low border-b lg:border-b-0 lg:border-r border-outline-variant/40 p-4 lg:p-5 flex lg:flex-col gap-4 items-center lg:items-stretch justify-between lg:justify-start">
  <a href="index.php" class="flex items-center gap-2"><img src="../assets/img/logo.png" alt="" class="h-10 w-auto mix-blend-multiply"><span class="font-title-lg text-title-lg text-primary leading-tight hidden sm:block">Le Sacré Céramique<span class="block font-label-sm text-label-sm text-outline uppercase tracking-widest">Studio d'édition</span></span></a>
  <nav class="flex lg:flex-col gap-1 lg:mt-6"><?php foreach ($nav as $k => [$href, $ic, $label]): $a = $k === $active; ?>
    <a href="<?= e($href) ?>" class="flex items-center gap-2 px-3 py-2 rounded-lg font-label-lg text-label-lg <?= $a ? 'bg-primary-container text-on-primary' : 'text-on-surface-variant hover:bg-surface-container-high' ?>"><span class="material-symbols-outlined text-[20px]"><?= e($ic) ?></span><span><?= e($label) ?></span></a>
  <?php endforeach; ?></nav>
  <div class="lg:mt-auto flex lg:flex-col gap-2">
    <a href="../index.php" target="_blank" rel="noopener" class="flex items-center gap-2 px-3 py-2 rounded-lg text-on-surface-variant hover:bg-surface-container-high font-label-lg text-label-lg"><span class="material-symbols-outlined text-[20px]">open_in_new</span><span class="hidden sm:inline">Voir le site</span></a>
    <a href="logout.php" class="flex items-center gap-2 px-3 py-2 rounded-lg text-on-surface-variant hover:bg-surface-container-high font-label-lg text-label-lg"><span class="material-symbols-outlined text-[20px]">logout</span><span class="hidden sm:inline">Déconnexion</span></a>
  </div>
</aside>
<main class="flex-1 min-w-0 p-4 sm:p-6 lg:p-10">
<?php if ($f = flash()): ?><div role="status" class="mb-6 px-4 py-3 rounded-lg font-body-sm text-body-sm <?= $f[1] === 'err' ? 'bg-error-container text-on-error-container' : 'bg-secondary-fixed text-on-secondary-fixed' ?>"><?= e($f[0]) ?></div><?php endif;
}

function admin_foot(): void
{
    echo '</main></div></body></html>';
}
