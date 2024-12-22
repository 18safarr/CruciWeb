<?php
namespace controllers;
require_once (__DIR__ . '/../model/Users.php');
use model\Users;
class UsersManager{
    private static $idUser;

    public static function setIdUSer($idUser){
        self::$idUser=$idUser;
    }
    public static function getIdUser(){
        return self::$idUser;
    }
}

?>