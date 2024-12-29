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
require_once '../app/controllers/DefinitionManager2.php';
use app\GrilleManager;
use controllers\GrilleManager2;
use controllers\UsersManager;
use controllers\DefinitionManager2;
use model\Grilles;
use model\Definitions;
use model\Cases;
use model\Users;

//  var_dump(Grilles::deleteGrille(3));
// // var_dump(Cases::getBlackCases(1));
// // var_dump(Definitions::getDefinitionDatas(9));
// echo DefinitionManager2::getDefinitionsHTML(1,"HORIZONTAL");

// UsersManager::setIdUSer(2);

// var_dump( GrilleManager2::getAllData(5));

//GrilleManager2::initParamsGridFor(1);
$dm = new DefinitionManager2(1,10,10);

var_dump(DefinitionManager2::$dataDefinitions);

//var_dump(GrilleManager2::$defHoriData);

// $data = Grilles::getPublicGrids();
// var_dump($data);
// GrilleManager2::setDimension(5,5);
// echo GrilleManager2::createGridHTML(withInput:false);
// echo GrilleManager2::createTablePublicGridHTML();
// $users = UsersManager::createUser("root2e","root");// Appel de la méthode statique
// if ($users){
//     var_dump($users);
// }


//$user = Users::authenticateUser("koundibr", "root");
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

// // $data = Grilles::getGrilleById(67);
// // var_dump($data);

// GrilleManager2::initParamsGridFor(69);

// var_dump( GrilleManager2::getBlackCells());

// // var_dump(GrilleManager2::getDimension())



// 
?>
