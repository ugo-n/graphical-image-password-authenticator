<?php
$error = "";
if(isset($_GET['err'])){
        $error = $_GET['err'];
}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
<title>Password Prototype</title>
<link rel="stylesheet" href="prototype.css">
<body>


<div class="index-box">
        <?php  
                if (!$error == '') {
                        if($error == 2){
                                echo "<span style='color:red'>This user does not exist</span> <br><br>";
                        }elseif($error == 1){
                                echo "<span style='color:red'>Please enter a valid username</span> <br><br>";
                        }
                }
        ?>

        <form action="enter-password.php"
                method="post"> 
                
        Enter Username: <input name="username" type = "text" maxlength="12" size="12"/>
        <!--limit username length to make display consistent-->
        <input type="submit" name="submit1" value="Login"/>

        </form>
</div>
</body>
</html>