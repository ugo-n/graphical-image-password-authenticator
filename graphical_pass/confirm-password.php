<?php


require "db_controller.php";
session_start();

$username = $_SESSION["username"];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$pass3 = $_POST['pass3'];
$pass4 = $_POST['pass4'];
$pass5 = $_POST['pass5'];

if(strlen($pass1) == 0 or strlen($pass2) == 0 or strlen($pass3) == 0 or strlen($pass4) == 0 or strlen($pass5) == 0 ){
  header('location: create-password.php?err=1');
  exit();
}

$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO `userinfo`(`username`, `pass_id1`, `pass_id2`, `pass_id3`, `pass_id4`, `pass_id5`) 
VALUES ('$username','$pass1','$pass2','$pass3','$pass4','$pass5')";

if ($conn->query($sql) === TRUE) {
    header('Location: login-page.php');
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
// remove all session variables
session_unset();
// destroy the session
session_destroy();

?>