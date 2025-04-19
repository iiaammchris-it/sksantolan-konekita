<?php
// Database connection
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "sanggunian"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch announcements from the database
function getAnnouncements() {
    global $conn;
    $sql = "SELECT * FROM announcements";
    $result = $conn->query($sql);
    $announcements = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $announcements[] = $row;
        }
    }
    return $announcements;
}

// Function to add new announcement
function addAnnouncement($title, $image, $description) {
    global $conn;
    $imagePath = 'uploads/' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    $sql = "INSERT INTO announcements (title, image, description) VALUES ('$title', '$imagePath', '$description')";
    return $conn->query($sql);
}

// Function to update announcement
function updateAnnouncement($id, $title, $description) {
    global $conn;
    $sql = "UPDATE announcements SET title='$title', description='$description' WHERE id=$id";
    return $conn->query($sql);
}

// Function to delete announcement
function deleteAnnouncement($id) {
    global $conn;
    $sql = "DELETE FROM announcements WHERE id=$id";
    return $conn->query($sql);
}
?>