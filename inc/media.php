<?php
declare(strict_types=1);

const UPLOAD_DIR = ROOT . '/assets/img/uploads';
const UPLOAD_URL = 'assets/img/uploads/';

/** Valide et enregistre une image téléversée. Retourne le chemin relatif ou null (et remplit $err). */
function upload_image(array $file, string &$err): ?string
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return null;
    }
    if ($file['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'])) {
        $err = "Échec du téléversement de l'image.";
        return null;
    }
    if ($file['size'] > 5 * 1024 * 1024) {
        $err = 'Image trop lourde (5 Mo maximum).';
        return null;
    }
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
    $ext = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'][$mime] ?? null;
    if ($ext === null || @getimagesize($file['tmp_name']) === false) {
        $err = 'Format non accepté (JPEG, PNG ou WebP uniquement).';
        return null;
    }
    $name = bin2hex(random_bytes(10)) . '.' . $ext;
    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0755, true);
    }
    if (!move_uploaded_file($file['tmp_name'], UPLOAD_DIR . '/' . $name)) {
        $err = "Impossible d'enregistrer l'image.";
        return null;
    }
    return UPLOAD_URL . $name;
}

/** Liste des images disponibles (assets/img + uploads). */
function media_library(): array
{
    $out = [];
    foreach (['assets/img', 'assets/img/uploads'] as $dir) {
        foreach (glob(ROOT . '/' . $dir . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE) ?: [] as $f) {
            $out[] = $dir . '/' . basename($f);
        }
    }
    return $out;
}
