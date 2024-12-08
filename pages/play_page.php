<?php
require_once  '../app/Autoloader.php';
// Enregistrer l'autoloader
app\Autoloader::register();
$gm = new app\GrilleManager();
$dm = new app\DefinitionManager();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CruciWeb</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/play_page.css">
</head>
<body>
    <!-- En-tête -->
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo CrusiWeb">
        </div>
        <nav>
            <button href="#">Mes parties</button>
            <button>Mes grilles</button>
            <button>Ajouter grille</button>
            <button class="logout">Déconnexion</button>
        </nav>
    </header>
   

    <main>
        <div class="grid-container">
            <!-- Définitions verticales -->
            <div class="clues vertical scrollable">
                <h3>Verticalement</h3>
                <ul>
                  <?php
                    echo $dm->getVerticalDefinitions();
                  ?>
                </ul>
            </div>

            <!-- Grille principale -->
            <div class="grid">
                <form method="POST" action="">
                    <h3>N° : 13</h3>
                    <h4>Niveau : Intermédiaire</h4>
                    <div class="scrollable-grid">
                        <div id="crossword">
                        <?php
                            echo $gm->createGrille();
                        ?>
                        </div>
                    </div>
                    <button type="submit" name="save" id="save-button">Sauvegarder</button>
                </form>
            </div>

            <!-- Définitions horizontales -->
            <div class="clues horizontal scrollable">
                <h3>Horizontalement</h3>
                <ul>
                <?php
                    echo $dm->getHorizontalDefinitions();
                  ?>
                </ul>
            </div>
        </div>
    </main>

    <footer>
        Copyright © 2024 - 2025 Master 1 Génie de l'Informatique Logicielle CruciWeb. Tous droits réservés.
    </footer>
    
</body>
</html>
