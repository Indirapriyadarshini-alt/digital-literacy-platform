
<?php
session_start();
include("../includes/db.php");

// Check admin login
if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}

// Fetch modules
$modules = mysqli_query($conn,"SELECT * FROM modules");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>

body{
    font-family: Arial;
    background:#f4f6f9;
    margin:0;
    padding:20px;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

h2{
    color:#333;
}

.top-buttons a{
    padding:10px 15px;
    background:#4CAF50;
    color:white;
    text-decoration:none;
    border-radius:6px;
    margin-left:10px;
}

.top-buttons a:hover{
    background:#45a049;
}

.module{
    border:1px solid #ddd;
    padding:15px;
    margin-top:15px;
    background:white;
    border-radius:10px;
    box-shadow:0px 2px 6px rgba(0,0,0,0.1);
}

.module h3{
    margin:0;
    color:#333;
}

.module p{
    margin-top:5px;
}

.actions{
    margin-top:10px;
}

.actions a{
    padding:6px 12px;
    text-decoration:none;
    color:white;
    border-radius:5px;
    margin-right:8px;
    font-size:14px;
}

.edit{
    background:#2196F3;
}

.delete{
    background:#f44336;
}

.quiz{
    background:#9C27B0;
}

.actions a:hover{
    opacity:0.85;
}

</style>
</head>

<body>

<div class="header">

<h2>Admin Dashboard</h2>

<div class="top-buttons">
<a href="add_module.php">Add Module</a>
<a href="index.php">Logout</a>
</div>

</div>

<?php

if(mysqli_num_rows($modules) > 0){

while($row = mysqli_fetch_assoc($modules)){

?>

<div class="module">

<h3><?php echo $row['title']; ?></h3>

<p><?php echo $row['description']; ?></p>

<div class="actions">

<a class="edit" href="edit_module.php?id=<?php echo $row['id']; ?>">Edit</a>

<a class="delete" href="delete_module.php?id=<?php echo $row['id']; ?>" 
onclick="return confirm('Are you sure you want to delete this module?')">
Delete
</a>

<a class="quiz" href="quiz_manage.php?module_id=<?php echo $row['id']; ?>">
Manage Quiz
</a>

</div>

</div>

<?php
}
}
else{
echo "<p>No modules available.</p>";
}
?>

</body>
</html>

