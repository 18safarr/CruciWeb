<?php
 namespace app\table;
 require_once '../app/App.php';
 use app\App;

 class Definitions{
    public static function addDefinition($orientation, $posX, $posY, $description, $solution,$idGrille) {
        $requete = "INSERT INTO Definitions (orientation, posDepX, posDepY, description,solution, idGrille) VALUES (?, ?, ?,?,?,?)";
        $attributes = [$orientation, $posX, $posY, $description, $solution,$idGrille];
        return App::getDb()->prepare($requete,$attributes,__CLASS__);
       
    }
    
 }
?>