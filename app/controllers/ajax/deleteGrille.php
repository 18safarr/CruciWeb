<?php
session_start();
require_once  (__DIR__ . '/../GrilleManager.php');


use controllers\GrilleManager;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['idGrille'])) {
        $idGrille = intval($data['idGrille']);
        
        // Appeler la méthode de suppression
        if (GrilleManager::deleteGrid($idGrille)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID de grille manquant.']);
    }
}
?>