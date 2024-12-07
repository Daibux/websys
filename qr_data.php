<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
session_start();
        require_once "database.php";
        $stmt = $pdo->prepare("SELECT * FROM qr_datas WHERE user_id =  :user_id");
        $stmt->execute([':user_id' => $_SESSION['userid']]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rows);
   ?>