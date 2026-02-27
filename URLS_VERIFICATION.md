# Vérification complète des URLs - Portfolio

## Configuration
- BASE_URL = http://localhost:8888/portfolio/web
- Tous les liens utilisent désormais : `<?= BASE_URL ?>/admin/...`

## ✅ URLs Publiques

### Navigation
- Accueil : `<?= BASE_URL ?>/`
- Compétences : `<?= BASE_URL ?>/#competences`
- Expériences : `<?= BASE_URL ?>/#experiences`
- Projets : `<?= BASE_URL ?>/#projets`
- Contact : `<?= BASE_URL ?>/contact`
- Détail projet : `<?= BASE_URL ?>/projet/{slug}`

### Fichiers
- CV : `<?= BASE_URL ?>/<?= $profil['cv'] ?>`
- Images projet : `<?= BASE_URL ?>/<?= $projet['image'] ?>`
- Logos compétences : `<?= BASE_URL ?>/<?= $competence['logo'] ?>`

## ✅ URLs Admin

### Authentification
- Connexion (GET/POST) : `<?= BASE_URL ?>/admin/connexion`
- Déconnexion : `<?= BASE_URL ?>/admin/deconnexion`

### Dashboard
- Dashboard : `<?= BASE_URL ?>/admin/dashboard`

### Profil
- Voir profil : `<?= BASE_URL ?>/admin/profil`
- Enregistrer (POST) : `<?= BASE_URL ?>/admin/profil/enregistrer`

### Projets
- Liste : `<?= BASE_URL ?>/admin/projets`
- Nouveau (GET) : `<?= BASE_URL ?>/admin/projets/nouveau`
- Créer (POST) : `<?= BASE_URL ?>/admin/projets/creer`
- Éditer (GET) : `<?= BASE_URL ?>/admin/projets/{id}/editer`
- Enregistrer (POST) : `<?= BASE_URL ?>/admin/projets/{id}/enregistrer`
- Supprimer (GET) : `<?= BASE_URL ?>/admin/projets/{id}/supprimer`

### Compétences
- Liste : `<?= BASE_URL ?>/admin/competences`
- Ajouter (POST) : `<?= BASE_URL ?>/admin/competences/ajouter`
- Modifier (POST) : `<?= BASE_URL ?>/admin/competences/modifier`
- Supprimer (GET) : `<?= BASE_URL ?>/admin/competences/{id}/supprimer`

### Expériences
- Liste : `<?= BASE_URL ?>/admin/experiences`
- Nouveau (GET) : `<?= BASE_URL ?>/admin/experiences/nouveau`
- Créer (POST) : `<?= BASE_URL ?>/admin/experiences/creer`
- Éditer (GET) : `<?= BASE_URL ?>/admin/experiences/{id}/editer`
- Enregistrer (POST) : `<?= BASE_URL ?>/admin/experiences/{id}/enregistrer`
- Supprimer (GET) : `<?= BASE_URL ?>/admin/experiences/{id}/supprimer`

### Messages
- Liste : `<?= BASE_URL ?>/admin/messages`
- Lire (GET) : `<?= BASE_URL ?>/admin/messages/{id}`
- Supprimer (GET) : `<?= BASE_URL ?>/admin/messages/{id}/supprimer`

## ✅ Corrections effectuées

1. **Supprimé tous les `/../admin/`** → Remplacé par `/admin/`
2. **Ajouté méthode `handleUpload()`** dans AdminController
3. **Liens de retour projet** : `/projets` → `/#projets`
4. **Tous les formulaires admin** utilisent maintenant les bonnes URLs
5. **Navigation admin** corrigée dans admin-header.php

## 🔧 Fonctions upload

### AdminController::handleUpload($fieldName, $allowedExtensions, $maxSize = 5MB)
- Validation extension
- Validation taille
- Génération nom unique
- Stockage dans `/assets/uploads/`
- Retourne : `'assets/uploads/filename.ext'` ou `null`

### Utilisé pour :
- Photo profil (jpg, png, webp)
- CV (pdf)
- Images projets (jpg, png, webp, gif)
- Logos compétences (png, jpg, svg, webp)

## ✅ Tous les chemins vérifiés

- ✅ app/views/includes/header.php
- ✅ app/views/includes/footer.php
- ✅ app/views/includes/admin-header.php
- ✅ app/views/site/*.php
- ✅ app/views/admin/*.php
- ✅ app/controllers/AdminController.php
- ✅ web/index.php (routes)
