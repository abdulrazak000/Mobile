<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require "config.php";

$data = json_decode(file_get_contents("php://input"), true);

$id = (int)($data["id"] ?? 0);

if ($id <= 0) {
    echo json_encode([
        "success" => 0,
        "message" => "Invalid product ID"
    ]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
if (!$stmt) {
    echo json_encode([
        "success" => 0,
        "message" => "Prepare failed: " . $conn->error
    ]);
    exit;
}

$stmt->bind_param("i", $id);
$success = $stmt->execute();

if (!$success) {
    echo json_encode([
        "success" => 0,
        "message" => "Execute failed: " . $stmt->error
    ]);
    exit;
}

if ($stmt->affected_rows > 0) {
    echo json_encode([
        "success" => 1,
        "message" => "Product deleted successfully"
    ]);
} else {
    echo json_encode([
        "success" => 0,
        "message" => "No product found with given ID"
    ]);
}
?>