
<?php
include("../includes/db.php");

$id = $_GET['id'];

// Fetch module data
$result = mysqli_query($conn,"SELECT * FROM modules WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

$title = $_POST['title'];
$description = $_POST['description'];
$video_link = $_POST['video_link'];

mysqli_query($conn,"UPDATE modules 
SET title='$title', description='$description', video_link='$video_link'
WHERE id=$id");

header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Module</title>

<style>
body{
font-family:Arial;
background:#f4f4f4;
padding:30px;
}

form{
background:white;
padding:20px;
border-radius:10px;
width:400px;
}

input,textarea{
width:100%;
padding:8px;
margin-top:5px;
margin-bottom:15px;
}

button{
padding:10px;
background:#4CAF50;
color:white;
border:none;
border-radius:5px;
}

</style>

</head>

<body>

<h2>Edit Module</h2>

<form method="POST">

Title
<input type="text" name="title" value="<?php echo $row['title']; ?>">

Description
<textarea name="description"><?php echo $row['description']; ?></textarea>

Video Link
<input type="text" name="video_link" value="<?php echo $row['video_link']; ?>">

<button type="submit" name="update">Update Module</button>

</form>

</body>
</html>