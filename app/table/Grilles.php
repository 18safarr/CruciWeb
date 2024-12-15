<?php
 namespace app\table;
 
 require_once '../app/App.php';
 use app\App;
 class Grilles{

    public static function addGrille($nomGrille, $dimX, $dimY, $idAuteur, $difficulte) {
        $requete = "INSERT INTO Grilles (nomGrille, dimX, dimY, datePublication, idAuteur, difficulte) VALUES (?, ?, ?, NOW(), ?, ?)";
        $attributes = [$nomGrille, $dimX, $dimY, $idAuteur, $difficulte];
        
        
        return App::getDb()->prepare($requete,$attributes,__CLASS__);
        
    }

    public static function getLastId(){
        return App::getDb()->lastInsertId();
    }

    public static function getGrilleById($idGrille) {
        $requete = "SELECT * FROM Grilles WHERE idGrille = ?";
        $attributes = [$idGrille];
        return App::getDb()->prepare($requete, $attributes, __CLASS__, true);
    }
 }
 
?>