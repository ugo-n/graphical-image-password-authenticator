<?php
include 'common.php';
pHeader();
?>

<form action="signup-confirm.php"
        method="post"> 
        
Create a Username: <input name="username" type = "text" maxlength="12" size="12"/>
<!--limit username length to make display consistent-->
<input type="submit" value="Sign Up"/>

</form>


<?php
pFooter();
?>