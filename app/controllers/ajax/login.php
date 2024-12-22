<?php
session_start();
require_once(__DIR__ . '/../UsersManager.php');
use controllers\UsersManager;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $email = $_POST["username"] ?? "";
    $pass = $_POST["password"] ?? "";

    $response = ["success" => false];


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
    

        if (UsersManager::isUserParamCorrect($email, $pass)) {
            $_SESSION["user_id"] = UsersManager::getIdByEmail($email); // L'identifiant utilisateur peut être dynamique.
            $response["success"] = true;
        }
    }

    echo json_encode($response);
}
?>


