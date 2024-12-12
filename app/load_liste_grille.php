<?php
require_once  '../app/GrilleManager.php';
require_once  '../app/DefinitionManager.php';
use app\GrilleManager;

if (isset($_POST['load-liste-grille'])) {
    $type = $_POST['load-liste-grille']; 

    if ($type=="privee") { 
        $gm = new GrilleManager();
       echo '<thead>
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
        <tbody>'.$gm->getAllShareGrilles2().'</tbody>';
    } else {
        $gm = new GrilleManager();
       echo '<thead>
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
        <tbody>'.$gm->getAllShareGrilles().'</tbody>';
      
    }
}
?>