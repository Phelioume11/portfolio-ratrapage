# Portfolio Professionnel — PHP MVC

Portfolio développé en PHP natif avec architecture MVC et base de données MySQL.

---

## Technologies

- PHP 8.3 natif (MVC)
- MySQL (port MAMP 8889)
- Tailwind CSS (CDN)
- Apache + MAMP (port 8888)

---

## Structure du projet

```
portfolio/
├── web/                    ← Racine Apache (dossier public)
│   ├── index.php           ← Point d'entrée
│   ├── .htaccess           ← URL rewriting
│   └── assets/
│       └── uploads/        ← Photos, CV, images projets
├── app/
│   ├── core/               ← Router, Controller, Database
│   ├── controllers/        ← SiteController, AdminController
│   ├── models/             ← ProfilModel, ProjetModel, etc.
│   └── views/
│       ├── site/           ← Pages publiques
│       ├── admin/          ← Interface d'administration
│       └── includes/       ← Header, footer partagés
├── config/
│   └── config.php          ← Configuration BDD et URL
├── bdd/
│   └── portfolio_refait.sql ← Script SQL à importer
└── docs/                   ← Diagrammes UML et Merise
```

---

## Installation avec MAMP

**1. Copier le projet**

Copier le dossier `portfolio/` dans :
```
C:\MAMP\htdocs\portfolio
```

**2. Créer la base de données**

Ouvrir phpMyAdmin : `http://localhost:8888/phpmyadmin`

Cliquer sur l'onglet **Importer**, choisir le fichier :
```
portfolio/bdd/portfolio_refait.sql
```

Ou coller le contenu du fichier dans l'onglet **SQL** et exécuter.

**3. Vérifier la configuration**

Ouvrir `config/config.php` et vérifier ces lignes :
```php
define('DB_PORT', '8889');   // Port MySQL MAMP
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('BASE_URL', 'http://localhost:8888/portfolio/web');
```

**4. Activer le mod_rewrite Apache**

Dans MAMP > Préférences > Apache : s'assurer que le `.htaccess` est supporté.

**5. Accéder au site**

| Page | URL |
|------|-----|
| Portfolio | `http://localhost:8888/portfolio/web/` |
| Administration | `http://localhost:8888/portfolio/web/admin/connexion` |

---

## Identifiants administrateur

| Champ | Valeur |
|-------|--------|
| Email | `admin@portfolio.local` |
| Mot de passe | `Admin1234!` |

---

## Fonctionnalités

**Pages publiques**
- Accueil avec hero, compétences animées, timeline expériences, projets mis en avant
- Liste complète des projets + page détail
- Formulaire de contact (messages stockés en BDD)
- Téléchargement du CV (PDF)

**Administration (/admin)**
- Connexion sécurisée (bcrypt)
- Gestion du profil (photo, CV, infos personnelles)
- CRUD projets avec image et compétences associées
- CRUD compétences par catégorie
- CRUD expériences (professionnelles et formations)
- Gestion des messages reçus

---

## Personnalisation

1. Connectez-vous sur `/admin/connexion`
2. Section **Mon profil** : renseignez vos vraies informations et uploadez votre CV
3. Ajoutez vos **compétences**, **expériences** et **projets**

Pour changer l'URL si votre port MAMP est différent, modifier `config/config.php` :
```php
define('BASE_URL', 'http://localhost:VOTRE_PORT/portfolio/web');
```
Et dans `web/.htaccess` :
```
RewriteBase /portfolio/web/
```

---

## Diagrammes

Disponibles dans le dossier `/docs/` :
- `use-case.svg` — Diagramme de cas d'utilisation
- `mcd.svg` — Modèle Conceptuel de Données
- `mld-mpd.svg` — Modèle Logique et Physique de Données
