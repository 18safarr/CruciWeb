<?php
 namespace app\table;
 require_once (__DIR__ . '/../App.php');
 use app\App;
class Cases{

    public static function addCase($posX, $posY,$idGrille) {
        $requete = "INSERT INTO Cases (positionX, positionY, idGrille) VALUES (?, ?, ?)";
        $attributes = [$posX, $posY,$idGrille];
        return App::getDb()->prepare($requete,$attributes,__CLASS__);
        
    }

    public static function getCasesByIdGrille($idGrille) {
        $requete = "SELECT * FROM Cases WHERE idGrille = ?";
        $attributes = [$idGrille];
        return App::getDb()->prepare($requete, $attributes, __CLASS__, true);
    }
}

?>