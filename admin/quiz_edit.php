<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
}

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$module_id = isset($_GET['module_id']) ? $_GET['module_id'] : 0;

// Fetch existing quiz data
$result = mysqli_query($conn,"SELECT * FROM quiz WHERE id=$id");
$quiz = mysqli_fetch_assoc($result);

// Update quiz if form submitted
if(isset($_POST['submit'])){
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $correct_option = $_POST['correct_option'];

    mysqli_query($conn,"UPDATE quiz SET question='$question', option1='$option1', option2='$option2', option3='$option3', correct_option='$correct_option' WHERE id=$id");

    header("Location: quiz_manage.php?module_id=$module_id");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Quiz Question</title>
</head>
<body>

<h2>Edit Quiz Question</h2>

<form method="POST">
    <input type="text" name="question" value="<?php echo $quiz['question']; ?>" required><br>
    <input type="text" name="option1" value="<?php echo $quiz['option1']; ?>" required><br>
    <input type="text" name="option2" value="<?php echo $quiz['option2']; ?>" required><br>
    <input type="text" name="option3" value="<?php echo $quiz['option3']; ?>" required><br>
    Correct Option (1/2/3): <input type="number" name="correct_option" min="1" max="3" value="<?php echo $quiz['correct_option']; ?>" required><br>
    <button type="submit" name="submit">Update Question</button>
</form>

<a href="quiz_manage.php?module_id=<?php echo $module_id; ?>">Back</a>

</body>
</html>