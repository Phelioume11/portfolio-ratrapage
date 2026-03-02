-- Base de données : portfolio-refait
-- Port MySQL MAMP : 8889

CREATE DATABASE IF NOT EXISTS `portfolio-refait` CHARACTER SET utf8mb4;

USE `portfolio-refait`;

-- Table admin
CREATE TABLE `admin` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

-- Table profil
CREATE TABLE `profil` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `prenom` VARCHAR(80),
    `nom` VARCHAR(80),
    `titre` VARCHAR(150),
    `bio` TEXT,
    `email` VARCHAR(100),
    `telephone` VARCHAR(30),
    `ville` VARCHAR(100),
    `github` VARCHAR(255),
    `linkedin` VARCHAR(255),
    `photo` VARCHAR(255),
    `cv` VARCHAR(255),
    PRIMARY KEY (`id`)
);

-- Table categories_competences
CREATE TABLE `categories_competences` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(80) NOT NULL,
    `ordre` INT DEFAULT 0,
    PRIMARY KEY (`id`)
);

-- Table competences
CREATE TABLE `competences` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `categorie_id` INT NOT NULL,
    `nom` VARCHAR(100) NOT NULL,
    `logo` VARCHAR(255) DEFAULT NULL COMMENT 'Chemin vers le logo',
    `ordre` INT DEFAULT 0,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`categorie_id`) REFERENCES `categories_competences`(`id`) ON DELETE CASCADE
);

-- Table projets
CREATE TABLE `projets` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `titre` VARCHAR(150) NOT NULL,
    `slug` VARCHAR(160) NOT NULL UNIQUE,
    `description` TEXT,
    `description_longue` TEXT,
    `image` VARCHAR(255),
    `lien_site` VARCHAR(255),
    `lien_github` VARCHAR(255),
    `mis_en_avant` TINYINT(1) DEFAULT 0,
    `ordre` INT DEFAULT 0,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

-- Table projets_competences (liaison)
CREATE TABLE `projets_competences` (
    `projet_id` INT NOT NULL,
    `competence_id` INT NOT NULL,
    PRIMARY KEY (`projet_id`, `competence_id`),
    FOREIGN KEY (`projet_id`) REFERENCES `projets`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`competence_id`) REFERENCES `competences`(`id`) ON DELETE CASCADE
);

-- Table experiences
CREATE TABLE `experiences` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(20) DEFAULT 'travail',
    `poste` VARCHAR(150) NOT NULL,
    `entreprise` VARCHAR(150) NOT NULL,
    `lieu` VARCHAR(100),
    `date_debut` DATE NOT NULL,
    `date_fin` DATE,
    `en_cours` TINYINT(1) DEFAULT 0,
    `description` TEXT,
    `ordre` INT DEFAULT 0,
    PRIMARY KEY (`id`)
);

-- Table messages
CREATE TABLE `messages` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(120) NOT NULL,
    `email` VARCHAR(120) NOT NULL,
    `sujet` VARCHAR(200) NOT NULL,
    `message` TEXT NOT NULL,
    `lu` TINYINT(1) DEFAULT 0,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

-- ============================================================
-- Données initiales
-- ============================================================

-- Admin (mot de passe : Admin1234!)
INSERT INTO `admin` (`username`, `email`, `password`) VALUES
('admin', 'admin@portfolio.local', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Profil exemple
INSERT INTO `profil` (`prenom`, `nom`, `titre`, `bio`, `email`, `telephone`, `ville`, `github`, `linkedin`) VALUES
('Prénom', 'Nom', 'Développeur Web Full Stack', 'Étudiant passionné en développement web à la recherche d\'une alternance. Je maîtrise PHP, JavaScript et les outils modernes du web.', 'contact@exemple.com', '+33 6 00 00 00 00', 'Paris, France', 'https://github.com/username', 'https://linkedin.com/in/username');

-- Catégories compétences
INSERT INTO `categories_competences` (`nom`, `ordre`) VALUES
('Front-end', 1), ('Back-end', 2), ('Outils', 3);

-- Compétences (exemples - à personnaliser via l'admin avec logos)
INSERT INTO `competences` (`categorie_id`, `nom`, `ordre`) VALUES
(1, 'HTML / CSS', 1), (1, 'JavaScript', 2), (1, 'Tailwind CSS', 3),
(2, 'PHP', 1), (2, 'MySQL', 2), (2, 'Symfony', 3),
(3, 'Git', 1), (3, 'VS Code', 2), (3, 'Docker', 3);

-- Expériences
INSERT INTO `experiences` (`type`, `poste`, `entreprise`, `lieu`, `date_debut`, `en_cours`, `description`, `ordre`) VALUES
('formation', 'Bachelor Développement Web', '3W Academy', 'Paris', '2024-09-01', 1, 'Formation en développement web full stack : PHP, Symfony, JavaScript, Docker, bases de données.', 1),
('formation', 'Baccalauréat Général', 'Lycée', 'Paris', '2021-09-01', 0, 'Spécialités Mathématiques et NSI. Mention Bien.', 2);

-- Projets
INSERT INTO `projets` (`titre`, `slug`, `description`, `mis_en_avant`, `ordre`) VALUES
('Portfolio Professionnel', 'portfolio', 'Portfolio développé en PHP natif avec architecture MVC et interface d\'administration.', 1, 1),
('Application Todo', 'todo-app', 'Application de gestion de tâches en JavaScript avec stockage local.', 0, 2);
