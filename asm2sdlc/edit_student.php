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

// Fetch student data based on the provided ID
$sql = "SELECT fullname, email, password FROM users WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // If no student found with the provided ID, redirect back to welcome page
    header("Location: welcome.php");
    exit();
}

$row = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Update student data in the database
    $sql = "UPDATE users SET fullname='$fullname', email='$email', password='$password', phone='$phone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to welcome page after successful update
        header("Location: welcome.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student</h2>
    <form action="" method="POST">
        <label for="fullname">Full Name:</label><br>
        <input type="text" id="fullname" name="fullname" value="<?php echo $row['fullname']; ?>" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>" required><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
