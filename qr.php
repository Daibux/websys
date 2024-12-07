<?php
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type");
        session_start();
        $qr_Code = 'longkis';
        require_once "database.php";
        if($_SERVER['REQUEST_METHOD'] == 'POST') { // Trigger automatically or via form submission
            $id_number = $_POST['idNumber'];
            $id_type = $_POST['idType'];

            //select then u check if it exists then echo error then exit(); u try pagwala i cr
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM qr_datas WHERE id_type = :id_type and user_id = :user_id');
            $stmt->bindParam(':id_type', $id_type);
            $stmt->bindParam(':user_id', $_SESSION['userid']);
            $stmt->execute();
            if ($stmt->fetchColumn() > 0) {
                echo 'duplicate_id_type';
                exit;
            }
    
            $front = $_FILES['frontIdImage']['tmp_name'];
            $back = $_FILES['backIdImage']['tmp_name'];
            // Read binary data
            $frontData = file_get_contents($front);
            $backData = file_get_contents($back);
            $url = md5(uniqid());

            // Insert into PostgreSQL
            $sql = "INSERT INTO id_images (id_number, id_type, front_data, back_data, url_data, user_id) 
            VALUES (:id_number, :id_type, :front_data, :back_data, :url_data, :user_id)"; //need ng bagong table named id_images
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_number', $id_number);
            $stmt->bindParam(':user_id', $_SESSION['userid']);
            $stmt->bindParam(':id_type', $id_type);
            $stmt->bindParam(':front_data', $frontData, PDO::PARAM_LOB);
            $stmt->bindParam(':back_data', $backData, PDO::PARAM_LOB);
            $stmt->bindParam(':url_data', $url);
            $stmt->execute();

            $default_content = 'https://websys.onrender.com/id.php'; //change pagonrender na
            $qr_Code = trim($default_content . "?key=" . $url);
            // $qr_Code->setSize(300);
            // // Generate and save the QR code image
            // $writer = new PngWriter();
            // $result = $writer->write($qr_Code);
            // $result->saveToFile($file_path);
            // $image_code = '<div class="text-center"><img src="'.$file_path.'" /></div>';
            $sql = "INSERT INTO qr_datas (user_id, qr_data, id_number, id_type) 
            VALUES (:user_id, :qr_data, :id_number, :id_type)"; //need ng bagong table named id_images
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_number', $id_number);
            $stmt->bindParam(':id_type', $id_type);
            $stmt->bindParam(':qr_data', $qr_Code);
            $stmt->bindParam(':user_id', $_SESSION['userid']);
            $stmt->execute();

            // Audit trail: Log the upload activity
            $activity = "Uploaded ID - ID Number: " . $id_number . " Type: " . $id_type;
            $sql = "INSERT INTO AuditTrail (userid, activity) 
                    VALUES (:userid, :activity)";  
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userid', $_SESSION['userid']); 
            $stmt->bindParam(':activity', $activity);
            $stmt->execute();

        echo $qr_Code;
    }
    ?>
