<?php
// Database connection
$host = getenv('DB_HOST') ?: 'dpg-csqqfatumphs73d6opqg-a.singapore-postgres.render.com';
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME') ?: 'userdata_0m9c';
$user = getenv('DB_USER') ?: 'admin';
$password = getenv('DB_PASSWORD') ?: 'zgn5icjdz4tfTIamfgL2hSrIZ0hRLvr7';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $url = $_GET['key'];
    $url2 = isset($_GET['key2']) ? $_GET['key2'] : null;
    $type = isset($_GET['type']) ? $_GET['type'] : null; // Check if 'type' exists

    $sql = "SELECT id_number, id_type, front_data, back_data FROM id_images WHERE url_data = :url_data";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':url_data' => $url]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $frontId = base64_encode(stream_get_contents( $row['front_data']));
        $backId = base64_encode(stream_get_contents($row['back_data']));
    } else {
        echo "Image not found.";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="icon" href="logo-title.png">
    <title>Id Page</title>
    <style>
        body {
            font-family: 'Poppins';
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            height: 100vh;
            margin: 0;
        }

        .logo a img {
            margin-top: 20px;
            width: 180px;
            height: 180px;
        }

        .profile-pic {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            vertical-align: middle;
            border: 1px solid;
            padding: 3px;
        }

        .dropdown {
            position: relative;
            margin-right: 100px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 45%;
            background-color: #F1F1F1;
            border-radius: 8px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
            width: 200px;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            font-size: 14px;
            padding: 0;
            display: block;
            color: black;
            margin: 10px;
            padding-left: 10px;
        }

        .dropdown-content a i {
            margin-right: 8px;
        }

        .dropdown-content a:hover {
            background: #263A69;
            border-radius: 8px;
            color: #F1F1F1;
        }

        .display-container {
        font-family: 'Poppins';
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 0 auto;
        margin-bottom: 5%;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .detail {
        margin-bottom: 20px;
    }

    .detail img {
        width: 100%;
    }

    .label {
        font-weight: bold;
        color: #555;
        display: block;
    }

    .value {
        color: #333;
        font-size: 1.1em;
    }

    .image-container {
        text-align: center;
        margin-top: 10px;
    }

    .image-container img {
        max-width: 50%;
        max-height: 50%;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .btn {
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .previous {
        background-color: #6c757d;
    }

    .previous:hover {
        background-color: #5a6268;
    }

    .next {
        background-color: #28a745;
    }

    .next:hover {
        background-color: #218838;
    }



    </style>
</head>
</html>
<?php if ($row): ?>


    <div class="display-container">
        <h1>
            ID Details
        </h1>
        <div class="detail">
            <span class="label">ID Number: <?php echo htmlspecialchars($row['id_number']); ?></span>
        </div>

        <div class="detail">
            <span class="label">ID Type: <?php echo htmlspecialchars($row['id_type']); ?></span>
        </div>

        <div class="detail">
            <span class="label">Front Image</span>
            <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($frontId); ?>" alt="Front Image">
        </div>

        <div class="detail">
            <span class="label">Back Image</span>
            <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($backId); ?>" alt="Back Image">
        </div>
    <?php if ($url2): ?>

            <div class="button-group">
                <button class="btn previous">Previous</button>
                <button class="btn next">Next</button>
            </div>
        </div>
    <?php endif; ?>
<?php else: ?>
    <p>No data found for the provided key.</p>
<?php endif; ?>

