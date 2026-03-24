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

// Get module_id from URL
$module_id = isset($_GET['module_id']) ? intval($_GET['module_id']) : 0;

// Fetch module details
$module_result = mysqli_query($conn, "SELECT * FROM modules WHERE id=$module_id");
if(mysqli_num_rows($module_result) == 0){
    die("Module not found!");
}
$module = mysqli_fetch_assoc($module_result);

// Handle language switch via buttons
if(isset($_POST['lang'])){
    $_SESSION['language'] = $_POST['lang'];
}
$language = $_SESSION['language'] ?? 'English';

// Select description based on language
switch($language){
    case 'Telugu':
        $lesson_text = $module['description_te'];
        break;
    case 'Hindi':
        $lesson_text = $module['description_hi'];
        break;
    default:
        $lesson_text = $module['description'];
}

// Mark as completed
if(isset($_POST['complete'])){
    $check = mysqli_query($conn, "SELECT * FROM user_progress WHERE user_id=$user_id AND module_id=$module_id");
    if(mysqli_num_rows($check) > 0){
        mysqli_query($conn, "UPDATE user_progress SET completed=1 WHERE user_id=$user_id AND module_id=$module_id");
    } else {
        mysqli_query($conn, "INSERT INTO user_progress (user_id,module_id,completed) VALUES ($user_id,$module_id,1)");
    }
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($module['title']); ?> - Lesson</title>
    <style>
        body { font-family: Arial; margin: 0; padding: 0; background: #f4f4f4; }
        .container { max-width: 800px; margin: 20px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.2); }
        h1 { text-align: center; }
        video { width: 100%; border-radius: 10px; margin-top: 20px; }
        p { font-size: 16px; margin-top: 15px; line-height: 1.5; }
        button { padding: 8px 15px; margin: 5px 5px 15px 0; border-radius: 5px; border: none; cursor: pointer; }
        .lang-btn { background: #eee; color: #333; }
        .lang-btn.active { background: #4CAF50; color: white; }
        .voice-btn { background: #4CAF50; color: white; }
        .voice-btn:hover { background: #45a049; }
        .complete-btn { background: #2196F3; color: white; }
        .complete-btn:hover { background: #0b7dda; }
        form { display: inline-block; }
    </style>
</head>
<body>

<div class="container">
    <h1><?php echo htmlspecialchars($module['title']); ?></h1>

    <!-- Language Buttons -->
    <form method="POST" style="margin-bottom: 10px;">
        <button type="submit" name="lang" value="English" class="lang-btn <?php if($language=='English') echo 'active'; ?>">English</button>
        <button type="submit" name="lang" value="Telugu" class="lang-btn <?php if($language=='Telugu') echo 'active'; ?>">Telugu</button>
        <button type="submit" name="lang" value="Hindi" class="lang-btn <?php if($language=='Hindi') echo 'active'; ?>">Hindi</button>
    </form>

    <!-- Voice Assistant Buttons -->
    <button onclick="speakText()" class="voice-btn">🔊 Listen</button>
    <button onclick="window.speechSynthesis.cancel()" class="voice-btn">🛑 Stop</button>

    <!-- Lesson Video -->
    <video controls>
        <source src="<?php echo $module['video_link']; ?>" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

    <!-- Lesson Description -->
    <p><?php echo htmlspecialchars($lesson_text); ?></p>

    <!-- Mark as Completed -->
    <form method="POST">
        <button type="submit" name="complete" class="complete-btn">Mark as Completed ✅</button>
    </form>
</div>

<script>
function speakText() {
    let text = "<?php echo addslashes($module['title'] . '. ' . $lesson_text); ?>";
    let speech = new SpeechSynthesisUtterance(text);

    <?php if($language == "Telugu"): ?>
        speech.lang = "te-IN";
    <?php elseif($language == "Hindi"): ?>
        speech.lang = "hi-IN";
    <?php else: ?>
        speech.lang = "en-US";
    <?php endif; ?>

    speech.rate = 0.9;
    window.speechSynthesis.speak(speech);
}
</script>

</body>
</html>