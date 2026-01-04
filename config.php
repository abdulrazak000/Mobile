<?php
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli(
  getenv("MYSQLHOST"),
  getenv("MYSQLUSER"),
  getenv("MYSQLPASSWORD"),
  getenv("MYSQLDATABASE")
);

if ($conn->connect_error) {
  echo json_encode([
    "success" => false,
    "message" => "Database connection failed"
  ]);
  exit;
}