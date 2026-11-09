<?php
declare(strict_types=1);

define('ROOT', dirname(__DIR__));
define('DATA_DIR', ROOT . '/data');

function e(mixed $v): string
{
    return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function load_json(string $name, array $default = []): array
{
    $file = DATA_DIR . '/' . $name . '.json';
    if (!is_file($file)) {
        return $default;
    }
    $data = json_decode((string)file_get_contents($file), true);
    return is_array($data) ? $data : $default;
}

/** Écriture atomique (fichier temporaire + rename) avec verrou. */
function save_json(string $name, array $data): bool
{
    $file = DATA_DIR . '/' . $name . '.json';
    $tmp = $file . '.' . bin2hex(random_bytes(4)) . '.tmp';
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($json === false || file_put_contents($tmp, $json, LOCK_EX) === false) {
        return false;
    }
    return rename($tmp, $file);
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

$S = load_settings();
