<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $video = $_POST['video_link'];

    mysqli_query($conn,"INSERT INTO modules(title,description,video_link) VALUES('$title','$desc','$video')");
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Module</title></head>
<body>
<h2>Add New Module</h2>
<form method="POST">
    <input type="text" name="title" placeholder="Module Title" required><br>
    <textarea name="description" placeholder="Module Description" required></textarea><br>
    <input type="text" name="video_link" placeholder="Video Link (e.g. videos/module1.mp4)" required><br>
    <button type="submit" name="submit">Add Module</button>
</form>
<a href="dashboard.php">Back</a>
</body>
</html>