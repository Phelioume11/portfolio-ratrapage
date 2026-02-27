<?php
// app/models/ProfilModel.php

class ProfilModel {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getProfil() {
        return $this->db->fetch('SELECT * FROM profil LIMIT 1');
    }

    public function sauvegarder($data) {
        $profil = $this->getProfil();

        if ($profil) {
            // Mise à jour
            $sql = 'UPDATE profil SET 
                prenom = :prenom,
                nom = :nom,
                titre = :titre,
                bio = :bio,
                email = :email,
                telephone = :telephone,
                ville = :ville,
                github = :github,
                linkedin = :linkedin
                WHERE id = :id';
            $data['id'] = $profil['id'];
            $this->db->query($sql, $data);
        } else {
            // Insertion
            $sql = 'INSERT INTO profil (prenom, nom, titre, bio, email, telephone, ville, github, linkedin) 
                    VALUES (:prenom, :nom, :titre, :bio, :email, :telephone, :ville, :github, :linkedin)';
            $this->db->query($sql, $data);
        }
    }

    public function updatePhoto($id, $photo) {
        $this->db->query('UPDATE profil SET photo = :photo WHERE id = :id', ['photo' => $photo, 'id' => $id]);
    }

    public function updateCV($id, $cv) {
        $this->db->query('UPDATE profil SET cv = :cv WHERE id = :id', ['cv' => $cv, 'id' => $id]);
    }
}
