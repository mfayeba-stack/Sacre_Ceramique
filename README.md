# Le Sacré Céramique — site vitrine

Site vitrine d'encensoirs et pots à thiouraye en terre cuite (PHP, Tailwind CDN, sans base de données).

## Fonctionnement
- Pages publiques : `index.php`, `notre-histoire.php`, `nos-produits.php`, `commander.php`, `contact.php`.
- Données : fichiers JSON (produits, réglages, modifications de pages, mot de passe admin).
- Administration : `/admin/` — Studio d'édition (textes, photos, disposition, thème) et Catalogue & tarifs.

## Développement local (Laragon)
Placez le dossier dans `www/` et ouvrez `http://localhost/sacre-ceramique/`.
En local, les données sont lues et écrites dans le dossier `data/`. Au premier accès à `/admin/`, choisissez le mot de passe administrateur.

## Mise en ligne (Vercel) avec administration
Le projet est déployé sur Vercel via le runtime `vercel-php` (voir `vercel.json` et `api/index.php`).

Les fonctions Vercel n'ont pas de disque persistant. Les données (produits, réglages, modifications de pages, mot de passe admin, sessions) et les photos téléversées sont donc stockées dans un **store Vercel Blob privé** (`inc/storage.php`), utilisé automatiquement dès que la variable `BLOB_READ_WRITE_TOKEN` existe.

Configuration, une seule fois :
1. Le store Blob est relié au projet : la variable `BLOB_READ_WRITE_TOKEN` est créée automatiquement.
2. Ajoutez la variable d'environnement `ADMIN_SETUP_TOKEN` (valeur aléatoire, 32 caractères minimum) dans Vercel > Settings > Environment Variables, puis redéployez.
3. Ouvrez `/admin/login.php`, saisissez ce jeton et choisissez le mot de passe administrateur.
4. Vérification du stockage : une fois connecté, ouvrez `/admin/api.php?action=store_check` (tous les champs doivent valoir `true`).

Les pages publiques sont mises en cache 30 secondes par le CDN : une modification publiée depuis le Studio apparaît sous 30 secondes.

Les valeurs initiales (produits, réglages) viennent des fichiers versionnés de `data/` tant que rien n'a été enregistré dans le store.
