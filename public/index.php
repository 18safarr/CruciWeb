<?php

require_once '../app/Autoloader.php';
// Enregistrer l'autoloader
app\Autoloader::register();

// Définir les routes
$routes = [
    'home_user' => '../pages/home_user.php',
    'play' => '../pages/play_page.php',
    'ajouter_grille' => '../pages/ajouter_grille.php',
    'auth' => '../pages/authentification.php',
    'ins' => '../pages/inscription.php'
];

// Récupérer la route ou définir une route par défaut
$p = $_GET['p'] ?? 'home_user';

// Vérifier si la route existe
if (array_key_exists($p, $routes)) {
    require $routes[$p];
} else {
    // Charger une page d'erreur 404 si la route est inconnue
    http_response_code(404);
    require '../pages/404.php'; // Créez une page 404 personnalisée
}
?>
