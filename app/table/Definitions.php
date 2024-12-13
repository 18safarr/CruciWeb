<?php
 namespace app\table;
 require_once '../app/App.php';
 use app\App;

 class Definitions{
    public static function addDefinition($idGrille, $orientation, $posX, $posY, $description, $solution) {
        $requete = "INSERT INTO Definitions (orientation, solution, caseDepart, idGrille) VALUES (?, ?, ?, ?)";
        $attributes = [$idGrille, $orientation, $posX, $posY, $description, $solution];
        return App::getDb()->prepare($requete,$attributes,__CLASS__);
       
    }
    
 }
?>