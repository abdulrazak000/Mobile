<?php
header("Content-Type: application/json; charset=UTF-8");

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db   = getenv("MYSQLDATABASE");
$port = getenv("MYSQLPORT");

if (!$host || !$user || !$pass || !$db) {
    echo json_encode([
        "success" => false,
        "message" => "Missing environment variables"
    ]);
    exit;
}

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => $conn->connect_error
    ]);
    exit;
}
