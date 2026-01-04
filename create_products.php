<?php
require "config.php";

$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    discount DECIMAL(10,2) DEFAULT 0,
    tax DECIMAL(10,2) DEFAULT 0
)";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Table products created or already exists"]);
} else {
    echo json_encode(["success" => false, "message" => $conn->error]);
}
?>