<?php
 namespace app\table;
 require_once(__DIR__ . '/../App.php');
 use app\App;
 class Grilles{

    public static function addGrille($nomGrille, $dimX, $dimY, $idAuteur, $difficulte,$public) {
        if($public==1){
            $requete = "INSERT INTO Grilles (nomGrille, dimX, dimY, datePublication, idAuteur, difficulte) VALUES (?, ?, ?, NOW(), ?, ?)";
            $attributes = [$nomGrille, $dimX, $dimY, $idAuteur, $difficulte];
        }else{
            $requete = "INSERT INTO Grilles (nomGrille, dimX, dimY, idAuteur, difficulte) VALUES (?, ?, ?, ?, ?)";
            $attributes = [$nomGrille, $dimX, $dimY, $idAuteur, $difficulte];
        }
        
        
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

    public static function getPublicGrids() {
        // Requête SQL pour récupérer toutes les grilles avec une date de publication non nulle
        $requete = "SELECT * FROM Grilles WHERE datePublication IS NOT NULL";
        return App::getDb()->query($requete,__CLASS__);
    }

    public static function getPrivateGridsFor($idAuteur) {
        $requete = "SELECT * FROM Grilles WHERE idAuteur = ?";
        $attributes = [$idAuteur];
        return App::getDb()->prepare($requete, $attributes, __CLASS__, true);
    }
 }
 
?>