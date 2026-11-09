<?php require __DIR__ . '/inc/bootstrap.php'; require __DIR__ . '/inc/cms.php'; $products = load_products(); ob_start(); ?>
<!DOCTYPE html>

<html lang="fr"><head><meta charset="utf-8"/><title>Nos Produits — Le Sacré Céramique</title><link rel="icon" href="assets/img/logo.png"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><meta content="web_standard" name="shell-type"/><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/><link href="https://fonts.googleapis.com" rel="preconnect"/><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/><?= theme_fonts_link() ?>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/><style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com"></script><script src="assets/js/tailwind-config.php"></script></head><body class="pb-16 lg:pb-0 bg-surface font-body-md text-on-surface antialiased selection:bg-primary-fixed selection:text-on-primary-fixed"><header class="fixed top-0 w-full z-50 bg-surface/90 backdrop-blur-xl shadow-[0_1px_12px_rgba(61,36,28,0.06)]"><div class="h-20 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-gutter"><div class="flex items-center gap-space-sm"><img alt="Le Sacré Céramique" class="mix-blend-multiply h-8 w-auto object-contain" src="assets/img/logo.png"/><a class="font-title-lg text-title-lg tracking-tight text-primary hover:text-primary-container transition-colors" data-path="accueil" href="index.php">Le Sacré Céramique</a></div><nav class="hidden lg:flex items-center gap-space-xs p-1" data-active-classes="bg-primary-container text-on-primary rounded-lg shadow-sm"><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="accueil" href="index.php">Accueil</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="notre-histoire" href="notre-histoire.php">Notre Histoire</a><a aria-current="page" class="px-space-sm py-2 font-label-lg transition-colors bg-primary-container text-on-primary rounded-lg shadow-sm" data-path="nos-produits" href="nos-produits.php">Nos Produits</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="commander" href="commander.php">Commander</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="contact" href="contact.php">Contact</a></nav><div class="flex items-center gap-space-sm"><a class="inline-flex items-center gap-2 px-space-md py-2.5 bg-primary text-on-primary rounded-lg font-label-md text-label-md uppercase tracking-wider hover:bg-primary-container transition-all shadow-[0_4px_16px_rgba(108,34,18,0.2)]" href="https://wa.me/<?= e($S['whatsapp']) ?>" rel="noopener noreferrer" target="_blank"><span class="material-symbols-outlined text-[18px]">chat</span><span class="hidden sm:inline">Commander sur WhatsApp</span></a></div></div><?php if(!empty($S['announcement']['enabled'])): ?><div class="bg-primary text-on-primary text-center px-4 py-2 font-label-md text-label-md"><?= e($S['announcement']['text']) ?> <a class="underline font-semibold ml-2" href="https://wa.me/<?= e($S['whatsapp']) ?>" target="_blank" rel="noopener noreferrer"><?= e($S['announcement']['link_label']) ?> →</a></div><?php endif; ?></header><main class="overflow-x-clip w-full <?= !empty($S['announcement']['enabled']) ? 'pt-[7rem]' : 'pt-20' ?> bg-surface"><div class="flex flex-col w-full">
<!-- Top Editorial Header & Story Intro -->
<section class="w-full bg-surface-container-low px-6 lg:px-12 py-space-xl">
<div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-end justify-between gap-space-md">
<div class="max-w-2xl space-y-space-xs">
<div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-container rounded-full text-secondary font-label-sm text-label-sm uppercase tracking-widest">
<span class="material-symbols-outlined text-[15px]" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
          Catalogue Sacré • Pièces Façonnées Main
        </div>
<h1 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-primary tracking-tight">
          Nos Pièces d’Art Céramique &amp; Encensoirs
        </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
          Chaque création est modelée dans la pure tradition séculaire sénégalaise. Conçues pour accueillir les braises ardentes, le thiouraye d’exception et les résines d’Arabie, nos poteries conjuguent sacré spirituel et élégance décorative.
        </p>
</div>
<!-- Quick Trust Indicators -->
<div class="flex flex-wrap items-center gap-4 text-on-surface-variant font-label-md text-label-md">
<div class="flex items-center gap-2 bg-surface px-4 py-2 rounded-lg shadow-sm">
<span class="material-symbols-outlined text-primary text-[18px]">verified</span>
<span>Argile Cuite Haute Densité</span>
</div>
<div class="flex items-center gap-2 bg-surface px-4 py-2 rounded-lg shadow-sm">
<span class="material-symbols-outlined text-secondary text-[18px]">workspace_premium</span>
<span>Expéditions Sénégal &amp; Monde</span>
</div>
</div>
</div>
</section>
<!-- Interactive Filter Tabs -->
<section class="sticky top-20 z-30 bg-surface/95 backdrop-blur-md px-6 lg:px-12 py-4 shadow-sm">
<div class="max-w-7xl mx-auto flex items-center justify-between gap-4 overflow-x-auto no-scrollbar">
<div data-noedit class="flex items-center gap-2 min-w-max" id="categoryFilters">
<button class="filter-btn active px-4 py-2 rounded-lg font-label-md text-label-md tracking-wider uppercase bg-primary text-on-primary shadow-sm transition-all" data-filter="all">
          Tous les produits
        </button><?php foreach($S['categories'] as $c): ?><button class="filter-btn px-4 py-2 rounded-lg font-label-md text-label-md tracking-wider uppercase bg-surface-container hover:bg-surface-container-high text-on-surface-variant transition-all" data-filter="<?= e($c[0]) ?>"><?= e($c[1]) ?></button><?php endforeach; ?></div>
<!-- Quick Cart Summary Trigger -->
<button class="relative shrink-0 flex items-center gap-2 px-3.5 py-2 rounded-lg bg-surface-container-high text-primary hover:bg-primary hover:text-on-primary transition-all font-label-md text-label-md uppercase" onclick="toggleSummaryDrawer()">
<span class="material-symbols-outlined text-[18px]">shopping_bag</span>
<span class="hidden md:inline">Panier rituel</span>
<span class="w-5 h-5 rounded-full bg-primary text-on-primary text-[11px] font-bold flex items-center justify-center" id="selectedCountBadge">0</span>
</button>
</div>
</section>
<!-- Product Catalog Grid -->
<section class="max-w-7xl mx-auto px-6 lg:px-12 py-space-xl w-full">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter" id="productsGrid">
<!-- Product 1: Encensoir Sacré Majestueux Terracotta -->
<?php foreach($products as $p): if(empty($p['visible'])) continue;
   $cats=implode(' ',$p['categories']??[]); $priceTxt=($p['priceFrom']?'À partir de ':'').fcfa((int)$p['price']);
   $stockCls=($p['stock']??'ok')==='low'?'text-error bg-error-container/40':'text-secondary bg-secondary-fixed/50';
   $msg='Bonjour, je souhaite commander '.$p['title'].' ('.$priceTxt.')'; ?>
<article class="product-item group bg-surface-container-lowest rounded-xl flex flex-col justify-between overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" data-category="<?= e($cats) ?>" data-id="<?= e($p['id']) ?>">
<div class="relative bg-surface-container-low overflow-hidden aspect-[4/3] flex items-center justify-center">
<img alt="<?= e($p['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="<?= e($p['image']) ?>" loading="lazy"/>
<?php if($p['badge']!==''): ?><div class="absolute top-3 left-3 flex flex-col gap-1.5"><span class="px-2.5 py-1 bg-surface/90 backdrop-blur text-primary font-label-sm text-label-sm uppercase rounded shadow-sm"><?= e($p['badge']) ?></span></div><?php endif; ?>
<?php if($p['tag']!==''): ?><div class="absolute bottom-3 right-3"><span class="px-2.5 py-1 bg-primary text-on-primary font-label-sm text-label-sm tracking-widest rounded shadow"><?= e($p['tag']) ?></span></div><?php endif; ?>
</div>
<div class="p-6 flex flex-col flex-1 justify-between gap-4">
<div>
<div class="flex items-center justify-between text-secondary font-label-sm text-label-sm uppercase tracking-wider mb-1"><span><?= e($p['kicker']) ?></span><?php if($p['rating']!==''): ?><span class="flex items-center gap-1 font-bold text-on-surface">★ <?= e($p['rating']) ?></span><?php endif; ?></div>
<h2 class="font-headline-sm text-headline-sm text-on-surface group-hover:text-primary transition-colors"><?= e($p['title']) ?></h2>
<p class="mt-2 font-body-sm text-body-sm text-on-surface-variant line-clamp-2"><?= e($p['description']) ?></p>
<?php if(!empty($p['specs'])): ?><div class="mt-4 pt-4 bg-surface-container-low/60 rounded-lg p-3 space-y-1.5 font-label-sm text-label-sm text-on-surface-variant"><?php foreach($p['specs'] as $sp): ?><div class="flex justify-between gap-3"><span><?= e($sp[0]) ?> :</span><span class="font-semibold text-on-surface text-right"><?= e($sp[1]) ?></span></div><?php endforeach; ?></div><?php endif; ?>
</div>
<div class="pt-2">
<div class="flex items-baseline justify-between mb-4">
<div><span class="font-headline-sm text-headline-sm text-primary font-semibold"><?= e($priceTxt) ?></span> <span class="text-on-surface-variant font-body-sm text-body-sm ml-1.5"><?= e(eur((int)$p['price'],(float)$S['eur_rate'])) ?></span></div>
<?php if($p['status']!==''): ?><span class="font-label-sm text-label-sm <?= $stockCls ?> px-2 py-0.5 rounded"><?= e($p['status']) ?></span><?php endif; ?>
</div>
<div class="grid grid-cols-2 gap-2">
<button type="button" class="select-btn w-full py-2.5 px-2 bg-surface-container hover:bg-surface-container-high text-on-surface font-label-md text-label-md rounded flex items-center justify-center gap-1.5 transition-colors" onclick="toggleProductSelection(<?= e(json_encode($p['id'])) ?>, <?= e(json_encode($p['title'],JSON_UNESCAPED_UNICODE)) ?>, <?= (int)$p['price'] ?>, <?= e(json_encode(eur((int)$p['price'],(float)$S['eur_rate']),JSON_UNESCAPED_UNICODE)) ?>)"><span class="material-symbols-outlined text-[18px]">add_circle</span><span>Sélectionner</span></button>
<a class="w-full py-2.5 px-2 bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md rounded flex items-center justify-center gap-1.5 transition-colors shadow-sm" href="https://wa.me/<?= e($S['whatsapp']) ?>?text=<?= rawurlencode($msg) ?>" rel="noopener noreferrer" target="_blank"><span class="material-symbols-outlined text-[18px]">chat</span><span>WhatsApp</span></a>
</div></div></div>
</article>
<?php endforeach; ?>
</div>
</section>
<!-- Ordering Advice & Sacred Ritual Guide -->
<section class="w-full bg-surface-container px-6 lg:px-12 py-space-xl">
<div class="max-w-7xl mx-auto">
<div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter items-center">
<div class="lg:col-span-1 space-y-space-xs">
<span class="font-label-sm text-label-sm text-primary uppercase tracking-widest">Le Guide des Rituels</span>
<h3 class="font-headline-md text-headline-md text-on-surface">Comment réussir son rituel Thiouraye ?</h3>
<p class="font-body-md text-body-md text-on-surface-variant">
            L'argile naturelle cuite retient la chaleur sans surchauffer le support. Voici la démarche recommandée par nos maîtres potiers pour préserver votre encensoir des décennies.
          </p>
<div class="pt-2">
<a class="inline-flex items-center gap-2 text-primary font-label-lg text-label-lg hover:underline" href="https://wa.me/<?= e($S['whatsapp']) ?>?text=Bonjour%2C%20je%20souhaite%20recevoir%20des%20conseils%20sur%20le%20choix%20de%20mon%20encensoir%20et%20thiouraye" rel="noopener noreferrer" target="_blank">
<span>Demander conseil à notre céramiste</span>
<span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</a>
</div>
</div>
<div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
<div class="bg-surface p-6 rounded-xl space-y-3 shadow-sm">
<div class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-[22px]">grain</span>
</div>
<h4 class="font-title-md text-title-md text-on-surface">1. Le Lit de Cendre</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">
              Déposez une fine couche de sable fin ou de cendre neutre au fond du récipient pour amortir l'onde thermique directe du charbon.
            </p>
</div>
<div class="bg-surface p-6 rounded-xl space-y-3 shadow-sm">
<div class="w-10 h-10 rounded-lg bg-secondary-fixed flex items-center justify-center text-secondary">
<span class="material-symbols-outlined text-[22px]">flare</span>
</div>
<h4 class="font-title-md text-title-md text-on-surface">2. La Braise Incandescente</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">
              Allumez votre charbon végétal jusqu'à complète incandescence grise avant de le glisser délicatement dans la cavité.
            </p>
</div>
<div class="bg-surface p-6 rounded-xl space-y-3 shadow-sm">
<div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-[22px]">spa</span>
</div>
<h4 class="font-title-md text-title-md text-on-surface">3. Le Thiouraye Précieux</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">
              Parsemez une pincée de thiouraye sur la braise. Refermez le couvercle ajouré pour admirer la dispersion du sillage sacré.
            </p>
</div>
</div>
</div>
</div>
</section>
<!-- Tailored WhatsApp Pre-order / Custom Batch Banner -->
<section class="max-w-7xl mx-auto px-6 lg:px-12 py-space-xl w-full">
<div class="bg-gradient-to-r from-primary to-primary-container text-on-primary rounded-xl p-8 lg:p-12 shadow-xl flex flex-col lg:flex-row items-center justify-between gap-8">
<div class="space-y-3 max-w-2xl">
<span class="font-label-sm text-label-sm uppercase tracking-widest text-primary-fixed">Mariages • Baptêmes • Commandes de Prestige</span>
<h3 class="font-headline-md text-headline-md leading-snug">
          Vous préparez un événement ou désirez une création sur-mesure ?
        </h3>
<p class="font-body-md text-body-md text-on-primary/90">
          Nous réalisons des séries personnalisées avec gravures, teintes exclusives de la mariée et coffrets rituels sur commande.
        </p>
</div>
<div class="flex flex-col sm:flex-row gap-4 shrink-0">
<a class="px-6 py-3.5 bg-surface text-primary rounded-lg font-label-md text-label-md uppercase tracking-wider font-semibold hover:bg-surface-bright transition-all shadow-md flex items-center justify-center gap-2" href="https://wa.me/<?= e($S['whatsapp']) ?>?text=Bonjour%2C%20je%20souhaite%20un%20devis%20pour%20une%20commande%20personnalis%C3%A9e%20d%27encensoirs" rel="noopener noreferrer" target="_blank">
<span class="material-symbols-outlined text-[20px]">chat</span>
<span>Échanger avec l'atelier</span>
</a>
</div>
</div>
</section>
<!-- Floating Floating Cart Summary Bar (appears when at least 1 item is selected) -->
<div class="fixed bottom-20 lg:bottom-6 inset-x-4 md:inset-x-auto md:right-8 md:w-96 z-40 transform translate-y-32 opacity-0 transition-all duration-300 pointer-events-none" id="floatingOrderBar">
<div class="bg-inverse-surface text-inverse-on-surface p-4 rounded-xl shadow-2xl flex flex-col gap-3">
<div class="flex items-center justify-between">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary-fixed text-[20px]">check_circle</span>
<span class="font-title-md text-title-md text-surface-bright" id="floatingSummaryText">0 pièce(s) sélectionnée(s)</span>
</div>
<button class="text-surface-dim hover:text-surface-bright text-xs underline" onclick="toggleSummaryDrawer()">
          Détails
        </button>
</div>
<div class="flex items-center justify-between font-label-md text-label-md text-surface-dim">
<span>Total estimé :</span>
<span class="font-semibold text-surface-bright text-[16px]" id="floatingTotalPrice">0 FCFA</span>
</div>
<button class="w-full py-3 bg-secondary-fixed hover:bg-secondary-fixed-dim text-on-secondary-fixed font-label-md text-label-md uppercase tracking-wider rounded font-bold flex items-center justify-center gap-2 transition-colors shadow" onclick="sendBulkWhatsAppOrder()">
<span class="material-symbols-outlined text-[18px]">send</span>
<span>Commander la sélection sur WhatsApp</span>
</button>
</div>
</div>
<!-- Summary Modal / Drawer -->
<div class="fixed inset-0 z-50 bg-black/50 backdrop-blur-sm hidden items-center justify-center p-4" id="summaryModal">
<div class="bg-surface w-full max-w-lg rounded-xl shadow-2xl overflow-hidden flex flex-col max-h-[85vh]">
<div class="p-6 bg-surface-container flex items-center justify-between">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-[24px]">shopping_bag</span>
<h4 class="font-headline-sm text-headline-sm text-primary">Votre Sélection Rituelle</h4>
</div>
<button class="p-1 rounded text-on-surface-variant hover:text-on-surface" onclick="toggleSummaryDrawer()">
<span class="material-symbols-outlined text-[24px]">close</span>
</button>
</div>
<div class="p-6 overflow-y-auto space-y-3 flex-1" id="selectedItemsContainer">
<p class="text-on-surface-variant font-body-sm text-body-sm text-center py-8">
          Aucun produit sélectionné pour l’instant. Cliquez sur « Sélectionner » sur les cartes de votre choix.
        </p>
</div>
<div class="p-6 bg-surface-container-low flex flex-col gap-3">
<div class="flex items-center justify-between font-title-md text-title-md text-on-surface">
<span>Total indicatif :</span>
<span class="font-bold text-primary" id="modalTotalPrice">0 FCFA</span>
</div>
<p class="font-label-sm text-label-sm text-on-surface-variant">
          La commande sera préparée directement par message WhatsApp avec l'artisan pour confirmer vos coloris et la livraison.
        </p>
<button class="w-full py-3 bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md uppercase tracking-wider rounded font-bold flex items-center justify-center gap-2 transition-colors shadow-md" onclick="sendBulkWhatsAppOrder()">
<span class="material-symbols-outlined text-[18px]">chat</span>
<span>Finaliser sur WhatsApp (<?= e($S['phone_display']) ?>)</span>
</button>
</div>
</div>
</div>
</div>
<script>
  // Selection Cart State
  const selectedProducts = new Map();

  function updateUiState() {
    const count = selectedProducts.size;
    const badge = document.getElementById('selectedCountBadge');
    const floatingBar = document.getElementById('floatingOrderBar');
    const floatingText = document.getElementById('floatingSummaryText');
    const floatingPrice = document.getElementById('floatingTotalPrice');
    const modalPrice = document.getElementById('modalTotalPrice');

    badge.innerText = count;

    let totalPrice = 0;
    selectedProducts.forEach(item => {
      totalPrice += item.price;
    });

    const formattedPrice = totalPrice.toLocaleString('fr-FR') + ' FCFA';
    floatingPrice.innerText = formattedPrice;
    modalPrice.innerText = formattedPrice;
    floatingText.innerText = count + (count > 1 ? ' pièces sélectionnées' : ' pièce sélectionnée');

    if (count > 0) {
      floatingBar.classList.remove('translate-y-32', 'opacity-0', 'pointer-events-none');
      floatingBar.classList.add('translate-y-0', 'opacity-100');
    } else {
      floatingBar.classList.add('translate-y-32', 'opacity-0', 'pointer-events-none');
      floatingBar.classList.remove('translate-y-0', 'opacity-100');
    }

    renderModalItems();
  }

  function toggleProductSelection(id, title, price, euro) {
    if (selectedProducts.has(id)) {
      selectedProducts.delete(id);
    } else {
      selectedProducts.set(id, { id, title, price, euro });
    }

    // Toggle button visuals
    const card = document.querySelector('.product-item[data-id="' + CSS.escape(id) + '"]');
    if (card) {
      const btn = card.querySelector('.select-btn');
      if (selectedProducts.has(id)) {
        btn.classList.add('bg-primary-container', 'text-on-primary');
        btn.classList.remove('bg-surface-container', 'text-on-surface');
        btn.innerHTML = `<span class="material-symbols-outlined text-[18px]">check</span><span>Ajouté</span>`;
      } else {
        btn.classList.remove('bg-primary-container', 'text-on-primary');
        btn.classList.add('bg-surface-container', 'text-on-surface');
        btn.innerHTML = `<span class="material-symbols-outlined text-[18px]">add_circle</span><span>Sélectionner</span>`;
      }
    }

    updateUiState();
  }

  function renderModalItems() {
    const container = document.getElementById('selectedItemsContainer');
    if (selectedProducts.size === 0) {
      container.innerHTML = `
        <div class="text-center py-8">
          <span class="material-symbols-outlined text-[36px] text-outline">production_quantity_limits</span>
          <p class="mt-2 text-on-surface-variant font-body-sm text-body-sm">Votre sélection est actuellement vide.</p>
        </div>`;
      return;
    }

    container.textContent = '';
    selectedProducts.forEach((item) => {
      const row = document.createElement('div');
      row.className = 'flex items-center justify-between p-3 rounded-lg bg-surface-container-high/60 gap-3';
      const info = document.createElement('div');
      info.className = 'min-w-0 flex-1';
      const h5 = document.createElement('h5');
      h5.className = 'font-title-md text-title-md text-on-surface truncate';
      h5.textContent = item.title;
      const p = document.createElement('p');
      p.className = 'font-label-sm text-label-sm text-secondary';
      p.textContent = item.price.toLocaleString('fr-FR') + ' FCFA (' + item.euro + ')';
      info.append(h5, p);
      const del = document.createElement('button');
      del.type = 'button';
      del.title = 'Retirer';
      del.className = 'text-error hover:bg-error-container/20 p-1.5 rounded transition-colors';
      del.innerHTML = '<span class="material-symbols-outlined text-[18px]">delete</span>';
      del.addEventListener('click', () => toggleProductSelection(item.id));
      row.append(info, del);
      container.appendChild(row);
    });
  }

  function toggleSummaryDrawer() {
    const modal = document.getElementById('summaryModal');
    if (modal.classList.contains('hidden')) {
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    } else {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  }

  function sendBulkWhatsAppOrder() {
    if (selectedProducts.size === 0) return;

    let message = "Bonjour Le Sacré Céramique ! Je souhaite passer commande pour la sélection suivante :\n\n";
    let index = 1;
    let total = 0;

    selectedProducts.forEach((item) => {
      message += `${index}. ${item.title} - ${item.price.toLocaleString('fr-FR')} FCFA\n`;
      total += item.price;
      index++;
    });

    message += `\n*Montant Total Estimé :* ${total.toLocaleString('fr-FR')} FCFA\n`;
    message += "Pourriez-vous me confirmer les finitions disponibles et le délai de livraison ? Merci !";

    const encoded = encodeURIComponent(message);
    window.open(`https://wa.me/<?= e($S['whatsapp']) ?>?text=${encoded}`, '_blank');
  }

  // Filter Buttons Interaction
  const filterBtns = document.querySelectorAll('#categoryFilters .filter-btn');
  const productCards = document.querySelectorAll('.product-item');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => {
        b.classList.remove('bg-primary', 'text-on-primary', 'shadow-sm');
        b.classList.add('bg-surface-container', 'text-on-surface-variant');
      });

      btn.classList.add('bg-primary', 'text-on-primary', 'shadow-sm');
      btn.classList.remove('bg-surface-container', 'text-on-surface-variant');

      const filterVal = btn.getAttribute('data-filter');

      productCards.forEach(card => {
        const cat = card.getAttribute('data-category');
        if (filterVal === 'all' || cat.includes(filterVal)) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
</script></main><footer class="w-full bg-surface-container-low text-on-surface mt-space-xl shadow-[0_-1px_16px_rgba(61,36,28,0.03)]"><div class="max-w-7xl mx-auto px-6 lg:px-12 py-space-xl"><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter"><div class="space-y-space-sm"><div class="flex items-center gap-space-xs"><img alt="Le Sacré Céramique" class="mix-blend-multiply h-7 w-auto object-contain" src="assets/img/logo.png"/><h3 class="font-headline-sm text-headline-sm text-primary">Le Sacré Céramique</h3></div><p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Atelier d'art perpétuant le modelage séculaire d'encensoirs en terre cuite et pots à thiouraye. Chaque pièce est sculptée à la main pour honorer la sérénité des rituels olfactifs.</p><div class="flex items-center gap-space-xs pt-2"><span class="material-symbols-outlined text-primary text-[20px]">verified</span><span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">100% Fait Main • Terre Cuite Locale</span></div></div><div class="space-y-space-sm"><h4 class="font-title-md text-title-md text-on-surface tracking-wide">Découverte &amp; Liens</h4><ul class="space-y-2 font-body-sm text-body-sm text-on-surface-variant"><li><a class="hover:text-primary transition-colors" data-path="accueil" href="index.php">Accueil &amp; Galerie</a></li><li><a class="hover:text-primary transition-colors" data-path="nos-produits" href="nos-produits.php">Encensoirs &amp; Brûleurs</a></li><li><a class="hover:text-primary transition-colors" data-path="notre-histoire" href="notre-histoire.php">L'Âme de l'Atelier</a></li><li><a class="hover:text-primary transition-colors" data-path="commander" href="commander.php">Processus de Commande</a></li><li><a class="hover:text-primary transition-colors" data-path="contact" href="contact.php">Atelier &amp; Échange</a></li></ul></div><div class="space-y-space-sm"><h4 class="font-title-md text-title-md text-on-surface tracking-wide">Horaires d'Ouverture</h4><div data-noedit class="font-body-sm text-body-sm text-on-surface-variant space-y-2"><?php foreach($S['hours'] as $hr): ?><p class="flex justify-between py-1 bg-surface-container px-3 rounded-lg"><span><?= e($hr[0]) ?></span><span class="font-label-md text-label-md text-primary"><?= e($hr[1]) ?></span></p><?php endforeach; ?></div><p class="font-label-sm text-label-sm text-outline-variant pt-1">Visites privées de l'atelier sur réservation préalable.</p></div><div class="space-y-space-sm"><h4 class="font-title-md text-title-md text-on-surface tracking-wide">Contact &amp; Réseaux</h4><p class="font-body-sm text-body-sm text-on-surface-variant">Commandes directes, créations sur-mesure et expéditions soigneusement emballées.</p><div class="flex items-center gap-space-xs text-primary font-title-md text-title-md"><span class="material-symbols-outlined text-[22px]">phone_in_talk</span><a class="hover:underline" href="tel:+<?= e($S['whatsapp']) ?>"><?= e($S['phone_display']) ?></a></div><div class="flex items-center gap-3 pt-2"><a aria-label="WhatsApp" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="https://wa.me/<?= e($S['whatsapp']) ?>" rel="noopener noreferrer" target="_blank"><span class="material-symbols-outlined text-[20px]">chat</span></a><a aria-label="Galerie Photo" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="#"><span class="material-symbols-outlined text-[20px]">photo_camera</span></a><a aria-label="Atelier Live" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="#"><span class="material-symbols-outlined text-[20px]">explore</span></a><a aria-label="Email" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="#"><span class="material-symbols-outlined text-[20px]">mail</span></a></div></div></div><div class="mt-space-xl pt-space-md bg-surface-container-lowest/50 rounded-xl px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4 font-body-sm text-body-sm text-on-surface-variant"><p>© 2025 Le Sacré Céramique. Tous droits réservés. Façonné avec dévotion.</p><p class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Poterie Sacrée • Thiouraye &amp; Résines • Pièces Uniques</p></div></div></footer><nav id="mobileNav" aria-label="Navigation mobile" class="lg:hidden fixed bottom-0 inset-x-0 z-50 bg-surface/95 backdrop-blur-xl border-t border-outline-variant/40 shadow-[0_-4px_16px_rgba(61,36,28,0.08)] pb-[env(safe-area-inset-bottom)]"><div class="grid grid-cols-5"><a href="index.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">home</span>Accueil</a><a href="nos-produits.php" aria-current="page" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-primary"><span class="material-symbols-outlined text-[22px]" style="font-variation-settings:'FILL' 1;">category</span>Créations</a><a href="commander.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">shopping_bag</span>Commander</a><a href="notre-histoire.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">menu_book</span>Histoire</a><a href="contact.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">call</span>Contact</a></div></nav></body></html>
<?php echo cms_render((string)ob_get_clean(), 'nos-produits'); ?>
