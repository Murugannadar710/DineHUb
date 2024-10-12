<?php
$servername = "localhost"; // Replace with your database server
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "dinehub";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect data from POST request
$dish_name = $_POST['dish_name'];
$description = $_POST['description'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$image_url = $_POST['image_url'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO orders (dish_name, description, price, quantity, image_url) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssdis", $dish_name, $description, $price, $quantity, $image_url);

// Execute
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
