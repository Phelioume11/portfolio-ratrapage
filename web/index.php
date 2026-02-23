<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 3bc80535e7c41aea22f1c663b3c71a80852a1268
<?php
// web/index.php - Point d'entrée de l'application

// Configuration
require_once __DIR__ . '/../config/config.php';

// Démarrage session
session_name(SESSION_NOM);
session_start();

// Chargement des classes
require_once ROOT_PATH . '/app/core/Database.php';
require_once ROOT_PATH . '/app/core/Controller.php';
require_once ROOT_PATH . '/app/core/Router.php';

// Modèles
require_once ROOT_PATH . '/app/models/ProfilModel.php';
require_once ROOT_PATH . '/app/models/ProjetModel.php';
require_once ROOT_PATH . '/app/models/CompetenceModel.php';
require_once ROOT_PATH . '/app/models/AutresModels.php'; // ExperienceModel, MessageModel, AdminModel

// Routeur
$router = new Router();

// ─── Routes publiques ───────────────────────────────────────
$router->add('GET',  '/',               'SiteController', 'accueil');
$router->add('GET',  '/projets',        'SiteController', 'projets');
$router->add('GET',  '/projet/{slug}',  'SiteController', 'projetDetail');
$router->add('GET',  '/contact',        'SiteController', 'contact');
$router->add('POST', '/contact',        'SiteController', 'contact');

// ─── Routes admin ────────────────────────────────────────────
$router->add('GET',  '/admin/connexion',  'AdminController', 'connexion');
$router->add('POST', '/admin/connexion',  'AdminController', 'connexion');
$router->add('GET',  '/admin/deconnexion','AdminController', 'deconnexion');

$router->add('GET',  '/admin/dashboard',  'AdminController', 'dashboard');

// Profil
$router->add('GET',  '/admin/profil',             'AdminController', 'profil');
$router->add('POST', '/admin/profil/enregistrer', 'AdminController', 'profilSave');

// Projets
$router->add('GET',  '/admin/projets',                       'AdminController', 'projets');
$router->add('GET',  '/admin/projets/nouveau',               'AdminController', 'projetNouveau');
$router->add('POST', '/admin/projets/creer',                 'AdminController', 'projetCreer');
$router->add('GET',  '/admin/projets/{id}/editer',           'AdminController', 'projetEditer');
$router->add('POST', '/admin/projets/{id}/enregistrer',      'AdminController', 'projetSave');
$router->add('GET',  '/admin/projets/{id}/toggle-featured',  'AdminController', 'projetToggleFeatured');
$router->add('GET',  '/admin/projets/{id}/supprimer',        'AdminController', 'projetSupprimer');

// Compétences
$router->add('GET',  '/admin/competences',            'AdminController', 'competences');
$router->add('POST', '/admin/competences/ajouter',    'AdminController', 'competenceAjouter');
$router->add('POST', '/admin/competences/modifier',   'AdminController', 'competenceModifier');
$router->add('GET',  '/admin/competences/{id}/supprimer', 'AdminController', 'competenceSupprimer');

// Expériences
$router->add('GET',  '/admin/experiences',                    'AdminController', 'experiences');
$router->add('GET',  '/admin/experiences/nouveau',            'AdminController', 'experienceNouvelle');
$router->add('POST', '/admin/experiences/creer',              'AdminController', 'experienceCreer');
$router->add('GET',  '/admin/experiences/{id}/editer',        'AdminController', 'experienceEditer');
$router->add('POST', '/admin/experiences/{id}/enregistrer',   'AdminController', 'experienceSave');
$router->add('GET',  '/admin/experiences/{id}/supprimer',     'AdminController', 'experienceSupprimer');

// Messages
$router->add('GET',  '/admin/messages',                 'AdminController', 'messages');
$router->add('GET',  '/admin/messages/{id}',            'AdminController', 'messageLire');
$router->add('GET',  '/admin/messages/{id}/supprimer',  'AdminController', 'messageSupprimer');

// ─── Chargement des contrôleurs et dispatch ──────────────────
require_once ROOT_PATH . '/app/controllers/SiteController.php';
require_once ROOT_PATH . '/app/controllers/AdminController.php';

// Calcul URI relative
$script_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$uri        = '/' . ltrim(substr(strtok($_SERVER['REQUEST_URI'], '?'), strlen($script_dir)), '/');

$router->run($uri, $_SERVER['REQUEST_METHOD']);
<<<<<<< HEAD
=======
=======
<?php echo 'Structure MVC OK'; ?>
>>>>>>> ce91a13dabf5fe53a4e23c1e41faa748047386bf
>>>>>>> 3bc80535e7c41aea22f1c663b3c71a80852a1268
