<?php
session_start();
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sanggunian";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login process
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM login WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if ($password == $row['password']) {
        $_SESSION['username'] = $username;
        header("Location: result_display.php");
        exit();
    } else {
        echo "Wrong password.";
    }
} else {
    echo "Invalid username.";
}

$conn->close();
?>