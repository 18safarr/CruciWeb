-- Étape 1 : Création de la base de données
DROP DATABASE IF EXISTS CRUCIWEB;

CREATE DATABASE CRUCIWEB;

-- Étape 2 : Utilisation de la base de données
USE CRUCIWEB;

-- Étape 3 : Crétion des tables
CREATE TABLE Users (
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    identifiant VARCHAR(50) NOT NULL,
    motDePasse VARCHAR(255) NOT NULL,
    isPlayer BOOLEAN DEFAULT TRUE
);

CREATE TABLE Grilles (
    idGrille INT AUTO_INCREMENT PRIMARY KEY,
    nomGrille VARCHAR(100) NOT NULL,
    dimX INT NOT NULL,
    dimY INT NOT NULL,
    datePublication DATE,
    idAuteur INT,
    difficulte INT,
    FOREIGN KEY (idAuteur) REFERENCES Users(idUser)
    ON DELETE CASCADE
);

CREATE TABLE Cases (
    idCase INT AUTO_INCREMENT PRIMARY KEY,
    positionX INT NOT NULL,
    positionY INT NOT NULL,
    isBlack BOOLEAN DEFAULT FALSE,
    contenu CHAR(1),
    solution CHAR(1),
    idGrille INT NOT NULL,
    FOREIGN KEY (idGrille) REFERENCES Grilles(idGrille)
    ON DELETE CASCADE
);

CREATE TABLE Definitions (
    idDefinition INT AUTO_INCREMENT PRIMARY KEY,
    orientation ENUM('VERTICAL', 'HORIZONTAL') NOT NULL,
    solution VARCHAR(255) NOT NULL,
    caseDepart INT NOT NULL,
    idGrille INT NOT NULL,
    FOREIGN KEY (idGrille) REFERENCES Grilles(idGrille) 
    ON DELETE CASCADE
);

CREATE TABLE Parties (
    idPartie INT AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT,
    dateEnregistrement DATE NOT NULL,
    statut ENUM('Terminée', 'Sauvegardée') DEFAULT 'Sauvegardée',
    idGrille INT NOT NULL,
    idAuteur INT NOT NULL,
    FOREIGN KEY (idGrille) REFERENCES Grilles(idGrille)
    ON DELETE CASCADE,
    FOREIGN KEY (idAuteur) REFERENCES Users(idUser)
    ON DELETE CASCADE
);


-- Si l'utilisateur n'existe pas, on le crée
CREATE USER IF NOT EXISTS 'cruciweb'@'localhost' IDENTIFIED BY 'root';


GRANT ALL PRIVILEGES ON `CRUCIWEB`.* TO 'cruciweb'@'localhost' WITH GRANT OPTION;