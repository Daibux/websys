<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_POST['password'] == $_POST['confirm-password'])
    {
        $email = $_POST['email'];
        $username = $_POST['username'];

        // Query to check if the user exists
        $stmt = $pdo->prepare("SELECT * FROM usertable WHERE userid = ?");
        $stmt->execute([$_SESSION['userid']]);
        $user = $stmt->fetch();

        $stmt = $pdo->prepare("UPDATE usertable SET email = :email, username = ;username WHERE userid = :userid");
        $stmt->execute(array(':email' => $email, ':username' => $username, ':userid' => $_SESSION['userid']));

        // If user exists and password is correct
        /*if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            echo 'success';
        } else if ($user) {
            echo 'incorrect_password'; // Incorrect password
        } else {
            echo 'not_found'; // User not found
        }
        */

        // Log the "Updated profile settings" activity in AuditTrail
        try {
            $activity = "Updated profile settings";
            $stmt = $pdo->prepare("INSERT INTO AuditTrail (UserID, Activity) VALUES (:userId, :activity)");
            $stmt->bindParam(':userId', $_SESSION['userid'], PDO::PARAM_INT);
            $stmt->bindParam(':activity', $activity, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            // Optionally log or handle the error if audit logging fails
            error_log("Failed to log profile update activity: " . $e->getMessage());
        }
        
        echo "User updated successfully";

        exit();
    }
    
}
