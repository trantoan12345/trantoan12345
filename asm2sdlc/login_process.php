<?php
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

// Retrieve input data
$email = $_POST['email'];
$password = $_POST['password'];

// Query to check if user exists
$sql = "SELECT id, fullname FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User exists, redirect to success page
    session_start();
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['fullname'] = $row['fullname'];
    header("Location: welcome.php");
} else {
    // User does not exist or incorrect credentials, redirect back to login page
    header("Location: login.php?error=1");
}

$conn->close();
?>
