<?php
unset($_SESSION['IS_LOGIN']);
setcookie('_ad_',md5(1),time() + 0,'','','',true);
header('location:login.php');
die();
?>