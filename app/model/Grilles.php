<?php
 namespace model;
 require_once(__DIR__ . '/../config/App.php');
 use config\App;
 class Grilles{

    public static function addGrille($nomGrille, $dimX, $dimY, $idAuteur, $difficulte,$solution,$public) {
        if($public==1){
            $requete = "INSERT INTO Grilles (nomGrille, dimX, dimY, datePublication, idAuteur, difficulte, solution) VALUES (?, ?, ?, NOW(), ?, ?, ?)";

            $attributes = [$nomGrille, $dimX, $dimY, $idAuteur, $difficulte, $solution];
        }else{
            $requete = "INSERT INTO Grilles (nomGrille, dimX, dimY, idAuteur, difficulte, solution) VALUES (?, ?, ?, ?, ?, ?)";
            $attributes = [$nomGrille, $dimX, $dimY, $idAuteur, $difficulte,$solution];
        }
        
        
        return App::getDb()->prepare($requete,$attributes,__CLASS__);
        
    }

    public static function updateGrille($idGrille, $nomGrille, $dimX, $dimY, $difficulte, $public,$solution) {
        if ($public == 1) {
            $requete = "UPDATE Grilles SET nomGrille = ?, dimX = ?, dimY = ?, difficulte = ?, datePublication = NOW(),solution = ? WHERE idGrille = ?";
            $attributes = [$nomGrille, $dimX, $dimY, $difficulte, $solution, $idGrille];
        } else {
            $requete = "UPDATE Grilles SET nomGrille = ?, dimX = ?, dimY = ?, difficulte = ?, datePublication = NULL, solution = ?  WHERE idGrille = ?";
            $attributes = [$nomGrille, $dimX, $dimY, $difficulte, $solution, $idGrille];
        }
    
        return App::getDb()->prepare($requete, $attributes, __CLASS__);
    }
    

    public static function getLastId(){
        return App::getDb()->lastInsertId();
    }

    public static function getAllGridData() {
        $requete = "SELECT * FROM Grilles";
        return App::getDb()->query($requete, __CLASS__);
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

    public static function deleteGrille($idGrille){
        // Requête SQL pour récupérer toutes les grilles avec une date de publication non nulle
        $requete = "DELETE  FROM Grilles WHERE idGrille = ?";
        $attributes = [$idGrille];
    
        return App::getDb()->prepare($requete, $attributes, __CLASS__, true);
    }
 }
 
?>