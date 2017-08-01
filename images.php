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

$sql = "SELECT * FROM images;";

$stmt = $conn->prepare($sql);
$stmt->execute();

$images = $stmt->fetchAll(PDO::FETCH_OBJ);

include "templates/header.php";
include "views/images/index.php";
