<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once (__DIR__ . '/../../controllers/GrilleManager2.php');
require_once (__DIR__ . '/../../model/Grilles.php');
require_once (__DIR__ . '/../../model/Definitions.php');
require_once (__DIR__ . '/../../model/Cases.php');
use controllers\GrilleManager2;
use controllers\DefinitionManager;
use model\Grilles;
use model\Definitions;
use model\Cases;



if (!isset($_SESSION['user_id']) && !isset($_SESSION["grille_id"])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non authentifié.",]);
    exit;
}

$inputData = json_decode(file_get_contents('php://input'), true);

if ($inputData) {
   
    $idGrille = $_SESSION["grille_id"];
    // Update grille

    $rc = Grilles::updateGrille(
        $idGrille,
        $inputData['nomGrille'], 
        $inputData['dimX'], 
        $inputData['dimY'],   
        $inputData['difficulte'],
        $inputData['publiee']
    );
    
    // // update les cases noires
    $rc=Cases::deleteBlackCases($idGrille);
    foreach ($inputData['blackCells'] as $cell) {
        $data = Cases::addCase($cell['x'], $cell['y'], $idGrille);
    }

    // // Insérer les définitions verticales
    foreach ($inputData['verticalDefs'] as $def) {
        $posY= ord($def['posY']) - 96;
        Definitions::updateDefinition($def['id'],$def['posX'] ,$posY, $def['description'], $def['solution']);
    }

    // // Insérer les définitions horizontales
    foreach ($inputData['horizontalDefs'] as $def) {
        $posY= ord($def['posY']) - 96;
        Definitions::updateDefinition($def['id'],$def['posX'] ,$posY, $def['description'], $def['solution']);
    }

    echo json_encode(["success" => true]);
} else {
   echo json_encode(["success" => false, "message" => "Données manquantes"]);
}