<?php
session_start();
require_once  (__DIR__ . '/../GrilleManager2.php');

use controllers\GrilleManager2;

if (isset($_POST['load-liste-grille'])) {
    $type = $_POST['load-liste-grille']; 

    if ($type=="privee") { 
       echo '<thead>
            <tr>
                <th>N°</th>
                <th>Nom grille</th>
                <th>Dimension</th>
                <th onclick="sortTableByLevel()"><span id="levelSortIcon">&#x25B2;&#x25BC;</span>Niveau</th>
                <th onclick="sortTableByDate()"><span id="dateSortIcon">&#x25B2;&#x25BC;</span>Date de publication</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>'.GrilleManager2::createTablePrivateGridHTML($_SESSION['user_id']).'</tbody>';
    } elseif($type=="public") {
       echo '<thead>
            <tr>
                <th>N°</th>
                <th>Nom grille</th>
                <th>Dimension</th>
                <th onclick="sortTableByLevel()"><span id="levelSortIcon">&#x25B2;&#x25BC;</span>Niveau</th>
                <th onclick="sortTableByDate()"><span id="dateSortIcon">&#x25B2;&#x25BC;</span>Date de publication</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>'.GrilleManager2::createTablePublicGridHTML().'</tbody>';
      
    }elseif($type=="admin"){
        echo GrilleManager2::createTableAllGridHTML();
    }
}
?>