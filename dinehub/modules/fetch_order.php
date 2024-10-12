<?php
// fetch_order.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dinehub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, dish_name, description, price, quantity, image_url FROM orders";
$result = $conn->query($sql);

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

echo json_encode($orders);

$conn->close();
?>
