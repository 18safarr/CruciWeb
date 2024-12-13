<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../app/GrilleManager.php';
require_once '../app/table/Grilles.php';
require_once '../app/table/Definitions.php';
require_once '../app/table/Cases.php';
require_once '../app/DefinitionManager.php';
use app\GrilleManager;
use app\DefinitionManager;
use app\table\Grilles;
use app\table\Definitions;
use app\table\Cases;


if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non authentifié."]);
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
        $inputData['difficulte']
    );

    // Insérer les cases noires
    foreach ($inputData['blackCells'] as $cell) {
        $data = Cases::addCase($idGrille, $cell['x'], $cell['y'], true);
    }

    // // Insérer les définitions verticales
    // foreach ($inputData['verticalDefs'] as $def) {
    //     Definitions::addDefinition($idGrille, 'VERTICAL', $def['posX'], $def['posY'], $def['description'], $def['solution']);
    // }

    // // Insérer les définitions horizontales
    // foreach ($inputData['horizontalDefs'] as $def) {
    //     Definitions::addDefinition($idGrille, 'HORIZONTAL', $def['posX'], $def['posY'], $def['description'], $def['solution']);
    // }

    echo json_encode(["success" => true]);
} else {
   echo json_encode(["success" => false, "message" => "Données manquantes"]);
}
