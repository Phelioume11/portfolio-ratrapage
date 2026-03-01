<?php
// app/core/Controller.php

class Controller {

    // Charge une vue
    protected function render($vue, $donnees = []) {
        extract($donnees);
        $fichier = ROOT_PATH . '/app/views/' . $vue . '.php';

        if (!file_exists($fichier)) {
            die('Vue introuvable : ' . $vue);
        }

        require $fichier;
    }

    // Redirige vers une URL
    protected function redirect($url) {
        header('Location: ' . $url);
        exit;
    }

    // Vérifie si l'admin est connecté
    protected function checkLogin() {
        if (empty($_SESSION['admin_id'])) {
            $this->redirect(BASE_URL . '/admin/connexion');
        }
    }

    // Génère un token CSRF
    protected function getToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    // Vérifie le token CSRF
    protected function verifyToken() {
        $token = $_POST['csrf_token'] ?? '';
        if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            die('Erreur CSRF');
        }
    }
}
