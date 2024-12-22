<?php
namespace config;
require_once(__DIR__ . '/Database.php');
use config\DataBase;
class App{
    const DB_NAME = "CRUCIWEB";
    const DB_USER = "cruciweb";
    const DB_PWD = "root";
    const DB_HOST = "localhost";

    public static $database;
    

    public static function getDb() {
        if (self::$database === null) {
            try {
                self::$database = new Database(self::DB_NAME, self::DB_USER, self::DB_PWD, self::DB_HOST);
            } catch (\Exception $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        return self::$database;
    }
}

?>