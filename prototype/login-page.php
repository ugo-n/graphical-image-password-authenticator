<?php
include 'common.php';
pHeader();
?>
<div class="index-box">
        <form action="enter-password.php"
                method="post"> 
                
        Enter Username: <input name="username" type = "text" maxlength="12" size="12"/>
        <!--limit username length to make display consistent-->
        <input type="submit" value="Login"/>

        </form>
</div>
<?php
pFooter();
?>