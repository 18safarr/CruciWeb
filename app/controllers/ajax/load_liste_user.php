<?php
session_start();
require_once  (__DIR__ . '/../UserManager.php');

use controllers\UserManager;

if (isset($_POST['load-liste-user'])) {
    $type = $_POST['load-liste-user']; 

    if ($type=="admin") { 
        echo UserManager::createTableAllUsersHTML();
    }
}elseif(isset($_POST['register'])){
    echo UserManager::createRegisterUserHTML();
}
?>