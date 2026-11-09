<?php
declare(strict_types=1);
require __DIR__ . '/_boot.php';
require __DIR__ . '/../inc/media.php';
require_login();

function delete_upload_if_orphan(string $path, array $products): void
{
    if (!str_starts_with($path, UPLOAD_URL) || basename($path) !== substr($path, strlen(UPLOAD_URL))) {
        return; // jamais supprimer hors du dossier d'uploads
    }
    foreach ($products as $p) {
        if (($p['image'] ?? '') === $path) {
            return;
        }
    }
    @unlink(UPLOAD_DIR . '/' . basename($path));
}

function clip(mixed $v, int $max): string
{
    return mb_substr(trim((string)$v), 0, $max);
}

function parse_specs(string $raw): array
{
    $specs = [];
    foreach (preg_split('/\R/', $raw) ?: [] as $line) {
        if (!str_contains($line, '|')) {
            continue;
        }
        [$k, $v] = array_map('trim', explode('|', $line, 2));
        if ($k !== '' && $v !== '' && count($specs) < 5) {
            $specs[] = [mb_substr($k, 0, 40), mb_substr($v, 0, 80)];
        }
    }
    return $specs;
}

$settings = load_settings();
$products = load_products();
$catSlugs = array_column($settings['categories'], 0);
$catLabels = array_column($settings['categories'], 1, 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $action = (string)($_POST['action'] ?? '');
    $id = (string)($_POST['id'] ?? '');
    $idx = null;
    foreach ($products as $i => $p) {
        if ($p['id'] === $id) {
            $idx = $i;
        }
    }

    switch ($action) {
        case 'save':
            $err = '';
            $title = clip($_POST['title'] ?? '', 120);
            $price = filter_var($_POST['price'] ?? '', FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 100000000]]);
            $rating = clip($_POST['rating'] ?? '', 3);
            if ($title === '' || $price === false) {
                flash('Le nom et un prix valide (en FCFA, nombre entier) sont obligatoires.', 'err');
                redirect($idx === null ? 'catalogue.php?new=1' : 'catalogue.php?edit=' . urlencode($id));
            }
            if ($rating !== '' && !preg_match('/^[0-5](\.\d)?$/', $rating)) {
                $rating = '';
            }
            $cats = array_values(array_intersect($catSlugs, (array)($_POST['categories'] ?? [])));
            $stock = in_array($_POST['stock'] ?? '', ['ok', 'low', 'out'], true) ? $_POST['stock'] : 'ok';
            $new = [
                'id' => $idx === null ? 'p' . bin2hex(random_bytes(4)) : $id,
                'categories' => $cats,
                'image' => $idx === null ? '' : $products[$idx]['image'],
                'badge' => clip($_POST['badge'] ?? '', 60),
                'tag' => clip($_POST['tag'] ?? '', 60),
                'kicker' => clip($_POST['kicker'] ?? '', 80),
                'rating' => $rating,
                'title' => $title,
                'description' => clip($_POST['description'] ?? '', 500),
                'specs' => parse_specs((string)($_POST['specs'] ?? '')),
                'price' => $price,
                'priceFrom' => !empty($_POST['priceFrom']),
                'status' => clip($_POST['status'] ?? '', 40),
                'stock' => $stock,
                'visible' => !empty($_POST['visible']),
            ];
            $uploaded = upload_image($_FILES['image'] ?? [], $err);
            if ($err !== '') {
                flash($err, 'err');
                redirect($idx === null ? 'catalogue.php?new=1' : 'catalogue.php?edit=' . urlencode($id));
            }
            $old = $new['image'];
            if ($uploaded !== null) {
                $new['image'] = $uploaded;
            }
            if ($new['image'] === '') {
                $new['image'] = 'assets/img/logo.png';
            }
            if ($idx === null) {
                $products[] = $new;
            } else {
                $products[$idx] = $new;
            }
            save_json('products', $products);
            if ($uploaded !== null && $old !== '') {
                delete_upload_if_orphan($old, $products);
            }
            flash('Produit enregistré. La vitrine est à jour.');
            redirect('catalogue.php');

        case 'delete':
            if ($idx !== null) {
                $img = $products[$idx]['image'];
                array_splice($products, $idx, 1);
                save_json('products', $products);
                delete_upload_if_orphan($img, $products);
                flash('Produit supprimé.');
            }
            redirect('catalogue.php');

        case 'toggle':
            if ($idx !== null) {
                $products[$idx]['visible'] = empty($products[$idx]['visible']);
                save_json('products', $products);
            }
            redirect('catalogue.php');

        case 'move':
            $to = ($_POST['dir'] ?? '') === 'up' ? -1 : 1;
            if ($idx !== null && isset($products[$idx + $to])) {
                [$products[$idx], $products[$idx + $to]] = [$products[$idx + $to], $products[$idx]];
                save_json('products', $products);
            }
            redirect('catalogue.php');

        case 'bulk':
            $pct = filter_var($_POST['percent'] ?? '', FILTER_VALIDATE_FLOAT);
            if ($pct === false || $pct < -90 || $pct > 300 || $pct == 0) {
                flash('Pourcentage invalide (entre -90 et 300, différent de 0).', 'err');
                redirect('catalogue.php');
            }
            foreach ($products as &$p) {
                $p['price'] = max(0, (int)(round($p['price'] * (1 + $pct / 100) / 100) * 100));
            }
            unset($p);
            save_json('products', $products);
            flash(sprintf('Tous les prix ont été ajustés de %+g %% (arrondis à 100 FCFA).', $pct));
            redirect('catalogue.php');

        case 'rate':
            $rate = filter_var($_POST['eur_rate'] ?? '', FILTER_VALIDATE_FLOAT);
            if ($rate === false || $rate < 100 || $rate > 2000) {
                flash('Taux invalide (FCFA pour 1 €, entre 100 et 2000).', 'err');
            } else {
                $saved = load_json('settings');
                $saved['eur_rate'] = $rate;
                save_json('settings', $saved);
                flash('Taux de change mis à jour.');
            }
            redirect('catalogue.php');
    }
    redirect('catalogue.php');
}

$editing = null;
if (isset($_GET['edit'])) {
    foreach ($products as $p) {
        if ($p['id'] === (string)$_GET['edit']) {
            $editing = $p;
        }
    }
}
$isNew = isset($_GET['new']);
$rate = (float)$settings['eur_rate'];
$visibleCount = count(array_filter($products, fn($p) => !empty($p['visible'])));
$avg = $products ? (int)round(array_sum(array_column($products, 'price')) / count($products)) : 0;

admin_head('Catalogue & tarification', 'catalogue');

if ($editing || $isNew):
    $p = $editing ?? ['id' => '', 'categories' => [], 'image' => '', 'badge' => '', 'tag' => '', 'kicker' => '', 'rating' => '', 'title' => '', 'description' => '', 'specs' => [], 'price' => 0, 'priceFrom' => false, 'status' => '', 'stock' => 'ok', 'visible' => true];
    $specsText = implode("\n", array_map(fn($s) => $s[0] . ' | ' . $s[1], $p['specs']));
    ?>
<a href="catalogue.php" class="inline-flex items-center gap-1 text-primary font-label-lg text-label-lg mb-4"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Retour au catalogue</a>
<h1 class="font-headline-md text-headline-md text-primary mb-6"><?= $editing ? 'Modifier : ' . e($p['title']) : 'Ajouter un encensoir' ?></h1>
<form method="post" enctype="multipart/form-data" class="grid grid-cols-1 xl:grid-cols-3 gap-6">
  <?= csrf_field() ?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= e($p['id']) ?>">
  <div class="xl:col-span-2 space-y-4 bg-surface-container-lowest rounded-xl p-6 shadow-sm">
    <label class="block"><span class="<?= LABEL ?>">Nom du produit *</span><input name="title" required maxlength="120" value="<?= e($p['title']) ?>" class="<?= INPUT ?>"></label>
    <label class="block"><span class="<?= LABEL ?>">Description</span><textarea name="description" rows="4" maxlength="500" class="<?= INPUT ?>"><?= e($p['description']) ?></textarea></label>
    <label class="block"><span class="<?= LABEL ?>">Caractéristiques (une par ligne : Libellé | Valeur)</span><textarea name="specs" rows="4" class="<?= INPUT ?> font-mono text-sm" placeholder="Matière | Argile rouge réfractaire"><?= e($specsText) ?></textarea></label>
    <div class="grid sm:grid-cols-3 gap-4">
      <label class="block"><span class="<?= LABEL ?>">Étiquette haut (badge)</span><input name="badge" maxlength="60" value="<?= e($p['badge']) ?>" class="<?= INPUT ?>"></label>
      <label class="block"><span class="<?= LABEL ?>">Étiquette bas</span><input name="tag" maxlength="60" value="<?= e($p['tag']) ?>" class="<?= INPUT ?>"></label>
      <label class="block"><span class="<?= LABEL ?>">Sur-titre</span><input name="kicker" maxlength="80" value="<?= e($p['kicker']) ?>" class="<?= INPUT ?>"></label>
    </div>
    <fieldset><legend class="<?= LABEL ?>">Catégories (filtres de la vitrine)</legend><div class="flex flex-wrap gap-3">
      <?php foreach ($settings['categories'] as [$slug, $label]): ?><label class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-surface-container"><input type="checkbox" name="categories[]" value="<?= e($slug) ?>" <?= in_array($slug, $p['categories'], true) ? 'checked' : '' ?> class="accent-primary"><span class="font-body-sm text-body-sm"><?= e($label) ?></span></label><?php endforeach; ?>
    </div></fieldset>
  </div>
  <div class="space-y-4">
    <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm space-y-4">
      <h2 class="font-title-lg text-title-lg text-primary">Tarif</h2>
      <label class="block"><span class="<?= LABEL ?>">Prix (FCFA) *</span><input id="priceInput" type="number" name="price" min="0" step="100" required value="<?= (int)$p['price'] ?>" class="<?= INPUT ?>"></label>
      <p class="font-body-sm text-body-sm text-on-surface-variant">Équivalent : <strong id="eurPreview"><?= e(eur((int)$p['price'], $rate)) ?></strong> (taux <?= e((string)$rate) ?>)</p>
      <label class="inline-flex items-center gap-2"><input type="checkbox" name="priceFrom" <?= $p['priceFrom'] ? 'checked' : '' ?> class="accent-primary"><span class="font-body-sm text-body-sm">Afficher « À partir de »</span></label>
      <label class="block"><span class="<?= LABEL ?>">Mention de disponibilité</span><input name="status" maxlength="40" value="<?= e($p['status']) ?>" class="<?= INPUT ?>" placeholder="En stock atelier"></label>
      <label class="block"><span class="<?= LABEL ?>">Niveau de stock</span><select name="stock" class="<?= INPUT ?>"><?php foreach (['ok' => 'Disponible', 'low' => 'Faible stock (en rouge)', 'out' => 'Épuisé'] as $v => $l): ?><option value="<?= $v ?>" <?= ($p['stock'] ?? 'ok') === $v ? 'selected' : '' ?>><?= $l ?></option><?php endforeach; ?></select></label>
      <label class="block"><span class="<?= LABEL ?>">Note (0 à 5, ex. 4.8)</span><input name="rating" maxlength="3" value="<?= e($p['rating']) ?>" class="<?= INPUT ?>"></label>
      <label class="inline-flex items-center gap-2"><input type="checkbox" name="visible" <?= !empty($p['visible']) ? 'checked' : '' ?> class="accent-primary"><span class="font-body-sm text-body-sm">Visible sur la vitrine</span></label>
    </div>
    <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm space-y-3">
      <h2 class="font-title-lg text-title-lg text-primary">Photo</h2>
      <?php if ($p['image']): ?><img src="../<?= e($p['image']) ?>" alt="" class="w-full aspect-[4/3] object-cover rounded-lg"><?php endif; ?>
      <input type="file" name="image" accept="image/jpeg,image/png,image/webp" class="block w-full font-body-sm text-body-sm">
      <p class="font-label-sm text-label-sm text-outline">JPEG, PNG ou WebP — 5 Mo maximum. Laissez vide pour garder la photo actuelle.</p>
    </div>
    <div class="flex gap-3"><button class="<?= BTN ?> flex-1">Enregistrer</button><a href="catalogue.php" class="<?= BTN2 ?>">Annuler</a></div>
  </div>
</form>
<script>
  const rate = <?= json_encode($rate) ?>, pi = document.getElementById('priceInput'), ep = document.getElementById('eurPreview');
  pi.addEventListener('input', () => { ep.textContent = '~ ' + Math.round((+pi.value || 0) / rate).toLocaleString('fr-FR') + ' €'; });
</script>
<?php else: ?>
<div class="flex flex-wrap items-end justify-between gap-4 mb-6">
  <div><p class="font-label-md text-label-md text-secondary uppercase tracking-widest">Atelier &amp; tarifs</p>
  <h1 class="font-headline-md text-headline-md text-primary">Catalogue &amp; Tarification</h1></div>
  <a href="catalogue.php?new=1" class="<?= BTN ?>"><span class="material-symbols-outlined text-[18px]">add</span>Ajouter un encensoir</a>
</div>
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
  <?php foreach ([['Total modèles', (string)count($products), 'inventory_2'], ['Visibles en ligne', (string)$visibleCount, 'visibility'], ['Prix moyen', fcfa($avg), 'payments'], ['Taux de change', '1 € = ' . number_format($rate, 2, ',', ' ') . ' FCFA', 'currency_exchange']] as [$l, $v, $ic]): ?>
    <div class="bg-surface-container-lowest rounded-xl p-4 shadow-sm"><div class="flex items-center justify-between"><span class="font-label-sm text-label-sm text-outline uppercase tracking-wider"><?= e($l) ?></span><span class="material-symbols-outlined text-primary text-[20px]"><?= e($ic) ?></span></div><p class="font-headline-sm text-headline-sm text-on-surface mt-2"><?= e($v) ?></p></div>
  <?php endforeach; ?>
</div>
<div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden mb-8">
  <div class="p-4 flex flex-wrap gap-3 items-center border-b border-outline-variant/30">
    <input id="q" type="search" placeholder="Rechercher un modèle…" class="<?= INPUT ?> max-w-xs">
    <select id="cat" class="<?= INPUT ?> max-w-xs"><option value="">Toutes catégories</option><?php foreach ($settings['categories'] as [$slug, $label]): ?><option value="<?= e($slug) ?>"><?= e($label) ?></option><?php endforeach; ?></select>
  </div>
  <div class="overflow-x-auto"><table class="w-full text-left">
    <thead class="bg-surface-container-low font-label-sm text-label-sm text-outline uppercase tracking-wider"><tr><th class="p-3">Pièce</th><th class="p-3">Catégories</th><th class="p-3">Prix</th><th class="p-3">Stock</th><th class="p-3">En ligne</th><th class="p-3 text-right">Actions</th></tr></thead>
    <tbody id="rows"><?php foreach ($products as $i => $p): ?>
      <tr class="border-t border-outline-variant/30 prod-row" data-name="<?= e(mb_strtolower($p['title'])) ?>" data-cats="<?= e(implode(' ', $p['categories'])) ?>">
        <td class="p-3"><div class="flex items-center gap-3"><img src="../<?= e($p['image']) ?>" alt="" class="w-12 h-12 rounded-lg object-cover bg-surface-container"><div><p class="font-title-md text-title-md"><?= e($p['title']) ?></p><p class="font-label-sm text-label-sm text-outline"><?= e($p['badge']) ?></p></div></div></td>
        <td class="p-3 font-body-sm text-body-sm text-on-surface-variant"><?= e(implode(', ', array_map(fn($c) => $catLabels[$c] ?? $c, $p['categories']))) ?></td>
        <td class="p-3 whitespace-nowrap"><p class="font-title-md text-title-md text-primary"><?= $p['priceFrom'] ? 'dès ' : '' ?><?= e(fcfa((int)$p['price'])) ?></p><p class="font-label-sm text-label-sm text-outline"><?= e(eur((int)$p['price'], $rate)) ?></p></td>
        <td class="p-3"><span class="px-2 py-0.5 rounded font-label-sm text-label-sm <?= ($p['stock'] ?? 'ok') === 'ok' ? 'bg-secondary-fixed/60 text-on-secondary-fixed' : 'bg-error-container text-on-error-container' ?>"><?= e(['ok' => 'Disponible', 'low' => 'Faible', 'out' => 'Épuisé'][$p['stock'] ?? 'ok']) ?></span></td>
        <td class="p-3"><form method="post"><?= csrf_field() ?><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= e($p['id']) ?>"><button title="Afficher / masquer" class="material-symbols-outlined <?= !empty($p['visible']) ? 'text-primary' : 'text-outline' ?>"><?= !empty($p['visible']) ? 'visibility' : 'visibility_off' ?></button></form></td>
        <td class="p-3"><div class="flex items-center justify-end gap-1">
          <?php foreach (['up' => ['arrow_upward', $i > 0], 'down' => ['arrow_downward', $i < count($products) - 1]] as $dir => [$ic, $ok]): ?>
            <form method="post"><?= csrf_field() ?><input type="hidden" name="action" value="move"><input type="hidden" name="id" value="<?= e($p['id']) ?>"><input type="hidden" name="dir" value="<?= $dir ?>"><button <?= $ok ? '' : 'disabled' ?> title="Déplacer" class="material-symbols-outlined text-[20px] p-1 <?= $ok ? 'text-on-surface-variant hover:text-primary' : 'text-outline-variant' ?>"><?= $ic ?></button></form>
          <?php endforeach; ?>
          <a href="catalogue.php?edit=<?= urlencode($p['id']) ?>" class="<?= BTN2 ?> !py-1.5">Modifier</a>
          <form method="post" onsubmit="return confirm('Supprimer définitivement « <?= e(addslashes($p['title'])) ?> » ?')"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= e($p['id']) ?>"><button title="Supprimer" class="material-symbols-outlined text-[20px] p-1 text-error hover:bg-error-container/40 rounded">delete</button></form>
        </div></td>
      </tr><?php endforeach; ?>
      <?php if (!$products): ?><tr><td colspan="6" class="p-8 text-center text-on-surface-variant">Aucun produit. Ajoutez votre premier encensoir.</td></tr><?php endif; ?>
    </tbody></table></div>
</div>
<div class="grid md:grid-cols-2 gap-6">
  <form method="post" class="bg-surface-container-low rounded-xl p-6 space-y-3"><?= csrf_field() ?><input type="hidden" name="action" value="bulk">
    <h2 class="font-title-lg text-title-lg text-primary">Ajustement en masse</h2>
    <p class="font-body-sm text-body-sm text-on-surface-variant">Augmente ou réduit tous les prix (ex. 10 ou -15). Arrondi à 100 FCFA.</p>
    <div class="flex gap-2"><input type="number" name="percent" step="0.5" min="-90" max="300" required placeholder="% (ex. -10)" class="<?= INPUT ?>"><button class="<?= BTN ?>" onclick="return confirm('Appliquer cet ajustement à TOUS les prix ?')">Appliquer</button></div>
  </form>
  <form method="post" class="bg-surface-container-low rounded-xl p-6 space-y-3"><?= csrf_field() ?><input type="hidden" name="action" value="rate">
    <h2 class="font-title-lg text-title-lg text-primary">Taux de change</h2>
    <p class="font-body-sm text-body-sm text-on-surface-variant">Nombre de FCFA pour 1 € (utilisé pour l'équivalent en euros affiché sur la vitrine).</p>
    <div class="flex gap-2"><input type="number" name="eur_rate" step="0.001" min="100" max="2000" required value="<?= e((string)$rate) ?>" class="<?= INPUT ?>"><button class="<?= BTN ?>">Enregistrer</button></div>
  </form>
</div>
<script>
  const q = document.getElementById('q'), c = document.getElementById('cat');
  function f() { document.querySelectorAll('.prod-row').forEach(r => { r.style.display = r.dataset.name.includes(q.value.toLowerCase()) && (!c.value || r.dataset.cats.split(' ').includes(c.value)) ? '' : 'none'; }); }
  q.addEventListener('input', f); c.addEventListener('change', f);
</script>
<?php endif;
admin_foot();
