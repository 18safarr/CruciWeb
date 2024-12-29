<?php
session_start();
require_once  (__DIR__ . '/../UsersManager.php');

use controllers\UsersManager;

if (isset($_POST['load-liste-user'])) {
    $type = $_POST['load-liste-user']; 

    if ($type=="admin") { 
        echo UsersManager::createTableAllUsersHTML();
    }
}elseif(isset($_POST['register'])){
    echo UsersManager::createRegisterUserHTML();
}
?>