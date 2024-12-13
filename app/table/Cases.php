<?php
 namespace app\table;
 require_once '../app/App.php';
 use app\App;
class Cases{

    public static function addCase($idGrille, $posX, $posY, $isBlack) {
        $requete = "INSERT INTO Cases (positionX, positionY, isBlack, idGrille) VALUES (?, ?, ?, ?)";
        $attributes = [$idGrille, $posX, $posY, $isBlack];
        return App::getDb()->prepare($requete,$attributes,__CLASS__);
        
    }
}

?>