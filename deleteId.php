<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();
require_once "database.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_type = $data['id_type'];
    $id_number = $data['id_number'];
    $user_id = $_SESSION['userid'];
    

$stmt = $pdo->prepare('DELETE FROM qr_datas WHERE id_type = :id_type and user_id = :user_id');
$stmt->bindParam(':id_type', $id_type);
$stmt->bindParam(':user_id', $_SESSION['userid']);
$stmt->execute();

$stmt = $pdo->prepare('DELETE FROM id_images WHERE id_type = :id_type and user_id = :user_id');
$stmt->bindParam(':id_type', $id_type);
$stmt->bindParam(':user_id', $_SESSION['userid']);
$stmt->execute();
// Check if the row was successfully deleted
if ($stmt->rowCount() > 0) {
    echo 'record_deleted';
} else {
    echo 'no_record_found';
}

//audit trail for id deletion
$activity = "Deleted ID - ID Number: " . $id_number . " Type: " . $id_type;
$sql = "INSERT INTO AuditTrail (userid, activity) 
        VALUES (:userid, :activity)";  
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':userid', $_SESSION['userid']); 
$stmt->bindParam(':activity', $activity);
$stmt->execute();

exit;
}