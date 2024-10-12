<?php
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

$name = $_POST['name'];
$date = $_POST['date'];
$time = $_POST['time'];
$guests = $_POST['guests'];

$sql = "INSERT INTO reservations (name, date, time, guests) VALUES ('$name', '$date', '$time', '$guests')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Reservation successful', 'name' => $name, 'date' => $date, 'time' => $time, 'guests' => $guests]);
} else {
    echo json_encode(['message' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
