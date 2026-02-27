<?php
// app/controllers/SiteController.php
// Gère les pages publiques du portfolio

class SiteController extends Controller {

    public function accueil() {
        $profil      = (new ProfilModel())->getProfil();
        $competences = (new CompetenceModel())->getToutesAvecCategories();
        $projets     = (new ProjetModel())->getTous(); // Tous les projets
        $experiences = (new ExperienceModel())->getTous();

        $this->render('site/accueil', [
            'profil'      => $profil,
            'competences' => $competences,
            'projets'     => $projets,
            'experiences' => $experiences
        ]);
    }

    public function projets() {
        $profil  = (new ProfilModel())->getProfil();
        $projets = (new ProjetModel())->getTous();

        $this->render('site/projets', [
            'profil'  => $profil,
            'projets' => $projets
        ]);
    }

    public function projetDetail($slug) {
        $profil = (new ProfilModel())->getProfil();
        $projet = (new ProjetModel())->getBySlug($slug);

        if (!$projet) {
            http_response_code(404);
            require ROOT_PATH . '/app/views/site/404.php';
            return;
        }

        $this->render('site/projet-detail', [
            'profil' => $profil,
            'projet' => $projet
        ]);
    }

    public function contact() {
        $profil  = (new ProfilModel())->getProfil();
        $succes  = false;
        $erreurs = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyToken();

            $nom     = trim($_POST['nom']     ?? '');
            $email   = trim($_POST['email']   ?? '');
            $sujet   = trim($_POST['sujet']   ?? '');
            $message = trim($_POST['message'] ?? '');

            // Validation simple
            if (empty($nom))    $erreurs[] = 'Le nom est requis.';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erreurs[] = 'L\'email n\'est pas valide.';
            if (empty($sujet))  $erreurs[] = 'Le sujet est requis.';
            if (strlen($message) < 10) $erreurs[] = 'Le message est trop court.';

            if (empty($erreurs)) {
                (new MessageModel())->creer([
                    'nom'     => htmlspecialchars($nom),
                    'email'   => htmlspecialchars($email),
                    'sujet'   => htmlspecialchars($sujet),
                    'message' => htmlspecialchars($message)
                ]);
                $succes = true;
            }
        }

        $this->render('site/contact', [
            'profil'  => $profil,
            'succes'  => $succes,
            'erreurs' => $erreurs,
            'token'   => $this->getToken()
        ]);
    }
}
