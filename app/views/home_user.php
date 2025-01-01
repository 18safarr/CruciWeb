<?php
session_start();
require_once (__DIR__ . '/../controllers/GrilleManager2.php');
use controllers\GrilleManager2;
require_once (__DIR__ . '/../controllers/UsersManager.php');
use controllers\UsersManager;



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrusiWeb - Accueil</title>
    <link rel="stylesheet" href="public/css/default.css">
    <link rel="stylesheet" href="public/css/home_user.css">
    <link rel="stylesheet" href="public/css/dashboard.css">
    <script src="public/js/home_user.js"></script>
    <script src="public/js/deleteGrille.js"></script>
    <script src="public/js/deletePartie.js"></script>
    <script src="public/js/sortTableElement.js" defer></script>
</head>
<body>
    <!-- En-tête -->
    <header>
        <div class="logo">
            <img src="public/images/logo.png" alt="Logo CrusiWeb">
        </div>
          <!-- Titre principal -->
        <h1 class="welcome-title">Bienvenue dans CrusiWeb</h1>
        
        
    </header>

  
    <h1 class="title-table">Mots croisés en ligne gratuit</h1>
    <!-- Conteneur principal -->
    <div class="container">
    
        <!-- Tableau des grilles -->
        <div class="table-container">
            <table id="grilleTable">
                <?php echo GrilleManager2::createTablePublicGridHTML(); ?>
            </table>
        </div>

        <div class="right-container" id="right-container">
            <!-- Le contenu chargé dynamiquement sera inséré ici par defaut il y'a la page connexion -->
            <?php if (!isset($_SESSION['user_id'])) { ?>
                <?php if (!isset($_GET['demand'])) { ?>
                    <div class="form-container">
                        <div class="logo">
                            <img src="public/images/auth.png" alt="Logo Crucigrille">
                        </div>
                        <h1>Se connecter</h1>
                        <form id="login-form" method="post">
                            <div class="form-group">
                                <label for="username">Identifiant ou e-mail</label>
                                <input type="text" id="username" name="username" placeholder="Entrez votre identifiant" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                            </div>
                            <p class="error-message" style="display:none;">Identifiant ou mot de passe incorrect</p>
                            <button type="submit" class="btn">Se connecter</button>
                        </form>
                        <div class="footer">
                            <!-- <p>Vous n'avez pas de compte ? <a href="#" onclick="loadForm('inscription')">S'inscrire</a></p> -->
                            <p>Vous n'avez pas de compte ? <a href="?demand=inscription" >S'inscrire</a></p>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="form-container">
                        <div class="logo">
                            <img src="public/images/sign_in.png" alt="Logo Crucigrille">
                        </div>
                        <h1>Créer un compte</h1>
                        <form id="inscription-form">
                            <div class="form-group">
                                <label for="email">Adresse e-mail</label>
                                <input type="email" id="email" name="email" placeholder="Entrez votre adresse e-mail" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" placeholder="Créez un mot de passe" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirmer le mot de passe</label>
                                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmez votre mot de passe" required>
                            </div>
                            <div id="error-message" class="error hidden">
                                <p>Les mots de passe ne correspondent pas.</p>
                            </div>
                            <button type="submit" id="submit-inscription" class="btn">S'inscrire</button>
                        </form>
                        <div class="footer">
                            <!-- <p>Vous avez déjà un compte ? <a href="#" onclick="loadForm('connexion')">Se connecter</a></p> -->
                            <p>Vous avez déjà un compte ? <a href="index.php">Se connecter</a></p>
                        </div>
                    </div>
                <?php }?>

            <?php } else { ?>

                <div class="user-dashboard">
                    <div class="profile">
                        <img src="public/images/user.png" alt="Photo de profil" class="profile-pic">
                        <h2>Bienvenue</h2>
                    </div>
                    <div class="actions">
                        <button class="btn blue-btn" class="inactive" id="voir-grilles-public">Home</button>
                        <button class="btn blue-btn" id="voir-mes-grilles">Mes grilles</button>
                        <button class="btn blue-btn" id="voir-mes-parties">Mes parties</button>
                        <button class="btn blue-btn" id="add-grille">Ajouter grille</button>
                    </div>
                    <button class="btn red-btn" id="logout" >Déconnexion</button>
                </div>

            <?php } ?>

        </div>
    </div>

   
</body>
 <!-- Pied de page -->
 <footer>
        <p>Copyright © 2024 - 2025 Master 1 Génie de l'Informatique Logicielle CrusiWeb. Tous droits réservés.</p>
</footer>
</html>
