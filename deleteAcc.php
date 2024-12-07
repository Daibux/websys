<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    // Update the specific column to an empty string
    $stmt = $pdo->prepare("DELETE FROM audittrail  WHERE userid = :user_id" );
    $stmt->bindParam(':user_id', $_SESSION['userid']);
    $stmt->execute();

    $stmt = $pdo->prepare("DELETE FROM usertable  WHERE userid = :user_id" );
    $stmt->bindParam(':user_id', $_SESSION['userid']);
    $stmt->execute();

    $stmt = $pdo->prepare("DELETE FROM qr_datas  WHERE user_id = :user_id" );
    $stmt->bindParam(':user_id', $_SESSION['userid']);
    $stmt->execute();

    $stmt = $pdo->prepare("DELETE FROM id_images  WHERE user_id = :user_id" );
    $stmt->bindParam(':user_id', $_SESSION['userid']);
    $stmt->execute();

 
    $_SESSION = array();
    session_destroy();
        echo 'Account Deleted';
    }

?>