<?php
session_start();
include("includes/db.php");

$message = "";

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password'])){

            // Store session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['language'] = $user['language'];

            header("Location: dashboard.php");
            exit();

        } else {
            $message = "Incorrect password!";
        }

    } else {
        $message = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Digital Literacy Platform</title>

    <style>
        body{
            font-family: Arial;
            background: linear-gradient(to right, #4CAF50, #81C784);
            display:flex; 
            justify-content:center; 
            align-items:center; 
            height:100vh;
            color:white;
        }

        .container{
            background:white; 
            color:#333;
            padding:30px; 
            border-radius:15px; 
            width:350px; 
            box-shadow:0 5px 15px rgba(0,0,0,0.2);
            text-align:center;
        }

        h2{margin-bottom:20px;}

        input{
            width:100%; 
            padding:10px; 
            margin:10px 0; 
            border-radius:5px; 
            border:1px solid #ccc;
        }

        button{
            width:100%; 
            padding:10px; 
            background:#4CAF50; 
            color:white; 
            border:none; 
            border-radius:25px; 
            cursor:pointer;
        }

        button:hover{background:#45a049;}

        .message{
            color:red; 
            margin-top:10px;
        }

        a{
            text-decoration:none; 
            color:#4CAF50;
        }

        img.logo{
            width:90px; 
            margin-bottom:15px;
        }
    </style>
</head>

<body>

<div class="container">
    <img src="assets/logo.png" class="logo" alt="Logo">

    <h2>Login</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <?php 
    if($message != ""){
        echo "<p class='message'>$message</p>"; 
    } 
    ?>

    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>

</body>
</html>