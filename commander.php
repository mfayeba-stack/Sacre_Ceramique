<?php require __DIR__ . '/inc/bootstrap.php'; require __DIR__ . '/inc/cms.php'; ob_start(); ?>
<!DOCTYPE html>

<html lang="fr"><head><meta charset="utf-8"/><title>Commander via WhatsApp — Le Sacré Céramique</title><link rel="icon" href="assets/img/logo.png"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><meta content="web_standard" name="shell-type"/><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/><link href="https://fonts.googleapis.com" rel="preconnect"/><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/><?= theme_fonts_link() ?>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/><style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com"></script><script src="assets/js/tailwind-config.php"></script></head><body class="pb-16 lg:pb-0 bg-surface font-body-md text-on-surface antialiased selection:bg-primary-fixed selection:text-on-primary-fixed"><header class="fixed top-0 w-full z-50 bg-surface/90 backdrop-blur-xl shadow-[0_1px_12px_rgba(61,36,28,0.06)]"><div class="h-20 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-gutter"><div class="flex items-center gap-space-sm"><img alt="Le Sacré Céramique" class="mix-blend-multiply h-8 w-auto object-contain" src="assets/img/logo.png"/><a class="font-title-lg text-title-lg tracking-tight text-primary hover:text-primary-container transition-colors" data-path="accueil" href="index.php">Le Sacré Céramique</a></div><nav class="hidden lg:flex items-center gap-space-xs p-1" data-active-classes="bg-primary-container text-on-primary rounded-lg shadow-sm"><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="accueil" href="index.php">Accueil</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="notre-histoire" href="notre-histoire.php">Notre Histoire</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="nos-produits" href="nos-produits.php">Nos Produits</a><a aria-current="page" class="px-space-sm py-2 font-label-lg transition-colors bg-primary-container text-on-primary rounded-lg shadow-sm" data-path="commander" href="commander.php">Commander</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="contact" href="contact.php">Contact</a></nav><div class="flex items-center gap-space-sm"><a class="inline-flex items-center gap-2 px-space-md py-2.5 bg-primary text-on-primary rounded-lg font-label-md text-label-md uppercase tracking-wider hover:bg-primary-container transition-all shadow-[0_4px_16px_rgba(108,34,18,0.2)]" href="https://wa.me/<?= e($S['whatsapp']) ?>" rel="noopener noreferrer" target="_blank"><span class="material-symbols-outlined text-[18px]">chat</span><span class="hidden sm:inline">Commander sur WhatsApp</span></a></div></div><?php if(!empty($S['announcement']['enabled'])): ?><div class="bg-primary text-on-primary text-center px-4 py-2 font-label-md text-label-md"><?= e($S['announcement']['text']) ?> <a class="underline font-semibold ml-2" href="https://wa.me/<?= e($S['whatsapp']) ?>" target="_blank" rel="noopener noreferrer"><?= e($S['announcement']['link_label']) ?> →</a></div><?php endif; ?></header><main class="overflow-x-clip w-full <?= !empty($S['announcement']['enabled']) ? 'pt-[7rem]' : 'pt-20' ?> bg-surface"><div class="flex flex-col w-full">
<!-- En-tête & Fil d'ariane Sacré -->
<section class="w-full bg-surface-container-low/70 py-space-lg lg:py-space-xl">
<div class="max-w-7xl mx-auto px-6 lg:px-12">
<div class="flex flex-col items-center text-center max-w-3xl mx-auto space-y-3">
<div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-container rounded-full text-on-surface-variant text-label-sm font-label-sm uppercase tracking-widest">
<span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
          Atelier Le Sacré Céramique • Dakar, Sénégal
        </div>
<h1 class="text-display font-display text-primary tracking-tight">
          Carnet de Commande Directe
        </h1>
<p class="text-body-lg font-body-lg text-on-surface-variant max-w-2xl leading-relaxed">
          Composez votre ensemble d'encensoirs et de coupes à thiouraye façonnés à la main. Votre sélection génère instantanément votre message personnalisé vers notre atelier via WhatsApp.
        </p>
</div>
<!-- Étapes du rituel de commande -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-space-md mt-space-lg pt-space-md">
<div class="flex items-start gap-4 p-space-md bg-surface-container-lowest/80 rounded-xl shadow-[0_4px_20px_-2px_rgba(61,36,28,0.05)]">
<div class="w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center font-title-md text-title-md shrink-0">1</div>
<div>
<h4 class="text-title-md font-title-md text-on-surface">Sélectionnez vos pièces</h4>
<p class="text-body-sm font-body-sm text-on-surface-variant mt-1">Choisissez les modèles, formats et émaux désirés selon vos rituels.</p>
</div>
</div>
<div class="flex items-start gap-4 p-space-md bg-surface-container-lowest/80 rounded-xl shadow-[0_4px_20px_-2px_rgba(61,36,28,0.05)]">
<div class="w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center font-title-md text-title-md shrink-0">2</div>
<div>
<h4 class="text-title-md font-title-md text-on-surface">Indiquez vos coordonnées</h4>
<p class="text-body-sm font-body-sm text-on-surface-variant mt-1">Précisez votre adresse de remise ou vos requêtes de personnalisation.</p>
</div>
</div>
<div class="flex items-start gap-4 p-space-md bg-surface-container-lowest/80 rounded-xl shadow-[0_4px_20px_-2px_rgba(61,36,28,0.05)]">
<div class="w-9 h-9 rounded-full bg-primary text-on-primary flex items-center justify-center font-title-md text-title-md shrink-0">3</div>
<div>
<h4 class="text-title-md font-title-md text-on-surface">Échange direct WhatsApp</h4>
<p class="text-body-sm font-body-sm text-on-surface-variant mt-1">Validation immédiate avec l'artisan pour le paiement et l'expédition.</p>
</div>
</div>
</div>
</div>
</section>
<!-- Studio de Commande : Deux Colonnes Asymétriques -->
<section class="w-full max-w-7xl mx-auto px-6 lg:px-12 py-space-xl">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
<!-- Colonne Gauche : Sélection des Œuvres (Cols 1 à 7) -->
<div class="lg:col-span-7 space-y-space-lg">
<div class="flex items-center justify-between pb-2">
<div>
<span class="text-label-md font-label-md uppercase tracking-wider text-secondary">Étape 1 &amp; 2</span>
<h2 class="text-headline-md font-headline-md text-primary mt-1">Pièces Sculptées &amp; Céramiques</h2>
</div>
<span class="text-body-sm font-body-sm text-on-surface-variant">Terre Cuite &amp; Émaux Sacrés</span>
</div>
<!-- Liste des produits interactifs -->
<div class="space-y-space-md" id="productCatalog">
<!-- 1. Encensoir Sacré Traditionnel -->
<div class="product-item bg-surface-container-lowest p-space-md rounded-xl shadow-[0_4px_20px_-2px_rgba(61,36,28,0.05)] transition-all hover:shadow-[0_12px_32px_-4px_rgba(61,36,28,0.10)]" data-product-id="traditionnel" data-product-name="Encensoir Sacré Traditionnel">
<div class="flex flex-col sm:flex-row gap-space-md">
<div class="relative w-full sm:w-40 h-44 rounded-lg overflow-hidden bg-surface-container shrink-0">
<img alt="Encensoir Sacré Traditionnel en terre cuite ouvragée" class="w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-500" src="assets/img/encensoir-traditionnel.jpg"/>
<span class="absolute top-2 left-2 px-2 py-0.5 bg-primary/90 text-on-primary text-label-sm font-label-sm uppercase rounded">Emblématique</span>
</div>
<div class="flex-1 flex flex-col justify-between space-y-3">
<div>
<div class="flex items-start justify-between gap-2">
<h3 class="text-title-lg font-title-lg text-on-surface">Encensoir Sacré Traditionnel</h3>
<input aria-label="Sélectionner Encensoir Traditionnel" class="product-select mt-1 w-5 h-5 accent-primary cursor-pointer rounded" type="checkbox"/>
</div>
<p class="text-body-sm font-body-sm text-on-surface-variant mt-1">
                    Coupole perforée en gouttelettes pour une lente diffusion du thiouraye et des résines. Disponible en tailles assorties.
                  </p>
</div>
<!-- Variantes de taille -->
<div class="flex flex-wrap gap-2 text-label-sm font-label-sm">
<label class="cursor-pointer">
<input checked="" class="peer sr-only" name="taille-traditionnel" type="radio" value="Petit modèle (12 cm)"/>
<span class="inline-block px-3 py-1.5 rounded-lg bg-surface-container-low peer-checked:bg-primary peer-checked:text-on-primary text-on-surface-variant transition-colors">Petit (12 cm)</span>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="taille-traditionnel" type="radio" value="Moyen modèle (16 cm)"/>
<span class="inline-block px-3 py-1.5 rounded-lg bg-surface-container-low peer-checked:bg-primary peer-checked:text-on-primary text-on-surface-variant transition-colors">Moyen (16 cm)</span>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="taille-traditionnel" type="radio" value="Grand modèle (20 cm)"/>
<span class="inline-block px-3 py-1.5 rounded-lg bg-surface-container-low peer-checked:bg-primary peer-checked:text-on-primary text-on-surface-variant transition-colors">Grand (20 cm)</span>
</label>
</div>
<!-- Contrôle de quantité -->
<div class="flex items-center justify-between pt-2">
<span class="text-label-md font-label-md text-outline">Quantité désirée :</span>
<div class="flex items-center bg-surface-container rounded-lg p-1">
<button class="btn-qty-minus w-7 h-7 flex items-center justify-center rounded bg-surface text-on-surface hover:bg-surface-container-highest transition-colors font-title-md" type="button">-</button>
<span class="qty-val px-4 font-title-md text-title-md text-primary">1</span>
<button class="btn-qty-plus w-7 h-7 flex items-center justify-center rounded bg-surface text-on-surface hover:bg-surface-container-highest transition-colors font-title-md" type="button">+</button>
</div>
</div>
</div>
</div>
</div>
<!-- 2. Coupe sur Pied Finition Prestige -->
<div class="product-item bg-surface-container-lowest p-space-md rounded-xl shadow-[0_4px_20px_-2px_rgba(61,36,28,0.05)] transition-all hover:shadow-[0_12px_32px_-4px_rgba(61,36,28,0.10)]" data-product-id="coupe-pied" data-product-name="Coupe sur Pied Finition Prestige">
<div class="flex flex-col sm:flex-row gap-space-md">
<div class="relative w-full sm:w-40 h-44 rounded-lg overflow-hidden bg-surface-container shrink-0">
<div class="w-full h-full bg-cover bg-center" data-alt="Collection of footed ceramic incense chalices with lustrous burnished metallic patinas and gold accents, arranged on a woven raffia mat in an artisanal pottery workshop in Senegal." style="background-image: url('assets/img/coupes-sur-pied.jpg')"></div>
<span class="absolute top-2 left-2 px-2 py-0.5 bg-secondary text-on-secondary text-label-sm font-label-sm uppercase rounded">Patine d'Or</span>
</div>
<div class="flex-1 flex flex-col justify-between space-y-3">
<div>
<div class="flex items-start justify-between gap-2">
<h3 class="text-title-lg font-title-lg text-on-surface">Coupe sur Pied Prestige</h3>
<input aria-label="Sélectionner Coupe sur Pied" class="product-select mt-1 w-5 h-5 accent-primary cursor-pointer rounded" type="checkbox"/>
</div>
<p class="text-body-sm font-body-sm text-on-surface-variant mt-1">
                    Calice ouvert d'inspiration cérémonielle, patiné à la main aux reflets dorés, bronze brossé et argent vieilli.
                  </p>
</div>
<!-- Teinte métallique -->
<div>
<label class="text-label-sm font-label-sm text-outline block mb-1.5">Nuance du piédestal &amp; calice :</label>
<select class="coupe-nuance w-full bg-surface-container-low text-on-surface rounded-lg px-3 py-2 text-body-sm font-body-sm focus:outline-none focus:bg-surface">
<option value="Doré Flamboyant Antique">Doré Flamboyant Antique</option>
<option value="Bronze Fumé Profond">Bronze Fumé Profond</option>
<option value="Argent Vieilli Brossé">Argent Vieilli Brossé</option>
<option value="Cuivre Solaire Chaleureux">Cuivre Solaire Chaleureux</option>
</select>
</div>
<!-- Quantité -->
<div class="flex items-center justify-between pt-1">
<span class="text-label-md font-label-md text-outline">Quantité désirée :</span>
<div class="flex items-center bg-surface-container rounded-lg p-1">
<button class="btn-qty-minus w-7 h-7 flex items-center justify-center rounded bg-surface text-on-surface hover:bg-surface-container-highest transition-colors font-title-md" type="button">-</button>
<span class="qty-val px-4 font-title-md text-title-md text-primary">1</span>
<button class="btn-qty-plus w-7 h-7 flex items-center justify-center rounded bg-surface text-on-surface hover:bg-surface-container-highest transition-colors font-title-md" type="button">+</button>
</div>
</div>
</div>
</div>
</div>
<!-- 3. Encensoir Coloris au Choix (Émaux Minéraux) -->
<div class="product-item bg-surface-container-lowest p-space-md rounded-xl shadow-[0_4px_20px_-2px_rgba(61,36,28,0.05)] transition-all hover:shadow-[0_12px_32px_-4px_rgba(61,36,28,0.10)]" data-product-id="coloris-choix" data-product-name="Encensoir à Émaux Colorés">
<div class="flex flex-col sm:flex-row gap-space-md">
<div class="relative w-full sm:w-40 h-44 rounded-lg overflow-hidden bg-surface-container shrink-0">
<div class="w-full h-full bg-cover bg-center" data-alt="Vibrant handcrafted ceramic incense pots in glazed colors including ochre yellow, deep terracotta red, forest green, pristine ivory white and gloss black, displayed on woven rush texture." style="background-image: url('assets/img/gamme-coloree.jpg')"></div>
<span class="absolute top-2 left-2 px-2 py-0.5 bg-surface-container-highest text-on-surface text-label-sm font-label-sm uppercase rounded">6 Émaux</span>
</div>
<div class="flex-1 flex flex-col justify-between space-y-3">
<div>
<div class="flex items-start justify-between gap-2">
<h3 class="text-title-lg font-title-lg text-on-surface">Encensoir Coloris au Choix</h3>
<input aria-label="Sélectionner Encensoir Coloris au Choix" class="product-select mt-1 w-5 h-5 accent-primary cursor-pointer rounded" type="checkbox"/>
</div>
<p class="text-body-sm font-body-sm text-on-surface-variant mt-1">
                    Silhouette sphérique épurée habillée d'émaux minéraux vibrants. Cuisson haute température préservant la brillance.
                  </p>
</div>
<!-- Palette sélecteur couleur -->
<div>
<span class="text-label-sm font-label-sm text-outline block mb-1.5">Coloris retenu : <span class="selected-color-label text-primary font-bold">Jaune Ocre Solaire</span></span>
<div class="flex items-center gap-2">
<button class="color-dot w-7 h-7 rounded-full bg-[#E5B636] shadow-sm transform scale-110 ring-2 ring-primary transition-all" data-color="Jaune Ocre Solaire" title="Jaune Ocre" type="button"></button>
<button class="color-dot w-7 h-7 rounded-full bg-[#2F5943] shadow-sm transition-all" data-color="Vert Émeraude Forêt" title="Vert Forêt" type="button"></button>
<button class="color-dot w-7 h-7 rounded-full bg-[#8A3826] shadow-sm transition-all" data-color="Rouge Terre Cuite Rubis" title="Rouge Terre Cuite" type="button"></button>
<button class="color-dot w-7 h-7 rounded-full bg-[#F5F2EB] shadow-sm transition-all" data-color="Blanc Écru Perle" title="Blanc Écru" type="button"></button>
<button class="color-dot w-7 h-7 rounded-full bg-[#1F1E1D] shadow-sm transition-all" data-color="Noir Ébène Brillant" title="Noir Ébène" type="button"></button>
<button class="color-dot w-7 h-7 rounded-full bg-[#52372C] shadow-sm transition-all" data-color="Brun Moka Satiné" title="Brun Moka" type="button"></button>
</div>
</div>
<!-- Quantité -->
<div class="flex items-center justify-between pt-1">
<span class="text-label-md font-label-md text-outline">Quantité désirée :</span>
<div class="flex items-center bg-surface-container rounded-lg p-1">
<button class="btn-qty-minus w-7 h-7 flex items-center justify-center rounded bg-surface text-on-surface hover:bg-surface-container-highest transition-colors font-title-md" type="button">-</button>
<span class="qty-val px-4 font-title-md text-title-md text-primary">1</span>
<button class="btn-qty-plus w-7 h-7 flex items-center justify-center rounded bg-surface text-on-surface hover:bg-surface-container-highest transition-colors font-title-md" type="button">+</button>
</div>
</div>
</div>
</div>
</div>
<!-- 4. Encensoir d'Exception Hors Série -->
<div class="product-item bg-surface-container-lowest p-space-md rounded-xl shadow-[0_4px_20px_-2px_rgba(61,36,28,0.05)] transition-all hover:shadow-[0_12px_32px_-4px_rgba(61,36,28,0.10)]" data-product-id="hors-serie" data-product-name="Encensoir Hors Série Majestueux">
<div class="flex flex-col sm:flex-row gap-space-md">
<div class="relative w-full sm:w-40 h-44 rounded-lg overflow-hidden bg-surface-container shrink-0">
<div class="w-full h-full bg-cover bg-center" data-alt="Two premium ceremonial ceramic incense urns elevated on opulent turned golden brass pedestals, one in pastel soft celadon green and the other in matte midnight black with undulating wavy rim collars." style="background-image: url('assets/img/hors-serie.jpg')"></div>
<span class="absolute top-2 left-2 px-2 py-0.5 bg-secondary-container text-on-secondary-container text-label-sm font-label-sm uppercase rounded font-bold">Hors Série</span>
</div>
<div class="flex-1 flex flex-col justify-between space-y-3">
<div>
<div class="flex items-start justify-between gap-2">
<div>
<h3 class="text-title-lg font-title-lg text-on-surface">Hors Série « Majestueux »</h3>
<span class="text-label-sm font-label-sm text-secondary uppercase font-semibold">Pièce d'apparat sur pied doré</span>
</div>
<input aria-label="Sélectionner Hors Série Majestueux" class="product-select mt-1 w-5 h-5 accent-primary cursor-pointer rounded" type="checkbox"/>
</div>
<p class="text-body-sm font-body-sm text-on-surface-variant mt-1">
                    Silhouette sculpturale à col festonné ondulé, coiffée d'un fleuron en pointe d'or pur.
                  </p>
</div>
<!-- Choix Émotion -->
<div class="flex gap-3">
<label class="cursor-pointer flex-1">
<input checked="" class="peer sr-only" name="variante-hors-serie" type="radio" value="Céladon Sacré &amp; Base Or"/>
<div class="px-3 py-2 text-center rounded-lg bg-surface-container-low peer-checked:bg-primary peer-checked:text-on-primary text-body-sm font-body-sm transition-all">
                      Céladon Doux &amp; Or
                    </div>
</label>
<label class="cursor-pointer flex-1">
<input class="peer sr-only" name="variante-hors-serie" type="radio" value="Noir Anthracite &amp; Base Or"/>
<div class="px-3 py-2 text-center rounded-lg bg-surface-container-low peer-checked:bg-primary peer-checked:text-on-primary text-body-sm font-body-sm transition-all">
                      Noir Nocturne &amp; Or
                    </div>
</label>
</div>
<!-- Quantité -->
<div class="flex items-center justify-between pt-1">
<span class="text-label-md font-label-md text-outline">Quantité désirée :</span>
<div class="flex items-center bg-surface-container rounded-lg p-1">
<button class="btn-qty-minus w-7 h-7 flex items-center justify-center rounded bg-surface text-on-surface hover:bg-surface-container-highest transition-colors font-title-md" type="button">-</button>
<span class="qty-val px-4 font-title-md text-title-md text-primary">1</span>
<button class="btn-qty-plus w-7 h-7 flex items-center justify-center rounded bg-surface text-on-surface hover:bg-surface-container-highest transition-colors font-title-md" type="button">+</button>
</div>
</div>
</div>
</div>
</div>
<!-- 5. Encensoir Finition Métal / Goutte Gravée -->
<div class="product-item bg-surface-container-lowest p-space-md rounded-xl shadow-[0_4px_20px_-2px_rgba(61,36,28,0.05)] transition-all hover:shadow-[0_12px_32px_-4px_rgba(61,36,28,0.10)]" data-product-id="goutte-metal" data-product-name="Encensoir Goutte d'Orient Métallisée">
<div class="flex flex-col sm:flex-row gap-space-md">
<div class="relative w-full sm:w-40 h-44 rounded-lg overflow-hidden bg-surface-container shrink-0">
<div class="w-full h-full bg-cover bg-center" data-alt="Three bulbous drop-shaped ceramic incense burners with textured vertical scored engravings and star perforations in brushed silver, burnished warm gold and patinated bronze finishes." style="background-image: url('assets/img/trio-metal.jpg')"></div>
<span class="absolute top-2 left-2 px-2 py-0.5 bg-surface text-primary text-label-sm font-label-sm uppercase rounded font-semibold">Terre Striée</span>
</div>
<div class="flex-1 flex flex-col justify-between space-y-3">
<div>
<div class="flex items-start justify-between gap-2">
<h3 class="text-title-lg font-title-lg text-on-surface">Goutte d'Orient Gravée</h3>
<input aria-label="Sélectionner Goutte Gravée" class="product-select mt-1 w-5 h-5 accent-primary cursor-pointer rounded" type="checkbox"/>
</div>
<p class="text-body-sm font-body-sm text-on-surface-variant mt-1">
                    Texture striée main aux motifs étoilés laissant filtrer des volutes incandescentes.
                  </p>
</div>
<!-- Finition striée -->
<div class="grid grid-cols-3 gap-2">
<label class="cursor-pointer">
<input checked="" class="peer sr-only" name="variante-goutte" type="radio" value="Or Brossé Antique"/>
<div class="py-1.5 px-2 text-center text-label-sm font-label-sm rounded-lg bg-surface-container-low peer-checked:bg-primary peer-checked:text-on-primary transition-all">Or Antique</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="variante-goutte" type="radio" value="Argent Étoilé"/>
<div class="py-1.5 px-2 text-center text-label-sm font-label-sm rounded-lg bg-surface-container-low peer-checked:bg-primary peer-checked:text-on-primary transition-all">Argent</div>
</label>
<label class="cursor-pointer">
<input class="peer sr-only" name="variante-goutte" type="radio" value="Bronze Sauvage"/>
<div class="py-1.5 px-2 text-center text-label-sm font-label-sm rounded-lg bg-surface-container-low peer-checked:bg-primary peer-checked:text-on-primary transition-all">Bronze</div>
</label>
</div>
<!-- Quantité -->
<div class="flex items-center justify-between pt-1">
<span class="text-label-md font-label-md text-outline">Quantité désirée :</span>
<div class="flex items-center bg-surface-container rounded-lg p-1">
<button class="btn-qty-minus w-7 h-7 flex items-center justify-center rounded bg-surface text-on-surface hover:bg-surface-container-highest transition-colors font-title-md" type="button">-</button>
<span class="qty-val px-4 font-title-md text-title-md text-primary">1</span>
<button class="btn-qty-plus w-7 h-7 flex items-center justify-center rounded bg-surface text-on-surface hover:bg-surface-container-highest transition-colors font-title-md" type="button">+</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Colonne Droite : Formulaire, Message & Bouton WhatsApp Interactif (Cols 8 à 12) -->
<div class="lg:col-span-5 sticky top-28 space-y-space-md">
<!-- Boîte de Commande & Génération Dynamique -->
<div class="bg-surface-container-lowest p-space-md lg:p-space-lg rounded-xl shadow-[0_12px_32px_-4px_rgba(61,36,28,0.10)] space-y-space-md">
<div class="border-b-0 space-y-1">
<div class="flex items-center justify-between">
<span class="text-label-md font-label-md uppercase tracking-wider text-secondary">Étape 3 : Finalisation</span>
<span class="inline-flex items-center gap-1 text-[#25D366] text-label-sm font-label-sm font-bold">
<span class="material-symbols-outlined text-[16px]">verified</span>
                Direct Atelier
              </span>
</div>
<h3 class="text-headline-sm font-headline-sm text-primary">Vos Informations</h3>
<p class="text-body-sm font-body-sm text-on-surface-variant">
              Renseignez vos coordonnées pour pré-formuler votre message direct.
            </p>
</div>
<!-- Champs du Formulaire -->
<form class="space-y-3.5" id="orderForm" onsubmit="return false;">
<div>
<label class="block text-label-md font-label-md text-on-surface mb-1" for="clientName">Votre Nom &amp; Prénom *</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-2.5 text-outline text-[18px]">person</span>
<input class="w-full pl-10 pr-3 py-2 bg-surface-container-low text-on-surface rounded-lg text-body-sm font-body-sm focus:outline-none focus:bg-surface transition-all" id="clientName" placeholder="Ex: Aminata Diallo" type="text"/>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
<div>
<label class="block text-label-md font-label-md text-on-surface mb-1" for="clientCity">Ville / Quartier *</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-2.5 text-outline text-[18px]">location_on</span>
<input class="w-full pl-10 pr-3 py-2 bg-surface-container-low text-on-surface rounded-lg text-body-sm font-body-sm focus:outline-none focus:bg-surface transition-all" id="clientCity" placeholder="Ex: Dakar, Almadies" type="text"/>
</div>
</div>
<div>
<label class="block text-label-md font-label-md text-on-surface mb-1" for="clientDelivery">Livraison souhaitée</label>
<select class="w-full px-3 py-2 bg-surface-container-low text-on-surface rounded-lg text-body-sm font-body-sm focus:outline-none focus:bg-surface transition-all" id="clientDelivery">
<option value="Livraison à domicile (Dakar)">Livraison à domicile (Dakar)</option>
<option value="Expédition Régions du Sénégal">Expédition Régions</option>
<option value="Retrait direct à l'Atelier">Retrait à l'Atelier</option>
<option value="Expédition Internationale (Fret/Colis)">Expédition Internationale</option>
</select>
</div>
</div>
<div>
<label class="block text-label-md font-label-md text-on-surface mb-1" for="clientNotes">Demande spéciale ou gravure (optionnel)</label>
<textarea class="w-full px-3 py-2 bg-surface-container-low text-on-surface rounded-lg text-body-sm font-body-sm focus:outline-none focus:bg-surface transition-all resize-none" id="clientNotes" placeholder="Ex: Coffret cadeau, gravure d'initiales sous le socle..." rows="2"></textarea>
</div>
</form>
<!-- Récapitulatif en temps réel de la commande -->
<div class="bg-surface-container-low p-space-sm rounded-lg space-y-2">
<div class="flex items-center justify-between text-label-sm font-label-sm text-outline uppercase tracking-wider">
<span>Aperçu de votre transmission WhatsApp</span>
<span class="bg-primary/10 text-primary px-2 py-0.5 rounded font-bold" id="selectedCountBadge">0 pièce sélectionnée</span>
</div>
<!-- Message WhatsApp Live Preview -->
<div class="p-3 bg-[#E7F8E8] text-[#1E3B2B] rounded font-mono text-[12px] leading-relaxed max-h-40 overflow-y-auto whitespace-pre-wrap select-all shadow-inner" id="whatsappPreviewBox">
Bonjour Le Sacré Céramique ! 🌿
Je souhaite passer commande pour vos pièces artisanales :

(Veuillez cocher au moins une céramique ci-contre)
            </div>
</div>
<!-- Grand Bouton Officiel WhatsApp Interactif -->
<div class="space-y-2 pt-1">
<a class="w-full flex items-center justify-center gap-3 py-3.5 px-6 rounded-lg bg-[#25D366] hover:bg-[#20BD5A] text-white font-title-md text-title-md transition-all shadow-[0_8px_24px_rgba(37,211,102,0.3)] hover:shadow-[0_12px_28px_rgba(37,211,102,0.4)] transform hover:-translate-y-0.5 text-center cursor-pointer" href="https://wa.me/<?= e($S['whatsapp']) ?>" id="whatsappSubmitBtn" rel="noopener noreferrer" target="_blank">
<svg class="w-6 h-6 fill-current shrink-0" viewbox="0 0 24 24">
<path d="M12.031 2C6.511 2 2.016 6.494 2.016 12.014c0 1.872.52 3.693 1.507 5.275L2 22l4.887-1.488a9.96 9.96 0 0 0 5.144 1.411h.004c5.517 0 10.012-4.494 10.012-10.014 0-2.673-1.04-5.186-2.932-7.078A9.946 9.946 0 0 0 12.031 2zm5.836 14.195c-.244.685-1.42 1.309-1.954 1.391-.497.077-1.127.11-3.232-.763-2.684-1.114-4.408-3.83-4.542-4.009-.134-.179-1.087-1.448-1.087-2.763 0-1.315.688-1.961.932-2.228.244-.268.534-.335.713-.335.178 0 .356.002.512.01.168.008.393-.064.615.47.234.561.792 1.932.862 2.073.07.142.117.308.024.493-.093.185-.14.301-.278.461-.138.161-.29.359-.415.482-.138.136-.282.285-.121.562.161.277.714 1.176 1.533 1.905 1.054.938 1.942 1.229 2.22 1.366.277.138.441.116.604-.071.164-.187.698-.813.885-1.092.187-.278.374-.232.628-.138.254.094 1.613.761 1.889.9.277.139.462.208.531.324.07.116.07 1.332-.174 2.017z"></path>
</svg>
<span>Envoyer ma commande sur WhatsApp</span>
</a>
<div class="flex items-center justify-center gap-2 text-center text-body-sm font-body-sm text-outline-variant pt-1">
<span class="material-symbols-outlined text-[16px]">lock</span>
<span>Ligne directe de l'artisan : <?= e($S['phone_display']) ?></span>
</div>
</div>
<!-- Rassurance artisanale -->
<div class="grid grid-cols-2 gap-2 pt-2 text-body-sm font-body-sm text-on-surface-variant">
<div class="p-2.5 bg-surface-container rounded-lg flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-[18px]">verified</span>
<span>Emballage antichoc garanti</span>
</div>
<div class="p-2.5 bg-surface-container rounded-lg flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-[18px]">local_shipping</span>
<span>Livraison rapide Dakar &amp; Régions</span>
</div>
</div>
</div>
<!-- Fiche Conseil : L'art du thiouraye -->
<div class="bg-primary/5 rounded-xl p-space-md space-y-2">
<div class="flex items-center gap-2 text-primary font-title-md text-title-md">
<span class="material-symbols-outlined text-[20px]">lightbulb</span>
<span>Conseil de cuisson &amp; conservation</span>
</div>
<p class="text-body-sm font-body-sm text-on-surface-variant leading-relaxed">
            Nos poteries en argile rouge cuite supportent les braises de charbon incandescent ou les charbons légers à encens. Pour un parfum envoûtant qui dure des heures, déposez une pincée de sable protecteur au fond avant la braise.
          </p>
</div>
</div>
</div>
</section>
<!-- Foire Aux Questions & Engagements -->
<section class="w-full bg-surface-container py-space-xl">
<div class="max-w-5xl mx-auto px-6 lg:px-12 space-y-space-lg">
<div class="text-center space-y-2">
<span class="text-label-md font-label-md uppercase tracking-wider text-secondary">Transparence &amp; Sérénité</span>
<h2 class="text-headline-md font-headline-md text-primary">Questions Fréquentes sur vos Commandes</h2>
<p class="text-body-md font-body-md text-on-surface-variant max-w-xl mx-auto">
          Tout savoir sur les délais de tournage, les modes de règlement et l'expédition protégée.
        </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
<!-- Question 1 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl space-y-2 shadow-[0_4px_20px_-2px_rgba(61,36,28,0.05)]">
<div class="flex items-center gap-2 text-primary">
<span class="material-symbols-outlined text-[22px]">hourglass_top</span>
<h4 class="text-title-md font-title-md text-on-surface">Quel est le délai de confection ?</h4>
</div>
<p class="text-body-sm font-body-sm text-on-surface-variant leading-relaxed">
            Les modèles en stock sont expédiés en 24h à 48h sur Dakar. Pour une création avec coloris exclusif ou gravure sur mesure, prévoyez 4 à 6 jours pour le modelage, le séchage lent et la double cuisson au four céramique.
          </p>
</div>
<!-- Question 2 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl space-y-2 shadow-[0_4px_20px_-2px_rgba(61,36,28,0.05)]">
<div class="flex items-center gap-2 text-primary">
<span class="material-symbols-outlined text-[22px]">payments</span>
<h4 class="text-title-md font-title-md text-on-surface">Quels sont les modes de paiement ?</h4>
</div>
<p class="text-body-sm font-body-sm text-on-surface-variant leading-relaxed">
            Nous facilitons vos démarches : règlement sécurisé par Wave, Orange Money, virement bancaire ou espèces à la livraison pour les résidents de Dakar.
          </p>
</div>
<!-- Question 3 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl space-y-2 shadow-[0_4px_20px_-2px_rgba(61,36,28,0.05)]">
<div class="flex items-center gap-2 text-primary">
<span class="material-symbols-outlined text-[22px]">inventory_2</span>
<h4 class="text-title-md font-title-md text-on-surface">La poterie risque-t-elle de casser ?</h4>
</div>
<p class="text-body-sm font-body-sm text-on-surface-variant leading-relaxed">
            Chaque pièce est doublée de fibre protectrice, calée dans du carton renforcé et signalée fragile. En cas d'aléa rarissime lors de la livraison, nous remplaçons immédiatement votre poterie sans frais.
          </p>
</div>
<!-- Question 4 -->
<div class="bg-surface-container-lowest p-space-md rounded-xl space-y-2 shadow-[0_4px_20px_-2px_rgba(61,36,28,0.05)]">
<div class="flex items-center gap-2 text-primary">
<span class="material-symbols-outlined text-[22px]">public</span>
<h4 class="text-title-md font-title-md text-on-surface">Livrez-vous hors du Sénégal ?</h4>
</div>
<p class="text-body-sm font-body-sm text-on-surface-variant leading-relaxed">
            Oui, nous expédions régulièrement dans la sous-région ouest-africaine (Côte d'Ivoire, Mali, Guinée) ainsi qu'en Europe via service postal express ou partenaires de fret aérien.
          </p>
</div>
</div>
</div>
</section>
<!-- Script Interactif WhatsApp Builder -->
<script>
    (function() {
      const WHATSAPP_PHONE = "<?= e($S['whatsapp']) ?>";

      const productsContainer = document.getElementById("productCatalog");
      const clientNameInput = document.getElementById("clientName");
      const clientCityInput = document.getElementById("clientCity");
      const clientDeliverySelect = document.getElementById("clientDelivery");
      const clientNotesTextarea = document.getElementById("clientNotes");
      const previewBox = document.getElementById("whatsappPreviewBox");
      const whatsappBtn = document.getElementById("whatsappSubmitBtn");
      const countBadge = document.getElementById("selectedCountBadge");

      // Gestion des sélecteurs de couleur
      const colorDots = document.querySelectorAll(".color-dot");
      const colorLabel = document.querySelector(".selected-color-label");
      let activeColor = "Jaune Ocre Solaire";

      colorDots.forEach(dot => {
        dot.addEventListener("click", () => {
          colorDots.forEach(d => {
            d.classList.remove("ring-2", "ring-primary", "scale-110");
          });
          dot.classList.add("ring-2", "ring-primary", "scale-110");
          activeColor = dot.getAttribute("data-color");
          if (colorLabel) colorLabel.textContent = activeColor;
          
          // Cocher automatiquement le produit lié
          const item = dot.closest(".product-item");
          const chk = item.querySelector(".product-select");
          if (chk && !chk.checked) chk.checked = true;
          
          updateWhatsAppMessage();
        });
      });

      // Gestion des quantités + / -
      document.querySelectorAll(".product-item").forEach(item => {
        const minusBtn = item.querySelector(".btn-qty-minus");
        const plusBtn = item.querySelector(".btn-qty-plus");
        const qtySpan = item.querySelector(".qty-val");
        const chk = item.querySelector(".product-select");

        minusBtn.addEventListener("click", () => {
          let current = parseInt(qtySpan.textContent) || 1;
          if (current > 1) {
            qtySpan.textContent = current - 1;
            updateWhatsAppMessage();
          }
        });

        plusBtn.addEventListener("click", () => {
          let current = parseInt(qtySpan.textContent) || 1;
          qtySpan.textContent = current + 1;
          if (chk && !chk.checked) chk.checked = true;
          updateWhatsAppMessage();
        });

        // Clic sur options radios / selects coche automatiquement
        item.querySelectorAll("input[type='radio'], select").forEach(control => {
          control.addEventListener("change", () => {
            if (chk && !chk.checked) chk.checked = true;
            updateWhatsAppMessage();
          });
        });

        if (chk) {
          chk.addEventListener("change", () => {
            updateWhatsAppMessage();
          });
        }
      });

      // Écouteurs sur le formulaire client
      [clientNameInput, clientCityInput, clientDeliverySelect, clientNotesTextarea].forEach(input => {
        input.addEventListener("input", updateWhatsAppMessage);
      });

      function buildOrderDetails() {
        const selected = [];
        const items = document.querySelectorAll(".product-item");

        items.forEach(item => {
          const chk = item.querySelector(".product-select");
          if (chk && chk.checked) {
            const name = item.getAttribute("data-product-name");
            const qty = item.querySelector(".qty-val").textContent.trim();
            const id = item.getAttribute("data-product-id");

            let detail = "";
            if (id === "traditionnel") {
              const checkedRadio = item.querySelector("input[name='taille-traditionnel']:checked");
              detail = checkedRadio ? " (" + checkedRadio.value + ")" : "";
            } else if (id === "coupe-pied") {
              const nuance = item.querySelector(".coupe-nuance").value;
              detail = " (Nuance : " + nuance + ")";
            } else if (id === "coloris-choix") {
              detail = " (Émail : " + activeColor + ")";
            } else if (id === "hors-serie") {
              const hsRadio = item.querySelector("input[name='variante-hors-serie']:checked");
              detail = hsRadio ? " (" + hsRadio.value + ")" : "";
            } else if (id === "goutte-metal") {
              const gmRadio = item.querySelector("input[name='variante-goutte']:checked");
              detail = gmRadio ? " (Finition : " + gmRadio.value + ")" : "";
            }

            selected.push("• " + qty + "x " + name + detail);
          }
        });

        return selected;
      }

      function updateWhatsAppMessage() {
        const selectedItems = buildOrderDetails();
        const clientName = clientNameInput.value.trim() || "[Votre Nom]";
        const clientCity = clientCityInput.value.trim() || "[Votre Ville / Quartier]";
        const deliveryMode = clientDeliverySelect.value;
        const notes = clientNotesTextarea.value.trim();

        countBadge.textContent = selectedItems.length + (selectedItems.length > 1 ? " pièces sélectionnées" : " pièce sélectionnée");

        let text = "Salam alaykoum / Bonjour Le Sacré Céramique ! 🌿\n";
        text += "Je souhaite commander les pièces artisanales suivantes :\n\n";

        if (selectedItems.length > 0) {
          text += selectedItems.join("\n") + "\n\n";
        } else {
          text += "(Veuillez cocher au moins un encensoir ou une coupe ci-contre)\n\n";
        }

        text += "👤 Nom du destinataire : " + clientName + "\n";
        text += "📍 Ville / Destination : " + clientCity + "\n";
        text += "📦 Mode de livraison : " + deliveryMode + "\n";

        if (notes) {
          text += "✍️ Note particulière : " + notes + "\n";
        }

        text += "\nMerci de me confirmer la disponibilité et les modalités de paiement ! ✨";

        previewBox.textContent = text;

        const encoded = encodeURI(text);
        whatsappBtn.href = "https://wa.me/" + WHATSAPP_PHONE + "?text=" + encoded;
      }

      // Initialisation par défaut : cocher le 1er encensoir
      const firstCheck = document.querySelector(".product-select");
      if (firstCheck) {
        firstCheck.checked = true;
      }
      updateWhatsAppMessage();
    })();
  </script>
</div></main><footer class="w-full bg-surface-container-low text-on-surface mt-space-xl shadow-[0_-1px_16px_rgba(61,36,28,0.03)]"><div class="max-w-7xl mx-auto px-6 lg:px-12 py-space-xl"><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter"><div class="space-y-space-sm"><div class="flex items-center gap-space-xs"><img alt="Le Sacré Céramique" class="mix-blend-multiply h-7 w-auto object-contain" src="assets/img/logo.png"/><h3 class="font-headline-sm text-headline-sm text-primary">Le Sacré Céramique</h3></div><p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Atelier d'art perpétuant le modelage séculaire d'encensoirs en terre cuite et pots à thiouraye. Chaque pièce est sculptée à la main pour honorer la sérénité des rituels olfactifs.</p><div class="flex items-center gap-space-xs pt-2"><span class="material-symbols-outlined text-primary text-[20px]">verified</span><span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">100% Fait Main • Terre Cuite Locale</span></div></div><div class="space-y-space-sm"><h4 class="font-title-md text-title-md text-on-surface tracking-wide">Découverte &amp; Liens</h4><ul class="space-y-2 font-body-sm text-body-sm text-on-surface-variant"><li><a class="hover:text-primary transition-colors" data-path="accueil" href="index.php">Accueil &amp; Galerie</a></li><li><a class="hover:text-primary transition-colors" data-path="nos-produits" href="nos-produits.php">Encensoirs &amp; Brûleurs</a></li><li><a class="hover:text-primary transition-colors" data-path="notre-histoire" href="notre-histoire.php">L'Âme de l'Atelier</a></li><li><a class="hover:text-primary transition-colors" data-path="commander" href="commander.php">Processus de Commande</a></li><li><a class="hover:text-primary transition-colors" data-path="contact" href="contact.php">Atelier &amp; Échange</a></li></ul></div><div class="space-y-space-sm"><h4 class="font-title-md text-title-md text-on-surface tracking-wide">Horaires d'Ouverture</h4><div data-noedit class="font-body-sm text-body-sm text-on-surface-variant space-y-2"><?php foreach($S['hours'] as $hr): ?><p class="flex justify-between py-1 bg-surface-container px-3 rounded-lg"><span><?= e($hr[0]) ?></span><span class="font-label-md text-label-md text-primary"><?= e($hr[1]) ?></span></p><?php endforeach; ?></div><p class="font-label-sm text-label-sm text-outline-variant pt-1">Visites privées de l'atelier sur réservation préalable.</p></div><div class="space-y-space-sm"><h4 class="font-title-md text-title-md text-on-surface tracking-wide">Contact &amp; Réseaux</h4><p class="font-body-sm text-body-sm text-on-surface-variant">Commandes directes, créations sur-mesure et expéditions soigneusement emballées.</p><div class="flex items-center gap-space-xs text-primary font-title-md text-title-md"><span class="material-symbols-outlined text-[22px]">phone_in_talk</span><a class="hover:underline" href="tel:+<?= e($S['whatsapp']) ?>"><?= e($S['phone_display']) ?></a></div><div class="flex items-center gap-3 pt-2"><a aria-label="WhatsApp" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="https://wa.me/<?= e($S['whatsapp']) ?>" rel="noopener noreferrer" target="_blank"><span class="material-symbols-outlined text-[20px]">chat</span></a><a aria-label="Galerie Photo" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="#"><span class="material-symbols-outlined text-[20px]">photo_camera</span></a><a aria-label="Atelier Live" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="#"><span class="material-symbols-outlined text-[20px]">explore</span></a><a aria-label="Email" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="#"><span class="material-symbols-outlined text-[20px]">mail</span></a></div></div></div><div class="mt-space-xl pt-space-md bg-surface-container-lowest/50 rounded-xl px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4 font-body-sm text-body-sm text-on-surface-variant"><p>© 2025 Le Sacré Céramique. Tous droits réservés. Façonné avec dévotion.</p><p class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Poterie Sacrée • Thiouraye &amp; Résines • Pièces Uniques</p></div></div></footer><nav id="mobileNav" aria-label="Navigation mobile" class="lg:hidden fixed bottom-0 inset-x-0 z-50 bg-surface/95 backdrop-blur-xl border-t border-outline-variant/40 shadow-[0_-4px_16px_rgba(61,36,28,0.08)] pb-[env(safe-area-inset-bottom)]"><div class="grid grid-cols-5"><a href="index.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">home</span>Accueil</a><a href="nos-produits.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">category</span>Créations</a><a href="commander.php" aria-current="page" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-primary"><span class="material-symbols-outlined text-[22px]" style="font-variation-settings:'FILL' 1;">shopping_bag</span>Commander</a><a href="notre-histoire.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">menu_book</span>Histoire</a><a href="contact.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">call</span>Contact</a></div></nav></body></html>
<?php echo cms_render((string)ob_get_clean(), 'commander'); ?>
