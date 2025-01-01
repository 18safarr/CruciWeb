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
    solution TEXT,
    FOREIGN KEY (idAuteur) REFERENCES Users(idUser)
    ON DELETE CASCADE
);

CREATE TABLE Cases (
    idCase INT AUTO_INCREMENT PRIMARY KEY,
    positionX INT NOT NULL,
    positionY INT NOT NULL,
    idGrille INT NOT NULL,
    FOREIGN KEY (idGrille) REFERENCES Grilles(idGrille) ON DELETE CASCADE
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



-- Si l'utilisateur n'existe pas, on le crée
CREATE USER IF NOT EXISTS 'cruciweb'@'localhost' IDENTIFIED BY 'root';


GRANT ALL PRIVILEGES ON `CRUCIWEB`.* TO 'cruciweb'@'localhost' WITH GRANT OPTION;

INSERT INTO Users (email,motDePasse,isPlayer) VALUES("sudoCruciWeb","$2y$10$sVPuwbsZvTMksS55KSVFyuGgedaUaoPO8A5Q68j/huWZ.hqVbziei",'0');
INSERT INTO Users (email,motDePasse) VALUES("koundia@univ.fr","$2y$10$sVPuwbsZvTMksS55KSVFyuGgedaUaoPO8A5Q68j/huWZ.hqVbziei");
INSERT INTO Users (email,motDePasse,isPlayer) VALUES("root","$2y$10$sVPuwbsZvTMksS55KSVFyuGgedaUaoPO8A5Q68j/huWZ.hqVbziei",'1');

-- Retrieve the last inserted 
SET @last_idUser = LAST_INSERT_ID();

-- Insert the crossword grid
INSERT INTO Grilles (nomGrille, dimX, dimY, datePublication, idAuteur, difficulte,solution) 
VALUES ('Grille 1', 10, 10, NULL, @last_idUser, 'Intermédiaire','{"1_1":"T","1_2":"E","1_3":"L","1_4":"E","1_5":"S","1_6":"C","1_7":"O","1_8":"P","1_9":"E","1_10":"S","2_1":"E","2_2":"T","2_3":"A","2_4":"T","2_5":"NOIRE","2_6":"O","2_7":"R","2_8":"I","2_9":"O","2_10":"N","3_1":"L","3_2":"NOIRE","3_3":"R","3_4":"A","3_5":"NOIRE","3_6":"U","3_7":"N","3_8":"C","3_9":"L","3_10":"E","4_1":"L","4_2":"U","4_3":"M","4_4":"I","4_5":"E","4_6":"R","4_7":"E","4_8":"NOIRE","4_9":"I","4_10":"O","5_1":"U","5_2":"R","5_3":"E","5_4":"S","5_5":"NOIRE","5_6":"O","5_7":"R","5_8":"E","5_9":"E","5_10":"NOIRE","6_1":"R","6_2":"A","6_3":"S","6_4":"NOIRE","6_5":"NOIRE","6_6":"N","6_7":"O","6_8":"N","6_9":"N","6_10":"E","7_1":"I","7_2":"N","7_3":"NOIRE","7_4":"B","7_5":"I","7_6":"N","7_7":"N","7_8":"I","7_9":"N","7_10":"G","8_1":"Q","8_2":"U","8_3":"A","8_4":"R","8_5":"T","8_6":"E","8_7":"T","8_8":"T","8_9":"E","8_10":"S","9_1":"U","9_2":"S","9_3":"I","9_4":"N","9_5":"E","9_6":"NOIRE","9_7":"NOIRE","9_8":"E","9_9":"NOIRE","9_10":"O","10_1":"E","10_2":"NOIRE","10_3":"L","10_4":"O","10_5":"M","10_6":"B","10_7":"A","10_8":"R","10_9":"D","10_10":"S"}');

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
