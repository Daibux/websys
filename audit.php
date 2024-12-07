<?php
$host = getenv('DB_HOST') ?: 'dpg-csqqfatumphs73d6opqg-a.singapore-postgres.render.com';
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME') ?: 'userdata_0m9c';
$user = getenv('DB_USER') ?: 'admin';
$password = getenv('DB_PASSWORD') ?: 'zgn5icjdz4tfTIamfgL2hSrIZ0hRLvr7';
try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}

// Start session to get the logged-in user's ID
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    echo 'Please log in to view activity logs.'; // Friendly message if user is not logged in
    exit();
}

$userId = $_SESSION['userid']; // Get the logged-in user's ID

// Query to fetch the user's activity logs
$query = "SELECT activity, date_time FROM AuditTrail WHERE userId = :userId ORDER BY date_time DESC";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$stmt->execute();

$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If no activities, show a friendly message
if (!$activities) {
    echo 'Your activity log is currently empty.';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Audit Trail</title>
</head>
<body>
    <div class="modal-content">
        <h3>Your Recent Activities</h3>
        <table class="activity-table">
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Activity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activities as $activity): ?>
                    <tr>
                        <td><?= htmlspecialchars($activity['date_time']) ?></td>
                        <td><?= htmlspecialchars($activity['activity']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

 
