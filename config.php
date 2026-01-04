<?php
header("Content-Type: application/json; charset=UTF-8");

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db   = getenv("MYSQLDATABASE");
$port = getenv("MYSQLPORT");

if (!$host || !$user || !$pass || !$db || !$port) {
    echo json_encode([
        "success" => false,
        "message" => "Missing environment variables for database connection"
    ]);
    exit;
}

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed: " . $conn->connect_error
    ]);
    exit;
}
?>