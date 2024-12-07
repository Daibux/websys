<?php
// Database connection
    require_once "database.php";
    
    $token = $_COOKIE["token"]; //JS TO PHP VARIABLE
    try {
        $stmt = $pdo->prepare("SELECT * FROM usertable WHERE email = ?");
        $stmt->execute([$token]);
        $user = $stmt->fetch();
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
   

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $oldHashedPassword = $user['password'];
    $password = $_POST['password'];

    //check if same as old password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    if ($hashedPassword == $oldHashedPassword) {
        echo 'same-password';
    }

    // Query to check if the user exists
    $stmt = $pdo->prepare("UPDATE usertable SET password = :hashed_password WHERE email = :email_data");
    $stmt->bindParam(':hashed_password', $hashedPassword);
    $stmt->bindParam(':email_data', $user['email']);
    $stmt->execute();

    exit();
}

//

function decryptToken($encryptedData, $secretKey) {
    // Decode the base64-encoded data
    $decodedData = base64_decode($encryptedData);

    // Extract the IV and encrypted text
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($decodedData, 0, $ivLength);
    $encryptedText = substr($decodedData, $ivLength);

    // Decrypt the data
    $decrypted = openssl_decrypt($encryptedText, 'aes-256-cbc', $secretKey, 0, $iv);

    return $decrypted;
}
?>