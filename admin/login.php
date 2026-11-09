<?php
declare(strict_types=1);
require __DIR__ . '/_boot.php';

$setup = admin_hash() === null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    if ($setup) {
        $p1 = (string)($_POST['password'] ?? '');
        $p2 = (string)($_POST['password2'] ?? '');
        if (mb_strlen($p1) < 10) {
            $error = 'Le mot de passe doit contenir au moins 10 caractères.';
        } elseif ($p1 !== $p2) {
            $error = 'Les deux mots de passe ne correspondent pas.';
        } else {
            save_json('admin', ['hash' => password_hash($p1, PASSWORD_DEFAULT), 'created' => date('c')]);
            session_regenerate_id(true);
            $_SESSION['admin'] = true;
            redirect('index.php');
        }
    } elseif (login_blocked()) {
        $error = 'Trop de tentatives. Réessayez dans 15 minutes.';
    } elseif (password_verify((string)($_POST['password'] ?? ''), (string)admin_hash())) {
        session_regenerate_id(true);
        $_SESSION['admin'] = true;
        redirect('index.php');
    } else {
        login_failed();
        $error = 'Mot de passe incorrect.';
    }
}
?><!DOCTYPE html>
<html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex,nofollow">
<title>Connexion — Administration</title><link rel="icon" href="../assets/img/logo.png">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400..900&family=Plus+Jakarta+Sans:wght@300..800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script><script src="../assets/js/tailwind-config.js"></script></head>
<body class="bg-surface font-body-md text-on-surface min-h-screen flex items-center justify-center p-4">
<form method="post" class="w-full max-w-sm bg-surface-container-lowest rounded-xl shadow-[0_12px_32px_-4px_rgba(61,36,28,0.12)] p-8 space-y-4">
  <img src="../assets/img/logo.png" alt="Le Sacré Céramique" class="h-20 mx-auto mix-blend-multiply">
  <h1 class="font-headline-sm text-headline-sm text-primary text-center"><?= $setup ? 'Première configuration' : 'Espace administration' ?></h1>
  <?php if ($setup): ?><p class="font-body-sm text-body-sm text-on-surface-variant">Choisissez le mot de passe de l'administrateur (10 caractères minimum). Faites-le dès la mise en ligne du site.</p><?php endif; ?>
  <?php if ($error): ?><p role="alert" class="px-3 py-2 rounded-lg bg-error-container text-on-error-container font-body-sm text-body-sm"><?= e($error) ?></p><?php endif; ?>
  <?= csrf_field() ?>
  <label class="block"><span class="<?= LABEL ?>">Mot de passe</span><input type="password" name="password" required autofocus autocomplete="<?= $setup ? 'new-password' : 'current-password' ?>" class="<?= INPUT ?>"></label>
  <?php if ($setup): ?><label class="block"><span class="<?= LABEL ?>">Confirmer</span><input type="password" name="password2" required autocomplete="new-password" class="<?= INPUT ?>"></label><?php endif; ?>
  <button class="<?= BTN ?> w-full"><?= $setup ? 'Créer le mot de passe' : 'Se connecter' ?></button>
</form></body></html>
