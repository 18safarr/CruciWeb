<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once (__DIR__ . '/../../controllers/GrilleManager.php');
require_once (__DIR__ . '/../../controllers/DefinitionManager.php');
use controllers\GrilleManager;
use controllers\DefinitionManager;



if (!isset($_SESSION['user_id']) && !isset($_SESSION["grille_id"])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non authentifié.",]);
    exit;
}

$inputData = json_decode(file_get_contents('php://input'), true);


if ($inputData) {
   try{
    $idGrille = $_SESSION["grille_id"];
    
    $resulat = GrilleManager::verifierGrille($inputData);
    $rc = GrilleManager::updateGrille(
        $idGrille,
        $inputData['nomGrille'], 
        $inputData['dimX'], 
        $inputData['dimY'],   
        $inputData['difficulte'],
        $inputData['publiee'],
        json_encode($resulat)
    );
    
    // // update les cases noires
    $rc=GrilleManager::deleteBlackCases($idGrille);
    foreach ($inputData['blackCells'] as $cell) {
        $data = GrilleManager::addCase($cell['x'], $cell['y'], $idGrille);
    }

    // // Insérer les définitions verticales
    foreach ($inputData['verticalDefs'] as $def) {
        $posY= ord($def['posY']) - 96;
        if($def['idDef']!="new")
            DefinitionManager::updateDefinition($def['idDef'],$def['posX'] ,$posY, $def['description'], $def['solution']);
        else
            DefinitionManager::addDefinition('VERTICAL',$def['posX'] ,$posY, $def['description'], $def['solution'],$idGrille);
    }

    // // Insérer les définitions horizontales
    foreach ($inputData['horizontalDefs'] as $def) {
        $posY= ord($def['posY']) - 96;
        if($def['idDef']!="new")
            DefinitionManager::updateDefinition($def['idDef'],$def['posX'] ,$posY, $def['description'], $def['solution']);
        else
            DefinitionManager::addDefinition('HORIZONTAL',$def['posX'] ,$posY, $def['description'], $def['solution'],$idGrille);
    }

    echo json_encode(["success" => true]);
    }catch(Exception $e){
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
} else {
   echo json_encode(["success" => false, "message" => "Données manquantes"]);
}