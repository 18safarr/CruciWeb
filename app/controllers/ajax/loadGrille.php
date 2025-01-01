<?php
require_once  (__DIR__ . '/../GrilleManager.php');
use controllers\GrilleManager; 
if (isset($_POST['cols']) && isset($_POST['rows'])) {
    $cols = (int) $_POST['cols'];
    $rows = (int) $_POST['rows'];

    if ($cols >= 5 && $rows >= 5) { // On impose des tailles minimales
        GrilleManager::setDimension($rows,$cols);
        echo GrilleManager::createGridHTML(withInput:false); // Génère et renvoie la grille
    } else {
        echo "Erreur: Les dimensions doivent être supérieures à 5x5.";
    }
} else {
    echo "Erreur: Paramètres manquants.";
}
?>