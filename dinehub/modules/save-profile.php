<?php
// save-profile.php

// Database credentials
$servername = "localhost";
$username = "root"; // your MySQL username
$password = ""; // your MySQL password
$dbname = "dinehub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from POST request
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$occupation = $_POST['occupation'];
$age = $_POST['age'];
$dob = $_POST['dob'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO profiles (username, email, password, gender, contact, address, occupation, age, dob) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $username, $email, $password, $gender, $contact, $address, $occupation, $age, $dob);

// Execute the statement
if ($stmt->execute()) {
    echo "<script>alert('Profile saved successfully!\\n\\nUsername: $username\\nEmail: $email\\nGender: $gender\\nContact: $contact\\nAddress: $address\\nOccupation: $occupation\\nAge: $age\\nDate of Birth: $dob'); window.location.href='home.html';</script>";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
