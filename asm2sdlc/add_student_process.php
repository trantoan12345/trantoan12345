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
$phone = $_POST['phone'];

// Query to insert new user
$sql = "INSERT INTO users (fullname, email, password ,phone  ) VALUES ('$fullname', '$email', '$password','$phone' )";

if ($conn->query($sql) === TRUE) {
    // User added successfully, redirect to welcome page
    header("Location: welcome.php");
} else {
    // If adding user fails, redirect back to add student page with error message
    header("Location: add_student.php?error=1");
}

$conn->close();
?>
