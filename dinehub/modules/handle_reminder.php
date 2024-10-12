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

// Retrieve POST data
$reminderDate = $_POST['reminder-date'];
$reminderTime = $_POST['reminder-time'];
$message = $_POST['message'];

// Prepare and bind SQL statement
$sql = "INSERT INTO reminders (reminder_date, reminder_time, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $reminderDate, $reminderTime, $message);

// Execute the statement and handle response
if ($stmt->execute()) {
    // Success response
    echo json_encode([
        'message' => 'Reminder set successfully',
        'reminderDate' => $reminderDate,
        'reminderTime' => $reminderTime,
        'message' => $message
    ]);
} else {
    // Error response
    echo json_encode(['message' => 'Error: ' . $stmt->error]);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
