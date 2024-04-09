<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$phone = "";
$dbname = "asm2sdlc";

$conn = new mysqli($servername, $username, $password , $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all users data
$sql = "SELECT id, fullname, email ,phone FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .logout {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['fullname']; ?>!</h2>
    <a href="logout.php" class="logout">Logout</a>
    <h3>Student managements</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>phone</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['fullname']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['phone']."</td>";
                echo "<td>";
                echo "<a href='edit_student.php?id=".$row['id']."'>Edit</a>";
                echo " | ";
                echo "<a href='delete_student.php?id=".$row['id']."'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
    </table>
    <a href="add_student.php" class="add-student">Add Student</a>
</body>
</html>

<?php
$conn->close();
?>
