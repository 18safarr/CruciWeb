<?php
session_start();
require_once (__DIR__ . '/../controllers/GrilleManager.php');
use controllers\GrilleManager;
require_once (__DIR__ . '/../controllers/UserManager.php');
use controllers\UserManager;
 if (!isset($_SESSION['admin_id'])) { 
    $status = "hidden";
    $style = 'style=" width: 25% !important; margin: 0 auto;"';
 }else{
    $status = "";
    $style = "";
 }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrusiWeb - Accueil</title>
    <link rel="stylesheet" href="public/css/default.css">
    <link rel="stylesheet" href="public/css/admin_page.css">
    <link rel="stylesheet" href="public/css/dashboard.css">
    <script src="public/js/admin_page.js"></script>
    <script src="public/js/deleteGrille.js"></script>
    <script src="public/js/deleteUser.js"></script>
    <script src="public/js/sortTableElement.js" defer></script>
</head>
<body>
    <!-- En-tête -->
    <header>
        <div class="logo">
            <img src="public/images/logo.png" alt="Logo CrusiWeb">
        </div>
          <!-- Titre principal -->
        <h1 class="welcome-title">Bienvenue dans la page admin de CrusiWeb</h1>
        
        
    </header>

  
    <!-- <h1 class="title-table">Mots croisés en ligne gratuit</h1> -->
    <!-- Conteneur principal -->
    <div class="container">
    
        <!-- Tableau des grilles -->
         
        <div class="table-container" <?php echo $status;?>>
            <?php echo UserManager::createRegisterUserHTML();?>
        </div>

        <div class="right-container" id="right-container" >
            <!-- Le contenu chargé dynamiquement sera inséré ici par defaut il y'a la page connexion -->
            <?php if (!isset($_SESSION['admin_id'])) { ?>
                    <div class="form-container" <?php echo $style; ?> >
                        <div class="logo">
                            <img src="public/images/admin.png" alt="Logo Crucigrille">
                        </div>
                        <h1>Identifiez-Vous</h1>
                        <form id="login-form" method="post">
                            <div class="form-group">
                                <label for="username">Identifiant</label>
                                <input type="text" id="username" name="username" placeholder="Entrez votre identifiant" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                            </div>
                            <p class="error-message" style="display:none;">Identifiant ou mot de passe incorrect</p>
                            <button type="submit" class="btn">Se connecter</button>
                        </form>
                    </div>
            <?php } else { ?>

                <div class="user-dashboard">
                    <div class="profile">
                        <img src="public/images/user.png" alt="Photo de profil" class="profile-pic">
                        <h2>Bienvenue</h2>
                    </div>
                    <div class="actions">
                        <button class="btn blue-btn" class="inactive" id="voir-users">Voir utilisateurs</button>
                        <button class="btn blue-btn" id="voir-grilles">Voir grilles</button>
                        <button class="btn blue-btn" id="add-user">+Utilisateur</button>
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
