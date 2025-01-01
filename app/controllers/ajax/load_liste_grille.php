<?php
session_start();
require_once  (__DIR__ . '/../GrilleManager.php');

use controllers\GrilleManager;

if (isset($_POST['load-liste-grille'])) {
    $type = $_POST['load-liste-grille']; 

    if ($type=="privee") { 
       echo GrilleManager::createTablePrivateGridHTML($_SESSION['user_id']);
    } elseif($type=="public") {
       echo GrilleManager::createTablePublicGridHTML();
    }elseif($type=="partie"){
        echo GrilleManager::createTablePartieHTML($_SESSION["user_id"]);
    }
    elseif($type=="admin"){
        echo GrilleManager::createTableAllGridHTML();
    }
}
?>