<?php
session_start();
require_once (__DIR__ . '/../controllers/GrilleManager.php');
require_once (__DIR__ . '/../controllers/DefinitionManager.php');
require_once (__DIR__ . '/../controllers/UserManager.php');

use controllers\DefinitionManager;
use controllers\GrilleManager;
use controllers\UserManager;


if (isset($_GET["idGrille"])){
    $idGrille = $_GET["idGrille"];

    $test=GrilleManager::initParamsGridFor($idGrille);
    DefinitionManager::setIdGrille($idGrille);
    #si l'id grille n'existe pas redirection vers la page daccueil
    if(isset($test))
        header("Location:index.php");

    $solution = GrilleManager::getSolutionGrille();

    if (isset($_SESSION['user_id'])){
        UserManager::setIdUSer($_SESSION['user_id']);
        $_SESSION["grille_id"] = $idGrille;
    }

    $grilleHTML = GrilleManager::createGridHTML();

}elseif(isset($_GET["idPartie"])&&isset($_SESSION['user_id'])){
    $idPartie = $_GET["idPartie"];
    $idGrille=GrilleManager::getIdGrilleBy($idPartie);
    $test=GrilleManager::initParamsGridFor($idGrille);
    #si l'id grille n'existe pas redirection vers la page daccueil
    if(isset($test))
        header("Location:index.php");
    DefinitionManager::setIdGrille($idGrille);
    GrilleManager::setIdPartie($idPartie);
    $solution = GrilleManager::getSolutionGrille();

    UserManager::setIdUSer($_SESSION['user_id']);
    $_SESSION["grille_id"] = $idGrille;
    $_SESSION["partie_id"] = $idPartie;

    $grilleHTML = GrilleManager::createGridPartieHTML();


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
    <link rel="stylesheet" href="public/css/play_page.css">
    <script src="public/js/nav.js" ></script>
    <script src="public/js/play_page.js"></script>
    <script src="public/js/checkGrille.js" defer></script>
</head>
<body>
    <!-- En-tête -->
    <header>
        <div class="logo">
            <img src="public/images/logo.png" alt="Logo CrusiWeb">
        </div>

        <?php if (isset($_SESSION['user_id'])) { ?>
            
            <nav>
                <button id="voir-grilles-public">Home</button>
                <button id="voir-mes-grilles">Mes grilles</button>
                <button id="voir-mes-parties">Mes parties</button>
                <button id="add-grille">Ajouter grille</button>
                <button id="logout" class="logout">Déconnexion</button>
            </nav>
        <?php } else if (!isset($_GET['demand'])) { ?>
            <nav>
            <button id="voir-grilles-public">Home</button>
                <form id="login-form" method="post">
                    
                    <label for="username">email</label>
                    <input type="text" id="username" name="username" placeholder="Entrez votre email" required>

                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>

                    
                    <button type="submit" class="btn">Se connecter</button>

                    <a href="?p=play&demand=inscription&idGrille=<?php echo $idGrille ?>" class="register-link">Inscrivez-vous</a>

                    <p class="error-message" style="display:none;">email ou mot de passe incorrect</p>
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
                    <a href="?p=play&idGrille=<?php echo $idGrille ?>" class="register-link">J'ai un compte</a>
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

            <!-- Définitions horizontales -->
            <div class="clues horizontal scrollable">
                <!-- <h3>Horizontalement</h3> -->
                <ul class="styled-list ">
                <?php
                    echo DefinitionManager::getlistDefinitionsHTML("HORIZONTAL");
                  ?>
                </ul>
                
            </div>
           

            <!-- Grille principale -->
            <div class="grid">
                <form method="POST" action="">
                    <h3>N° : <?php echo $idGrille; ?> |  Nom : Ma Grille</h3>
                    <h3>Niveau : Intermédiaire</h3>
                    <div class="scrollable-grid">
                        <div id="crossword">
                        <?php

                            echo $grilleHTML;
                        ?>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <button type="button" name="save" id="save-button">Sauvegarder</button>
                    <?php }?>
                    <button type="button" name="check" id="check-button" onclick="checkGrille(<?php echo htmlspecialchars(json_encode($solution), ENT_QUOTES, 'UTF-8');?>)">Vérifier</button>
                </form>
            </div>

             <!-- Définitions verticales -->
             <div class="clues vertical scrollable">
                <!--   <h3>Verticalement</h3> -->
                    <ul class="styled-list">
                        <?php
                            echo DefinitionManager::getlistDefinitionsHTML("VERTICAL");
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
