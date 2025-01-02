<?php
require_once(__DIR__ . '/../UserManager.php');

use controllers\UserManager;

// Vérification que la requête est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validation des données
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Tous les champs sont obligatoires.']);
        exit;
    }

    // Vérification si l'utilisateur existe déjà
    
    if (UserManager::isUserExist($email)) {
        echo json_encode(['success' => false, 'message' => 'Cet e-mail est déjà utilisé.']);
        exit;
    }

    $success = UserManager::createUser($email, $password);

    if ($success==true) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la création de l\'utilisateur.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Requête invalide.']);
}
?>
