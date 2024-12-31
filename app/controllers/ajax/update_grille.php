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

function verifierGrille($inputData) {
    $grille = [];
    $casesNoires = $inputData['blackCells'];
    $definitionsVert = $inputData['verticalDefs'];
    $definitionsHori = $inputData['horizontalDefs'];

    // Marquer les cases noires
    foreach ($casesNoires as $case) {
        $grille["{$case['x']},{$case['y']}"] = 'NOIRE';
    }

    // // Vérifier les définitions
    foreach ($definitionsVert as $def) {
        $x = $def['posX'];
        $y = ord($def['posY']) - 96; // Convertir 'a', 'b', etc. en numéros
        $solution = $def['solution'];
        $orientation = "VERTICAL";

        for ($i = 0; $i < strlen($solution); $i++) {
            $case = "$x,$y";

            // Vérifier si la case est une case noire
            if (isset($grille[$case]) && $grille[$case] === 'NOIRE') {
                
                throw new Exception("Erreur : La définition traverse une case noire en $case.");
            }

            // Vérifier les intersections
            if (isset($grille[$case]) && $grille[$case] !== $solution[$i]) {
                //return "Erreur : Conflit de lettres en $case (\"{$grille[$case]}\" vs \"{$solution[$i]}\").";
                throw new Exception("Erreur : Conflit de lettres en $case (\"{$grille[$case]}\" vs \"{$solution[$i]}\").");
                
            }

            // Marquer la case avec la lettre
            $grille[$case] = $solution[$i];

            // Passer à la case suivante
            if ($orientation === 'HORIZONTAL') {
                $y++;
            } else if ($orientation === 'VERTICAL') {
                $x++;
            }
        }
    }
    foreach ($definitionsHori as $def) {
        $x = $def['posX'];
        $y = ord($def['posY']) - 96; // Convertir 'a', 'b', etc. en numéros
        $solution = $def['solution'];
        $orientation = "HORIZONTAL";

        for ($i = 0; $i < strlen($solution); $i++) {
            $case = "$x,$y";

            // Vérifier si la case est une case noire
            if (isset($grille[$case]) && $grille[$case] === 'NOIRE') {
                throw new Exception("Erreur : La définition traverse une case noire en $case.");
            }

            // Vérifier les intersections
            if (isset($grille[$case]) && $grille[$case] !== $solution[$i]) {
                // return "Erreur : Conflit de lettres en $case (\"{$grille[$case]}\" vs \"{$solution[$i]}\").";
                throw new Exception("Erreur : Conflit de lettres en $case (\"{$grille[$case]}\" vs \"{$solution[$i]}\").");
            }

            // Marquer la case avec la lettre
            $grille[$case] = $solution[$i];

            // Passer à la case suivante
            if ($orientation === 'HORIZONTAL') {
                $y++;
            } else if ($orientation === 'VERTICAL') {
                $x++;
            }
        }
    }

    return "good"; // La grille est valide
}

if ($inputData) {
   try{
    $idGrille = $_SESSION["grille_id"];
    
    $resulat = verifierGrille($inputData);

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