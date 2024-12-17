<?php
namespace app;
require_once (__DIR__ . '/table/Users.php');
use app\table\Users;
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