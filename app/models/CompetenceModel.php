<?php
// app/models/CompetenceModel.php

class CompetenceModel {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Récupère toutes les catégories avec leurs compétences
    public function getToutesAvecCategories() {
        $categories = $this->db->fetchAll('SELECT * FROM categories_competences ORDER BY ordre ASC');

        foreach ($categories as $key => $cat) {
            $categories[$key]['competences'] = $this->db->fetchAll(
                'SELECT * FROM competences WHERE categorie_id = :id ORDER BY ordre ASC',
                ['id' => $cat['id']]
            );
        }

        return $categories;
    }

    public function getToutes() {
        return $this->db->fetchAll(
            'SELECT c.*, cc.nom AS categorie_nom FROM competences c 
             JOIN categories_competences cc ON cc.id = c.categorie_id 
             ORDER BY cc.ordre, c.ordre'
        );
    }

    public function getCategories() {
        return $this->db->fetchAll('SELECT * FROM categories_competences ORDER BY ordre');
    }

    public function getCompetenceById($id) {
        return $this->db->fetch('SELECT * FROM competences WHERE id = :id', ['id' => $id]);
    }

    public function ajouterCompetence($data) {
        $this->db->query(
            'INSERT INTO competences (categorie_id, nom, logo, ordre) VALUES (:categorie_id, :nom, :logo, :ordre)',
            $data
        );
    }

    public function modifierCompetence($id, $data) {
        $this->db->query(
            'UPDATE competences SET categorie_id = :categorie_id, nom = :nom, logo = :logo, ordre = :ordre WHERE id = :id',
            array_merge($data, ['id' => $id])
        );
    }

    public function supprimerCompetence($id) {
        $this->db->query('DELETE FROM competences WHERE id = :id', ['id' => $id]);
    }
}
