-- -- Insérer la grille
-- INSERT INTO Grilles (nomGrille, dimX, dimY, datePublication, idAuteur, difficulte) 
-- VALUES ('Grille 1', 5, 5, '2024-12-15', 1, 'Intermédiaire');

use CRUCIWEB;
-- -- Insérer les cases noires
INSERT INTO Cases (positionX, positionY, idGrille) VALUES 
(3, 2, 53), 
(3, 3, 53), 
(3, 5, 53), 
(3, 6, 53), 
(5, 2, 53), 
(5, 3, 53), 
(5, 5, 53), 
(5, 6, 53);

-- Insérer les définitions verticales
INSERT INTO Definitions (orientation, posDepX, posDepY, description, solution, idGrille) VALUES 
('VERTICAL', 2, 2, 'Un arbre', 'ARBRE', 53), 
('VERTICAL', 4, 2, 'Objet qui vole', 'CIEL', 54), 
('VERTICAL', 6, 2, 'Plante colorée', 'FLEUR', 53);

-- Insérer les définitions horizontales
INSERT INTO Definitions (orientation, posDepX, posDepY, description, solution, idGrille) VALUES 
('HORIZONTAL', 2, 2, 'Grand végétal', 'ARBRE', 53), 
('HORIZONTAL', 2, 4, 'Bleu au-dessus', 'CIEL', 53), 
('HORIZONTAL', 2, 6, 'Plante avec pétales', 'FLEUR', 53);
