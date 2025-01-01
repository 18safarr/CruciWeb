<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);



require_once (__DIR__ . '/../../controllers/GrilleManager2.php');
require_once (__DIR__ . '/../../controllers/DefinitionManager2.php');
use controllers\GrilleManager2;
use controllers\DefinitionManager2;


if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non authentifié.",]);
    exit;
}

$inputData = json_decode(file_get_contents('php://input'), true);


if ($inputData) {
    try{
        $resulat = GrilleManager2::verifierGrille($inputData);
        
            // Insérer la grille dans la table Grilles
    
            $idGrille = GrilleManager2::addGrille(
                $inputData['nomGrille'], 
                $inputData['dimX'], 
                $inputData['dimY'], 
                $_SESSION['user_id'],   
                $inputData['difficulte'],
                json_encode($resulat),
                $inputData['publiee']

            );
            //$idGrille = Grilles::getLastId();
            // Insérer les cases noires
            foreach ($inputData['blackCells'] as $cell) {
                $data = GrilleManager2::addCase($cell['x'], $cell['y'], $idGrille);
            }
    
            // // Insérer les définitions verticales
            foreach ($inputData['verticalDefs'] as $def) {
                $posY= ord($def['posY']) - 96;
                //Definitions::addDefinition('VERTICAL',$posX , $def['posY'], , ,$idGrille);
                DefinitionManager2::addDefinition('VERTICAL',$def['posX'] ,$posY, $def['description'], $def['solution'],$idGrille);
            }
    
            // Insérer les définitions horizontales
            foreach ($inputData['horizontalDefs'] as $def) {
                $posY= ord($def['posY']) - 96;
                DefinitionManager2::addDefinition('HORIZONTAL',$def['posX'] ,$posY, $def['description'], $def['solution'],$idGrille);
            }
    
            echo json_encode(["success" => true,"message" => $resulat]);
    
      
    }catch(Exception $e){
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
    
    
} else {
   echo json_encode(["success" => false, "message" => "Données manquantes"]);
}

?>