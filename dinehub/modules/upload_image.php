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

// Ensure the 'uploads' directory exists
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    echo "Error: The 'uploads' directory does not exist.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']) && isset($_POST['caption'])) {
    $caption = $conn->real_escape_string($_POST['caption']);
    $image = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $imagePath = $uploadDir . basename($image);

    // Move uploaded file
    if (move_uploaded_file($imageTmp, $imagePath)) {
        $sql = "INSERT INTO images (image_path, caption) VALUES ('$imagePath', '$caption')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Image uploaded successfully'); window.location.href = 'image.html';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image. Check if the 'uploads' directory is writable.";
    }
}
$conn->close();
?>
