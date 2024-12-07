<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Query to check if the user exists
    $stmt = $pdo->prepare("SELECT * FROM usertable WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // If user exists and password is correct
    if ($user) {
        echo 'success';
    }  else {
        echo 'not_found'; // User not found
    }
    exit();
}