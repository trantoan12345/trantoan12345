<?php
// Check if ID parameter is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: welcome.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asm2sdlc";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Delete student from the database
$sql = "DELETE FROM users WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    // Redirect back to welcome page after successful deletion
    header("Location: welcome.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
