<?php
// app/models/ProjetModel.php

class ProjetModel {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getTous() {
        return $this->db->fetchAll('SELECT * FROM projets ORDER BY ordre ASC, created_at DESC');
    }

    public function getMisEnAvant() {
        return $this->db->fetchAll('SELECT * FROM projets WHERE mis_en_avant = 1 ORDER BY ordre ASC');
    }

    public function getById($id) {
        return $this->db->fetch('SELECT * FROM projets WHERE id = :id', ['id' => $id]);
    }

    public function getBySlug($slug) {
        $projet = $this->db->fetch('SELECT * FROM projets WHERE slug = :slug', ['slug' => $slug]);

        if ($projet) {
            // Récupérer les compétences du projet
            $projet['competences'] = $this->db->fetchAll(
                'SELECT c.nom FROM competences c 
                 JOIN projets_competences pc ON pc.competence_id = c.id 
                 WHERE pc.projet_id = :id',
                ['id' => $projet['id']]
            );
        }

        return $projet;
    }

    public function creer($data) {
        $sql = 'INSERT INTO projets (titre, slug, description, description_longue, lien_site, lien_github, mis_en_avant, ordre)
                VALUES (:titre, :slug, :description, :description_longue, :lien_site, :lien_github, :mis_en_avant, :ordre)';
        $this->db->query($sql, $data);
        return $this->db->lastId();
    }

    public function modifier($id, $data) {
        $sql = 'UPDATE projets SET 
                titre = :titre,
                slug = :slug,
                description = :description,
                description_longue = :description_longue,
                lien_site = :lien_site,
                lien_github = :lien_github,
                mis_en_avant = :mis_en_avant,
                ordre = :ordre
                WHERE id = :id';
        $data['id'] = $id;
        $this->db->query($sql, $data);
    }

    public function supprimer($id) {
        $this->db->query('DELETE FROM projets WHERE id = :id', ['id' => $id]);
    }

    public function toggleFeatured($id) {
        $this->db->query(
            'UPDATE projets SET mis_en_avant = NOT mis_en_avant WHERE id = :id',
            ['id' => $id]
        );
    }

    // Génère un slug à partir du titre
    public function genererSlug($titre) {
        $slug = mb_strtolower(trim($titre));
        $slug = str_replace(['à','â','é','è','ê','î','ô','ù','û','ç'], ['a','a','e','e','e','i','o','u','u','c'], $slug);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s]+/', '-', $slug);
        return trim($slug, '-');
    }

    public function updateImage($id, $image) {
        $this->db->query('UPDATE projets SET image = :image WHERE id = :id', ['image' => $image, 'id' => $id]);
    }

    public function syncCompetences($projetId, $competenceIds) {
        // Supprimer les anciennes liaisons
        $this->db->query('DELETE FROM projets_competences WHERE projet_id = :id', ['id' => $projetId]);

        // Ajouter les nouvelles
        foreach ($competenceIds as $cid) {
            $this->db->query(
                'INSERT INTO projets_competences (projet_id, competence_id) VALUES (:pid, :cid)',
                ['pid' => $projetId, 'cid' => (int)$cid]
            );
        }
    }

    public function getCompetenceIds($projetId) {
        $rows = $this->db->fetchAll('SELECT competence_id FROM projets_competences WHERE projet_id = :id', ['id' => $projetId]);
        return array_column($rows, 'competence_id');
    }
}
