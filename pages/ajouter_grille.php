<?php
require_once  '../app/Autoloader.php';
// Enregistrer l'autoloader
app\Autoloader::register();
$gm = new app\GrilleManager();
$dm = new app\DefinitionManager();

if (isset($_POST['cols'])&&(isset($_POST['rows']))){
    $cols = $_POST['cols'];
    $rows = $_POST['rows'];
}else{
    $cols = 13;
    $rows = 12;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CruciWeb</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/ajouter_grille.css">
    <script src="js/ajouter_grille.js" defer></script>
    <script src="js/load_grille.js" defer></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo CruciWeb">
        </div>
        <nav>
            <button>Mes parties</button>
            <button>Mes grilles</button>
            <button class="disabled">Ajouter grille</button>
            <button class="logout">Déconnexion</button>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="container-row">
                <!-- Paramètres de la grille -->
                <div class="params">
                    <h2>Paramètres de la grille</h2>
                    <label for="grid-name">Nom de la grille :</label>
                    <input type="text" id="grid-name" value="ma_grille">

                    <label for="grid-size-x">Dimension :</label>
                    <div class="dimension">
                        <input type="number" id="grid-size-x" class="grid-size" value="<?php echo $cols ?>" min="5">
                        <span>x</span>
                        <input type="number" id="grid-size-y" class="grid-size" value="<?php echo $rows ?>" min="5">
                    </div>

                    <button id="generate-grid">Générer grille</button>

                    <!-- Sauvegarde de la grille -->
                <div class="save">
                    <h2>Sauvegarde de la grille</h2>
                    <label for="difficulty">Niveau Difficulté :</label>
                    <select id="difficulty">
                        <option value="Facile">Facile</option>
                        <option value="Intermédiaire" selected>Intermédiaire</option>
                        <option value="Difficile">Difficile</option>
                    </select>
                    <label>Publiée :</label>
                    <input type="radio" name="publish" id="publish-no" checked> Non
                    <input type="radio" name="publish" id="publish-yes"> Oui

                    <button id="save-grid">Enrégistrer</button>
                </div>
            </div>
                
        </div>

            <!-- Grille de mots croisés -->
            <div class="grid">
                <div class="scrollable-grid">
                    <div id="crossword">
                        <?php
                            echo $gm->createGrille2($rows,$cols);
                        ?>
                    </div>
                </div>
            </div>

            

            <!-- Section des définitions -->
            <div class="definitions">
                <!-- Définitions verticales -->
                <div class="defVertical">
                    <div class="more-def">
                        <h2>Définitions Verticales</h2>
                        <button id="add-vertical-definition">+</button>
                    </div>
                    
                    <div class="definitions-scroll">
                        <div class="definition">
                            <label>Départ</label>
                            <input type="text" class="def-num" placeholder="a, b, c...">
                            <input type="text" class="def-num" placeholder="1, 2, 3...">
                            <label>Description</label>
                            <input type="text" class="def-desc" placeholder="Définition">
                            <label>Solution</label>
                            <input type="text" class="def-sol" placeholder="Solution">
                            <button class="supp-def">X</button>
                            <button class="valider-def">&#x2713;</button>
                        </div>
                    </div>
                    
                </div>

                <!-- Définitions horizontales -->
                <div class="defHorizontal">
                    <div class="more-def">
                        <h2>Définitions Horizontales</h2>
                        <button id="add-horizontal-definition">+</button>
                    </div>
                    <div class="definitions-scroll">
                        <div class="definition">
                            <label>Départ</label>
                            <input type="text" class="def-num" placeholder="1, 2, 3...">
                            <input type="text" class="def-num" placeholder="a, b, c...">
                            <label>Description</label>
                            <input type="text" class="def-desc" placeholder="Définition">
                            <label>Solution</label>
                            <input type="text" class="def-sol" placeholder="Solution">
                            <button class="supp-def">X</button>
                            <button class="valider-def">&#x2713;</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>

    <footer>
        Copyright © 2024 - 2025 Master 1 Génie de l'Informatique Logicielle CruciWeb. Tous droits réservés.
    </footer>
</body>
</html>
