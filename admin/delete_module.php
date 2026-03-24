
<?php
include("../includes/db.php");

// Check if id is passed
if(isset($_GET['id'])){

    $id = $_GET['id'];

    // Delete module
    mysqli_query($conn,"DELETE FROM modules WHERE id=$id");

    // Redirect back to dashboard
    header("Location: dashboard.php");
}
?>