<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}

$module_id = isset($_GET['module_id']) ? $_GET['module_id'] : 0;

// Add new quiz question
if(isset($_POST['submit'])){
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $correct_option = $_POST['correct_option'];

    mysqli_query($conn,"INSERT INTO quiz(module_id, question, option1, option2, option3, correct_option) VALUES('$module_id','$question','$option1','$option2','$option3','$correct_option')");
    header("Location: quiz_manage.php?module_id=$module_id");
}

// Fetch quiz questions for this module
$quizs = mysqli_query($conn,"SELECT * FROM quiz WHERE module_id=$module_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Quiz</title>
    <style>
        body{font-family: Arial;}
        table{border-collapse: collapse; width: 100%;}
        th, td{border:1px solid #ccc; padding:8px; text-align:left;}
        a{padding:5px 10px; background:#4CAF50; color:white; text-decoration:none; border-radius:5px;}
    </style>
</head>
<body>

<h2>Manage Quiz for Module ID: <?php echo $module_id; ?></h2>

<h3>Add New Question</h3>
<form method="POST">
    <input type="text" name="question" placeholder="Question" required><br>
    <input type="text" name="option1" placeholder="Option 1" required><br>
    <input type="text" name="option2" placeholder="Option 2" required><br>
    <input type="text" name="option3" placeholder="Option 3" required><br>
    Correct Option (1/2/3): <input type="number" name="correct_option" min="1" max="3" required><br>
    <button type="submit" name="submit">Add Question</button>
</form>

<h3>Existing Questions</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Question</th>
        <th>Options</th>
        <th>Correct</th>
        <th>Action</th>
    </tr>
    <?php while($q = mysqli_fetch_assoc($quizs)) { ?>
    <tr>
        <td><?php echo $q['id']; ?></td>
        <td><?php echo $q['question']; ?></td>
        <td>1: <?php echo $q['option1']; ?> | 2: <?php echo $q['option2']; ?> | 3: <?php echo $q['option3']; ?></td>
        <td><?php echo $q['correct_option']; ?></td>
        <td>
            <a href="quiz_edit.php?id=<?php echo $q['id']; ?>&module_id=<?php echo $module_id; ?>">Edit</a>
            <a href="quiz_delete.php?id=<?php echo $q['id']; ?>&module_id=<?php echo $module_id; ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

<br>
<a href="dashboard.php">Back to Modules</a>

</body>
</html>