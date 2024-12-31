-- Étape 1 : Création de la base de données
DROP DATABASE IF EXISTS CRUCIWEB;

CREATE DATABASE CRUCIWEB;

-- Étape 2 : Utilisation de la base de données
USE CRUCIWEB;

-- Étape 3 : Crétion des tables
CREATE TABLE Users (
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
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
    difficulte ENUM('Débutant','Intermédiaire','Expert') NOT NULL,
    FOREIGN KEY (idAuteur) REFERENCES Users(idUser)
    ON DELETE CASCADE
);

CREATE TABLE Cases (
    idCase INT AUTO_INCREMENT PRIMARY KEY,
    positionX INT NOT NULL,
    positionY INT NOT NULL,
    idGrille INT NOT NULL,
    isBlack ENUM('YES', 'NO') DEFAULT 'YES',
    contenue VARCHAR(1),
    FOREIGN KEY (idGrille) REFERENCES Grilles(idGrille) ON DELETE CASCADE,
    CHECK (isBlack = 'YES' OR contenue IS NOT NULL)
);

CREATE TABLE Definitions (
    idDefinition INT AUTO_INCREMENT PRIMARY KEY,
    orientation ENUM('VERTICAL', 'HORIZONTAL') NOT NULL,
    posDepX INT NOT NULL,
    posDepY INT NOT NULL,
    description VARCHAR(255) NOT NULL,
    solution VARCHAR(255) NOT NULL,
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

INSERT INTO Users (email,motDePasse) VALUES("root","$2y$10$sVPuwbsZvTMksS55KSVFyuGgedaUaoPO8A5Q68j/huWZ.hqVbziei");
INSERT INTO Users (email,motDePasse) VALUES("sudouser","$2y$10$sVPuwbsZvTMksS55KSVFyuGgedaUaoPO8A5Q68j/huWZ.hqVbziei");


-- Insert the crossword grid
INSERT INTO Grilles (nomGrille, dimX, dimY, datePublication, idAuteur, difficulte) 
VALUES ('Grille 1', 10, 10, '2024-12-15', 1, 'Intermédiaire');

-- Retrieve the last inserted idGrille
SET @last_idGrille = LAST_INSERT_ID();

-- Insert the black squares using the last inserted idGrille
INSERT INTO Cases (positionX, positionY, idGrille) VALUES 
(2, 5, @last_idGrille), 
(3, 2, @last_idGrille), 
(3, 5, @last_idGrille), 
(4, 8, @last_idGrille), 
(5, 5, @last_idGrille), 
(5, 10, @last_idGrille), 
(6, 4, @last_idGrille), 
(6, 5, @last_idGrille), 
(7, 3, @last_idGrille),
(9, 6, @last_idGrille),
(9, 7, @last_idGrille),
(9, 9, @last_idGrille),
(10, 2, @last_idGrille);

-- INSERT INTO Cases (positionX, positionY, idGrille,isBlack,contenue) VALUES 
-- (10, 3, @last_idGrille,"NO",'A');

-- Insert the vertical definitions using the last inserted idGrille
INSERT INTO Definitions (orientation, posDepX, posDepY, description, solution, idGrille) VALUES 
('VERTICAL', 1, 1, 'Telle notre bonne vieille planète.', 'TELLURIQUE', @last_idGrille), 
('VERTICAL', 1, 2, 'Les astronomes sont toujours à sa recherche', 'ET', @last_idGrille), 
('VERTICAL', 4, 2, 'Le cadeau d’Herschel.', 'URANUS', @last_idGrille), 
('VERTICAL', 1, 3, 'Brouillent la vision', 'LARMES', @last_idGrille),
('VERTICAL', 8, 3, 'Odeur méridionale.', 'AIL', @last_idGrille),
('VERTICAL', 1, 4, 'Pour éviter que le ciel ne nous tombe sur la tête', 'ETAIS', @last_idGrille), 
('VERTICAL', 7, 4, 'En Moravie.', 'BRNO', @last_idGrille),
('VERTICAL', 7, 5, 'Article.', 'ITEM', @last_idGrille),
('VERTICAL', 1, 6, 'Boréale, australe ou solaire.', 'COURONNE', @last_idGrille),
('VERTICAL', 1, 7, 'Décoreront.', 'ORNERONT', @last_idGrille),
('VERTICAL', 1, 8, 'Celui du Midi est un haut lieu de l’astronomie française', 'PIC', @last_idGrille), 
('VERTICAL', 5, 8, 'Les instruments astronomiques renversent les images, mais ce n’est pas une raison pour tourner le ciel de cette façon.', 'ENITER', @last_idGrille),
('VERTICAL', 1, 9, 'Pour faire quelque chose avec du vent.', 'EOLIENNE', @last_idGrille),
('VERTICAL', 1, 10, 'Aux quatre coins de la rose', 'SNEO', @last_idGrille), 
('VERTICAL', 6, 10, 'Un gamin vraiment désordonné.', 'EGSOS', @last_idGrille);

-- Insert the horizontal definitions using the last inserted idGrille
INSERT INTO Definitions (orientation, posDepX, posDepY, description, solution, idGrille) VALUES 
('HORIZONTAL', 1, 1, 'Les outils des astronomes.', 'TELESCOPES', @last_idGrille), 
('HORIZONTAL', 2, 1, 'Louis XIV, selon Louis XIV', 'ETAT', @last_idGrille), 
('HORIZONTAL', 2, 6, 'Chasseur équatorial.', 'ORION', @last_idGrille), 
('HORIZONTAL', 3, 3, 'Que ce soit le dieu ou le métal, il irradie', 'RA', @last_idGrille), 
('HORIZONTAL', 3, 6, 'Sam ou Tom.', 'UNCLE', @last_idGrille),
('HORIZONTAL', 4, 1, 'Porteuse de messages célestes', 'LUMIERE', @last_idGrille), 
('HORIZONTAL', 4, 9, 'A une liaison avec Jupiter.', 'IO', @last_idGrille),
('HORIZONTAL', 5, 1, 'Aurochs', 'URES', @last_idGrille), 
('HORIZONTAL', 5, 6, 'Bout de bois.', 'OREE', @last_idGrille),
('HORIZONTAL', 6, 1, 'Court', 'RAS', @last_idGrille), 
('HORIZONTAL', 6, 6, 'Religieuse.', 'NONNE', @last_idGrille),
('HORIZONTAL', 7, 1, 'À la mode', 'IN', @last_idGrille), 
('HORIZONTAL', 7, 4, 'Technique utilisée par les virtuoses de l’imagerie électronique.', 'BINNING', @last_idGrille),
('HORIZONTAL', 8, 1, 'Petits ensembles, battus d’une tête par celui de Stephan.', 'QUARTETTES', @last_idGrille),
('HORIZONTAL', 9, 1, 'Local industriel.', 'USINE', @last_idGrille),
('HORIZONTAL', 10, 3, 'On les trouve surtout dans le nord de l’Italie.', 'LOMBARDS', @last_idGrille);
