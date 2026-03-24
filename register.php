<?php
session_start();
include("includes/db.php");

$message = "";

// Handle form submission
if(isset($_POST['register'])){
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];

    // Default language for all users
    $language = "English";

    // Basic validation
    if(empty($name) || empty($email) || empty($password)){
        $message = "All fields are required!";
    } else {

        // Check if email already exists
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if(mysqli_num_rows($check) > 0){
            $message = "Email already registered!";
        } else {

            // Hash the password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insert into database
            $insert = mysqli_query($conn, 
                "INSERT INTO users (name,email,password,language) 
                 VALUES ('$name','$email','$password_hash','$language')"
            );

            if($insert){
                $message = "Registration successful! You can login now.";
            } else {
                $message = "Something went wrong!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Digital Literacy Platform</title>
    <style>
        body { font-family: Arial; background-color: #f2f2f2; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .register-container { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 0 15px rgba(0,0,0,0.2); width: 380px; }
        h1 { text-align: center; margin-bottom: 20px; }
        input { width: 100%; padding: 10px; margin: 8px 0; border-radius: 6px; border: 1px solid #ccc; }
        button { width: 100%; padding: 10px; background: #4CAF50; color: white; border: none; border-radius: 6px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #45a049; }
        .message { text-align: center; margin-bottom: 10px; font-weight: bold; }
        .error { color: red; }
        .success { color: green; }
        a { color: #4CAF50; text-decoration: none; }
    </style>
</head>

<body>
<div class="register-container">
    <h1>Register</h1>

    <?php 
    if($message != "") {
        $class = (strpos($message, 'successful') !== false) ? 'success' : 'error';
        echo "<p class='message $class'>$message</p>"; 
    }
    ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
    </form>

    <p style="text-align:center; margin-top:10px;">
        Already have an account? <a href="login.php">Login here</a>
    </p>
</div>
</body>
</html>