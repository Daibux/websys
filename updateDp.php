<?php
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        session_start();
        require_once "database.php";
        if($_SERVER['REQUEST_METHOD'] == 'POST') { // Trigger automatically or via form submission

            if (!isset($_FILES['file']) || $_FILES['file']['error'] != UPLOAD_ERR_OK) {
                echo 'File upload failed. Please try again.';
                exit;
            }
        
            $dp = $_FILES['file']['tmp_name'];
        
            // Check if the file path is not empty  
            if (empty($dp)) {
                echo 'Uploaded file path is empty.';
                exit;
            }
    
            $dpData = file_get_contents($dp);

            // Insert into PostgreSQL
            $stmt = $pdo->prepare("UPDATE usertable SET user_dp = :user_dp WHERE userid = :userid");
            $stmt->bindParam( ':user_dp', $dpData, PDO::PARAM_LOB);
            $stmt->bindParam(':userid', $_SESSION['userid']); 
            $stmt->execute();

            // Audit trail: Log the upload activity
            $activity = "Uploaded Profile Picture";
            $sql = "INSERT INTO AuditTrail (userid, activity) 
                    VALUES (:userid, :activity)";  
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userid', $_SESSION['userid']); 
            $stmt->bindParam(':activity', $activity);
            $stmt->execute();

            $stmt = $pdo->prepare("SELECT * FROM usertable WHERE userid = ?");
            $stmt->execute([$_SESSION['userid']]);
            $user = $stmt->fetch();
            $_SESSION['user_dp'] = base64_encode(stream_get_contents($user['user_dp']));
            echo 'Changed Image Succesfully';
    }
    ?>
