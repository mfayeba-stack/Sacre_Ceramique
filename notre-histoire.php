<?php require __DIR__ . '/inc/bootstrap.php'; require __DIR__ . '/inc/cms.php'; ob_start(); ?>
<!DOCTYPE html>

<html lang="fr"><head><meta charset="utf-8"/><title>Notre Histoire — Le Sacré Céramique</title><link rel="icon" href="assets/img/logo.png"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/><meta content="web_standard" name="shell-type"/><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/><link href="https://fonts.googleapis.com" rel="preconnect"/><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/><?= theme_fonts_link() ?>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/><style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com"></script><script src="assets/js/tailwind-config.php"></script></head><body class="pb-16 lg:pb-0 bg-surface font-body-md text-on-surface antialiased selection:bg-primary-fixed selection:text-on-primary-fixed"><header class="fixed top-0 w-full z-50 bg-surface/90 backdrop-blur-xl shadow-[0_1px_12px_rgba(61,36,28,0.06)]"><div class="h-20 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-gutter"><div class="flex items-center gap-space-sm"><img alt="Le Sacré Céramique" class="mix-blend-multiply h-8 w-auto object-contain" src="assets/img/logo.png"/><a class="font-title-lg text-title-lg tracking-tight text-primary hover:text-primary-container transition-colors" data-path="accueil" href="index.php">Le Sacré Céramique</a></div><nav class="hidden lg:flex items-center gap-space-xs p-1" data-active-classes="bg-primary-container text-on-primary rounded-lg shadow-sm"><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="accueil" href="index.php">Accueil</a><a aria-current="page" class="px-space-sm py-2 font-label-lg transition-colors bg-primary-container text-on-primary rounded-lg shadow-sm" data-path="notre-histoire" href="notre-histoire.php">Notre Histoire</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="nos-produits" href="nos-produits.php">Nos Produits</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="commander" href="commander.php">Commander</a><a class="px-space-sm py-2 font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" data-path="contact" href="contact.php">Contact</a></nav><div class="flex items-center gap-space-sm"><a class="inline-flex items-center gap-2 px-space-md py-2.5 bg-primary text-on-primary rounded-lg font-label-md text-label-md uppercase tracking-wider hover:bg-primary-container transition-all shadow-[0_4px_16px_rgba(108,34,18,0.2)]" href="https://wa.me/<?= e($S['whatsapp']) ?>" rel="noopener noreferrer" target="_blank"><span class="material-symbols-outlined text-[18px]">chat</span><span class="hidden sm:inline">Commander sur WhatsApp</span></a></div></div><?php if(!empty($S['announcement']['enabled'])): ?><div class="bg-primary text-on-primary text-center px-4 py-2 font-label-md text-label-md"><?= e($S['announcement']['text']) ?> <a class="underline font-semibold ml-2" href="https://wa.me/<?= e($S['whatsapp']) ?>" target="_blank" rel="noopener noreferrer"><?= e($S['announcement']['link_label']) ?> →</a></div><?php endif; ?></header><main class="overflow-x-clip w-full <?= !empty($S['announcement']['enabled']) ? 'pt-[7rem]' : 'pt-20' ?> bg-surface"><div class="flex flex-col w-full">
<!-- Editorial Intro / Narrative Header -->
<section class="relative px-6 lg:px-12 py-space-xl max-w-7xl mx-auto w-full">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
<div class="lg:col-span-7 space-y-space-md">
<div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-container rounded-full">
<span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-widest">Chroniques de la Matière • Dakar</span>
</div>
<h1 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-primary leading-tight">
          L'esprit de l'argile, la ferveur du geste et la flamme sacrée.
        </h1>
<p class="font-body-lg text-body-lg text-on-surface-variant font-light max-w-2xl leading-relaxed">
          Né d'un désir vibrant de préserver les rituels olfactifs séculaires, l'atelier <span class="text-primary font-medium italic">Le Sacré Céramique</span> façonne à la main des encensoirs et pots à thiouraye pensés comme des sculptures votives, unissant la terre nourricière à la volupté des résines précieuses.
        </p>
<div class="pt-2 flex flex-wrap items-center gap-4">
<div class="flex items-center gap-3 pr-6">
<span class="material-symbols-outlined text-secondary text-[28px]" style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
<div>
<p class="font-title-md text-title-md text-on-surface">Cuisson Ancestrale</p>
<p class="font-label-sm text-label-sm text-on-surface-variant">Terre cuite chamottée &amp; patines nobles</p>
</div>
</div>
<div class="flex items-center gap-3 pl-2">
<span class="material-symbols-outlined text-primary text-[28px]">all_inclusive</span>
<div>
<p class="font-title-md text-title-md text-on-surface">Héritage Vivant</p>
<p class="font-label-sm text-label-sm text-on-surface-variant">Transmission d'un rituel intemporel</p>
</div>
</div>
</div>
</div>
<div class="lg:col-span-5 relative">
<div class="relative bg-surface-container-low rounded-2xl p-4 shadow-xl overflow-hidden">
<img alt="Trois brûleurs d'encens d'art Le Sacré Céramique sculptés à la main, finitions argentée martelée, or bruni et bronze antique texturé avec motifs étoilés et perforations pour la diffusion des résines" class="w-full h-[460px] object-cover rounded-xl shadow-md transition-transform duration-700 hover:scale-105" src="assets/img/trio-metal.jpg"/>
<div class="absolute bottom-6 left-6 right-6 bg-surface-bright/95 backdrop-blur-md rounded-xl p-4 shadow-lg">
<div class="flex items-center justify-between">
<div>
<p class="font-label-sm text-label-sm text-primary uppercase tracking-widest font-semibold">Triptyque Signature</p>
<p class="font-title-md text-title-md text-on-surface">Série Métaux Sacrés • Or, Argent &amp; Bronze</p>
</div>
<span class="material-symbols-outlined text-secondary text-[24px]">workspace_premium</span>
</div>
</div>
</div>
<!-- Decorative warm ambient glow behind image -->
<div class="absolute -top-10 -right-10 w-72 h-72 bg-secondary-fixed/40 rounded-full blur-3xl -z-10 pointer-events-none"></div>
</div>
</div>
</section>
<!-- Narrative Split: "Aux origines de la terre et du feu" -->
<section class="bg-surface-container-low py-space-xl px-6 lg:px-12 w-full">
<div class="max-w-7xl mx-auto">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
<!-- Visual Story Column -->
<div class="lg:col-span-5 order-2 lg:order-1 relative">
<div class="relative rounded-2xl overflow-hidden shadow-xl bg-surface-container">
<img alt="Encensoir traditionnel en céramique rouge terracotta foncée orné de gravures curvilignes et perforations d'aération posé avec des résines parfumées et fleurs séchées" class="w-full h-[520px] object-cover rounded-2xl shadow-inner" src="assets/img/encensoir-traditionnel.jpg"/>
<div class="absolute top-6 left-6 bg-primary/90 text-on-primary px-4 py-2 rounded-lg backdrop-blur-md shadow-md">
<span class="font-label-sm text-label-sm tracking-widest uppercase">Origine &amp; Essence</span>
</div>
<div class="absolute bottom-6 left-6 right-6 bg-surface-container-lowest/90 backdrop-blur-sm p-4 rounded-xl text-center">
<p class="font-title-lg text-title-lg italic text-primary">« Plus qu'un objet, une tradition. »</p>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mt-1">L'authenticité du fait main, la beauté du naturel</p>
</div>
</div>
<!-- Decorative stamp motif -->
<div class="absolute -bottom-6 -left-6 w-24 h-24 bg-surface-bright rounded-2xl shadow-md p-3 flex flex-col items-center justify-center text-center">
<span class="material-symbols-outlined text-primary text-[28px]">spa</span>
<span class="font-label-sm text-label-sm text-on-surface font-semibold">100% Pure</span>
<span class="font-label-sm text-[9px] text-outline">Argile Brute</span>
</div>
</div>
<!-- Text Content Column -->
<div class="lg:col-span-7 order-1 lg:order-2 space-y-space-md lg:pl-space-md">
<div class="space-y-space-xs">
<p class="font-label-md text-label-md text-secondary uppercase tracking-widest">Chapitre I • Genèse</p>
<h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-on-surface">Aux origines de la terre et du feu</h2>
</div>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
            Dans la mémoire de nos aïeules, le crépitement d'une braise et les volutes douces de thiouraye ont toujours marqué le seuil des maisons hospitalières. Ce rituel intime réconforte l'esprit, purifie le sanctuaire familial et enlace chaque pièce d'une signature olfactive inoubliable.
          </p>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
            Pourtant, au fil des années, les récipients en fonte anonyme et les fabrications industrielles avaient fait oublier la noblesse du modelage terrien. <strong class="text-primary font-semibold">Le Sacré Céramique</strong> est né de ce sursaut passionné : réhabiliter la poterie rituelle à travers un regard sculptural, respectueux des gestes ancestraux et sublimé par des finitions d'une élégance rare.
          </p>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-space-sm pt-space-xs">
<div class="bg-surface-bright p-space-sm rounded-xl shadow-sm space-y-1">
<div class="w-8 h-8 rounded-lg bg-primary-fixed flex items-center justify-center text-primary font-bold">01</div>
<h3 class="font-title-md text-title-md text-on-surface">Émotion Olfactive</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Conçus pour réguler la chaleur des braises et magnifier les encens sans les calciner prématurément.</p>
</div>
<div class="bg-surface-bright p-space-sm rounded-xl shadow-sm space-y-1">
<div class="w-8 h-8 rounded-lg bg-secondary-fixed flex items-center justify-center text-secondary font-bold">02</div>
<h3 class="font-title-md text-title-md text-on-surface">Sérénité d'Intérieur</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Des objets vivants qui habitent l'espace d'une présence apaisante, même lorsqu'ils sont au repos.</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Step-by-Step Craftsmanship Bento Grid: 'Notre savoir-faire d'exception' -->
<section class="py-space-xl px-6 lg:px-12 max-w-7xl mx-auto w-full space-y-space-lg">
<div class="text-center max-w-3xl mx-auto space-y-space-xs">
<p class="font-label-md text-label-md text-primary uppercase tracking-widest">Alchimie &amp; Maîtrise</p>
<h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-on-surface">Notre savoir-faire d'exception</h2>
<p class="font-body-md text-body-md text-on-surface-variant">
        Chaque encensoir exige plus de huit jours de dévotion ininterrompue entre la prise d'argile brute et la dernière touche de cire naturelle.
      </p>
</div>
<!-- Craft Steps Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
<!-- Step 1 -->
<div class="bg-surface-container-low p-space-md rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col justify-between space-y-space-sm">
<div class="space-y-space-xs">
<div class="flex items-center justify-between">
<span class="w-9 h-9 rounded-full bg-primary text-on-primary font-label-md text-label-md flex items-center justify-center">01</span>
<span class="material-symbols-outlined text-outline-variant text-[24px]">landscape</span>
</div>
<h3 class="font-title-lg text-title-lg text-on-surface">Sélection de l'Argile Naturelle</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
            Nous prélevons une argile sédimentaire locale riche en oxyde de fer, tamisée à la main pour éliminer les impuretés et garantir une résistance thermique remarquable au contact des charbons ardents.
          </p>
</div>
<div class="pt-space-xs font-label-sm text-label-sm text-primary font-semibold uppercase tracking-wider flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">check_circle</span> Matière vivante &amp; noble
        </div>
</div>
<!-- Step 2 -->
<div class="bg-surface-container-low p-space-md rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col justify-between space-y-space-sm">
<div class="space-y-space-xs">
<div class="flex items-center justify-between">
<span class="w-9 h-9 rounded-full bg-primary text-on-primary font-label-md text-label-md flex items-center justify-center">02</span>
<span class="material-symbols-outlined text-outline-variant text-[24px]">draw</span>
</div>
<h3 class="font-title-lg text-title-lg text-on-surface">Modelage &amp; Tournage à la Main</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
            Sur le tour traditionnel puis à la main libre, le potier monte la panse ventrue et façonne le dôme d'ajourage. Chaque courbe est calibrée pour créer un vortex d'air optimal favorisant la combustion lente du thiouraye.
          </p>
</div>
<div class="pt-space-xs font-label-sm text-label-sm text-primary font-semibold uppercase tracking-wider flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">check_circle</span> Geste millénaire unique
        </div>
</div>
<!-- Step 3 -->
<div class="bg-surface-container-low p-space-md rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col justify-between space-y-space-sm">
<div class="space-y-space-xs">
<div class="flex items-center justify-between">
<span class="w-9 h-9 rounded-full bg-primary text-on-primary font-label-md text-label-md flex items-center justify-center">03</span>
<span class="material-symbols-outlined text-outline-variant text-[24px]">light_mode</span>
</div>
<h3 class="font-title-lg text-title-lg text-on-surface">Séchage Lent &amp; Ombragé</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
            À l'abri du soleil direct pour prévenir toute micro-fissure, les pièces reposent pendant 72 heures dans une pièce aérée. La terre atteint alors la consistance idéale dite « cuir » propice à l'incision minutieuse.
          </p>
</div>
<div class="pt-space-xs font-label-sm text-label-sm text-primary font-semibold uppercase tracking-wider flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">check_circle</span> Équilibre hydrique parfait
        </div>
</div>
<!-- Step 4 -->
<div class="bg-surface-container-low p-space-md rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col justify-between space-y-space-sm">
<div class="space-y-space-xs">
<div class="flex items-center justify-between">
<span class="w-9 h-9 rounded-full bg-primary text-on-primary font-label-md text-label-md flex items-center justify-center">04</span>
<span class="material-symbols-outlined text-outline-variant text-[24px]">auto_awesome</span>
</div>
<h3 class="font-title-lg text-title-lg text-on-surface">Perçages &amp; Gravures Sacrées</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
            À la pointe d'ébène, l'artisan perfore les étoiles, pétales et conduits d'évacuation par où s'élèvera la fumée odorante. Les cannelures et stries verticales sont gravées une à une à un rythme quasi méditatif.
          </p>
</div>
<div class="pt-space-xs font-label-sm text-label-sm text-primary font-semibold uppercase tracking-wider flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">check_circle</span> Aération calculée au millimètre
        </div>
</div>
<!-- Step 5 -->
<div class="bg-surface-container-low p-space-md rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col justify-between space-y-space-sm">
<div class="space-y-space-xs">
<div class="flex items-center justify-between">
<span class="w-9 h-9 rounded-full bg-primary text-on-primary font-label-md text-label-md flex items-center justify-center">05</span>
<span class="material-symbols-outlined text-outline-variant text-[24px]">whatshot</span>
</div>
<h3 class="font-title-lg text-title-lg text-on-surface">Cuisson au Four Traditionnel</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
            Montée progressive en température jusqu'à plus de 950°C. Les minéraux s'agrègent, scellant la robustesse de l'objet tout en conférant cette sonorité claire et minérale reconnaissable au simple toucher du couvercle.
          </p>
</div>
<div class="pt-space-xs font-label-sm text-label-sm text-primary font-semibold uppercase tracking-wider flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">check_circle</span> Résistance au feu durable
        </div>
</div>
<!-- Step 6 -->
<div class="bg-surface-container-low p-space-md rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col justify-between space-y-space-sm">
<div class="space-y-space-xs">
<div class="flex items-center justify-between">
<span class="w-9 h-9 rounded-full bg-primary text-on-primary font-label-md text-label-md flex items-center justify-center">06</span>
<span class="material-symbols-outlined text-outline-variant text-[24px]">palette</span>
</div>
<h3 class="font-title-lg text-title-lg text-on-surface">Patines &amp; Finitions Royales</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
            Application soignée des patines cuivrées, dorures satinées, reflets d'argent vieilli ou rouge ocre profond. Chaque pièce est ensuite adoucie par un lustrage naturel pour un contact tactile voluptueux.
          </p>
</div>
<div class="pt-space-xs font-label-sm text-label-sm text-primary font-semibold uppercase tracking-wider flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">check_circle</span> Éclat chaleureux unique
        </div>
</div>
</div>
</section>
<!-- Photo Insight & Tactile Atmosphere Section -->
<section class="bg-surface-container py-space-xl px-6 lg:px-12 w-full">
<div class="max-w-7xl mx-auto space-y-space-lg">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
<div class="lg:col-span-6 space-y-space-sm">
<p class="font-label-md text-label-md text-primary uppercase tracking-widest">Matière &amp; Philosophie</p>
<h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-on-surface">Une symbiose entre rituel sacré et art de vivre</h2>
<p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
            L'encensoir n'est pas un accessoire passager. C'est le centre névralgique de votre sanctuaire intérieur. Lorsqu'il accueille la braise rougeoyante et les fragments de résines de santal, de myrrhe ou de thiouraye dakarois, il s'anime : la lumière filtre doucement à travers ses fenêtres ajourées, projetant sur vos murs un jeu d'ombres dansant propice au recueillement.
          </p>
<div class="p-space-md bg-surface-bright rounded-2xl shadow-sm border-0 flex items-start gap-4">
<span class="material-symbols-outlined text-secondary text-[32px] shrink-0 mt-1">favorite</span>
<div>
<h4 class="font-title-md text-title-md text-on-surface">Le respect des gestes transmis</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                Nous formons de jeunes potiers passionnés afin d'assurer que ce patrimoine immatériel ne disparaisse jamais au profit de la production déshumanisée.
              </p>
</div>
</div>
</div>
<div class="lg:col-span-6">
<div class="grid grid-cols-2 gap-4">
<div class="space-y-4">
<div class="rounded-2xl overflow-hidden shadow-lg bg-surface-bright">
<img class="w-full h-56 object-cover hover:scale-105 transition-transform duration-500" data-alt="Mains d'artisan potier couvertes d'argile humide modelant soigneusement le col d'un pot à encens sur un tour traditionnel sous la lumière dorée d'un atelier à Dakar" src="assets/img/tailles-couleurs.jpg"/>
</div>
<div class="p-4 bg-primary text-on-primary rounded-2xl shadow-md text-center">
<p class="font-headline-md text-headline-md font-bold">100%</p>
<p class="font-label-sm text-label-sm uppercase tracking-wider text-primary-fixed">Façonné à la main</p>
</div>
</div>
<div class="space-y-4 pt-6">
<div class="p-4 bg-secondary text-on-secondary rounded-2xl shadow-md text-center">
<p class="font-headline-md text-headline-md font-bold">&gt; 950°C</p>
<p class="font-label-sm text-label-sm uppercase tracking-wider text-secondary-fixed">Cuisson céramique</p>
</div>
<div class="rounded-2xl overflow-hidden shadow-lg bg-surface-bright">
<img class="w-full h-56 object-cover hover:scale-105 transition-transform duration-500" data-alt="Gros plan sur les détails d'un encensoir d'artisanat africain avec fumée d'encens parfumée s'échappant doucement des perforations en étoile dans une atmosphère tamisée et feutrée" src="assets/img/gamme-coloree.jpg"/>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Fundamental Values / Quatre Piliers -->
<section class="py-space-xl px-6 lg:px-12 max-w-7xl mx-auto w-full space-y-space-lg">
<div class="text-center max-w-2xl mx-auto space-y-space-xs">
<p class="font-label-md text-label-md text-secondary uppercase tracking-widest">Nos Engagements</p>
<h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-on-surface">Les piliers du Sacré</h2>
<p class="font-body-md text-body-md text-on-surface-variant">L'exigence du beau, la sincérité du durable et l'amour inconditionnel des rituels.</p>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-gutter">
<!-- Pillar 1 -->
<div class="bg-surface-bright p-space-md rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 space-y-space-sm text-center flex flex-col items-center">
<div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center text-primary shadow-inner">
<span class="material-symbols-outlined text-[30px]" style="font-variation-settings: 'FILL' 1;">eco</span>
</div>
<h3 class="font-title-md text-title-md text-on-surface">Terre 100% Naturelle</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
          Aucun additif toxique ni solvant nocif lors de la chauffe. Notre argile est saine pour l'air que respire votre famille.
        </p>
</div>
<!-- Pillar 2 -->
<div class="bg-surface-bright p-space-md rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 space-y-space-sm text-center flex flex-col items-center">
<div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center text-primary shadow-inner">
<span class="material-symbols-outlined text-[30px]">fingerprint</span>
</div>
<h3 class="font-title-md text-title-md text-on-surface">Chaque Pièce Unique</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
          Le grain, la courbe et la patine portent l'empreinte singulière du moment de création. Vous adoptez une œuvre sans réplique.
        </p>
</div>
<!-- Pillar 3 -->
<div class="bg-surface-bright p-space-md rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 space-y-space-sm text-center flex flex-col items-center">
<div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center text-primary shadow-inner">
<span class="material-symbols-outlined text-[30px]" style="font-variation-settings: 'FILL' 1;">shield</span>
</div>
<h3 class="font-title-md text-title-md text-on-surface">Durabilité Éprouvée</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
          Pensé pour traverser les années et vous accompagner lors de toutes vos célébrations, veillées et moments de ressourcement.
        </p>
</div>
<!-- Pillar 4 -->
<div class="bg-surface-bright p-space-md rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 space-y-space-sm text-center flex flex-col items-center">
<div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center text-primary shadow-inner">
<span class="material-symbols-outlined text-[30px]">temple_buddhist</span>
</div>
<h3 class="font-title-md text-title-md text-on-surface">Harmonie &amp; Rituel</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
          Une ergonomie étudiée pour déposer aisément charbon et encens sans risque de brûlure ni surchauffe excessive des socles.
        </p>
</div>
</div>
</section>
<!-- Founder's Word & Quality Guarantee -->
<section class="bg-surface-container-high py-space-xl px-6 lg:px-12 w-full">
<div class="max-w-5xl mx-auto bg-surface-bright rounded-3xl p-8 lg:p-12 shadow-xl relative overflow-hidden">
<div class="relative z-10 grid grid-cols-1 md:grid-cols-12 gap-gutter items-center">
<div class="md:col-span-4 flex flex-col items-center text-center space-y-3">
<div class="w-32 h-32 rounded-full overflow-hidden shadow-lg border-0 bg-surface-container">
<img class="w-full h-full object-cover" data-alt="Portrait chaleureux et digne du maître artisan céramiste souriant dans son atelier avec un tablier de potier en lin entouré de créations en terre cuite" src="assets/img/logo.png"/>
</div>
<div>
<h3 class="font-title-lg text-title-lg text-on-surface">Moustapha &amp; L'Équipe</h3>
<p class="font-label-sm text-label-sm text-primary uppercase tracking-widest font-semibold">Fondateur &amp; Artisan Céramiste</p>
</div>
<div class="flex items-center gap-1 text-secondary">
<span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
<span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
</div>
</div>
<div class="md:col-span-8 space-y-space-sm md:border-l-0 md:pl-space-md">
<div class="flex items-center gap-2 text-primary">
<span class="material-symbols-outlined text-[32px]">format_quote</span>
<span class="font-label-sm text-label-sm uppercase tracking-widest font-semibold">Parole d'Atelier</span>
</div>
<p class="font-headline-sm text-headline-sm text-on-surface italic font-normal leading-snug">
            « Lorsque nous pétrissons l'argile, nous y imprimons notre respect pour ceux qui allumeront la flamme chez eux. Notre promesse est simple : vous offrir une pièce qui vibre, qui réchauffe le cœur et traverse le temps. »
          </p>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
            Chaque création est contrôlée personnellement avant expédition. En cas de casse durant le transport ou de non-conformité avec vos souhaits, nous remplaçons immédiatement votre pièce sans aucune démarche complexe.
          </p>
<div class="pt-2 flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-[20px]">verified</span>
<span class="font-label-sm text-label-sm text-on-surface font-semibold uppercase tracking-wider">Garantie Livraison Intacte &amp; Qualité Maître Artisan</span>
</div>
</div>
</div>
</div>
</section>
<!-- Interactive Call to Action / Invitation to Explore & Custom Orders -->
<section class="py-space-xl px-6 lg:px-12 max-w-7xl mx-auto w-full">
<div class="bg-primary text-on-primary rounded-3xl p-8 lg:p-14 shadow-2xl relative overflow-hidden">
<!-- Background subtle atmospheric SVG rings -->
<div class="absolute -right-20 -bottom-20 w-96 h-96 opacity-10 pointer-events-none">
<svg class="w-full h-full text-on-primary" fill="currentColor" viewbox="0 0 200 200">
<circle cx="100" cy="100" fill="none" r="80" stroke="currentColor" stroke-width="2"></circle>
<circle cx="100" cy="100" fill="none" r="60" stroke="currentColor" stroke-width="2"></circle>
<circle cx="100" cy="100" fill="none" r="40" stroke="currentColor" stroke-width="2"></circle>
</svg>
</div>
<div class="relative z-10 max-w-3xl space-y-space-md">
<div class="inline-flex items-center gap-2 px-3 py-1 bg-primary-container rounded-full text-on-primary">
<span class="material-symbols-outlined text-[18px]">brush</span>
<span class="font-label-sm text-label-sm uppercase tracking-wider">Création Sur Mesure &amp; Collections</span>
</div>
<h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg font-medium leading-tight">
          Prêt à accueillir la chaleur sacrée dans votre intérieur ?
        </h2>
<p class="font-body-lg text-body-lg text-primary-fixed leading-relaxed">
          Découvrez nos collections d'encensoirs disponibles ou contactez directement l'artisan via WhatsApp pour personnaliser les dimensions, les perforations et la patine de votre futur brûleur.
        </p>
<div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 pt-2">
<a class="px-space-md py-3.5 bg-surface text-primary rounded-lg font-label-lg text-label-lg uppercase tracking-wider hover:bg-surface-container transition-all shadow-md text-center flex items-center justify-center gap-2 font-semibold" data-path="nos-produits" href="nos-produits.php">
<span class="material-symbols-outlined text-[20px]">explore</span>
            Découvrir le Catalogue
          </a>
<a class="px-space-md py-3.5 bg-secondary-container text-on-secondary-container hover:bg-secondary-fixed rounded-lg font-label-lg text-label-lg uppercase tracking-wider transition-all shadow-md text-center flex items-center justify-center gap-2 font-semibold" href="https://wa.me/<?= e($S['whatsapp']) ?>?text=Bonjour,%20j'ai%20découvert%20l'histoire%20de%20l'atelier%20Le%20Sacré%20Céramique%20et%20je%20souhaite%20commander%20une%20pièce%20sur%20mesure." rel="noopener noreferrer" target="_blank">
<span class="material-symbols-outlined text-[20px]">chat</span>
            Échanger sur WhatsApp (<?= e($S['phone_display']) ?>)
          </a>
</div>
</div>
</div>
</section>
</div></main><footer class="w-full bg-surface-container-low text-on-surface mt-space-xl shadow-[0_-1px_16px_rgba(61,36,28,0.03)]"><div class="max-w-7xl mx-auto px-6 lg:px-12 py-space-xl"><div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter"><div class="space-y-space-sm"><div class="flex items-center gap-space-xs"><img alt="Le Sacré Céramique" class="mix-blend-multiply h-7 w-auto object-contain" src="assets/img/logo.png"/><h3 class="font-headline-sm text-headline-sm text-primary">Le Sacré Céramique</h3></div><p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">Atelier d'art perpétuant le modelage séculaire d'encensoirs en terre cuite et pots à thiouraye. Chaque pièce est sculptée à la main pour honorer la sérénité des rituels olfactifs.</p><div class="flex items-center gap-space-xs pt-2"><span class="material-symbols-outlined text-primary text-[20px]">verified</span><span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">100% Fait Main • Terre Cuite Locale</span></div></div><div class="space-y-space-sm"><h4 class="font-title-md text-title-md text-on-surface tracking-wide">Découverte &amp; Liens</h4><ul class="space-y-2 font-body-sm text-body-sm text-on-surface-variant"><li><a class="hover:text-primary transition-colors" data-path="accueil" href="index.php">Accueil &amp; Galerie</a></li><li><a class="hover:text-primary transition-colors" data-path="nos-produits" href="nos-produits.php">Encensoirs &amp; Brûleurs</a></li><li><a class="hover:text-primary transition-colors" data-path="notre-histoire" href="notre-histoire.php">L'Âme de l'Atelier</a></li><li><a class="hover:text-primary transition-colors" data-path="commander" href="commander.php">Processus de Commande</a></li><li><a class="hover:text-primary transition-colors" data-path="contact" href="contact.php">Atelier &amp; Échange</a></li></ul></div><div class="space-y-space-sm"><h4 class="font-title-md text-title-md text-on-surface tracking-wide">Horaires d'Ouverture</h4><div data-noedit class="font-body-sm text-body-sm text-on-surface-variant space-y-2"><?php foreach($S['hours'] as $hr): ?><p class="flex justify-between py-1 bg-surface-container px-3 rounded-lg"><span><?= e($hr[0]) ?></span><span class="font-label-md text-label-md text-primary"><?= e($hr[1]) ?></span></p><?php endforeach; ?></div><p class="font-label-sm text-label-sm text-outline-variant pt-1">Visites privées de l'atelier sur réservation préalable.</p></div><div class="space-y-space-sm"><h4 class="font-title-md text-title-md text-on-surface tracking-wide">Contact &amp; Réseaux</h4><p class="font-body-sm text-body-sm text-on-surface-variant">Commandes directes, créations sur-mesure et expéditions soigneusement emballées.</p><div class="flex items-center gap-space-xs text-primary font-title-md text-title-md"><span class="material-symbols-outlined text-[22px]">phone_in_talk</span><a class="hover:underline" href="tel:+<?= e($S['whatsapp']) ?>"><?= e($S['phone_display']) ?></a></div><div class="flex items-center gap-3 pt-2"><a aria-label="WhatsApp" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="https://wa.me/<?= e($S['whatsapp']) ?>" rel="noopener noreferrer" target="_blank"><span class="material-symbols-outlined text-[20px]">chat</span></a><a aria-label="Galerie Photo" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="#"><span class="material-symbols-outlined text-[20px]">photo_camera</span></a><a aria-label="Atelier Live" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="#"><span class="material-symbols-outlined text-[20px]">explore</span></a><a aria-label="Email" class="w-9 h-9 rounded-lg bg-surface-container-high hover:bg-primary-container text-on-surface hover:text-on-primary flex items-center justify-center transition-all shadow-[0_2px_8px_rgba(61,36,28,0.06)]" href="#"><span class="material-symbols-outlined text-[20px]">mail</span></a></div></div></div><div class="mt-space-xl pt-space-md bg-surface-container-lowest/50 rounded-xl px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4 font-body-sm text-body-sm text-on-surface-variant"><p>© 2025 Le Sacré Céramique. Tous droits réservés. Façonné avec dévotion.</p><p class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Poterie Sacrée • Thiouraye &amp; Résines • Pièces Uniques</p></div></div></footer><nav id="mobileNav" aria-label="Navigation mobile" class="lg:hidden fixed bottom-0 inset-x-0 z-50 bg-surface/95 backdrop-blur-xl border-t border-outline-variant/40 shadow-[0_-4px_16px_rgba(61,36,28,0.08)] pb-[env(safe-area-inset-bottom)]"><div class="grid grid-cols-5"><a href="index.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">home</span>Accueil</a><a href="nos-produits.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">category</span>Créations</a><a href="commander.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">shopping_bag</span>Commander</a><a href="notre-histoire.php" aria-current="page" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-primary"><span class="material-symbols-outlined text-[22px]" style="font-variation-settings:'FILL' 1;">menu_book</span>Histoire</a><a href="contact.php" class="flex flex-col items-center gap-0.5 py-2 font-label-sm text-label-sm text-on-surface-variant"><span class="material-symbols-outlined text-[22px]">call</span>Contact</a></div></nav></body></html>
<?php echo cms_render((string)ob_get_clean(), 'notre-histoire'); ?>
