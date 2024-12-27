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

    public static function getBlackCases($idGrille) {
        $requete = "SELECT * FROM Cases WHERE idGrille = ? AND isBlack = 'YES'";
        $attributes = [$idGrille];
        return App::getDb()->prepare($requete, $attributes, __CLASS__, true);
    }
}

?>