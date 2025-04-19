<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>

<h2>Announcements</h2>

<!-- Form to add new announcement -->
<form action="announcement.php" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title" required><br>
    <input type="file" name="image" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="submit" name="add_announcement" value="Add Announcement">
</form>

<!-- Display existing announcements -->
<?php
// Include announcement.php to use its functions
include 'announcement.php';

// Call the getAnnouncements() function to retrieve announcements
$announcements = getAnnouncements();

// Check if there are announcements to display
if (!empty($announcements)) {
    // Loop through announcements and display each one
    foreach ($announcements as $announcement) {
        echo "<div>";
        echo "<h3>{$announcement['title']}</h3>";
        echo "<img src='{$announcement['image']}' alt='{$announcement['title']}' width='100'><br>";
        echo "<p>{$announcement['description']}</p>";
        echo "<a href='announcement.php?action=edit&id={$announcement['id']}'>Edit</a>";
        echo "<a href='announcement.php?action=delete&id={$announcement['id']}'>Delete</a>";
        echo "</div>";
    }
} else {
    echo "<p>No announcements available.</p>";
}
?>

</body>
</html>