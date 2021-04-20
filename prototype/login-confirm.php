<?php
include 'common.php';
$password = $_POST["password"];
$pass_array = explode(",",$password);
unset($pass_array[5]);
$pass_confirm = implode(",", $pass_array);
$confirm = "";
$pass = file_get_contents("pass-test.txt");
if(strcmp($pass,$pass_confirm) === 0){
    $confirm = "passwords match!";
}


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