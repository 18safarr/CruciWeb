USE CRUCIWEB;

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

-- Insert the vertical definitions using the last inserted idGrille
INSERT INTO Definitions (orientation, posDepX, posDepY, description, solution, idGrille) VALUES 
('VERTICAL', 1, 1, 'Telle notre bonne vieille planète.', 'TELLURIQUE', @last_idGrille), 
('VERTICAL', 1, 2, 'Les astronomes sont toujours à sa recherche', 'ET', @last_idGrille), 
('VERTICAL', 4, 2, 'Le cadeau d’Herschel.', 'URANUS', @last_idGrille), 
('VERTICAL', 1, 3, 'Brouillent la vision', 'LARMES', @last_idGrille),
('VERTICAL', 8, 3, 'Odeur méridionale.', 'AIL', @last_idGrille),
('VERTICAL', 1, 4, 'Pour éviter que le ciel ne nous tombe sur la tête', 'ATAIS', @last_idGrille), 
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
