<?php
// app/controllers/AdminController.php
// Interface d'administration

class AdminController extends Controller {

    // ── Connexion ────────────────────────────────────────────

    public function connexion() {
        if (!empty($_SESSION['admin_id'])) {
            $this->redirect(BASE_URL . '/admin/dashboard');
        }

        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyToken();

            $email = trim($_POST['email'] ?? '');
            $mdp   = trim($_POST['password'] ?? '');

            $admin = (new AdminModel())->getByEmail($email);

            if ($admin && password_verify($mdp, $admin['password'])) {
                session_regenerate_id(true);
                $_SESSION['admin_id']  = $admin['id'];
                $_SESSION['admin_nom'] = $admin['username'];
                $this->redirect(BASE_URL . '/admin/dashboard');
            } else {
                $erreur = 'Email ou mot de passe incorrect.';
            }
        }

        $this->render('admin/connexion', [
            'erreur' => $erreur,
            'token'  => $this->getToken()
        ]);
    }

    public function deconnexion() {
        session_destroy();
        $this->redirect(BASE_URL . '/admin/connexion');
    }

    // ── Dashboard ────────────────────────────────────────────

    public function dashboard() {
        $this->checkLogin();

        $stats = [
            'projets'     => count((new ProjetModel())->getTous()),
            'competences' => count((new CompetenceModel())->getToutes()),
            'messages'    => (new MessageModel())->compterNonLus(),
            'experiences' => count((new ExperienceModel())->getTous()),
        ];

        $derniers_messages = array_slice((new MessageModel())->getTous(), 0, 5);

        $this->render('admin/dashboard', [
            'stats'            => $stats,
            'derniers_messages' => $derniers_messages
        ]);
    }

    // ── Profil ───────────────────────────────────────────────

    public function profil() {
        $this->checkLogin();
        $profil = (new ProfilModel())->getProfil() ?? [];

        $this->render('admin/profil', [
            'profil' => $profil,
            'succes' => isset($_GET['ok']),
            'token'  => $this->getToken()
        ]);
    }

    public function profilSave() {
        $this->checkLogin();
        $this->verifyToken();

        $model = new ProfilModel();
        $data  = [
            'prenom'    => trim($_POST['prenom']    ?? ''),
            'nom'       => trim($_POST['nom']       ?? ''),
            'titre'     => trim($_POST['titre']     ?? ''),
            'bio'       => trim($_POST['bio']       ?? ''),
            'email'     => trim($_POST['email']     ?? ''),
            'telephone' => trim($_POST['telephone'] ?? ''),
            'ville'     => trim($_POST['ville']     ?? ''),
            'github'    => trim($_POST['github']    ?? ''),
            'linkedin'  => trim($_POST['linkedin']  ?? ''),
        ];

        $model->sauvegarder($data);
        $profil = $model->getProfil();

        // Upload photo
        if (!empty($_FILES['photo']['name'])) {
            $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $nom = 'photo_' . time() . '.' . $ext;
                move_uploaded_file($_FILES['photo']['tmp_name'], UPLOAD_PATH . '/' . $nom);
                $model->updatePhoto($profil['id'], 'assets/uploads/' . $nom);
            }
        }

        // Upload CV
        if (!empty($_FILES['cv']['name'])) {
            $ext = strtolower(pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION));
            if ($ext === 'pdf') {
                $nom = 'cv_' . time() . '.pdf';
                move_uploaded_file($_FILES['cv']['tmp_name'], UPLOAD_PATH . '/' . $nom);
                $model->updateCV($profil['id'], 'assets/uploads/' . $nom);
            }
        }

        $this->redirect(BASE_URL . '/admin/profil?ok=1');
    }

    // ── Projets ──────────────────────────────────────────────

    public function projets() {
        $this->checkLogin();
        $projets = (new ProjetModel())->getTous();
        $this->render('admin/projets', ['projets' => $projets]);
    }

    public function projetNouveau() {
        $this->checkLogin();
        $competences = (new CompetenceModel())->getToutes();
        $this->render('admin/projet-form', [
            'projet'             => [],
            'competences'        => $competences,
            'comps_selectionnees' => [],
            'token'              => $this->getToken()
        ]);
    }

    public function projetCreer() {
        $this->checkLogin();
        $this->verifyToken();

        $pm   = new ProjetModel();
        $slug = $pm->genererSlug($_POST['titre'] ?? 'projet');

        $data = [
            'titre'             => trim($_POST['titre'] ?? ''),
            'slug'              => $slug,
            'description'       => trim($_POST['description'] ?? ''),
            'description_longue' => trim($_POST['description_longue'] ?? ''),
            'lien_site'         => trim($_POST['lien_site'] ?? ''),
            'lien_github'       => trim($_POST['lien_github'] ?? ''),
            'mis_en_avant'      => isset($_POST['mis_en_avant']) ? 1 : 0,
            'ordre'             => (int)($_POST['ordre'] ?? 0),
        ];

        $id = $pm->creer($data);

        // Image
        if (!empty($_FILES['image']['name'])) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                $nom = 'projet_' . $id . '_' . time() . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_PATH . '/' . $nom);
                $pm->updateImage($id, 'assets/uploads/' . $nom);
            }
        }

        // Compétences
        if (!empty($_POST['competences']) && is_array($_POST['competences'])) {
            $pm->syncCompetences($id, $_POST['competences']);
        }

        $this->redirect(BASE_URL . '/admin/projets');
    }

    public function projetEditer($id) {
        $this->checkLogin();
        $projet = (new ProjetModel())->getById((int)$id);
        if (!$projet) $this->redirect(BASE_URL . '/admin/projets');

        $competences         = (new CompetenceModel())->getToutes();
        $comps_selectionnees = (new ProjetModel())->getCompetenceIds((int)$id);

        $this->render('admin/projet-form', [
            'projet'             => $projet,
            'competences'        => $competences,
            'comps_selectionnees' => $comps_selectionnees,
            'token'              => $this->getToken()
        ]);
    }

    public function projetSave($id) {
        $this->checkLogin();
        $this->verifyToken();

        $pm   = new ProjetModel();
        $slug = $pm->genererSlug($_POST['titre'] ?? 'projet');

        $data = [
            'titre'             => trim($_POST['titre'] ?? ''),
            'slug'              => $slug,
            'description'       => trim($_POST['description'] ?? ''),
            'description_longue' => trim($_POST['description_longue'] ?? ''),
            'lien_site'         => trim($_POST['lien_site'] ?? ''),
            'lien_github'       => trim($_POST['lien_github'] ?? ''),
            'mis_en_avant'      => isset($_POST['mis_en_avant']) ? 1 : 0,
            'ordre'             => (int)($_POST['ordre'] ?? 0),
        ];

        $pm->modifier((int)$id, $data);

        // Image
        if (!empty($_FILES['image']['name'])) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                $nom = 'projet_' . $id . '_' . time() . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_PATH . '/' . $nom);
                $pm->updateImage((int)$id, 'assets/uploads/' . $nom);
            }
        }

        $comps = (!empty($_POST['competences']) && is_array($_POST['competences'])) ? $_POST['competences'] : [];
        $pm->syncCompetences((int)$id, $comps);

        $this->redirect(BASE_URL . '/admin/projets');
    }

    public function projetSupprimer($id) {
        $this->checkLogin();
        (new ProjetModel())->supprimer((int)$id);
        $this->redirect(BASE_URL . '/admin/projets');
    }

    public function projetToggleFeatured($id) {
        $this->checkLogin();
        (new ProjetModel())->toggleFeatured((int)$id);
        $this->redirect(BASE_URL . '/admin/projets');
    }

    // ── Compétences ──────────────────────────────────────────

    public function competences() {
        $this->checkLogin();
        $categories = (new CompetenceModel())->getToutesAvecCategories();
        $this->render('admin/competences', [
            'categories' => $categories,
            'token'      => $this->getToken()
        ]);
    }

    public function competenceAjouter() {
        $this->checkLogin();
        $this->verifyToken();
        
        $data = [
            'categorie_id' => (int)($_POST['categorie_id'] ?? 1),
            'nom'          => trim($_POST['nom'] ?? ''),
            'logo'         => null,
            'ordre'        => (int)($_POST['ordre'] ?? 0),
        ];
        
        // Upload logo
        if (!empty($_FILES['logo']['name'])) {
            $logoPath = $this->handleUpload('logo', ['png','jpg','jpeg','svg','webp']);
            if ($logoPath) $data['logo'] = $logoPath;
        }
        
        (new CompetenceModel())->ajouterCompetence($data);
        $this->redirect(BASE_URL . '/admin/competences');
    }

    public function competenceModifier() {
        $this->checkLogin();
        $this->verifyToken();
        
        $id = (int)$_POST['id'];
        $data = [
            'categorie_id' => (int)($_POST['categorie_id'] ?? 1),
            'nom'          => trim($_POST['nom'] ?? ''),
            'logo'         => null,
            'ordre'        => (int)($_POST['ordre'] ?? 0),
        ];
        
        // Upload logo si fourni
        if (!empty($_FILES['logo']['name'])) {
            $logoPath = $this->handleUpload('logo', ['png','jpg','jpeg','svg','webp']);
            if ($logoPath) $data['logo'] = $logoPath;
        } else {
            // Garder l'ancien logo
            $comp = (new CompetenceModel())->getCompetenceById($id);
            $data['logo'] = $comp['logo'] ?? null;
        }
        
        (new CompetenceModel())->modifierCompetence($id, $data);
        $this->redirect(BASE_URL . '/admin/competences');
    }

    public function competenceSupprimer($id) {
        $this->checkLogin();
        (new CompetenceModel())->supprimerCompetence((int)$id);
        $this->redirect(BASE_URL . '/admin/competences');
    }

    // ── Expériences ──────────────────────────────────────────

    public function experiences() {
        $this->checkLogin();
        $experiences = (new ExperienceModel())->getTous();
        $this->render('admin/experiences', [
            'experiences' => $experiences,
            'token'       => $this->getToken()
        ]);
    }

    public function experienceNouvelle() {
        $this->checkLogin();
        $this->render('admin/experience-form', ['exp' => [], 'token' => $this->getToken()]);
    }

    public function experienceCreer() {
        $this->checkLogin();
        $this->verifyToken();
        (new ExperienceModel())->creer([
            'type'        => $_POST['type']        ?? 'travail',
            'poste'       => trim($_POST['poste']       ?? ''),
            'entreprise'  => trim($_POST['entreprise']  ?? ''),
            'lieu'        => trim($_POST['lieu']        ?? ''),
            'date_debut'  => $_POST['date_debut']  ?? date('Y-m-d'),
            'date_fin'    => !empty($_POST['date_fin']) ? $_POST['date_fin'] : null,
            'en_cours'    => isset($_POST['en_cours']) ? 1 : 0,
            'description' => trim($_POST['description'] ?? ''),
            'ordre'       => (int)($_POST['ordre'] ?? 0),
        ]);
        $this->redirect(BASE_URL . '/admin/experiences');
    }

    public function experienceEditer($id) {
        $this->checkLogin();
        $exp = (new ExperienceModel())->getById((int)$id);
        if (!$exp) $this->redirect(BASE_URL . '/admin/experiences');
        $this->render('admin/experience-form', ['exp' => $exp, 'token' => $this->getToken()]);
    }

    public function experienceSave($id) {
        $this->checkLogin();
        $this->verifyToken();
        (new ExperienceModel())->modifier((int)$id, [
            'type'        => $_POST['type']        ?? 'travail',
            'poste'       => trim($_POST['poste']       ?? ''),
            'entreprise'  => trim($_POST['entreprise']  ?? ''),
            'lieu'        => trim($_POST['lieu']        ?? ''),
            'date_debut'  => $_POST['date_debut']  ?? date('Y-m-d'),
            'date_fin'    => !empty($_POST['date_fin']) ? $_POST['date_fin'] : null,
            'en_cours'    => isset($_POST['en_cours']) ? 1 : 0,
            'description' => trim($_POST['description'] ?? ''),
            'ordre'       => (int)($_POST['ordre'] ?? 0),
        ]);
        $this->redirect(BASE_URL . '/admin/experiences');
    }

    public function experienceSupprimer($id) {
        $this->checkLogin();
        (new ExperienceModel())->supprimer((int)$id);
        $this->redirect(BASE_URL . '/admin/experiences');
    }

    // ── Messages ─────────────────────────────────────────────

    public function messages() {
        $this->checkLogin();
        $messages = (new MessageModel())->getTous();
        $this->render('admin/messages', ['messages' => $messages]);
    }

    public function messageLire($id) {
        $this->checkLogin();
        $msg = (new MessageModel())->getById((int)$id);
        if (!$msg) $this->redirect(BASE_URL . '/admin/messages');
        (new MessageModel())->marquerLu((int)$id);
        $this->render('admin/message-detail', ['msg' => $msg]);
    }

    public function messageSupprimer($id) {
        $this->checkLogin();
        (new MessageModel())->supprimer((int)$id);
        $this->redirect(BASE_URL . '/admin/messages');
    }

    // ── Helper : Upload de fichiers ──────────────────────────

    private function handleUpload($fieldName, $allowedExtensions, $maxSize = 5242880) {
        if (empty($_FILES[$fieldName]['name'])) {
            return null;
        }

        $file = $_FILES[$fieldName];
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        if ($file['size'] > $maxSize) {
            return null;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($ext, $allowedExtensions)) {
            return null;
        }

        $filename = uniqid() . '_' . time() . '.' . $ext;
        $destination = UPLOAD_PATH . '/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return 'assets/uploads/' . $filename;
        }

        return null;
    }
}
