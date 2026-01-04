<?php
require "config.php";

$result = $conn->query("SELECT * FROM products");

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    "success" => true,
    "data" => $data
]);
