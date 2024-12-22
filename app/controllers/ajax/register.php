<?php
require_once(__DIR__ . '/../model/Users.php');
require_once(__DIR__ . '/../App.php');
use model\Users;
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

    // // Vérification si l'utilisateur existe déjà
    // $userModel = new Users();
    // if ($userModel->emailExists($email)) {
    //     echo json_encode(['success' => false, 'message' => 'Cet e-mail est déjà utilisé.']);
    //     exit;
    // }

    // // Création d'un nouvel utilisateur
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hachage du mot de passe
    // $success = $userModel->createUser($email, $hashedPassword);

    // if ($success) {
    //     echo json_encode(['success' => true]);
    // } else {
    //     echo json_encode(['success' => false, 'message' => 'Erreur lors de la création de l\'utilisateur.']);
    // }
} else {
    echo json_encode(['success' => false, 'message' => 'Requête invalide.']);
}
?>
