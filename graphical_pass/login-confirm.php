<?php
include 'common.php';
include 'db_controller.php';

session_start();
$username = $_SESSION["username"];
header("refresh:3;url=https://www.google.com/");

?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Password Prototype</title>
    <link rel="stylesheet" href="prototype.css">
</head>
<body>
<div class='index-box'>
    <p>Welcome <?php echo $username?>!</p>
</div>
</body>
</html>