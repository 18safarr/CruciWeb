<?php
// require_once '../app/Autoloader.php';
// // Enregistrer l'autoloader
// app\Autoloader::register();

//var_dump(app\App::getDb()->teste('Users'));

// var_dump(new app\table\Users());

// var_dump(app\table\Users::getAllUsers());

require_once '../app/App.php';
require_once '../app/Database.php';
require_once '../app/table/Users.php';
use app\table\Users;

//$users = Users::insertUser("koundibr","root");// Appel de la méthode statique

$user = Users::authenticateUser("koundibr", "root");
var_dump($user);


?>