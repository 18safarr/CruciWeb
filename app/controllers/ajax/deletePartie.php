<?php
session_start();
require_once  (__DIR__ . '/../GrilleManager2.php');


use controllers\GrilleManager2;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['idPartie'])) {
        $idPartie = intval($data['idPartie']);
        
        // Appeler la méthode de suppression
        if (GrilleManager2::deletePartie($idPartie)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID partie manquant.']);
    }
}
?>