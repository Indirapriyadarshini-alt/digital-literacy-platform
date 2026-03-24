<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$module_id = isset($_GET['module_id']) ? $_GET['module_id'] : 0;

// Delete quiz question
mysqli_query($conn,"DELETE FROM quiz WHERE id=$id");

// Redirect back to quiz management
header("Location: quiz_manage.php?module_id=$module_id");
exit();