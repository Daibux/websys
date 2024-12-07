<?php
$host = 'dpg-csqqfatumphs73d6opqg-a.singapore-postgres.render.com';
$port = '5432';
$dbname = 'userdata_0m9c';
$user =  'admin';
$password = 'zgn5icjdz4tfTIamfgL2hSrIZ0hRLvr7';

try {
    // Create a new PDO instance with the PostgreSQL connection details
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Log success message only for debugging, not for production
    error_log("Connected to the PostgreSQL database successfully!");
} catch (PDOException $e) {
    // Log error for debugging; don't expose details to the client
    error_log("Database connection error: " . $e->getMessage());
    die("Could not connect to the database.");
}
?>
