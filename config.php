<?php
header("Content-Type: application/json; charset=UTF-8");

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db   = getenv("MYSQLDATABASE");
$port = getenv("MYSQLPORT") ?: 3306;

$conn = new mysqli($host, $user, $pass, $db, (int)$port);

if ($conn->connect_error) {
    echo json_encode([
        "success" => 0,
        "message" => "Connection failed: " . $conn->connect_error
    ]);
    exit;
}
?>
