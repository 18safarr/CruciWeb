<?php
session_start();
require_once '../app/table/Users.php';
use app\table\Users;



$id = $_POST["username"] ?? "";
$pass = $_POST["password"] ?? "";

$response = ["success" => false];


if ($_SERVER["REQUEST_METHOD"] === "POST") {
   

    if (Users::authenticateUser($id, $pass)) {
        $_SESSION["user_id"] = $id; // L'identifiant utilisateur peut être dynamique.
        $response["success"] = true;
    }
}

echo json_encode($response);
?>


