<?php
session_start();
require_once  (__DIR__ . '/../UsersManager.php');


use controllers\UsersManager;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['idUser'])) {
        $idUser = intval($data['idUser']);
        
        // Appeler la méthode de suppression
        if (UsersManager::deleteUser($idUser)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID Utilisateur manquant.']);
    }
}
?>