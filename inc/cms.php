<?php
declare(strict_types=1);

/**
 * Moteur d'édition sans base de données.
 *
 * - Chaque élément du <main> reçoit un identifiant stable = chemin d'index dans l'arbre d'origine.
 * - Les modifications (textes, images, blocs masqués, ordre) sont stockées dans data/pages/<page>.json
 *   et appliquées à l'affichage. Chaque modification embarque une empreinte du contenu d'origine :
 *   si le gabarit change, une modification devenue obsolète est ignorée au lieu de casser la page.
 * - Le thème (couleurs, polices) est stocké dans data/settings.json.
 */

const CMS_PAGES = ['index' => 'Accueil', 'notre-histoire' => 'Notre Histoire', 'nos-produits' => 'Nos Produits', 'commander' => 'Commander', 'contact' => 'Contact'];

const THEME_COLORS = [
    'primary' => 'Couleur principale (titres, boutons)',
    'primary-container' => 'Principale — survol et dégradés',
    'secondary' => 'Accent doré',
    'secondary-container' => 'Accent doré clair',
    'tertiary' => 'Brun profond',
    'surface' => 'Fond du site',
    'surface-container-low' => 'Fond des sections claires',
    'surface-container' => 'Fond des cartes et bandeaux',
    'on-surface' => 'Texte principal',
    'on-surface-variant' => 'Texte secondaire',
];

const THEME_FONTS_HEADING = ['Playfair Display', 'Cormorant Garamond', 'Lora'];
const THEME_FONTS_BODY = ['Plus Jakarta Sans', 'Inter', 'Poppins', 'Nunito'];

function cms_h(string $s): string
{
    return substr(md5($s), 0, 8);
}

function cms_norm(string $s): string
{
    return trim((string)preg_replace('/\s+/u', ' ', $s));
}

// ───────────────────────── Thème ─────────────────────────

function theme_values(): array
{
    $s = load_settings();
    $t = is_array($s['theme'] ?? null) ? $s['theme'] : [];
    $colors = [];
    foreach ((array)($t['colors'] ?? []) as $k => $v) {
        if (isset(THEME_COLORS[$k]) && is_string($v) && preg_match('/^#[0-9a-fA-F]{6}$/', $v)) {
            $colors[$k] = strtolower($v);
        }
    }
    $heading = in_array($t['fonts']['heading'] ?? '', THEME_FONTS_HEADING, true) ? $t['fonts']['heading'] : THEME_FONTS_HEADING[0];
    $body = in_array($t['fonts']['body'] ?? '', THEME_FONTS_BODY, true) ? $t['fonts']['body'] : THEME_FONTS_BODY[0];
    return ['colors' => $colors, 'heading' => $heading, 'body' => $body];
}

function theme_base_colors(): array
{
    $base = json_decode((string)file_get_contents(ROOT . '/inc/tailwind-base.json'), true);
    return $base['theme']['extend']['colors'];
}

function theme_fonts_link(): string
{
    $t = theme_values();
    $h = str_replace(' ', '+', $t['heading']) . ':ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700';
    $b = str_replace(' ', '+', $t['body']) . ':wght@400;500;600;700';
    return '<link href="https://fonts.googleapis.com/css2?family=' . $h . '&family=' . $b . '&display=swap" rel="stylesheet"/>';
}

function cms_tailwind_config_js(): string
{
    $base = json_decode((string)file_get_contents(ROOT . '/inc/tailwind-base.json'), true);
    $t = theme_values();
    $ext = &$base['theme']['extend'];
    foreach ($t['colors'] as $k => $v) {
        $ext['colors'][$k] = $v;
    }
    foreach ($ext['fontFamily'] as $k => $fam) {
        if (($fam[0] ?? '') === 'Playfair Display') {
            $ext['fontFamily'][$k] = [$t['heading']];
        } elseif (($fam[0] ?? '') === 'Plus Jakarta Sans') {
            $ext['fontFamily'][$k] = [$t['body']];
        }
    }
    return 'tailwind.config=' . json_encode($base, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . ";\n";
}

// ───────────────────────── Surcharges de pages ─────────────────────────

function cms_admin(): bool
{
    if (!isset($_COOKIE['sc_admin'])) {
        return false;
    }
    if (session_status() === PHP_SESSION_NONE) {
        session_name('sc_admin');
        @session_start(['read_and_close' => true]);
    }
    return !empty($_SESSION['admin']);
}

function cms_is_edit(): bool
{
    return isset($_GET['sc_edit']) && cms_admin();
}

function cms_empty_overrides(): array
{
    return ['texts' => [], 'images' => [], 'hidden' => [], 'order' => []];
}

function cms_load_overrides(string $page): array
{
    if (!isset(CMS_PAGES[$page])) {
        return cms_empty_overrides();
    }
    $f = DATA_DIR . '/pages/' . $page . '.json';
    $d = is_file($f) ? json_decode((string)file_get_contents($f), true) : null;
    return is_array($d) ? array_replace(cms_empty_overrides(), $d) : cms_empty_overrides();
}

/** Les tableaux associatifs à clés numériques ("0", "0.1"…) doivent rester des objets JSON. */
function cms_as_objects(array $ov): array
{
    foreach (['texts', 'images', 'hidden', 'order'] as $k) {
        $ov[$k] = (object)($ov[$k] ?? []);
    }
    return $ov;
}

function cms_save_overrides(string $page, array $ov): bool
{
    if (!isset(CMS_PAGES[$page])) {
        return false;
    }
    if (!is_dir(DATA_DIR . '/pages')) {
        mkdir(DATA_DIR . '/pages', 0755, true);
    }
    $ok = true;
    $file = DATA_DIR . '/pages/' . $page . '.json';
    $empty = !$ov['texts'] && !$ov['images'] && !$ov['hidden'] && !$ov['order'];
    if ($empty) {
        return !is_file($file) || unlink($file);
    }
    $tmp = $file . '.' . bin2hex(random_bytes(4)) . '.tmp';
    $json = json_encode(cms_as_objects($ov), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    return $json !== false && file_put_contents($tmp, $json, LOCK_EX) !== false && rename($tmp, $file) && $ok;
}

/** Valide l'état envoyé par l'éditeur ; ne garde que des données bien formées. */
function cms_sanitize_overrides(array $in): array
{
    $out = cms_empty_overrides();
    $idRe = '/^\d+(\.\d+)*$/';
    foreach ((array)($in['texts'] ?? []) as $id => $e) {
        $id = (string)$id;
        if (preg_match('/^\d+(\.\d+)*(t\d+)?$/', $id) && is_array($e)
            && is_string($e['h'] ?? null) && preg_match('/^[0-9a-f]{8}$/', $e['h']) && is_string($e['v'] ?? null)) {
            $v = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '', str_replace("\r", '', $e['v']));
            $out['texts'][$id] = ['h' => $e['h'], 'v' => mb_substr((string)$v, 0, 3000)];
        }
    }
    foreach ((array)($in['images'] ?? []) as $id => $e) {
        $id = (string)$id;
        if (preg_match($idRe, $id) && is_array($e)
            && is_string($e['h'] ?? null) && preg_match('/^[0-9a-f]{8}$/', $e['h'])
            && is_string($e['v'] ?? null) && cms_valid_image_path($e['v'])) {
            $out['images'][$id] = ['h' => $e['h'], 'v' => $e['v']];
        }
    }
    foreach ((array)($in['hidden'] ?? []) as $id => $sig) {
        $id = (string)$id;
        if (preg_match($idRe, $id) && is_string($sig) && preg_match('/^[0-9a-f]{8}$/', $sig)) {
            $out['hidden'][$id] = $sig;
        }
    }
    foreach ((array)($in['order'] ?? []) as $pid => $list) {
        $pid = (string)$pid;
        if (!($pid === 'root' || preg_match($idRe, $pid)) || !is_array($list) || count($list) > 300) {
            continue;
        }
        $clean = [];
        foreach ($list as $item) {
            if (is_string($item) && preg_match('/^\d+(\.\d+)*:[0-9a-f]{8}$/', $item)) {
                $clean[] = $item;
            }
        }
        if ($clean) {
            $out['order'][$pid] = $clean;
        }
    }
    return $out;
}

function cms_valid_image_path(string $p): bool
{
    return (bool)preg_match('#^assets/img/[A-Za-z0-9_\-./]+$#', $p) && !str_contains($p, '..') && !str_contains($p, '//');
}

const CMS_SKIP_TAGS = ['script', 'style', 'svg', 'noscript', 'select', 'textarea', 'input', 'option', 'iframe', 'br', 'canvas', 'template'];

function cms_skip(DOMElement $el): bool
{
    if (in_array(strtolower($el->tagName), CMS_SKIP_TAGS, true) || $el->hasAttribute('data-noedit')) {
        return true;
    }
    $cls = ' ' . $el->getAttribute('class') . ' ';
    return str_contains($cls, ' material-symbols-outlined ') || str_contains($cls, ' product-item ');
}

/** Texte d'un élément « feuille » (texte + <br> uniquement) ; null s'il contient d'autres éléments. */
function cms_leaf_text(DOMElement $el): ?string
{
    $lines = [];
    $cur = '';
    foreach ($el->childNodes as $c) {
        if ($c instanceof DOMText) {
            $cur .= $c->nodeValue;
        } elseif ($c instanceof DOMElement && strtolower($c->tagName) === 'br') {
            $lines[] = cms_norm($cur);
            $cur = '';
        } elseif ($c instanceof DOMElement) {
            return null;
        }
    }
    $lines[] = cms_norm($cur);
    $txt = implode("\n", $lines);
    return trim($txt) === '' ? null : trim($txt, "\n");
}

function cms_scan(DOMElement $parent, string $pid, array &$st): void
{
    $i = 0;
    foreach (iterator_to_array($parent->childNodes) as $c) {
        if (!($c instanceof DOMElement)) {
            continue;
        }
        $id = $pid === '' ? (string)$i : $pid . '.' . $i;
        $i++;
        if (cms_skip($c)) {
            continue;
        }
        $tag = strtolower($c->tagName);
        $st['els'][$id] = ['n' => $c, 'pid' => $pid === '' ? 'root' : $pid, 'sig' => cms_h($tag . '|' . mb_substr(cms_norm($c->textContent), 0, 80))];

        if ($tag === 'img' && $c->hasAttribute('src')) {
            $st['imgs'][$id] = ['n' => $c, 'orig' => $c->getAttribute('src')];
        }
        if ($c->hasAttribute('style') && preg_match('/url\(\s*[\'"]?([^\'")]+)[\'"]?\s*\)/', $c->getAttribute('style'), $m)) {
            $st['bgs'][$id] = ['n' => $c, 'orig' => $m[1]];
        }
        if (!$c->hasAttribute('id')) {
            $leaf = cms_leaf_text($c);
            if ($leaf !== null) {
                $st['texts'][$id] = ['n' => $c, 'orig' => $leaf, 'kind' => 'leaf'];
            } else {
                $k = 0;
                foreach (iterator_to_array($c->childNodes) as $t) {
                    if ($t instanceof DOMText && cms_norm($t->nodeValue) !== '') {
                        $st['texts'][$id . 't' . $k] = ['n' => $t, 'orig' => cms_norm($t->nodeValue), 'kind' => 'node'];
                        $k++;
                    }
                }
            }
        }
        cms_scan($c, $id, $st);
    }
}

function cms_set_leaf(DOMElement $el, string $v): void
{
    while ($el->firstChild) {
        $el->removeChild($el->firstChild);
    }
    $doc = $el->ownerDocument;
    foreach (explode("\n", $v) as $n => $line) {
        if ($n > 0) {
            $el->appendChild($doc->createElement('br'));
        }
        $el->appendChild($doc->createTextNode($line));
    }
}

function cms_render(string $html, string $page): string
{
    $edit = cms_is_edit();
    $ov = cms_load_overrides($page);
    if (!$edit && !$ov['texts'] && !$ov['images'] && !$ov['hidden'] && !$ov['order']) {
        return $html;
    }
    if (!preg_match('~(<main\b[^>]*>)(.*)(</main>)~s', $html, $m, PREG_OFFSET_CAPTURE)) {
        return $html;
    }
    $inner = $m[2][0];
    $scripts = [];
    $inner = preg_replace_callback('~<(script|style)\b.*?</\1>~is', function ($mm) use (&$scripts) {
        $scripts[] = $mm[0];
        return '<!--SC_BLOCK_' . (count($scripts) - 1) . '-->';
    }, $inner);

    $doc = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors(true);
    $doc->loadHTML('<?xml encoding="UTF-8"><html><body><div id="sc-root">' . $inner . '</div></body></html>');
    libxml_clear_errors();
    $root = $doc->getElementById('sc-root');
    if (!$root) {
        return $html;
    }

    $st = ['els' => [], 'texts' => [], 'imgs' => [], 'bgs' => []];
    cms_scan($root, '', $st);

    // textes
    foreach ($ov['texts'] as $id => $e) {
        $u = $st['texts'][$id] ?? null;
        if (!$u || cms_h($u['orig']) !== $e['h']) {
            continue;
        }
        if ($u['kind'] === 'leaf') {
            cms_set_leaf($u['n'], $e['v']);
        } else {
            $raw = $u['n']->nodeValue;
            $u['n']->nodeValue = (preg_match('/^\s/u', $raw) ? ' ' : '') . cms_norm(str_replace("\n", ' ', $e['v'])) . (preg_match('/\s$/u', $raw) ? ' ' : '');
        }
    }
    // images
    foreach ($ov['images'] as $id => $e) {
        if (isset($st['imgs'][$id]) && cms_h($st['imgs'][$id]['orig']) === $e['h']) {
            $st['imgs'][$id]['n']->setAttribute('src', $e['v']);
            $st['imgs'][$id]['n']->removeAttribute('srcset');
        } elseif (isset($st['bgs'][$id]) && cms_h($st['bgs'][$id]['orig']) === $e['h']) {
            $n = $st['bgs'][$id]['n'];
            $n->setAttribute('style', str_replace($st['bgs'][$id]['orig'], $e['v'], $n->getAttribute('style')));
        }
    }
    // ordre
    foreach ($ov['order'] as $pid => $list) {
        $pid = (string)$pid;
        $parent = $pid === 'root' ? $root : ($st['els'][$pid]['n'] ?? null);
        if (!$parent) {
            continue;
        }
        $cur = [];
        foreach ($st['els'] as $id => $e) {
            $id = (string)$id;
            if ($e['pid'] === $pid && $e['n']->parentNode === $parent) {
                $cur[$id] = $e;
            }
        }
        $wanted = [];
        foreach ($list as $item) {
            [$id, $sig] = explode(':', $item);
            if (isset($cur[$id]) && $cur[$id]['sig'] === $sig && !isset($wanted[$id])) {
                $wanted[$id] = $cur[$id]['n'];
            }
        }
        foreach ($cur as $id => $e) {
            if (!isset($wanted[$id])) {
                $wanted[$id] = $e['n'];
            }
        }
        $slots = array_values(array_map(fn($e) => $e['n'], $cur));
        $order = array_values($wanted);
        $marks = [];
        foreach ($slots as $k => $n) {
            $marks[$k] = $parent->insertBefore($doc->createComment('m'), $n);
        }
        foreach ($order as $k => $n) {
            $parent->insertBefore($n, $marks[$k]);
        }
        foreach ($marks as $mk) {
            $parent->removeChild($mk);
        }
    }
    // blocs masqués
    $hiddenIds = [];
    foreach ($ov['hidden'] as $id => $sig) {
        $id = (string)$id;
        if (isset($st['els'][$id]) && $st['els'][$id]['sig'] === $sig) {
            $hiddenIds[(string)$id] = true;
        }
    }

    if ($edit) {
        foreach ($st['els'] as $id => $e) {
            $id = (string)$id;
            $n = $e['n'];
            $n->setAttribute('data-sc', $id);
            $n->setAttribute('data-sc-pid', $e['pid']);
            $n->setAttribute('data-sc-sig', $e['sig']);
            if (isset($hiddenIds[$id])) {
                $n->setAttribute('data-sc-hid', '1');
            }
        }
        foreach ($st['texts'] as $id => $u) {
            $id = (string)$id;
            if ($u['kind'] === 'leaf') {
                $u['n']->setAttribute('data-sc-e', $id);
                $u['n']->setAttribute('data-sc-h', cms_h($u['orig']));
            } else {
                $span = $doc->createElement('span');
                $span->setAttribute('data-sc-t', (string)$id);
                $span->setAttribute('data-sc-h', cms_h($u['orig']));
                $u['n']->parentNode->replaceChild($span, $u['n']);
                $span->appendChild($u['n']);
            }
        }
        foreach ($st['imgs'] as $id => $u) {
            $u['n']->setAttribute('data-sc-img', cms_h($u['orig']));
        }
        foreach ($st['bgs'] as $id => $u) {
            $u['n']->setAttribute('data-sc-bg', cms_h($u['orig']));
        }
    } else {
        foreach (array_keys($hiddenIds) as $id) {
            $n = $st['els'][$id]['n'];
            if ($n->parentNode) {
                $n->parentNode->removeChild($n);
            }
        }
    }

    $out = '';
    foreach ($root->childNodes as $c) {
        $out .= $doc->saveHTML($c);
    }
    foreach ($scripts as $i => $s) {
        $out = str_replace('<!--SC_BLOCK_' . $i . '-->', $s, $out);
    }
    $html = substr($html, 0, $m[2][1]) . $out . substr($html, $m[2][1] + strlen($m[2][0]));

    if ($edit) {
        header('Cache-Control: no-store');
        $state = json_encode(['page' => $page, 'ov' => cms_as_objects($ov)], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);
        $inject = '<style id="sc-style">'
            . '[data-sc-hid]{opacity:.28!important;outline:2px dashed #b45309!important;outline-offset:-2px}'
            . '.sc-ed{outline:1px dashed rgba(108,34,18,.45);outline-offset:2px;cursor:text}.sc-ed:hover{outline-color:#6c2212;background:rgba(253,194,104,.18)}.sc-ed:focus{outline:2px solid #6c2212;background:rgba(253,194,104,.28);white-space:pre-wrap}'
            . '.sc-img{outline:2px dashed rgba(128,86,0,.6);outline-offset:-2px;cursor:pointer}'
            . '.sc-hover{outline:2px solid #2563eb!important;outline-offset:-2px;cursor:crosshair!important}.sc-sel{outline:3px solid #dc2626!important;outline-offset:-3px}'
            . '</style><script>window.SC=' . $state . ';</script><script src="assets/js/editor.js"></script>';
        $html = preg_replace('~</body>~i', $inject . '</body>', $html, 1);
    }
    return $html;
}
