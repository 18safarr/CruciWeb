<?php
session_start();

// Vérifier si une session existe
if (isset($_SESSION['user_id'])) {
    // Détruire toutes les données de session
    session_unset();
    session_destroy();

    // Rediriger l'utilisateur vers la page de connexion ou d'accueil
    header("Location: http://localhost/CruciWeb/public/");
    exit();
} else {
    // Si aucune session n'existe, redirigez également
    header("Location: http://localhost/CruciWeb/public/");
    exit();
}
?>
