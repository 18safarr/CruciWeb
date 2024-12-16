<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once (__DIR__ . '/../GrilleManager.php');
require_once (__DIR__ . '/../table/Grilles.php');
require_once (__DIR__ . '/../table/Definitions.php');
require_once (__DIR__ . '/../table/Cases.php');
require_once (__DIR__ . '/../DefinitionManager.php');
use app\GrilleManager;
use app\DefinitionManager;
use app\table\Grilles;
use app\table\Definitions;
use app\table\Cases;


if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non authentifié.",]);
    exit;
}

$inputData = json_decode(file_get_contents('php://input'), true);

if ($inputData) {
   

    // Insérer la grille dans la table Grilles

    $idGrille = Grilles::addGrille(
        $inputData['nomGrille'], 
        $inputData['dimX'], 
        $inputData['dimY'], 
        $_SESSION['user_id'],   
        $inputData['difficulte'],
        $inputData['publiee']
    );
    $idGrille = Grilles::getLastId();
    // Insérer les cases noires
    foreach ($inputData['blackCells'] as $cell) {
        $data = Cases::addCase($cell['x'], $cell['y'], $idGrille);
    }

    // // Insérer les définitions verticales
    foreach ($inputData['verticalDefs'] as $def) {
        $posY= ord($def['posY']) - 96;
        //Definitions::addDefinition('VERTICAL',$posX , $def['posY'], , ,$idGrille);
        Definitions::addDefinition('VERTICAL',$def['posX'] ,$posY, $def['description'], $def['solution'],$idGrille);
    }

    // Insérer les définitions horizontales
    foreach ($inputData['horizontalDefs'] as $def) {
        $posY= ord($def['posY']) - 96;
        Definitions::addDefinition('HORIZONTAL',$def['posX'] ,$posY, $def['description'], $def['solution'],$idGrille);
    }

    echo json_encode(["success" => true]);
} else {
   echo json_encode(["success" => false, "message" => "Données manquantes"]);
}