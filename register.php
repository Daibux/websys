<?php
require 'database.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = trim($_POST['password']);
        $userID = trim($_POST['password']);

        // Validation patterns
        $phonePattern = '/^(\+639|09)\d{9}$/';  
        $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if (!preg_match($phonePattern, $phone)) {
            echo json_encode(['status' => 'error', 'message' => 'invalid_phone']);
            exit;
        }
        if (!preg_match($emailPattern, $email)) {
            echo json_encode(['status' => 'error', 'message' => 'invalid_email']);
            exit;
        }

        // Check for duplicate username
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM usertable WHERE username = :username');
        $stmt->execute([':username' => $username]);
        if ($stmt->fetchColumn() > 0) {
            echo json_encode(['status' => 'error', 'message' => 'duplicate_username']);
            exit;
        }

        // Check for duplicate email
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM usertable WHERE email = :email');
        $stmt->execute([':email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            echo json_encode(['status' => 'error', 'message' => 'duplicate_email']);
            exit;
        }

        // Hash the password and insert into database
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare('INSERT INTO usertable (username, email, phone, password, fname, lname) VALUES (:username, :email, :phone, :password, :fname, :lname)');
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':phone' => $phone,
            ':password' => $hashedPassword,
            ':lname' => $lname,
            ':fname' => $fname
        ]);

        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'database_error']);
    }
}
?>
