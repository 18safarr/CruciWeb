<?php
session_start();
error_reporting(E_ALL); // Activer l'enregistrement de toutes les erreurs
require_once (__DIR__ . '/../../controllers/GrilleManager.php');
use controllers\GrilleManager;
header("Content-Type: application/json");

if (!isset($_SESSION['grille_id'])) {
    echo json_encode(["success" => false, "message" => "Grille nom reconnue."]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    
    
    $rc=0;
    try {
        if(isset($_SESSION['user_id'])){

            if(isset($_SESSION['grille_id'])){
            
                if(isset($_SESSION['partie_id'])){
                    $rc=GrilleManager::updatePartie($_SESSION['partie_id'],$data['contenu']);
                }else{
                    $rc = GrilleManager::savePartie(
                        $data["contenu"],
                        "Terminée",
                        $_SESSION['grille_id'],
                        $_SESSION['user_id']
                    );
                }
            }
        
        }
       

      
       

        echo json_encode(["success" => true,"message" => "BRAVO !!!!!!!!!!!!!!!!!!!!!!"]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données manquantes."]);
}

?>