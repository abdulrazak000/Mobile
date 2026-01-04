<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Debug start<br>";

require "config.php";

echo "DB connected<br>";

$result = $conn->query("SHOW TABLES");

if (!$result) {
    echo "Query failed: " . $conn->error;
    exit;
}

while ($row = $result->fetch_array()) {
    echo "Table: " . $row[0] . "<br>";
}
?>