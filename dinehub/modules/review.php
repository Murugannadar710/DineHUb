<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$host = 'localhost';  // Your database host
$dbname = 'dinehub';  // Your database name
$username = 'root';   // Your database username
$password = '';       // Your database password

// Establish a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch reviews
$sql = "SELECT name, rating, message, submitted_at FROM feedback ORDER BY submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews | DineHub</title>
    <link rel="stylesheet" href="review.css"> <!-- Ensure the CSS file exists -->
</head>
<body>
    <div class="container">

        <div id="reviewsContainer">
            <?php
            if ($result->num_rows > 0) {
                // Display each review
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='review'>";
                    echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                    echo "<p>Rating: " . htmlspecialchars($row['rating']) . "/5</p>";
                    echo "<p>" . htmlspecialchars($row['message']) . "</p>";
                    echo "<small>Submitted on: " . htmlspecialchars($row['submitted_at']) . "</small>";
                    echo "</div>";
                }
            } else {
                echo "<p>No reviews available yet.</p>";
            }
            ?>
        </div>

        <!-- Back to Home Button -->
        <div class="back-home">
            <a href="home.html" class="back-home-btn">Back to Home</a>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
