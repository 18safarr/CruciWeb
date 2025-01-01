<?php
session_start();
error_reporting(E_ALL); // Activer l'enregistrement de toutes les erreurs
require_once (__DIR__ . '/../../controllers/GrilleManager.php');
use controllers\GrilleManager;
header("Content-Type: application/json");

if (!isset($_SESSION['user_id']) || !isset($_SESSION['grille_id'])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non authentifié."]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    
    // $idAuteur = $_SESSION["user_id"];

    try {
        
        $rc = GrilleManager::savePartie(
            $data["contenu"],
            $data["statut"],
            $_SESSION['grille_id'],
            $_SESSION['user_id']
        );
      
       

        echo json_encode(["success" => true,"message"=>$rc]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données manquantes."]);
}

?>