<?php
session_start();

// Hardcoded admin credentials
$admin_user = "admin";
$admin_pass = "password";

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($user == $admin_user && $pass == $admin_pass){
        $_SESSION['admin'] = $user;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        body {font-family: Arial; background:#f9f9f9;}
        .login {width:300px;margin:100px auto;padding:20px;border:1px solid #ccc;background:white;border-radius:8px;}
        input {width:100%;padding:8px;margin:5px 0;}
        button {width:100%;padding:8px;background:#4CAF50;color:white;border:none;border-radius:5px;}
        h2{text-align:center;}
        p.error{color:red;}
    </style>
</head>
<body>

<div class="login">
    <h2>Admin Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    <?php if(isset($error)){ echo "<p class='error'>$error</p>"; } ?>
</div>

</body>
</html>