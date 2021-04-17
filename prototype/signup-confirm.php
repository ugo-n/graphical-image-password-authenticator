<?php
include 'common.php';
pHeader();
?>
//if username valid redirect to create password_get_info
//if not, go back to create username page

<h1>sign up success, try logging in now</h1>
<div>
    <a href="./login-page.php"> Login now</a>
</div>
<?php
pFooter();
?>