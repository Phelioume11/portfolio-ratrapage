<?php
// config.php - Configuration du projet

// Base de données (MAMP)
define('DB_HOST', 'localhost');
define('DB_PORT', '8889');
define('DB_NAME', 'portfolio-refait');
define('DB_USER', 'root');
define('DB_PASS', 'root');

// URL du site - adapter selon votre config MAMP
define('BASE_URL', 'http://localhost:8888/portfolio/web');

// Chemins
define('ROOT_PATH', dirname(__DIR__));
define('WEB_PATH', ROOT_PATH . '/web');
define('UPLOAD_PATH', WEB_PATH . '/assets/uploads');

// Session
define('SESSION_NOM', 'portfolio_session');

// Affichage des erreurs (penser à désactiver en prod)
ini_set('display_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Europe/Paris');
