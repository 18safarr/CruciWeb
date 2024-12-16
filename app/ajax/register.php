<?php
require_once(__DIR__ . '/../table/Users.php');
require_once(__DIR__ . '/../App.php');
use app\table\Users;

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$response = ['success' => false];

if (Users::insertUser($username, $email, $password)) {
    $response['success'] = true;
} else {
    $response['message'] = 'Erreur lors de l\'inscription';
}

echo json_encode($response);
?>
