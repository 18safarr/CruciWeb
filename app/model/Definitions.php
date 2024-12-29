<?php
 namespace model;
 require_once(__DIR__ . '/../config/App.php');
 use config\App;

 class Definitions{

    public static function getDefinitionDatas($idGrille,$orientation="VERTICAL") {
        $requete = "SELECT * FROM Definitions WHERE idGrille = ?";
        $attributes = [$idGrille];
        return App::getDb()->prepare($requete, $attributes, __CLASS__, true);
    }

    public static function addDefinition($orientation, $posX, $posY, $description, $solution,$idGrille) {
        $requete = "INSERT INTO Definitions (orientation, posDepX, posDepY, description,solution, idGrille) VALUES (?, ?, ?,?,?,?)";
        $attributes = [$orientation, $posX, $posY, $description, $solution,$idGrille];
        return App::getDb()->prepare($requete,$attributes,__CLASS__);
       
    }

    public static function updateDefinition($idDefinition, $posX, $posY, $description, $solution) {
        // Requête de mise à jour
        $requete = "UPDATE Definitions SET posDepX = ?, posDepY = ?, description = ?, solution = ? WHERE idDefinition = ?";
        
        // Les attributs à lier aux placeholders
        $attributes = [$posX, $posY, $description, $solution, $idDefinition];
        
        // Exécution de la requête préparée
        return App::getDb()->prepare($requete, $attributes, __CLASS__);
    }
    
    
 }
?>