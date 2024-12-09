<?php
require_once '../app/Autoloader.php';
app\Autoloader::register();

if (isset($_POST['cols']) && isset($_POST['rows'])) {
    $cols = (int) $_POST['cols'];
    $rows = (int) $_POST['rows'];

    if ($cols >= 5 && $rows >= 5) { // On impose des tailles minimales
        $gm = new app\GrilleManager();
        echo $gm->createGrille2($rows, $cols); // Génère et renvoie la grille
    } else {
        echo "Erreur: Les dimensions doivent être supérieures à 5x5.";
    }
} else {
    echo "Erreur: Paramètres manquants.";
}
?>