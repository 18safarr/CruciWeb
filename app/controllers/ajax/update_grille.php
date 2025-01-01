<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once (__DIR__ . '/../../controllers/GrilleManager2.php');
require_once (__DIR__ . '/../../controllers/DefinitionManager2.php');
use controllers\GrilleManager2;
use controllers\DefinitionManager2;



if (!isset($_SESSION['user_id']) && !isset($_SESSION["grille_id"])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non authentifié.",]);
    exit;
}

$inputData = json_decode(file_get_contents('php://input'), true);


if ($inputData) {
   try{
    $idGrille = $_SESSION["grille_id"];
    
    $resulat = GrilleManager2::verifierGrille($inputData);

    $rc = GrilleManager2::updateGrille(
        $idGrille,
        $inputData['nomGrille'], 
        $inputData['dimX'], 
        $inputData['dimY'],   
        $inputData['difficulte'],
        $inputData['publiee']
    );
    
    // // update les cases noires
    $rc=GrilleManager2::deleteBlackCases($idGrille);
    foreach ($inputData['blackCells'] as $cell) {
        $data = GrilleManager2::addCase($cell['x'], $cell['y'], $idGrille);
    }

    // // Insérer les définitions verticales
    foreach ($inputData['verticalDefs'] as $def) {
        $posY= ord($def['posY']) - 96;
        if($def['idDef']!="new")
            DefinitionManager2::updateDefinition($def['idDef'],$def['posX'] ,$posY, $def['description'], $def['solution']);
        else
            DefinitionManager2::addDefinition('VERTICAL',$def['posX'] ,$posY, $def['description'], $def['solution'],$idGrille);
    }

    // // Insérer les définitions horizontales
    foreach ($inputData['horizontalDefs'] as $def) {
        $posY= ord($def['posY']) - 96;
        if($def['idDef']!="new")
            DefinitionManager2::updateDefinition($def['idDef'],$def['posX'] ,$posY, $def['description'], $def['solution']);
        else
            DefinitionManager2::addDefinition('HORIZONTAL',$def['posX'] ,$posY, $def['description'], $def['solution'],$idGrille);
    }

    echo json_encode(["success" => true]);
    }catch(Exception $e){
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
} else {
   echo json_encode(["success" => false, "message" => "Données manquantes"]);
}