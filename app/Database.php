<?php
namespace app;
use PDO;

class DataBase
{
    private $db_name;
    private $db_user;
    private $db_pwd;
    private $db_host;
    private $pdo;

    public function __construct($db_name="CRUCIWEB", $db_user="cruciweb", $db_pwd="root", $db_host="localhost")
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pwd = $db_pwd;
        $this->db_host = $db_host;
    }

    private function getPDO()
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host, $this->db_user, $this->db_pwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->pdo;
    }

    public function query($statement, $class_name)
    {
        // Exécuter la requête et récupérer les résultats
        $req = $this->getPDO()->query($statement);
        $datas = $req->fetchAll(PDO::FETCH_CLASS, $class_name); // Mapper les résultats à la classe
        return $datas;
    }
    public function lastInsertId()
    {
        return $this->getPDO()->lastInsertId();
    }
    public function prepare($statement, $attributes, $class_name)
    {
        // Préparer et exécuter la requête avec les attributs donnés
        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);
        
        // Retourner le résultat en fonction de l'option 'single'
        $datas = $req->fetchAll(PDO::FETCH_CLASS, $class_name);
        
        return $datas;
    }
}

  
?>