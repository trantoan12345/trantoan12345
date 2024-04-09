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
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];

// Query to insert new user
$sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    // Registration successful, redirect to login page with success message
    header("Location: login.php?registered=1");
} else {
    // If registration fails, redirect back to register page with error message
    header("Location: register.php?error=1");
}

$conn->close();
?>
