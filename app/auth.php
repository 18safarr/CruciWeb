<?php
session_start();
require_once '../app/Autoloader.php';
app\Autoloader::register();

// Simuler un utilisateur pour l'exemple.
$validEmail = "root";
$validPassword = "root";

$response = ["success" => false];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    

    if ($email === $validEmail && $password === $validPassword) {
        $_SESSION["user_id"] = 1; // L'identifiant utilisateur peut être dynamique.
        $response["success"] = true;
    }
}

echo json_encode($response);
?>
