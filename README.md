# Le Sacré Céramique — site vitrine

Site vitrine d'encensoirs et pots à thiouraye en terre cuite (PHP, Tailwind CDN, sans base de données).

## Fonctionnement
- Pages publiques : `index.php`, `notre-histoire.php`, `nos-produits.php`, `commander.php`, `contact.php`.
- Données : fichiers JSON dans `data/` (produits, réglages, modifications de pages).
- Administration (local uniquement) : `/admin/` — Studio d'édition (textes, photos, disposition, thème) et Catalogue & tarifs. Au premier accès, choisissez le mot de passe administrateur.

## Développement local (Laragon)
Placez le dossier dans `www/` et ouvrez `http://localhost/sacre-ceramique/`.

## Mise en ligne (Vercel)
Le projet est déployé sur Vercel via le runtime `vercel-php` (voir `vercel.json` et `api/index.php`).
Vercel ayant un stockage en lecture seule, l'administration y est désactivée :
1. modifiez le site en local via `/admin/` ;
2. `git add -A && git commit -m "Mise à jour du contenu" && git push` ;
3. Vercel redéploie automatiquement.
