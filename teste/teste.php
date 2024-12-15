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

require_once '../app/GrilleManager.php';
require_once '../app/GrilleManager2.php';
require_once '../app/table/Grilles.php';
require_once '../app/table/Definitions.php';
require_once '../app/table/Cases.php';
require_once '../app/DefinitionManager.php';
use app\GrilleManager;
use app\GrilleManager2;
use app\DefinitionManager;
use app\table\Grilles;
use app\table\Definitions;
use app\table\Cases;

//$users = Users::insertUser("koundibr","root");// Appel de la méthode statique

// $user = Users::authenticateUser("koundibr", "root");
// var_dump($user);

// $user = Users::getId("koundibr");
// var_dump($user);
 //Insérer la grille dans la table Grilles
//  $idGrille = Grilles::addGrille(
//     'nomGrille', 
//     null, 
//     2, 
//     2, 
//     'Expert'
// );

// $posX= ord('a') - 96;
// Definitions::addDefinition('VERTICAL',$posX , 2, "bonjour", "reveill",2);

// $data = Cases::getCasesByIdGrille(67);
// var_dump($data);

// $data = Grilles::getGrilleById(67);
// var_dump($data);

GrilleManager2::initParamsGridFor(69);

var_dump( GrilleManager2::getBlackCells());

// var_dump(GrilleManager2::getDimension())



?>