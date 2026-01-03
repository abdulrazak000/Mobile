<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require "config.php";

$data = json_decode(file_get_contents("php://input"), true);

$name     = $data["name"] ?? "";
$price    = (float)($data["price"] ?? 0);
$discount = (float)($data["discount"] ?? 0);
$tax      = (float)($data["tax"] ?? 0);

if ($name === "" || $price <= 0) {
    echo json_encode(["success" => false]);
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO products (name, price, discount, tax)
     VALUES (?, ?, ?, ?)"
);

$stmt->bind_param("sddd", $name, $price, $discount, $tax);
$success = $stmt->execute();

echo json_encode(["success" => $success]);