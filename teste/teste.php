<?php
// require_once '../app/Autoloader.php';
// // Enregistrer l'autoloader
// app\Autoloader::register();

//var_dump(app\App::getDb()->teste('Users'));

// var_dump(new app\table\Users());

// var_dump(app\table\Users::getAllUsers());

require_once '../app/config/App.php';
require_once '../app/config/Database.php';
require_once '../app/model/Users.php';

require_once '../app/controllers/GrilleManager2.php';
require_once '../app/controllers/UsersManager.php';
require_once '../app/model/Grilles.php';
require_once '../app/model/Definitions.php';
require_once '../app/model/Cases.php';
require_once '../app/controllers/DefinitionManager.php';
use app\GrilleManager;
use app\GrilleManager2;
use app\UsersManager;
use app\DefinitionManager;
use app\model\Grilles;
use app\model\Definitions;
use app\model\Cases;
use model\Users;



// var_dump(Definitions::getDefinitionDatas(53));

// UsersManager::setIdUSer(2);

// echo GrilleManager2::createTablePrivateGridHTML(2);

// $data = Grilles::getPublicGrids();
// var_dump($data);
// GrilleManager2::setDimension(5,5);
// echo GrilleManager2::createGridHTML(withInput:false);
// echo GrilleManager2::createTablePublicGridHTML();
//$users = Users::insertUser("root","root");// Appel de la méthode statique

//$user = Users::authenticateUser("koundibr", "root");
var_dump($user);

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

// // $data = Grilles::getGrilleById(67);
// // var_dump($data);

// GrilleManager2::initParamsGridFor(69);

// var_dump( GrilleManager2::getBlackCells());

// // var_dump(GrilleManager2::getDimension())



// 
?>
