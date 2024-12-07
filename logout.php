<?php  
session_start();
require_once "database.php"; // Include the database connection setup

if (isset($_SESSION['userid'])) {
    try {
        // Log the "User logged out" activity in AuditTrail
        $activity = "User logged out";

        $stmt = $pdo->prepare("INSERT INTO AuditTrail (userid, Activity) VALUES (:userid, :activity)");
        $stmt->bindParam(':userid', $_SESSION['userid'], PDO::PARAM_INT);
        $stmt->bindParam(':activity', $activity, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        // Log the error if the activity logging fails
        error_log("Failed to log logout activity: " . $e->getMessage());
    }
}
// Destroy the session
$_SESSION = array();
echo 'ok';
session_destroy();

exit;
?>
