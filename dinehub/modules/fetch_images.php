<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dinehub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, image_path, caption FROM images";
$result = $conn->query($sql);

$images = array();
while ($row = $result->fetch_assoc()) {
    $images[] = $row;
}

echo json_encode($images);

$conn->close();
?>
