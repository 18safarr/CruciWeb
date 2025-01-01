<?php
session_start();
require_once  (__DIR__ . '/../GrilleManager2.php');

use controllers\GrilleManager2;

if (isset($_POST['load-liste-grille'])) {
    $type = $_POST['load-liste-grille']; 

    if ($type=="privee") { 
       echo GrilleManager2::createTablePrivateGridHTML($_SESSION['user_id']);
    } elseif($type=="public") {
       echo GrilleManager2::createTablePublicGridHTML();
    }elseif($type=="partie"){
        echo GrilleManager2::createTablePartieHTML($_SESSION["user_id"]);
    }
    elseif($type=="admin"){
        echo GrilleManager2::createTableAllGridHTML();
    }
}
?>