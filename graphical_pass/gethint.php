<?php
// Array with names
require "db_controller.php";

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";




$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// lookup all hints from array if $q is different from ""

if ($q !== "" and strlen($q) >= 3){
  $q = strtolower($q);
  $sql ="SELECT * FROM userinfo WHERE username='$q'";
  if ($result = $conn->query($sql)) {
    $row_cnt = mysqli_num_rows($result);
    if($row_cnt != 0){
        $hint = "Username is not available";
        $result->close();
    }else{
        $hint = "Username is available!";
    }
    //echo "username has already been used";
    
  } else {
    echo "Error creating table: " . $conn->error;
 }
 $row_cnt = 0;
  
}

$conn->close();

// Output "no suggestion" if no hint was found or output correct values

echo $hint === "" ? "Username is too short" : $hint;

?>