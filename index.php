<!DOCTYPE html>
<html>
<head>
    <title>Digital Literacy Platform</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body{
            margin:0;
            font-family: Arial;
            background: linear-gradient(to right, #4CAF50, #81C784);
            color:white;
        }
        .container{
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            height:100vh;
            text-align:center;
        }
        img.logo{width:150px; margin-bottom:20px;}
        h1{font-size:48px; margin:10px 0;}
        p{font-size:20px; margin-bottom:30px;}
        .btn{
            display:inline-block;
            padding:15px 30px;
            margin:10px;
            background:white;
            color:#4CAF50;
            text-decoration:none;
            font-weight:bold;
            border-radius:30px;
            transition:0.3s;
        }
        .btn:hover{
            background:#f1f1f1;
            transform:scale(1.05);
        }
    </style>
</head>
<body>
<div class="container">
    <img src="assets/logo.png" class="logo" alt="Logo">
    <h1>Digital Literacy Platform</h1>
    <p>Empowering Rural Women Entrepreneurs</p>
    <div>
        <a href="register.php" class="btn">Register</a>
        <a href="login.php" class="btn">Login</a>
    </div>
</div>
</body>
</html>