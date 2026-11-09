<?php
declare(strict_types=1);
require __DIR__ . '/_boot.php';
require __DIR__ . '/../inc/cms.php';
require_login();

function clip(mixed $v, int $max): string
{
    return mb_substr(trim((string)$v), 0, $max);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $action = (string)($_POST['action'] ?? '');
    $saved = load_json('settings');

    if ($action === 'general') {
        $wa = preg_replace('/\D+/', '', (string)($_POST['whatsapp'] ?? ''));
        if (strlen($wa) < 8 || strlen($wa) > 15) {
            flash("Numéro WhatsApp invalide : indiquez-le avec l'indicatif pays, chiffres uniquement (ex. 221789462361).", 'err');
            redirect('index.php?tab=general');
        }
        $hours = [];
        foreach ((array)($_POST['hours_label'] ?? []) as $i => $label) {
            $label = clip($label, 40);
            $value = clip($_POST['hours_value'][$i] ?? '', 40);
            if ($label !== '' && $value !== '' && count($hours) < 6) {
                $hours[] = [$label, $value];
            }
        }
        $saved['whatsapp'] = $wa;
        $saved['phone_display'] = clip($_POST['phone_display'] ?? '', 30);
        $saved['hours'] = $hours;
        $saved['announcement'] = [
            'enabled' => !empty($_POST['ann_enabled']),
            'text' => clip($_POST['ann_text'] ?? '', 140),
            'link_label' => clip($_POST['ann_link'] ?? '', 40),
        ];
        save_json('settings', $saved) ? flash('Réglages enregistrés.') : flash('Écriture impossible dans data/.', 'err');
        redirect('index.php?tab=general');
    }

    if ($action === 'theme' || $action === 'theme_reset') {
        if ($action === 'theme_reset') {
            unset($saved['theme']);
        } else {
            $colors = [];
            $base = theme_base_colors();
            foreach (THEME_COLORS as $k => $_) {
                $v = strtolower((string)($_POST['color'][$k] ?? ''));
                if (preg_match('/^#[0-9a-f]{6}$/', $v) && $v !== strtolower($base[$k])) {
                    $colors[$k] = $v;
                }
            }
            $h = in_array($_POST['font_heading'] ?? '', THEME_FONTS_HEADING, true) ? $_POST['font_heading'] : THEME_FONTS_HEADING[0];
            $b = in_array($_POST['font_body'] ?? '', THEME_FONTS_BODY, true) ? $_POST['font_body'] : THEME_FONTS_BODY[0];
            $saved['theme'] = ['colors' => $colors, 'fonts' => ['heading' => $h, 'body' => $b]];
        }
        save_json('settings', $saved) ? flash('Thème appliqué à tout le site.') : flash('Écriture impossible dans data/.', 'err');
        redirect('index.php?tab=theme');
    }

    if ($action === 'password') {
        $cur = (string)($_POST['current'] ?? '');
        $new = (string)($_POST['new'] ?? '');
        if (!password_verify($cur, (string)admin_hash())) {
            flash('Mot de passe actuel incorrect.', 'err');
        } elseif (mb_strlen($new) < 10 || $new !== (string)($_POST['new2'] ?? '')) {
            flash('Nouveau mot de passe : 10 caractères minimum, identique dans les deux champs.', 'err');
        } else {
            save_json('admin', ['hash' => password_hash($new, PASSWORD_DEFAULT), 'updated' => date('c')]);
            session_regenerate_id(true);
            flash('Mot de passe modifié.');
        }
        redirect('index.php?tab=general');
    }
    redirect('index.php');
}

$S = load_settings();
$theme = theme_values();
$baseColors = theme_base_colors();
$tab = in_array($_GET['tab'] ?? '', ['edit', 'theme', 'general'], true) ? $_GET['tab'] : 'edit';
$hours = $S['hours'];
while (count($hours) < 4) {
    $hours[] = ['', ''];
}
$startPage = isset(CMS_PAGES[$_GET['page'] ?? '']) ? $_GET['page'] : 'index';
admin_head("Studio d'édition", 'studio');
?>
<style>
  .sc-tab[aria-selected=true]{background:#8a3826;color:#fff}
  .sc-seg[aria-pressed=true]{background:#8a3826;color:#fff}
  .sc-side-tab[aria-selected=true]{border-color:#6c2212;color:#6c2212}
</style>

<div class="flex flex-wrap items-end justify-between gap-3 mb-4">
  <div><p class="font-label-md text-label-md text-secondary uppercase tracking-widest">Atelier digital</p>
  <h1 class="font-headline-md text-headline-md text-primary">Studio d'édition</h1></div>
  <div class="flex items-center gap-2">
    <span id="dirtyBadge" class="hidden px-2 py-1 rounded bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm">Modifications non publiées</span>
    <button id="btnReset" type="button" class="<?= BTN2 ?>" title="Supprimer toutes les modifications de cette page"><span class="material-symbols-outlined text-[18px]">restart_alt</span><span class="hidden md:inline">Réinitialiser la page</span></button>
    <button id="btnSave" type="button" class="<?= BTN ?> disabled:opacity-40" disabled><span class="material-symbols-outlined text-[18px]">cloud_upload</span>Publier</button>
  </div>
</div>

<div class="flex flex-wrap items-center gap-3 mb-4">
  <div id="pageTabs" class="flex flex-wrap gap-1 p-1 rounded-lg bg-surface-container" role="tablist">
    <?php foreach (CMS_PAGES as $key => $label): ?><button type="button" role="tab" data-page="<?= e($key) ?>" aria-selected="<?= $key === $startPage ? 'true' : 'false' ?>" class="sc-tab px-3 py-1.5 rounded-md font-label-lg text-label-lg"><?= e($label) ?></button><?php endforeach; ?>
  </div>
  <div class="flex gap-1 p-1 rounded-lg bg-surface-container" role="group" aria-label="Mode d'édition">
    <button type="button" data-mode="text" aria-pressed="true" class="sc-seg px-3 py-1.5 rounded-md font-label-lg text-label-lg flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">edit_note</span>Textes &amp; images</button>
    <button type="button" data-mode="blocks" aria-pressed="false" class="sc-seg px-3 py-1.5 rounded-md font-label-lg text-label-lg flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">view_agenda</span>Blocs &amp; disposition</button>
    <button type="button" data-mode="nav" aria-pressed="false" class="sc-seg px-3 py-1.5 rounded-md font-label-lg text-label-lg flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">ads_click</span>Naviguer</button>
  </div>
  <div class="flex gap-1 p-1 rounded-lg bg-surface-container ml-auto" role="group" aria-label="Taille de l'aperçu">
    <button type="button" data-w="100%" aria-pressed="true" class="sc-dev sc-seg px-3 py-1.5 rounded-md font-label-lg text-label-lg flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">desktop_windows</span><span class="hidden sm:inline">Ordinateur</span></button>
    <button type="button" data-w="390px" aria-pressed="false" class="sc-dev sc-seg px-3 py-1.5 rounded-md font-label-lg text-label-lg flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">smartphone</span><span class="hidden sm:inline">Mobile</span></button>
  </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_22rem] gap-5">
  <div class="bg-surface-container-high rounded-xl p-2 min-w-0">
    <div class="flex justify-center"><iframe id="frame" title="Aperçu éditable" src="about:blank" style="width:100%;height:78vh" class="bg-surface rounded-lg border border-outline-variant/40 transition-all"></iframe></div>
  </div>

  <aside class="space-y-4">
    <div class="flex border-b border-outline-variant/40" role="tablist">
      <?php foreach (['edit' => 'Édition', 'theme' => 'Thème', 'general' => 'Général'] as $k => $l): ?><button type="button" role="tab" data-side="<?= $k ?>" aria-selected="<?= $k === $tab ? 'true' : 'false' ?>" class="sc-side-tab flex-1 px-3 py-2 border-b-2 border-transparent font-label-lg text-label-lg text-on-surface-variant"><?= $l ?></button><?php endforeach; ?>
    </div>

    <section data-panel="edit" class="<?= $tab === 'edit' ? '' : 'hidden' ?> space-y-4">
      <div id="helpText" class="p-4 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface-variant space-y-2"></div>
      <div id="blockPanel" class="hidden p-4 rounded-xl bg-surface-container-lowest shadow-sm space-y-3">
        <p class="<?= LABEL ?> !mb-0">Bloc sélectionné</p>
        <p id="selLabel" class="font-body-sm text-body-sm break-words">Cliquez sur un élément de l'aperçu.</p>
        <div class="grid grid-cols-2 gap-2">
          <button type="button" data-cmd="parent" class="<?= BTN2 ?>"><span class="material-symbols-outlined text-[18px]">north_west</span>Bloc parent</button>
          <button type="button" data-cmd="hide" class="<?= BTN2 ?>"><span class="material-symbols-outlined text-[18px]">visibility_off</span><span id="hideLabel">Masquer</span></button>
          <button type="button" data-cmd="up" class="<?= BTN2 ?>"><span class="material-symbols-outlined text-[18px]">arrow_upward</span>Monter</button>
          <button type="button" data-cmd="down" class="<?= BTN2 ?>"><span class="material-symbols-outlined text-[18px]">arrow_downward</span>Descendre</button>
        </div>
      </div>
      <p id="productsNote" class="hidden p-3 rounded-lg bg-secondary-fixed text-on-secondary-fixed font-body-sm text-body-sm">Les fiches produits (noms, prix, photos) se gèrent dans <a class="underline font-semibold" href="catalogue.php">Catalogue &amp; tarifs</a>.</p>
    </section>

    <section data-panel="theme" class="<?= $tab === 'theme' ? '' : 'hidden' ?>">
      <form method="post" class="space-y-3"><?= csrf_field() ?><input type="hidden" name="action" value="theme">
        <p class="font-body-sm text-body-sm text-on-surface-variant">Les couleurs et polices s'appliquent à <strong>toutes</strong> les pages du site.</p>
        <?php foreach (THEME_COLORS as $k => $label): $val = $theme['colors'][$k] ?? $baseColors[$k]; ?>
          <label class="flex items-center justify-between gap-3 p-2 rounded-lg bg-surface-container-low"><span class="font-body-sm text-body-sm"><?= e($label) ?></span><input type="color" name="color[<?= e($k) ?>]" value="<?= e($val) ?>" class="w-12 h-9 rounded cursor-pointer border border-outline-variant bg-transparent"></label>
        <?php endforeach; ?>
        <label class="block"><span class="<?= LABEL ?>">Police des titres</span><select name="font_heading" class="<?= INPUT ?>"><?php foreach (THEME_FONTS_HEADING as $f): ?><option <?= $f === $theme['heading'] ? 'selected' : '' ?>><?= e($f) ?></option><?php endforeach; ?></select></label>
        <label class="block"><span class="<?= LABEL ?>">Police du texte</span><select name="font_body" class="<?= INPUT ?>"><?php foreach (THEME_FONTS_BODY as $f): ?><option <?= $f === $theme['body'] ? 'selected' : '' ?>><?= e($f) ?></option><?php endforeach; ?></select></label>
        <div class="flex gap-2"><button class="<?= BTN ?> flex-1">Appliquer</button><button name="action" value="theme_reset" class="<?= BTN2 ?>" onclick="return confirm('Revenir aux couleurs et polices d\'origine ?')">Défaut</button></div>
      </form>
    </section>

    <section data-panel="general" class="<?= $tab === 'general' ? '' : 'hidden' ?> space-y-5">
      <form method="post" class="space-y-3"><?= csrf_field() ?><input type="hidden" name="action" value="general">
        <h2 class="font-title-lg text-title-lg text-primary">WhatsApp, contact &amp; horaires</h2>
        <label class="block"><span class="<?= LABEL ?>">Numéro WhatsApp (avec indicatif)</span><input name="whatsapp" inputmode="numeric" required value="<?= e($S['whatsapp']) ?>" class="<?= INPUT ?>"></label>
        <label class="block"><span class="<?= LABEL ?>">Téléphone affiché</span><input name="phone_display" maxlength="30" value="<?= e($S['phone_display']) ?>" class="<?= INPUT ?>"></label>
        <p class="<?= LABEL ?> !mb-0 pt-1">Horaires (pied de page)</p>
        <?php foreach ($hours as $hr): ?><div class="grid grid-cols-2 gap-2"><input name="hours_label[]" maxlength="40" value="<?= e($hr[0]) ?>" placeholder="Jour(s)" class="<?= INPUT ?>"><input name="hours_value[]" maxlength="40" value="<?= e($hr[1]) ?>" placeholder="09h00 – 19h00" class="<?= INPUT ?>"></div><?php endforeach; ?>
        <h3 class="font-title-md text-title-md text-primary pt-2">Bandeau d'annonce</h3>
        <label class="inline-flex items-center gap-2"><input type="checkbox" name="ann_enabled" <?= !empty($S['announcement']['enabled']) ? 'checked' : '' ?> class="accent-primary"><span class="font-body-sm text-body-sm">Afficher en haut de toutes les pages</span></label>
        <input name="ann_text" maxlength="140" value="<?= e($S['announcement']['text']) ?>" placeholder="Message" class="<?= INPUT ?>">
        <input name="ann_link" maxlength="40" value="<?= e($S['announcement']['link_label']) ?>" placeholder="Texte du lien WhatsApp" class="<?= INPUT ?>">
        <button class="<?= BTN ?> w-full">Enregistrer</button>
      </form>
      <form method="post" class="space-y-3 pt-4 border-t border-outline-variant/40"><?= csrf_field() ?><input type="hidden" name="action" value="password">
        <h2 class="font-title-lg text-title-lg text-primary">Mot de passe</h2>
        <input type="password" name="current" required autocomplete="current-password" placeholder="Mot de passe actuel" class="<?= INPUT ?>">
        <input type="password" name="new" required minlength="10" autocomplete="new-password" placeholder="Nouveau (10 car. min.)" class="<?= INPUT ?>">
        <input type="password" name="new2" required minlength="10" autocomplete="new-password" placeholder="Confirmer" class="<?= INPUT ?>">
        <button class="<?= BTN2 ?> w-full">Modifier</button>
      </form>
    </section>
  </aside>
</div>

<!-- Médiathèque -->
<div id="mediaModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center p-4" role="dialog" aria-modal="true" aria-label="Choisir une image">
  <div class="bg-surface rounded-xl shadow-2xl w-full max-w-3xl max-h-[85vh] flex flex-col">
    <div class="p-4 flex items-center justify-between border-b border-outline-variant/40"><h2 class="font-title-lg text-title-lg text-primary">Choisir une image</h2><button type="button" id="mediaClose" class="material-symbols-outlined" aria-label="Fermer">close</button></div>
    <div class="p-4 border-b border-outline-variant/40 flex flex-wrap items-center gap-3"><input type="file" id="mediaFile" accept="image/jpeg,image/png,image/webp" class="font-body-sm text-body-sm"><span id="mediaMsg" class="font-body-sm text-body-sm text-on-surface-variant">JPEG, PNG ou WebP — 5 Mo max.</span></div>
    <div id="mediaGrid" class="p-4 overflow-y-auto grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3"></div>
  </div>
</div>

<script>
(function () {
  const CSRF = <?= json_encode(csrf()) ?>;
  const frame = document.getElementById('frame');
  const btnSave = document.getElementById('btnSave');
  const badge = document.getElementById('dirtyBadge');
  let page = <?= json_encode($startPage) ?>, mode = 'text', dirty = false, pickId = null, stateResolve = null;

  const HELP = {
    text: '<p><strong>Textes :</strong> cliquez sur n\'importe quel texte de l\'aperçu (cadre pointillé) et tapez directement.</p><p><strong>Images :</strong> cliquez sur une photo pour la remplacer ou en téléverser une nouvelle.</p><p>Rien n\'est visible du public avant de cliquer sur <strong>Publier</strong>.</p>',
    blocks: '<p><strong>Disposition :</strong> cliquez sur une zone de la page (elle s\'entoure en rouge). Utilisez <em>Bloc parent</em> pour sélectionner un ensemble plus large (une section entière, une grille…), puis <em>Monter / Descendre</em> pour la déplacer ou <em>Masquer</em> pour la retirer.</p>',
    nav: '<p><strong>Navigation :</strong> les liens fonctionnent comme sur le site. En passant d\'une page à l\'autre, le Studio suit automatiquement.</p>'
  };
  const helpEl = document.getElementById('helpText');
  const blockPanel = document.getElementById('blockPanel');

  function setHelp() { helpEl.innerHTML = HELP[mode]; blockPanel.classList.toggle('hidden', mode !== 'blocks'); }
  function toFrame(msg) { msg.sc = 1; if (frame.contentWindow) frame.contentWindow.postMessage(msg, location.origin); }
  function setDirty(d) { dirty = d; btnSave.disabled = !d; badge.classList.toggle('hidden', !d); }
  function load(p) {
    page = p; setDirty(false); sel(null);
    frame.src = '../' + p + '.php?sc_edit=1';
    document.querySelectorAll('#pageTabs [data-page]').forEach(b => b.setAttribute('aria-selected', b.dataset.page === p ? 'true' : 'false'));
    document.getElementById('productsNote').classList.toggle('hidden', p !== 'nos-produits');
  }
  function sel(s) {
    document.getElementById('selLabel').textContent = s ? s.label : "Cliquez sur un élément de l'aperçu.";
    document.getElementById('hideLabel').textContent = s && s.hidden ? 'Afficher' : 'Masquer';
    blockPanel.querySelectorAll('[data-cmd]').forEach(b => {
      const c = b.dataset.cmd;
      b.disabled = !s || (c === 'up' && !s.canUp) || (c === 'down' && !s.canDown) || (c === 'parent' && !s.hasParent);
      b.classList.toggle('opacity-40', b.disabled);
    });
  }

  document.querySelectorAll('#pageTabs [data-page]').forEach(b => b.addEventListener('click', () => {
    if (b.dataset.page === page && frame.src !== 'about:blank') return;
    if (dirty && !confirm('Abandonner les modifications non publiées de cette page ?')) return;
    load(b.dataset.page);
  }));
  document.querySelectorAll('[data-mode]').forEach(b => b.addEventListener('click', () => {
    mode = b.dataset.mode;
    document.querySelectorAll('[data-mode]').forEach(x => x.setAttribute('aria-pressed', x === b ? 'true' : 'false'));
    setHelp(); sel(null); toFrame({ type: 'mode', mode });
  }));
  document.querySelectorAll('.sc-dev').forEach(b => b.addEventListener('click', () => {
    frame.style.width = b.dataset.w; frame.style.maxWidth = '100%';
    document.querySelectorAll('.sc-dev').forEach(x => x.setAttribute('aria-pressed', x === b ? 'true' : 'false'));
  }));
  document.querySelectorAll('[data-side]').forEach(b => b.addEventListener('click', () => {
    document.querySelectorAll('[data-side]').forEach(x => x.setAttribute('aria-selected', x === b ? 'true' : 'false'));
    document.querySelectorAll('[data-panel]').forEach(p => p.classList.toggle('hidden', p.dataset.panel !== b.dataset.side));
  }));
  blockPanel.querySelectorAll('[data-cmd]').forEach(b => b.addEventListener('click', () => toFrame({ type: 'cmd', op: b.dataset.cmd })));

  // ── messages de l'aperçu ──
  window.addEventListener('message', e => {
    if (e.origin !== location.origin || !e.data || e.data.sc !== 1) return;
    const m = e.data;
    if (m.type === 'ready') {
      page = m.page;
      document.querySelectorAll('#pageTabs [data-page]').forEach(b => b.setAttribute('aria-selected', b.dataset.page === page ? 'true' : 'false'));
      document.getElementById('productsNote').classList.toggle('hidden', page !== 'nos-produits');
      setDirty(false); sel(null); toFrame({ type: 'mode', mode });
    } else if (m.type === 'dirty') setDirty(m.dirty);
    else if (m.type === 'select') sel(m.sel);
    else if (m.type === 'pickImage') openMedia(m.id);
    else if (m.type === 'state' && stateResolve) { stateResolve(m.ov); stateResolve = null; }
  });

  function toast(msg, err) {
    const t = document.createElement('div');
    t.className = 'fixed bottom-6 right-6 z-[60] px-4 py-3 rounded-lg shadow-lg font-body-sm text-body-sm ' + (err ? 'bg-error-container text-on-error-container' : 'bg-primary text-on-primary');
    t.textContent = msg; document.body.appendChild(t); setTimeout(() => t.remove(), 3500);
  }
  async function api(action, body) {
    const r = await fetch('api.php?action=' + action, { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': CSRF }, body: JSON.stringify(body) });
    return r.json().catch(() => ({ ok: false, error: 'Réponse invalide du serveur.' }));
  }

  btnSave.addEventListener('click', async () => {
    const ov = await new Promise(res => { stateResolve = res; toFrame({ type: 'getState' }); setTimeout(() => { if (stateResolve) { stateResolve = null; res(null); } }, 3000); });
    if (!ov) { toast("L'aperçu ne répond pas, rechargez la page.", true); return; }
    const r = await api('save_page', { page, ov });
    if (r.ok) { toFrame({ type: 'saved' }); toast('Page publiée.'); } else toast(r.error || 'Échec de la publication.', true);
  });
  document.getElementById('btnReset').addEventListener('click', async () => {
    if (!confirm('Supprimer TOUTES les modifications de la page « ' + page + ' » et revenir au contenu d\'origine ?')) return;
    const r = await api('reset_page', { page });
    if (r.ok) { load(page); toast('Page réinitialisée.'); } else toast(r.error || 'Échec.', true);
  });

  // ── médiathèque ──
  const modal = document.getElementById('mediaModal'), grid = document.getElementById('mediaGrid'), msg = document.getElementById('mediaMsg');
  async function openMedia(id) {
    pickId = id; modal.classList.remove('hidden'); modal.classList.add('flex');
    const r = await (await fetch('api.php?action=media_list')).json();
    grid.innerHTML = '';
    (r.images || []).forEach(p => {
      const b = document.createElement('button'); b.type = 'button';
      b.className = 'rounded-lg overflow-hidden border border-outline-variant/40 hover:border-primary aspect-square bg-surface-container';
      const i = document.createElement('img'); i.src = '../' + p; i.alt = ''; i.loading = 'lazy'; i.className = 'w-full h-full object-cover';
      b.appendChild(i); b.addEventListener('click', () => choose(p)); grid.appendChild(b);
    });
  }
  function closeMedia() { modal.classList.add('hidden'); modal.classList.remove('flex'); pickId = null; }
  function choose(p) { toFrame({ type: 'setImage', id: pickId, path: p }); closeMedia(); }
  document.getElementById('mediaClose').addEventListener('click', closeMedia);
  modal.addEventListener('click', e => { if (e.target === modal) closeMedia(); });
  document.getElementById('mediaFile').addEventListener('change', async e => {
    const f = e.target.files[0]; if (!f) return;
    const fd = new FormData(); fd.append('image', f); msg.textContent = 'Téléversement…';
    const r = await (await fetch('api.php?action=media_upload', { method: 'POST', headers: { 'X-CSRF-Token': CSRF }, body: fd })).json().catch(() => ({ ok: false, error: 'Erreur réseau.' }));
    e.target.value = '';
    if (r.ok) choose(r.path); else msg.textContent = r.error || 'Échec.';
  });

  setHelp(); sel(null); load(page);
  window.addEventListener('beforeunload', e => { if (dirty) { e.preventDefault(); e.returnValue = ''; } });
})();
</script>
<?php admin_foot();
