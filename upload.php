<?php

require "vendor/autoload.php";

$Loader = new josegonzalez\Dotenv\Loader('./.env');
// Parse the .env file
$Loader->parse();
// Send the parsed .env file to the $_ENV variable
$Loader->toEnv();

try {
    $conn = new PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_DATABASE'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$uploadDir = 'uploads/';

$uploadFile = $uploadDir . time() . '-' . basename($_FILES['file']['name']);

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {

    // prepare sql and bind parameters
    $stmt = $conn->prepare('INSERT INTO images (path) VALUES (:path)');
    $stmt->bindParam(':path', $path);

    // set parameters and execute
    $path = $uploadFile;

    $stmt->execute();

    echo json_encode(['uploaded' => true]);
} else {
    echo json_encode(['uploaded' => false]);
}
