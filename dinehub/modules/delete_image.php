<?php
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

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

$sql = "SELECT image_path FROM images WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $imagePath = $row['image_path'];
    unlink($imagePath); // Delete file from server

    $sql = "DELETE FROM images WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        echo "Image deleted successfully";
    } else {
        echo "Failed to delete image";
    }
} else {
    echo "Image not found";
}

$stmt->close();
$conn->close();
?>
