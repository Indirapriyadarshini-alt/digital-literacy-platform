<?php
session_start();
include("includes/db.php");

// Check login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Fetch all modules
$modules_result = mysqli_query($conn, "SELECT * FROM modules ORDER BY id ASC");

// Fetch user progress
$progress_result = mysqli_query($conn, "SELECT module_id, completed FROM user_progress WHERE user_id=$user_id");
$user_progress = [];
while($row = mysqli_fetch_assoc($progress_result)){
    $user_progress[$row['module_id']] = $row['completed'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Digital Literacy Platform</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .header { background: #4CAF50; color: white; padding: 20px; text-align: center; }
        .header h1 { margin: 0; }
        .container { max-width: 1000px; margin: 20px auto; padding: 10px; display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .module-card { background: white; border-radius: 10px; overflow: hidden; width: 250px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
        .module-card img { width: 100%; height: 150px; object-fit: cover; }
        .module-card .content { padding: 10px; }
        .module-card h3 { margin: 10px 0 5px 0; font-size: 18px; }
        .module-card p { font-size: 14px; color: #555; }
        .progress-bar { background: #ddd; height: 10px; border-radius: 5px; margin-top: 10px; }
        .progress { background: green; height: 10px; border-radius: 5px; }
        .buttons { margin-top: 10px; display: flex; justify-content: space-between; }
        .buttons a { text-decoration: none; background: #4CAF50; color: white; padding: 5px 10px; border-radius: 5px; font-size: 14px; }
        .buttons a:hover { background: #45a049; }
    </style>
</head>
<body>

<div class="header">
    <h1>Welcome, <?php echo htmlspecialchars($user_name); ?> 👋</h1>
    <p>Start learning digital skills easily</p>
    <a href="logout.php" style="color:white; background:#388E3C; padding:5px 10px; border-radius:5px; text-decoration:none;">Logout</a>
</div>

<div class="container">
    <?php while($module = mysqli_fetch_assoc($modules_result)) {
        $completed = isset($user_progress[$module['id']]) && $user_progress[$module['id']] == 1;
    ?>
    <div class="module-card">
        <img src="<?php echo $module['thumbnail']; ?>" alt="<?php echo htmlspecialchars($module['title']); ?>">
        <div class="content">
            <h3><?php echo htmlspecialchars($module['title']); ?></h3>
            <p><?php echo htmlspecialchars($module['description']); ?></p>
            
            <div class="progress-bar">
                <div class="progress" style="width: <?php echo $completed ? '100%' : '0%'; ?>"></div>
            </div>
            <?php if($completed) echo "<p style='color:green;'>✅ Completed</p>"; ?>
            
            <div class="buttons">
                <a href="lesson.php?module_id=<?php echo $module['id']; ?>">Watch</a>
                <a href="quiz.php?module_id=<?php echo $module['id']; ?>">Quiz</a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

</body>
</html>