<?php
session_start();
require_once  '../app/GrilleManager.php';
require_once  '../app/DefinitionManager.php';
require_once  '../app/GrilleManager2.php';
use app\GrilleManager;
use app\DefinitionManager;
use app\GrilleManager2;

$gm = new GrilleManager();
$dm = new DefinitionManager();

if (isset($_GET["idGrille"])){
    $idGrille = $_GET["idGrille"];
    GrilleManager2::initParamsGridFor($idGrille);
}
   


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CruciWeb</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/play_page.css">
    <script src="js/nav.js" ></script>
</head>
<body>
    <!-- En-tête -->
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo CrusiWeb">
        </div>

        <?php if (isset($_SESSION['user_id'])) { ?>
            
            <nav>
                <button id="voir-grilles-public">Home</button>
                <button id="voir-mes-grilles">Mes grilles</button>
                <button>Mes parties</button>
                <button id="add-grille">Ajouter grille</button>
                <button id="logout" class="logout">Déconnexion</button>
            </nav>
        <?php } else if (!isset($_GET['demand'])) { ?>
            <nav>
                <form id="login-form" method="post">
                    
                    <label for="username">Identifiant</label>
                    <input type="text" id="username" name="username" placeholder="Entrez votre identifiant" required>

                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>

                    
                    <button type="submit" class="btn">Se connecter</button>

                    <a href="?p=play&demand=inscription" class="register-link">Inscrivez-vous</a>

                    <p class="error-message" style="display:none;">Identifiant ou mot de passe incorrect</p>
                </form>
            </nav>
            <?php } else if (isset($_GET['demand'])) { ?>
            <nav>
                <form id="inscription-form" class="form-container">
                    <!-- Champ E-mail -->
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" placeholder="Entrez votre adresse e-mail" required>

                    <!-- Champ Mot de passe -->
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Créez un mot de passe" required>

                    <!-- Champ Confirmation de mot de passe -->
                    <label for="confirm-password">Confirmer</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmez le mot de passe" required>

                    <!-- Bouton d'inscription -->
                    <button type="submit" class="btn">S'inscrire</button>
                    <a href="?p=play" class="register-link">J'ai un compte</a>
                    <!-- Message d'erreur -->
                    <div id="error-message" class="error hidden" style="height: 10px; margin:0px;">
                        <p class="error-message" style="display:none;">Les mots de passe ne correspondent pas.</p>
                    </div>
                </form>
            </nav>

        <?php } ?>
       
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
                            echo GrilleManager2::createGridHTML();
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
