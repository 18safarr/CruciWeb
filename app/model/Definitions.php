<?php
 namespace model;
 require_once(__DIR__ . '/../config/App.php');
 use config\App;

 class Definitions{

    public static function getDefinitionDatas($idGrille,$orientation="VERTICAL") {
        $requete = "SELECT * FROM Definitions WHERE idGrille = ? and orientation = ?";
        $attributes = [$idGrille,$orientation];
        return App::getDb()->prepare($requete, $attributes, __CLASS__, true);
    }

    public static function addDefinition($orientation, $posX, $posY, $description, $solution,$idGrille) {
        $requete = "INSERT INTO Definitions (orientation, posDepX, posDepY, description,solution, idGrille) VALUES (?, ?, ?,?,?,?)";
        $attributes = [$orientation, $posX, $posY, $description, $solution,$idGrille];
        return App::getDb()->prepare($requete,$attributes,__CLASS__);
       
    }
    
 }
?>