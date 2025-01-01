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

require_once '../app/controllers/GrilleManager.php';
require_once '../app/controllers/UserManager.php';
require_once '../app/model/Grilles.php';
require_once '../app/model/Parties.php';
require_once '../app/model/Definitions.php';
require_once '../app/model/Cases.php';
require_once '../app/controllers/DefinitionManager.php';
use app\GrilleManager;
use controllers\GrilleManager;
use controllers\UserManager;
use controllers\DefinitionManager;
use model\Grilles;
use model\Parties;
use model\Definitions;
use model\Cases;
use model\Users;

// var_dump(Parties::savePartie(
//     "{\"5_7\":\"d\",\"8_2\":\"d\"}",
//     "Terminée",
//     1,
//     2
// ));
$data = Parties::getPartie(2);
var_dump(GrilleManager::addGrille("toi", 5, 5, 2, 'Débutant',"Débutant",1));
// echo GrilleManager::createTablePartieHTML(2);
// foreach ($data as $partie) {
//     $contenu = json_decode($partie->contenu, true);

//     foreach ($contenu as $key => $value) {
//         // Séparer x et y en utilisant '_'
//         list($x, $y) = explode('_', $key);
    
//         // Afficher x, y et la valeur correspondante
//         echo "x: $x, y: $y, valeur: $value\n";
//     }
   

// }

