<?php
// Définir les routes
$routes = [
    'home_user' => 'app/views/home_user.php',
    'play' => 'app/views/play_page.php',
    'ajouter_grille' => 'app/views/ajouter_grille.php',
    'auth' => 'app/views/authentification.php',
    'ins' => 'app/views/inscription.php'
];

// Récupérer la route ou définir une route par défaut
$p = $_GET['p'] ?? 'home_user';

// Vérifier si la route existe
if (array_key_exists($p, $routes)) {
    require $routes[$p];
} else {
    // Charger une page d'erreur 404 si la route est inconnue
    http_response_code(404);
    require 'app/views/404.php'; // Créez une page 404 personnalisée
}
?>
