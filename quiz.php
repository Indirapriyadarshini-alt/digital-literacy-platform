<?php
session_start();
include("includes/db.php");

// Check login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get module_id from URL
if(!isset($_GET['module_id'])){
    echo "No module selected!";
    exit();
}

// IMPORTANT: map module_id → lesson_id
$lesson_id = intval($_GET['module_id']);

// Fetch questions
$result = mysqli_query($conn, "SELECT * FROM quiz WHERE lesson_id=$lesson_id");

if(mysqli_num_rows($result) == 0){
    echo "No questions available for this lesson!";
    exit();
}

// Submit quiz
if(isset($_POST['submit_quiz'])){
    $score = 0;
    $total = mysqli_num_rows($result);

    // Reset pointer
    mysqli_data_seek($result, 0);

    while($row = mysqli_fetch_assoc($result)){
        $qid = $row['id'];

        if(isset($_POST['q'.$qid]) && $_POST['q'.$qid] == $row['correct_answer']){
            $score++;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
    <style>
        body{
            font-family: Arial;
            background:#f4f4f4;
        }
        .container{
            max-width:700px;
            margin:30px auto;
            background:white;
            padding:20px;
            border-radius:10px;
        }
        .question{
            margin-bottom:20px;
        }
        button{
            padding:10px 20px;
            background:#4CAF50;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }
        h2{
            text-align:center;
        }
    </style>
</head>
<body>

<div class="container">

<h2>Quiz</h2>

<?php if(isset($score)){ ?>

    <h3>Your Score: <?php echo $score; ?> / <?php echo $total; ?></h3>

    <?php if($score >= ($total/2)){ ?>
        <p style="color:green;">✅ Passed!</p>
    <?php } else { ?>
        <p style="color:red;">❌ Try Again!</p>
    <?php } ?>

    <a href="dashboard.php">⬅ Back to Dashboard</a>

<?php } else { ?>

<form method="POST">

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="question">
    <p><b><?php echo $row['question']; ?></b></p>

    <input type="radio" name="q<?php echo $row['id']; ?>" value="<?php echo $row['option1']; ?>"> <?php echo $row['option1']; ?><br>
    <input type="radio" name="q<?php echo $row['id']; ?>" value="<?php echo $row['option2']; ?>"> <?php echo $row['option2']; ?><br>
    <input type="radio" name="q<?php echo $row['id']; ?>" value="<?php echo $row['option3']; ?>"> <?php echo $row['option3']; ?><br>
    <input type="radio" name="q<?php echo $row['id']; ?>" value="<?php echo $row['option4']; ?>"> <?php echo $row['option4']; ?><br>
</div>

<?php } ?>

<button type="submit" name="submit_quiz">Submit Quiz</button>

</form>

<?php } ?>

</div>

</body>
</html>