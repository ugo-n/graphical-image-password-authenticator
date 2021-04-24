<?php
include 'common.php';
include 'db_controller.php';

session_start();
$username = $_SESSION["username"];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$pass3 = $_POST['pass3'];
$pass4 = $_POST['pass4'];
$pass5 = $_POST['pass5'];

// $pass_array = explode(",",$password);
// unset($pass_array[5]);
// $pass_confirm = implode(",", $pass_array);
// $confirm = "";
// $pass = file_get_contents("pass-test.txt");
// if(strcmp($pass,$pass_confirm) === 0){
//     $confirm = "passwords match!";
// }



?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <title>Password Prototype</title>
    <link rel="stylesheet" href="prototype.css">
</head>
<body>
    <p><?php echo $pass;?></p>
    <p><?php print_r($pass_confirm)?></p>
    <p><?php print($confirm)?></p>
</body>
</html>