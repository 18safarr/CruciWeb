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

  
    <h1 class="title-table">Mots croisés en ligne gratuit</h1>
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

        <div class="right-container" id="right-container">
            <!-- Le contenu chargé dynamiquement sera inséré ici par defaut il y'a la page connexion -->
           <?php require_once '../pages/connexion_form.php'; ?>
        </div>
    </div>

   
</body>
 <!-- Pied de page -->
 <footer>
        <p>Copyright © 2024 - 2025 Master 1 Génie de l'Informatique Logicielle CrusiWeb. Tous droits réservés.</p>
</footer>
</html>
