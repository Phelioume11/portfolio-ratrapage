<?php
// app/models/ExperienceModel.php

class ExperienceModel {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getTous() {
        return $this->db->fetchAll('SELECT * FROM experiences ORDER BY date_debut DESC');
    }

    public function getById($id) {
        return $this->db->fetch('SELECT * FROM experiences WHERE id = :id', ['id' => $id]);
    }

    public function creer($data) {
        $sql = 'INSERT INTO experiences (type, poste, entreprise, lieu, date_debut, date_fin, en_cours, description, ordre)
                VALUES (:type, :poste, :entreprise, :lieu, :date_debut, :date_fin, :en_cours, :description, :ordre)';
        $this->db->query($sql, $data);
    }

    public function modifier($id, $data) {
        $sql = 'UPDATE experiences SET 
                type = :type,
                poste = :poste,
                entreprise = :entreprise,
                lieu = :lieu,
                date_debut = :date_debut,
                date_fin = :date_fin,
                en_cours = :en_cours,
                description = :description,
                ordre = :ordre
                WHERE id = :id';
        $data['id'] = $id;
        $this->db->query($sql, $data);
    }

    public function supprimer($id) {
        $this->db->query('DELETE FROM experiences WHERE id = :id', ['id' => $id]);
    }
}


// =====================================
// app/models/MessageModel.php
// =====================================

class MessageModel {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getTous() {
        return $this->db->fetchAll('SELECT * FROM messages ORDER BY created_at DESC');
    }

    public function getById($id) {
        return $this->db->fetch('SELECT * FROM messages WHERE id = :id', ['id' => $id]);
    }

    public function compterNonLus() {
        $res = $this->db->fetch('SELECT COUNT(*) as total FROM messages WHERE lu = 0');
        return $res['total'];
    }

    public function creer($data) {
        $sql = 'INSERT INTO messages (nom, email, sujet, message) VALUES (:nom, :email, :sujet, :message)';
        $this->db->query($sql, $data);
    }

    public function marquerLu($id) {
        $this->db->query('UPDATE messages SET lu = 1 WHERE id = :id', ['id' => $id]);
    }

    public function supprimer($id) {
        $this->db->query('DELETE FROM messages WHERE id = :id', ['id' => $id]);
    }
}


// =====================================
// app/models/AdminModel.php
// =====================================

class AdminModel {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getByEmail($email) {
        return $this->db->fetch('SELECT * FROM admin WHERE email = :email', ['email' => $email]);
    }

    public function getById($id) {
        return $this->db->fetch('SELECT * FROM admin WHERE id = :id', ['id' => $id]);
    }
}
