<?php
session_start();
require_once(__DIR__ . '/../UserManager.php');
use controllers\UserManager;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    
    $email = $_POST["username"] ?? "";
    $pass = $_POST["password"] ?? "";

    $response = ["success" => false];


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
        if(!isset($_POST["role"])){

            if (UserManager::isUserParamCorrect($email, $pass,"player")) {
                $_SESSION["user_id"] = UserManager::getIdByEmail($email); // L'identifiant utilisateur peut être dynamique.
                $response["success"] = true;
            }
            
        }else{
            if (UserManager::isUserParamCorrect($email, $pass,"admin")) {
                $_SESSION["admin_id"] = UserManager::getIdByEmail($email);
                $response["success"] = true;
            }
            
        }
       
    }

    echo json_encode($response);
}
?>


