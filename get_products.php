<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require "config.php";

try {
    $stmt = $conn->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => 1,
        "data" => $products
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "success" => 0,
        "message" => "Query failed: " . $e->getMessage()
    ]);
}
?>