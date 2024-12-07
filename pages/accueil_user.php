<?php
require_once  '../app/Autoloader.php';
// Enregistrer l'autoloader
app\Autoloader::register();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrusiWeb - Accueil</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <!-- En-tête -->
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo CrusiWeb">
        </div>
        <div class="header-buttons">
            <button class="btn connexion">Connexion</button>
            <button class="btn inscription">S'inscrire</button>
        </div>
    </header>

    <!-- Titre principal -->
    <h1 class="welcome-title">Bienvenue dans CrusiWeb</h1>

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
                $rows = new app\GrilleTable();
                echo $rows->getRows();
               ?>
            </tbody>
        </table>
    </div>

    <!-- Pied de page -->
    <footer>
        <p>Copyright © 2024 - 2025 Master 1 Génie de l'Informatique Logicielle CrusiWeb. Tous droits réservés.</p>
    </footer>

    <script src="js/index.js"></script>
</body>
</html>
