<?php
namespace controllers;
require_once (__DIR__ . '/../model/Users.php');
use model\Users;
use PDO;
use PDOException;

class UsersManager{
    private static $idUser;

    public static function setIdUSer($idUser){
        self::$idUser=$idUser;
    }
    public static function getIdUser(){
        return self::$idUser;
    }

    public static function isUserExist($email){
    
        return Users::userExists($email);
    }

    public static function getIdByEmail($email){
        return Users::getId($email);
    }

    public static function isUserParamCorrect($email,$password){
        return Users::authenticateUser($email, $password);
    }

    public static function createUser($email,$password){
        try{
            Users::insertUser($email,$password);
        }catch(PDOException $e){
            return false;
        }
        return true;
    }
}

?>