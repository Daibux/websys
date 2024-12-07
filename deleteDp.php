<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Update the specific column to an empty string
    $stmt = $pdo->prepare("UPDATE usertable SET user_dp = NULL WHERE userid = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['userid']);
    $stmt->execute();

    // Check if the row was successfully updated
    if ($stmt->rowCount() > 0) {
        echo 'Photo removed';
    } else {
        echo 'no_record_found_or_no_change';
    }

    // Audit trail for column update
    $activity = "User Profile Removed";
    $sql = "INSERT INTO AuditTrail (userid, activity) 
            VALUES (:userid, :activity)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userid', $_SESSION['userid']); 
    $stmt->bindParam(':activity', $activity);
    $stmt->execute();

    $_SESSION['user_dp'] = NULL;
    exit;
}
?>
