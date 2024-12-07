<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $stmt = $pdo->prepare("SELECT * FROM usertable WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // If user exists and password is correct
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['userid'] = $user['userid'];
        $_SESSION['user_dp'] = $user['user_dp'];
        $_SESSION['fname'] = $user['fname'];
        $_SESSION['lname'] = $user['lname'];
        $_SESSION['phone'] = $user['phone'];
        // Log the "User logged in" activity in AuditTrail 
            $activity = "User logged in";
         
            $stmt = $pdo->prepare("INSERT INTO AuditTrail (userid, Activity) VALUES (:userid, :activity)");
        $stmt->bindParam(':userid', $user['userid'], PDO::PARAM_INT);
            $stmt->bindParam(':activity', $activity, PDO::PARAM_STR);
            $stmt->execute();

        echo 'success';
    } else if ($user) {
        echo 'incorrect_password'; // Incorrect password
    } else {
        echo 'not_found'; // User not found
    }
    exit();
}