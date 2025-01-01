<?php
session_start();
require_once (__DIR__ . '/../controllers/GrilleManager2.php');
require_once (__DIR__ . '/../controllers/DefinitionManager2.php');
use controllers\DefinitionManager2;
use controllers\GrilleManager2;

if (!isset($_SESSION['user_id'])){
 
    header("Location:index.php");
} 
if (isset($_GET["idGrille"])){
    $idGrille = $_GET["idGrille"];
    GrilleManager2::initParamsGridFor($idGrille);
    list($nomGrille,
    $difficulte,
    $date,$rows,$cols)= GrilleManager2::getAllData($idGrille);

    $dm = new DefinitionManager2($idGrille,$rows,$cols);

    $_SESSION["grille_id"] = $idGrille;



}else{
    header("Location:index.php");
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CruciWeb</title>
    <link rel="stylesheet" href="public/css/default.css">
    <link rel="stylesheet" href="public/css/modifier_grille.css">
    <script src="public/js/modifier_grille.js" defer></script>
    <script src="public/js/nav.js" defer></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="public/images/logo.png" alt="Logo CruciWeb">
        </div>
        <nav>
            <button id="voir-grilles-public">HOME</button>
            <button id="voir-mes-parties">Mes parties</button>
            <button id="voir-mes-grilles" >Mes grilles</button>
            <button id="add-grille">Ajouter grille</button>
            <button class="logout" id="logout">Déconnexion</button>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="container-row">
                <!-- Paramètres de la grille -->
                <div class="params">
                    <h2>Paramètres de la grille</h2>
                    <label for="grid-name">Nom de la grille :</label>
                    <input type="text" id="grid-name" value="<?php echo $nomGrille; ?>">

                    <label for="grid-size-x">Dimension :</label>
                    <div class="dimension">
                        <input type="number" id="grid-size-x" class="grid-size" value="<?php echo $cols ?>" min="5" max=15>
                        <span>x</span>
                        <input type="number" id="grid-size-y" class="grid-size" value="<?php echo $rows ?>" min="5" max=15>
                    </div>

                    <button id="generate-grid">Générer grille</button>

                    <!-- Sauvegarde de la grille -->
                <div class="save">
                    <h2>Sauvegarde de la grille </h2>
                    <label for="difficulty">Niveau Difficulté :</label>
                    <select id="difficulty">
                        <option value="Débutant" <?php echo $difficulte === "Débutant" ? 'selected' : ''; ?>>Débutant</option>
                        <option value="Intermédiaire" <?php echo $difficulte === "Intermédiaire" ? 'selected' : ''; ?>>Intermédiaire</option>
                        <option value="Expert" <?php echo $difficulte === "Expert" ? 'selected' : ''; ?>>Expert</option>
                    </select>
                    <label>Publiée :</label>
                    <input type="radio" name="publish" id="publish-no" <?php echo isset($date) ? '' : 'checked'; ?>> Non
                    <input type="radio" name="publish" id="publish-yes" <?php echo isset($date)  ? 'checked' : ''; ?>> Oui 

                    <button id="save-grid">Modifier</button>
                </div>
            </div>
                
        </div>

            <!-- Grille de mots croisés -->
            <div class="grid">
                <div class="scrollable-grid">
                    <div id="crossword">
                        <?php
                            echo GrilleManager2::createGridHTML(withInput:false)
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
                        <!-- <div class="definition" id="vertical-template"> -->
                        <?php echo DefinitionManager2::getDefintionFormHTML("VERTICAL",true); ?>
                        <!-- </div> -->
                    </div>
                    
                </div>

                <!-- Définitions horizontales -->
                <div class="defHorizontal">
                    <div class="more-def">
                        <h2>Définitions Horizontales</h2>
                        <button id="add-horizontal-definition">+</button>
                    </div>
                    <div class="definitions-scroll">
                        <!-- <div class="definition" id="horizontal-template"> -->
                            <?php echo DefinitionManager2::getDefintionFormHTML("HORIZONTAL",true); ?>
                        <!-- </div> -->
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
