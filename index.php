<?php require __DIR__ . '/inc/bootstrap.php'; require __DIR__ . '/inc/cms.php'; ob_start(); ?>
<!DOCTYPE html>

<html lang="fr"><head><meta charset="utf-8"/><title>Le Sacré Céramique — Encensoirs & pots à thiouraye en terre cuite</title><link rel="icon" href="assets/img/logo.png"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><meta content="web_standard" name="shell-type"/><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/><link href="https://fonts.googleapis.com" rel="preconnect"/><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/><?= theme_fonts_link() ?>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/><style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com"></script><script src="assets/js/tailwind-config.php"></script></head><body class="pb-16 lg:pb-0 bg-surface font-body-md text-on-surface antialiased selection:bg-primary-fixed selection:text-on-primary-fixed"><header class="fixed top-0 w-full z-50 bg-surface/90 backdrop-blur-xl shadow-[0_1px_12px_rgba(61,36,28,0.06)]"><div class="h-20 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-gutter"><div class="flex items-center gap-space-sm"><img alt="Le Sacré Céramique" class="mix-blend-multiply h-8 w-auto object-contain" src="assets/img/logo.png"/><a class="font-title-lg text-title-lg tracking-tight text-primary hover:text-primary-container transition-colors" data-path="accueil" href="index.php">Le Sacré Céramique</a></div><nav class="hidden lg:flex items-center gap-space-xs p-1" data-active-classes="bg-primary-container text-on-primary rounded-lg shadow-sm"><a aria-current="page" class="px-space-sm py-2 font-label-lg transition-colors bg-primary-container text-on-primary rounded-lg shadow-sm" data-path="accueil" href="index.php">Accueil</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="notre-histoire" href="notre-histoire.php">Notre Histoire</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="nos-produits" href="nos-produits.php">Nos Produits</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="commander" href="commander.php">Commander</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="contact" href="contact.php">Contact</a></nav><div class="flex items-center gap-space-sm"><a class="inline-flex items-center gap-2 px-space-md py-2.5 bg-primary text-on-primary rounded-lg font-label-md text-label-md uppercase tracking-wider hover:bg-primary-container transition-all shadow-[0_4px_16px_rgba(108,34,18,0.2)]" href="https://wa.me/<?= e($S['whatsapp']) ?>" rel="noopener noreferrer" target="_blank"><span class="material-symbols-outlined text-[18px]">chat</span><span class="hidden sm:inline">Commander sur WhatsApp</span></a></div></div><?php if(!empty($S['announcement']['enabled'])): ?><div class="bg-primary text-on-primary text-center px-4 py-2 font-label-md text-label-md"><?= e($S['announcement']['text']) ?> <a class="underline font-semibold ml-2" href="https://wa.me/<?= e($S['whatsapp']) ?>" target="_blank" rel="noopener noreferrer"><?= e($S['announcement']['link_label']) ?> →</a></div><?php endif; ?></header><main class="overflow-x-clip w-full <?= !empty($S['announcement']['enabled']) ? 'pt-[7rem]' : 'pt-20' ?> bg-surface"><div class="flex flex-col w-full">
<!-- HERO SECTION -->
<section class="relative w-full overflow-hidden bg-gradient-to-b from-surface-container-low via-surface to-surface-container-lowest py-space-lg lg:py-space-xl">
<div class="max-w-7xl mx-auto px-6 lg:px-12">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg lg:gap-gutter items-center">
<!-- Left Column: Editorial & Brand Core -->
<div class="lg:col-span-7 flex flex-col items-start space-y-space-md z-10">
<div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-secondary-fixed/40 text-on-secondary-fixed-variant">
<span class="material-symbols-outlined text-[16px] text-secondary">flare</span>
<span class="font-label-sm text-label-sm uppercase tracking-wider font-semibold">Artisanat Sacré &amp; Poterie d’Art</span>
</div>
<div class="space-y-3">
<p class="font-headline-sm text-headline-sm italic text-primary-container">
              L'authenticité du fait main, la beauté du naturel.
            </p>
<h1 class="font-display text-display-mobile lg:text-display text-primary tracking-tight leading-[1.08]">
              L'âme de la terre <br/><span class="italic font-normal text-on-surface">au cœur de vos rituels.</span>
</h1>
</div>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl">Plus qu'un objet, une tradition séculaire. Nos encensoirs en terre cuite et pots à thiouraye sont façonnés individuellement par nos maîtres potiers pour sublimer vos résines, écorces précieuses et parfums d’intérieur.</p>
<!-- Interactive Action Buttons -->
<div class="flex flex-wrap items-center gap-space-sm pt-2 w-full sm:w-auto">
<a class="inline-flex items-center justify-center gap-2 px-space-lg py-3.5 bg-primary text-on-primary rounded-lg font-label-lg text-label-lg uppercase tracking-wider hover:bg-primary-container transition-all shadow-[0_10px_25px_-5px_rgba(108,34,18,0.25)]" href="#creations">
<span>Découvrir la collection</span>
<span class="material-symbols-outlined text-[18px]">south</span>
</a>
<a class="inline-flex items-center justify-center gap-2 px-space-md py-3.5 bg-surface-container-high text-on-surface hover:text-primary rounded-lg font-label-lg text-label-lg tracking-wide transition-all shadow-sm" href="https://wa.me/<?= e($S['whatsapp']) ?>?text=Bonjour%2C%20je%20souhaite%20commander%20une%20cr%C3%A9ation%20Le%20Sacr%C3%A9%20C%C3%A9ramique" rel="noopener noreferrer" target="_blank">
<span class="material-symbols-outlined text-primary text-[20px]">chat</span>
<span>Commander via WhatsApp</span>
</a>
</div>
<!-- Discrete Artisanal Guarantee Footnote -->
<div class="flex items-center gap-6 pt-4 text-on-surface-variant/80 font-label-sm text-label-sm tracking-wider uppercase">
<span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px] text-primary">verified</span> Modèles Uniques</span>
<span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px] text-secondary">local_shipping</span> Expédition Sénégal &amp; International</span>
</div>
</div>
<!-- Right Column: Visual Centerpiece (Hero Showcase) -->
<div class="lg:col-span-5 relative flex justify-center items-center">
<div class="relative w-full max-w-md lg:max-w-none">
<!-- Decorative backdrop glow -->
<div class="absolute -inset-4 bg-gradient-to-tr from-secondary-fixed/30 to-primary-fixed/40 rounded-full blur-2xl opacity-60"></div>
<!-- Main Terracotta Hero Card -->
<div class="relative rounded-xl overflow-hidden shadow-[0_16px_40px_-8px_rgba(61,36,28,0.18)] bg-surface-container-lowest p-2">
<div class="relative aspect-[4/5] rounded-lg overflow-hidden bg-surface-container">
<img alt="Encensoir en terre cuite sculpté Le Sacré Céramique" class="w-full h-full object-cover object-center transform hover:scale-105 transition-transform duration-700 ease-out" src="assets/img/hors-serie.jpg"/>
<!-- Overlay Seal Badge -->
<div class="absolute bottom-4 left-4 right-4 bg-surface/90 backdrop-blur-md px-4 py-3 rounded-lg flex items-center justify-between shadow-md">
<div>
<span class="font-label-sm text-label-sm text-outline uppercase tracking-wider block">Signature Atelier</span>
<span class="font-title-md text-title-md text-primary">Poterie Sacrée Millénaire</span>
</div>
<span class="font-headline-sm text-headline-sm text-secondary">✦</span>
</div>
</div>
</div>
<!-- Floating Ritual Tag -->
<div class="hidden sm:flex absolute -top-4 -left-6 bg-surface-bright px-4 py-3 rounded-lg shadow-[0_8px_24px_rgba(61,36,28,0.12)] items-center gap-3">
<span class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-[20px]">local_fire_department</span>
</span>
<div>
<p class="font-label-sm text-label-sm text-outline uppercase tracking-wider">Usage Rituels</p>
<p class="font-title-md text-title-md text-on-surface">Thiouraye &amp; Braises</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- ASSURANCE & ARTISANAL PILLARS -->
<section class="w-full bg-surface-container py-space-lg">
<div class="max-w-7xl mx-auto px-6 lg:px-12">
<div class="grid grid-cols-2 md:grid-cols-4 gap-gutter">
<div class="flex flex-col items-center text-center p-4 rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow">
<div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center text-primary mb-3">
<span class="material-symbols-outlined text-[24px]">front_hand</span>
</div>
<h2 class="font-title-md text-title-md text-on-surface">Fait main avec passion</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Tourné et ajouré à la main, chaque pièce possède une vibration propre.</p>
</div>
<div class="flex flex-col items-center text-center p-4 rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow">
<div class="w-12 h-12 rounded-full bg-secondary-fixed flex items-center justify-center text-secondary mb-3">
<span class="material-symbols-outlined text-[24px]">eco</span>
</div>
<h2 class="font-title-md text-title-md text-on-surface">Terre naturelle &amp; durable</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Argile pure sélectionnée pour sa haute résistance thermique aux braises.</p>
</div>
<div class="flex flex-col items-center text-center p-4 rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow">
<div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center text-tertiary mb-3">
<span class="material-symbols-outlined text-[24px]">mode_heat</span>
</div>
<h2 class="font-title-md text-title-md text-on-surface">Idéal pour vos rituels</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Diffusion lente et généreuse des arômes et thiourayes nobles.</p>
</div>
<div class="flex flex-col items-center text-center p-4 rounded-xl bg-surface-container-lowest shadow-sm hover:shadow-md transition-shadow">
<div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center text-primary mb-3">
<span class="material-symbols-outlined text-[24px]">villa</span>
</div>
<h2 class="font-title-md text-title-md text-on-surface">Une touche d'authenticité</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Un élément sculptural d'exception pour réchauffer et honorer votre intérieur.</p>
</div>
</div>
</div>
</section>
<!-- CREATIONS A LA UNE -->
<section class="w-full py-space-xl bg-surface" id="creations">
<div class="max-w-7xl mx-auto px-6 lg:px-12">
<!-- Section Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-space-lg">
<div class="space-y-2">
<span class="font-label-md text-label-md text-secondary uppercase tracking-widest font-semibold flex items-center gap-2">
<span class="w-6 h-px bg-secondary"></span> Collection Exclusive
          </span>
<h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-primary">Créations à la Une</h2>
<p class="font-body-md text-body-md text-on-surface-variant max-w-xl">
            Chaque modèle est sculpté selon des méthodes ancestrales. Découvrez nos pièces traditionnelles, bicolores et nos finitions de prestige.
          </p>
</div>
<div class="flex items-center gap-3">
<span class="font-label-sm text-label-sm text-outline uppercase tracking-wider">Contact direct :</span>
<a class="font-title-md text-title-md text-primary font-bold hover:underline" href="tel:+<?= e($S['whatsapp']) ?>"><?= e($S['phone_display']) ?></a>
</div>
</div>
<!-- Bento Product Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-gutter">
<!-- Product 1: Grand Encensoir Royal Sculpté (Large feature) -->
<div class="lg:col-span-6 flex flex-col bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_4px_20px_-2px_rgba(61,36,28,0.06)] hover:shadow-[0_12px_32px_-4px_rgba(61,36,28,0.12)] transition-all group">
<div class="relative aspect-[4/3] bg-surface-container overflow-hidden">
<img alt="Encensoir Royal Sculpté en terre cuite" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" src="assets/img/encensoir-traditionnel.jpg"/>
<div class="absolute top-4 left-4 bg-primary text-on-primary px-3 py-1 rounded-md font-label-sm text-label-sm uppercase tracking-wider">
              Pièce Maîtresse
            </div>
</div>
<div class="p-6 flex flex-col flex-1 justify-between space-y-4">
<div>
<div class="flex items-center justify-between mb-1">
<span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest">Terre Brûlée &amp; Patine Ocre</span>
<span class="font-label-md text-label-md text-outline">Fait Main</span>
</div>
<h3 class="font-headline-sm text-headline-sm text-on-surface group-hover:text-primary transition-colors">Encensoir Royal Sculpté</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-2 leading-relaxed">
                Le modèle iconique de l'atelier Le Sacré Céramique. Ajourages précis en forme de pétales pour une diffusion douce et sécurisée du thiouraye sénégalais et des résines parfumées.
              </p>
</div>
<div class="pt-4 flex items-center justify-between">
<div>
<span class="font-label-sm text-label-sm text-outline uppercase block">Disponibilité</span>
<span class="font-title-md text-title-md text-primary">Sur commande</span>
</div>
<a class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-on-primary rounded-lg font-label-md text-label-md uppercase tracking-wider hover:bg-primary-container transition-all" href="https://wa.me/<?= e($S['whatsapp']) ?>?text=Bonjour%2C%20je%20souhaite%20commander%20l'Encensoir%20Royal%20Sculpt%C3%A9" rel="noopener noreferrer" target="_blank">
<span class="material-symbols-outlined text-[16px]">chat</span>
                Commander
              </a>
</div>
</div>
</div>
<!-- Product 2: Encensoir 'Hors Série' Bicolore -->
<div class="lg:col-span-6 flex flex-col bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_4px_20px_-2px_rgba(61,36,28,0.06)] hover:shadow-[0_12px_32px_-4px_rgba(61,36,28,0.12)] transition-all group">
<div class="relative aspect-[4/3] bg-surface-container overflow-hidden">
<img alt="Encensoir Hors Série Bicolore sur pied doré" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" src="assets/img/hors-serie.jpg"/>
<div class="absolute top-4 left-4 bg-secondary text-on-secondary px-3 py-1 rounded-md font-label-sm text-label-sm uppercase tracking-wider font-semibold">
              Hors Série
            </div>
</div>
<div class="p-6 flex flex-col flex-1 justify-between space-y-4">
<div>
<div class="flex items-center justify-between mb-1">
<span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest">Édition Spéciale • Pied Doré</span>
<span class="font-label-md text-label-md text-outline">Collection Chic</span>
</div>
<h3 class="font-headline-sm text-headline-sm text-on-surface group-hover:text-primary transition-colors">Duo Hors Série Somptueux</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-2 leading-relaxed">
                Sublime rencontre entre la céramique aux perforations constellation et un pied sculptural laqué or. Disponible en vert sauge profond et noir ébène mystique.
              </p>
</div>
<div class="pt-4 flex items-center justify-between">
<div>
<span class="font-label-sm text-label-sm text-outline uppercase block">Disponibilité</span>
<span class="font-title-md text-title-md text-secondary">Édition Limitée</span>
</div>
<a class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-on-primary rounded-lg font-label-md text-label-md uppercase tracking-wider hover:bg-primary-container transition-all" href="https://wa.me/<?= e($S['whatsapp']) ?>?text=Bonjour%2C%20je%20souhaite%20commander%20le%20mod%C3%A8le%20Hors%20S%C3%A9rie%20Bicolore" rel="noopener noreferrer" target="_blank">
<span class="material-symbols-outlined text-[16px]">chat</span>
                Commander
              </a>
</div>
</div>
</div>
<!-- Product 3: Gamme Colorée & Émaillée -->
<div class="lg:col-span-7 flex flex-col bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_4px_20px_-2px_rgba(61,36,28,0.06)] hover:shadow-[0_12px_32px_-4px_rgba(61,36,28,0.12)] transition-all group">
<div class="relative aspect-[16/10] bg-surface-container overflow-hidden">
<img alt="Palette de pots à thiouraye colorés et émaillés" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" src="assets/img/gamme-coloree.jpg"/>
<div class="absolute top-4 left-4 bg-tertiary text-on-tertiary px-3 py-1 rounded-md font-label-sm text-label-sm uppercase tracking-wider">
              Palette Minérale
            </div>
</div>
<div class="p-6 flex flex-col flex-1 justify-between space-y-4">
<div>
<div class="flex items-center justify-between mb-1">
<span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest">Multi-coloris &amp; Finition Brillante</span>
<span class="font-label-md text-label-md text-outline">6 Déclinaisons</span>
</div>
<h3 class="font-headline-sm text-headline-sm text-on-surface group-hover:text-primary transition-colors">Gamme Harmonie Chromatique</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-2 leading-relaxed">
                Jaune safran, vert impérial, terracotta verni, noir nuit, blanc perle et rouge rubis. Une collection joyeuse pensée pour s’accorder aux teintes de chaque salon ou espace de méditation.
              </p>
</div>
<div class="pt-4 flex items-center justify-between">
<div>
<span class="font-label-sm text-label-sm text-outline uppercase block">Teintes</span>
<span class="font-title-md text-title-md text-on-surface">Au choix sur mesure</span>
</div>
<a class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-on-primary rounded-lg font-label-md text-label-md uppercase tracking-wider hover:bg-primary-container transition-all" href="https://wa.me/<?= e($S['whatsapp']) ?>?text=Bonjour%2C%20je%20souhaite%20choisir%20une%20couleur%20de%20la%20gamme%20color%C3%A9e" rel="noopener noreferrer" target="_blank">
<span class="material-symbols-outlined text-[16px]">chat</span>
                Choisir ma teinte
              </a>
</div>
</div>
</div>
<!-- Product 4: Coupe sur pied dorée & patinée -->
<div class="lg:col-span-5 flex flex-col bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_4px_20px_-2px_rgba(61,36,28,0.06)] hover:shadow-[0_12px_32px_-4px_rgba(61,36,28,0.12)] transition-all group">
<div class="relative aspect-[16/10] bg-surface-container overflow-hidden">
<img alt="Coupe sur pied dorée et patinée Le Sacré Céramique" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" src="assets/img/coupes-sur-pied.jpg"/>
<div class="absolute top-4 left-4 bg-on-tertiary-fixed text-tertiary-fixed px-3 py-1 rounded-md font-label-sm text-label-sm uppercase tracking-wider">
              Prestige
            </div>
</div>
<div class="p-6 flex flex-col flex-1 justify-between space-y-4">
<div>
<div class="flex items-center justify-between mb-1">
<span class="font-label-sm text-label-sm text-secondary uppercase tracking-widest">Élévation Sacrée</span>
<span class="font-label-md text-label-md text-outline">Modèle d'Autel</span>
</div>
<h3 class="font-headline-sm text-headline-sm text-on-surface group-hover:text-primary transition-colors">Coupe sur Pied Dorée &amp; Patinée</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-2 leading-relaxed">
                Une silhouette surélevée protégeant vos meubles de la chaleur, tout en conférant une allure majestueuse au foyer d'encens.
              </p>
</div>
<div class="pt-4 flex items-center justify-between">
<div>
<span class="font-label-sm text-label-sm text-outline uppercase block">Finitions</span>
<span class="font-title-md text-title-md text-primary">Bronze &amp; Or</span>
</div>
<a class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-on-primary rounded-lg font-label-md text-label-md uppercase tracking-wider hover:bg-primary-container transition-all" href="https://wa.me/<?= e($S['whatsapp']) ?>?text=Bonjour%2C%20je%20souhaite%20commander%20la%20Coupe%20sur%20Pied%20Dor%C3%A9e" rel="noopener noreferrer" target="_blank">
<span class="material-symbols-outlined text-[16px]">chat</span>
                Commander
              </a>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- L'ART DU THIOURAYE & DES RITUELS PARFUMES -->
<section class="w-full bg-surface-container-low py-space-xl relative overflow-hidden">
<div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
<!-- Left storytelling block -->
<div class="lg:col-span-6 space-y-space-md">
<div class="inline-flex items-center gap-2 text-secondary font-label-md text-label-md uppercase tracking-widest font-semibold">
<span class="material-symbols-outlined text-[18px]">spa</span>
<span>Transmission &amp; Senteurs</span>
</div>
<h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-primary leading-tight">
            L'Art du Thiouraye <br/><span class="italic text-on-surface font-normal">&amp; des Rituels Parfumés</span>
</h2>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
            Au Sénégal et à travers l’Afrique de l’Ouest, le thiouraye est bien plus qu’un parfum d'ambiance. C’est une invitation à la paix intérieure, à la sensualité, et à la bénédiction du foyer. L'argile cuite demeure le réceptacle absolu : elle respire, régule la chaleur du charbon et empêche les résines aromatiques de brûler trop vite.
          </p>
<!-- 3 Steps of the ritual -->
<div class="space-y-4 pt-2">
<div class="flex items-start gap-4 p-4 rounded-xl bg-surface-container-lowest/80 shadow-sm">
<span class="w-8 h-8 rounded-full bg-secondary-fixed text-on-secondary-fixed font-title-md text-title-md flex items-center justify-center shrink-0">1</span>
<div>
<h3 class="font-title-md text-title-md text-on-surface">La Braise Calme</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Déposez une braise ardente ou un disque de charbon végétal bien incandescent au fond du bol en terre cuite.</p>
</div>
</div>
<div class="flex items-start gap-4 p-4 rounded-xl bg-surface-container-lowest/80 shadow-sm">
<span class="w-8 h-8 rounded-full bg-primary-fixed text-on-primary-fixed font-title-md text-title-md flex items-center justify-center shrink-0">2</span>
<div>
<h3 class="font-title-md text-title-md text-on-surface">L'Offrande Aromatique</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Ajoutez une pincée de thiouraye aux huiles précieuses, des grains de gowé ou d'oliban naturel sur la braise.</p>
</div>
</div>
<div class="flex items-start gap-4 p-4 rounded-xl bg-surface-container-lowest/80 shadow-sm">
<span class="w-8 h-8 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-title-md text-title-md flex items-center justify-center shrink-0">3</span>
<div>
<h3 class="font-title-md text-title-md text-on-surface">Le Voile Parfumé</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Refermez le couvercle ajouré : la fumée s'élève en volutes harmonieuses, parfumant durablement étoffes et intérieurs.</p>
</div>
</div>
</div>
</div>
<!-- Right Visual Showcase / Ceramic Process -->
<div class="lg:col-span-6 flex flex-col space-y-gutter">
<div class="relative rounded-xl overflow-hidden bg-surface-container-highest shadow-[0_12px_32px_rgba(61,36,28,0.1)]">
<div class="aspect-[5/4] w-full">
<img alt="Ambiance rituelle d'encens et poterie en terre cuite" class="w-full h-full object-cover" src="assets/img/trio-metal.jpg"/>
</div>
<div class="absolute inset-0 bg-gradient-to-t from-on-surface/80 via-transparent to-transparent flex flex-col justify-end p-6 text-on-primary">
<p class="font-label-md text-label-md uppercase tracking-wider text-secondary-fixed">Savoir-faire Ancien</p>
<h3 class="font-headline-sm text-headline-sm">Modelé à la main sous le soleil de Dakar</h3>
<p class="font-body-sm text-body-sm text-surface-container-low opacity-90 mt-1">Chaque pièce passe par l'eau, le tournage, le séchage à l'air libre et la cuisson traditionnelle.</p>
</div>
</div>
<!-- Quick facts banner -->
<div class="grid grid-cols-2 gap-4">
<div class="bg-surface-container-lowest p-5 rounded-xl text-center shadow-sm">
<span class="font-display text-display-mobile lg:text-display text-primary block leading-none">100%</span>
<span class="font-label-md text-label-md text-on-surface-variant mt-2 block">Terre Naturelle Non Traitée</span>
</div>
<div class="bg-surface-container-lowest p-5 rounded-xl text-center shadow-sm">
<span class="font-display text-display-mobile lg:text-display text-secondary block leading-none">+500</span>
<span class="font-label-md text-label-md text-on-surface-variant mt-2 block">Foyers Sublimés</span>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- TESTIMONIALS SECTION -->
<section class="w-full py-space-xl bg-surface">
<div class="max-w-7xl mx-auto px-6 lg:px-12">
<div class="text-center max-w-2xl mx-auto space-y-3 mb-space-lg">
<span class="font-label-md text-label-md text-secondary uppercase tracking-widest font-semibold">Témoignages &amp; Éloges</span>
<h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-primary">Adopté par les Amoureux de Traditions</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Découvrez les retours de notre communauté passionnée de rituels olfactifs et de décoration authentique.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<!-- Card 1 -->
<div class="p-6 rounded-xl bg-surface-container-low shadow-[0_4px_16px_rgba(61,36,28,0.04)] flex flex-col justify-between space-y-4">
<div class="space-y-3">
<div class="flex items-center text-secondary">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<p class="font-body-md text-body-md text-on-surface italic">
              "L’encensoir royal en terre cuite rouge est d'une beauté saisissante. Il retient parfaitement la chaleur sans brûler mes meubles et la fumée s’échappe avec une grâce incroyable."
            </p>
</div>
<div class="flex items-center gap-3 pt-2">
<div class="w-10 h-10 rounded-full bg-primary-fixed text-primary font-bold flex items-center justify-center font-title-md text-title-md">
              A
            </div>
<div>
<p class="font-title-md text-title-md text-on-surface">Aminata D.</p>
<p class="font-label-sm text-label-sm text-outline">Dakar, Sénégal</p>
</div>
</div>
</div>
<!-- Card 2 -->
<div class="p-6 rounded-xl bg-surface-container-low shadow-[0_4px_16px_rgba(61,36,28,0.04)] flex flex-col justify-between space-y-4">
<div class="space-y-3">
<div class="flex items-center text-secondary">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<p class="font-body-md text-body-md text-on-surface italic">
              "J’ai commandé le modèle Hors Série vert sauge avec le pied doré par WhatsApp. Réponse ultra rapide, emballage soigné et la pièce est encore plus belle en vrai que sur photo !"
            </p>
</div>
<div class="flex items-center gap-3 pt-2">
<div class="w-10 h-10 rounded-full bg-secondary-fixed text-secondary font-bold flex items-center justify-center font-title-md text-title-md">
              K
            </div>
<div>
<p class="font-title-md text-title-md text-on-surface">Khadija M.</p>
<p class="font-label-sm text-label-sm text-outline">Abidjan, Côte d'Ivoire</p>
</div>
</div>
</div>
<!-- Card 3 -->
<div class="p-6 rounded-xl bg-surface-container-low shadow-[0_4px_16px_rgba(61,36,28,0.04)] flex flex-col justify-between space-y-4">
<div class="space-y-3">
<div class="flex items-center text-secondary">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
<p class="font-body-md text-body-md text-on-surface italic">
              "Un objet qui reconnecte aux racines. Le grain de la terre, les ouvertures taillées à la main... C'est du véritable artisanat d'art, chaleureux et vibrant."
            </p>
</div>
<div class="flex items-center gap-3 pt-2">
<div class="w-10 h-10 rounded-full bg-tertiary-fixed text-tertiary font-bold flex items-center justify-center font-title-md text-title-md">
              S
            </div>
<div>
<p class="font-title-md text-title-md text-on-surface">Seydou N.</p>
<p class="font-label-sm text-label-sm text-outline">Paris, France</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- CONCIERGE & DIRECT WHATSAPP ORDER CALLOUT -->
<section class="w-full bg-gradient-to-r from-primary via-primary-container to-tertiary text-on-primary py-space-xl">
<div class="max-w-7xl mx-auto px-6 lg:px-12">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
<div class="lg:col-span-8 space-y-4">
<div class="inline-flex items-center gap-2 bg-on-primary/10 px-3 py-1 rounded-full text-primary-fixed font-label-sm text-label-sm uppercase tracking-wider">
<span class="material-symbols-outlined text-[16px]">support_agent</span>
<span>Commande Directe &amp; Personnalisée</span>
</div>
<h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg font-medium leading-tight">
            Envie d'un encensoir sur-mesure ou d'une pièce unique ?
          </h2>
<p class="font-body-lg text-body-lg text-primary-fixed leading-relaxed max-w-2xl">
            Échangez directement avec notre atelier pour choisir vos dimensions, teintes d'émaillage ou organiser une livraison expresse.
          </p>
<div class="flex flex-wrap items-center gap-6 pt-2">
<div class="flex items-center gap-3">
<span class="w-12 h-12 rounded-full bg-on-primary/10 flex items-center justify-center">
<span class="material-symbols-outlined text-[24px]">call</span>
</span>
<div>
<span class="font-label-sm text-label-sm text-primary-fixed uppercase tracking-wider block">Téléphone / WhatsApp</span>
<a class="font-headline-sm text-headline-sm text-on-primary hover:underline font-bold" href="tel:+<?= e($S['whatsapp']) ?>"><?= e($S['phone_display']) ?></a>
</div>
</div>
</div>
</div>
<div class="lg:col-span-4 flex flex-col items-start lg:items-end justify-center">
<a class="inline-flex items-center gap-3 px-8 py-4 bg-surface text-primary rounded-xl font-title-md text-title-md hover:bg-surface-bright transition-all shadow-[0_10px_30px_rgba(0,0,0,0.2)]" href="https://wa.me/<?= e($S['whatsapp']) ?>?text=Bonjour%2C%20je%20d%C3%A9sire%20passer%20commande%20d'un%20encensoir%20Le%20Sacr%C3%A9%20C%C3%A9ramique" rel="noopener noreferrer" target="_blank">
<span class="material-symbols-outlined text-[24px] text-primary">chat</span>
<span>Commander sur WhatsApp</span>
</a>
<p class="font-label-sm text-label-sm text-primary-fixed mt-3 text-center lg:text-right">
            Réponse sous quelques minutes • Conseils rituels offerts
          </p>
</div>
</div>
</div>
</section>
</div></main><footer class="w-full bg-surface-container-low text-on-surface mt-space-xl shadow-[0_-1px_16px_rgba(61,36,28,0.03)]"><div class="max-w-7xl mx-auto px-6 lg:px-12 py-space-xl"><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter"><div class="space-y-space-sm"><div class="flex items-center gap-space-xs"><img alt="Le Sacré Céramique" class="mix-blend-multiply h-7 w-auto object-contain" src="assets/img/logo.png"/><h3 class="font-headline-sm text-headline-sm text-primary">Le Sacré Céramique</h3></div><p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Atelier d'art perpétuant le modelage séculaire d'encensoirs en terre cuite et pots à thiouraye. Chaque pièce est sculptée à la main pour honorer la sérénité des rituels olfactifs.</p><div class="flex items-center gap-space-xs pt-2"><span class="material-symbols-outlined text-primary text-[20px]">verified</span><span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">100% Fait Main • Terre Cuite Locale</span></div></div><div class="space-y-space-sm"><h4 class="font-title-md text-title-md text-on-surface tracking-wide">Découverte &amp; Liens</h4><ul class="space-y-2 font-body-sm text-body-sm text-on-surface-variant"><li><a class="hover:text-primary transition-colors" data-path="accueil" href="index.php">Accueil &amp; Galerie</a></li><li><a class="hover:text-primary transition-colors" data-path="nos-produits" href="nos-produits.php">Encensoirs &amp; Brûleurs</a></li><li><a class="hover:text-primary transition-colors" data-path="notre-histoire" href="notre-histoire.php">L'Âme de l'Atelier</a></li><li><a class="hover:text-primary transition-colors" data-path="commander" href="commander.php">Processus de Commande</a></li><li><a class="hover:text-primary transition-colors" data-path="contact" href="contact.php">Atelier &amp; Échange</a></li></ul></div><div class="space-y-space-sm"><h4 class="font-title-md text-title-md text-on-surface tracking-wide">Horaires d'Ouverture</h4><div data-noedit class="font-body-sm text-body-sm text-on-surface-variant space-y-2"><?php foreach($S['hours'] as $hr): ?><p class="flex justify-between py-1 bg-surface-container px-3 rounded-lg"><span><?= e($hr[0]) ?></span><span class="font-label-md text-label-md text-primary"><?= e($hr[1]) ?></span></p><?php endforeach; ?></div><p class="font-label-sm text-label-sm text-outline-variant pt-1">Visites privées de l'atelier sur réservation préalable.</p></div><div class="space-y-space-sm"><h4 class="font-title-md text-title-md text-on-surface tracking-wide">Contact &amp; Réseaux</h4><p class="font-body-sm text-body-sm text-on-surface-variant">Commandes directes, créations sur-mesure et expéditions soigneusement emballées.</p><div class="flex items-center gap-space-xs text-primary font-title-md text-title-md"><span class="material-symbols-outlined text-[22px]">phone_in_talk</span><a class="hover:underline" href="tel:+<?= e($S['whatsapp']) ?>"><?= e($S['phone_display']) ?></a></div><div class="flex items-center gap-3 pt-2"><a aria-label="WhatsApp" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="https://wa.me/<?= e($S['whatsapp']) ?>" rel="noopener noreferrer" target="_blank"><span class="material-symbols-outlined text-[20px]">chat</span></a><a aria-label="Galerie Photo" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="#"><span class="material-symbols-outlined text-[20px]">photo_camera</span></a><a aria-label="Atelier Live" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="#"><span class="material-symbols-outlined text-[20px]">explore</span></a><a aria-label="Email" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="#"><span class="material-symbols-outlined text-[20px]">mail</span></a></div></div></div><div class="mt-space-xl pt-space-md bg-surface-container-lowest/50 rounded-xl px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4 font-body-sm text-body-sm text-on-surface-variant"><p>© 2025 Le Sacré Céramique. Tous droits réservés. Façonné avec dévotion.</p><p class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Poterie Sacrée • Thiouraye &amp; Résines • Pièces Uniques</p></div></div></footer><nav id="mobileNav" aria-label="Navigation mobile" class="lg:hidden fixed bottom-0 inset-x-0 z-50 bg-surface/95 backdrop-blur-xl border-t border-outline-variant/40 shadow-[0_-4px_16px_rgba(61,36,28,0.08)] pb-[env(safe-area-inset-bottom)]"><div class="grid grid-cols-5"><a href="index.php" aria-current="page" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-primary"><span class="material-symbols-outlined text-[22px]" style="font-variation-settings:'FILL' 1;">home</span>Accueil</a><a href="nos-produits.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">category</span>Créations</a><a href="commander.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">shopping_bag</span>Commander</a><a href="notre-histoire.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">menu_book</span>Histoire</a><a href="contact.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">call</span>Contact</a></div></nav></body></html>
<?php echo cms_render((string)ob_get_clean(), 'index'); ?>
