<?php

require_once  '../app/Autoloader.php';
// Enregistrer l'autoloader
app\Autoloader::register();

if (isset($_GET['p'])){
    $p = $_GET['p'];
}else{
    $p="home_user";
}

if($p==="home_user"){
    require '../pages/accueil_user.php';
}
?>