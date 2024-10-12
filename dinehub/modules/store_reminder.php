<?php
// Database connection
$conn = new mysqli('localhost', 'your_username', 'your_password', 'dinehub');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve reservations
$result = $conn->query("SELECT username, description, members, date, time FROM reservations");

$reservations = [];
while ($row = $result->fetch_assoc()) {
    $reservations[] = $row;
}

echo json_encode($reservations);

$conn->close();
?>
