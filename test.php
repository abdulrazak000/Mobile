<?php
require "config.php";

$result = $conn->query("SHOW TABLES");

if (!$result) {
    echo json_encode(["success" => false, "message" => $conn->error]);
    exit;
}

$tables = [];

while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
}

echo json_encode(["success" => true, "tables" => $tables]);
?>