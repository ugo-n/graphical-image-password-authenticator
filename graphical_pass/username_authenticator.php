<?php
include 'db_controller.php';
session_start();
$_SESSION["username"] = $_POST['username'];
$username = $_SESSION['username'];

$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// lookup all hints from array if $q is different from ""

if ($username !== "" and strlen($username) >= 3){
  $username = strtolower($username);
  $sql ="SELECT * FROM userinfo WHERE username='$username'";
  if ($result = $conn->query($sql)) {
    $row_cnt = mysqli_num_rows($result);
    if($row_cnt != 0){
        header('location: signup-page.php?err=1');
    }else{
        header('location: create-password.php');
    }
    //echo "username has already been used";
    
  } else {
    echo "Error creating table: " . $conn->error;
 }
}
?>