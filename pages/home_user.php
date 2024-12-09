<?php
require_once '../app/Autoloader.php';
// Enregistrer l'autoloader
app\Autoloader::register();
$grille = new app\GrilleManager();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrusiWeb - Accueil</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/home_user.css">
    <script src="js/sortTableElement.js" defer></script>
    <script src="js/load_form.js" defer></script>
</head>
<body>
    <!-- En-tête -->
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo CrusiWeb">
        </div>
          <!-- Titre principal -->
        <h1 class="welcome-title">Bienvenue dans CrusiWeb</h1>
        
        
    </header>

  

    <!-- Conteneur principal -->
    <div class="container">
        <!-- Tableau des grilles -->
        <div class="table-container">
            <table id="grilleTable">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom grille</th>
                        <th>Dimension</th>
                        <th onclick="sortTableByLevel()"><span id="levelSortIcon">&#x25B2;&#x25BC;</span>Niveau</th>
                        <th onclick="sortTableByDate()"><span id="dateSortIcon">&#x25B2;&#x25BC;</span>Date de publication</th>
                        <th>Auteur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $gm = new app\GrilleManager();
                    echo $gm->getAllShareGrilles();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Section de connexion -->
        <!-- Conteneur droit -->
        <div class="right-container" id="right-container">
            <!-- Le contenu chargé dynamiquement sera inséré ici -->
            <div class="form-container">
                <div class="logo">
                    <img src="images/sign_in.png" alt="Logo Crucigrille">
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
                    <button type="submit" class="btn">S'inscrire</button>
                </form>
                <div class="footer">
                    <p>Vous avez déjà un compte ? <a href="#" onclick="loadForm('connexion')">Se connecter</a></p>
                </div>
            </div>
        </div>
    </div>

   
</body>
 <!-- Pied de page -->
 <footer>
        <p>Copyright © 2024 - 2025 Master 1 Génie de l'Informatique Logicielle CrusiWeb. Tous droits réservés.</p>
    </footer>
</html>
