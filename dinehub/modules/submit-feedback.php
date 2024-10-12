<?php
// Database connection details
$host = 'localhost'; // or '127.0.0.1'
$dbname = 'dinehub';
$username = 'root'; // your DB username
$password = ''; // your DB password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $message = $_POST['message'];

    // Prepare SQL statement to insert feedback into the database
    $sql = "INSERT INTO feedback (name, email, rating, message) VALUES (?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters and execute
    $stmt->bind_param("ssis", $name, $email, $rating, $message); // 'ssis' = string, string, integer, string
    if ($stmt->execute()) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();

// Redirect back to feedback page after submission
header("Location: feedback.html");
exit;
?>
