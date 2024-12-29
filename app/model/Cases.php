<?php
 namespace model;
 require_once (__DIR__ . '/../config/App.php');
 use config\App;
class Cases{

    public static function addCase($posX, $posY,$idGrille) {
        $requete = "INSERT INTO Cases (positionX, positionY, idGrille) VALUES (?, ?, ?)";
        $attributes = [$posX, $posY,$idGrille];
        return App::getDb()->prepare($requete,$attributes,__CLASS__);
        
    }

 

    public static function updateCase($posX, $posY, $idGrille) {
        // Requête de mise à jour
        $requete = "UPDATE Cases SET positionX = ?, positionY = ? WHERE idGrille = ?";
        
        // Les attributs à lier aux placeholders
        $attributes = [$posX, $posY, $idGrille];
        
        // Exécution de la requête préparée
        return App::getDb()->prepare($requete, $attributes, __CLASS__);
    }    

    public static function getBlackCases($idGrille) {
        $requete = "SELECT * FROM Cases WHERE idGrille = ? AND isBlack = 'YES'";
        $attributes = [$idGrille];
        return App::getDb()->prepare($requete, $attributes, __CLASS__, true);
    }

    public static function deleteBlackCases($idGrille) {
        $requete = "DELETE FROM Cases WHERE idGrille = ? AND isBlack = 'YES'";
        $attributes = [$idGrille];
        return App::getDb()->prepare($requete, $attributes, __CLASS__);
    }
}

?>