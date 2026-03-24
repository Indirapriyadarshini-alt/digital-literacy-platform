<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "digital_literacy";

$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: set charset (important for regional languages)
mysqli_set_charset($conn, "utf8");

?>