<?php
// Database connection
$conn = new mysqli('localhost', 'your_username', 'your_password', 'dinehub');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$username = $_POST['username'];
$description = $_POST['description'];
$members = $_POST['members'];
$date = $_POST['date'];
$time = $_POST['time'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO reservations (username, description, members, date, time) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $username, $description, $members, $date, $time);

if ($stmt->execute()) {
    // Return success response
    echo json_encode([
        'username' => $username,
        'description' => $description,
        'members' => $members,
        'date' => $date,
        'time' => $time
    ]);
} else {
    // Return error response
    echo json_encode(['error' => 'Failed to save reservation.']);
}

$stmt->close();
$conn->close();
?>
