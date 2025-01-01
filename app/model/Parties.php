<?php
namespace model;
// require_once '../app/App.php';
require_once (__DIR__ . '/../config/App.php');
use config\App;
class Parties{
    public static function savePartie($contenu,$statut,$idGrille,$idAuteur){
        $requete = "INSERT INTO Parties (contenu,dateEnregistrement,statut,idGrille,idAuteur) VALUES (?, NOW(), ?, ?, ?)";
        $attributes = [$contenu,$statut,$idGrille,$idAuteur];
        return App::getDb()->prepare($requete,$attributes,__CLASS__);
    }

    public static function getPartie($idPartie){
        $requete = "SELECT * FROM Parties WHERE idPartie = ?";

        return App::getDb()->prepare($requete,[$idPartie],__CLASS__);
    }

    public static function getPartiesFor($idAuteur) {
        $requete = "SELECT * FROM Parties WHERE idAuteur = ?";
        $attributes = [$idAuteur];
        return App::getDb()->prepare($requete, $attributes, __CLASS__, true);
    }

    public static function deletePartie($idPartie){
        // Requête SQL pour récupérer toutes les Parties avec une date de publication non nulle
        $requete = "DELETE  FROM Parties WHERE idPartie = ?";
        $attributes = [$idPartie];
    
        return App::getDb()->prepare($requete, $attributes, __CLASS__, true);
    }
}

?>