<?php
$host = getenv("DB_HOST");
$port = getenv("DB_PORT");
$user = getenv("DB_USER");
$pass = getenv("DB_PASS");
$db   = getenv("DB_NAME");

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode([
        "success" => 0,
        "message" => "Connection failed: " . $e->getMessage()
    ]);
    exit;
}
?>