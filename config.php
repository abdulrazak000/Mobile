<?php
header("Content-Type: application/json; charset=UTF-8");

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db   = getenv("MYSQLDATABASE");

if (!$host || !$user || !$db) {
    echo json_encode([
        "success" => false,
        "message" => "Missing environment variables for database connection"
    ]);
    exit;
}

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed: " . $conn->connect_error
    ]);
    exit;
}
?>
