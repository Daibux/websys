<?php
session_start();
require_once "database.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $updates = []; // Array to store update fields
        $params = [];  // Array to store bound values
        $activityLog = []; // Array to store activities for the audit trail

        // Validate and update username
        if (!empty($_POST['username'])) {
            $updates[] = "username = :username";
            $params[':username'] = $_POST['username'];
            $_SESSION['username'] = $_POST['username'];
            $activityLog[] = "Username updated to {$_POST['username']}";
        }

        // Validate and update email
        if (!empty($_POST['email'])) {
            $updates[] = "email = :email";
            $params[':email'] = $_POST['email'];
            $_SESSION['email'] = $_POST['email'];
            $activityLog[] = "Email updated to {$_POST['email']}";
        }

        // Validate and update password
        if (!empty($_POST['password'])) {
            if (empty($_POST['confirm_password'])) {
                echo 'Confirm password is required.';
                exit;
            }

            if ($_POST['password'] !== $_POST['confirm_password']) {
                echo 'Passwords do not match.';
                exit;
            }

            $updates[] = "password = :password";
            $params[':password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $activityLog[] = "Password updated.";
        }

        // Execute the update query if there are fields to update
        if (!empty($updates)) {
            $query = "UPDATE usertable SET " . implode(", ", $updates) . " WHERE email = :email_data";
            $params[':email_data'] = $_SESSION['email'];

            $stmt = $pdo->prepare($query);
            $stmt->execute($params);

            // Log activities in the audit trail
            foreach ($activityLog as $activity) {
                $auditStmt = $pdo->prepare("INSERT INTO AuditTrail (UserID, Activity) VALUES (:userId, :activity)");
                $auditStmt->bindParam(':userId', $_SESSION['userid'], PDO::PARAM_INT);
                $auditStmt->bindParam(':activity', $activity, PDO::PARAM_STR);
                $auditStmt->execute();
            }

            echo 'success';
        } else {
            echo 'No changes to update.';
        }
    }
} catch (PDOException $e) {
    error_log("Error updating user: " . $e->getMessage());
    echo 'error';
}
