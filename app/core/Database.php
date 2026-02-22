<?php
// app/core/Database.php
// Connexion PDO à la base de données

class Database {
    
    public $pdo;

    public function __construct() {
        // Construction du DSN avec le port MAMP
        $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        
        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    // Exécute une requête avec paramètres
    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    // Retourne toutes les lignes
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }

    // Retourne une seule ligne
    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }

    // Retourne le dernier ID inséré
    public function lastId() {
        return $this->pdo->lastInsertId();
    }
}
