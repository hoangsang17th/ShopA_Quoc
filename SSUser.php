<?php
session_start();
if(!isset($_SESSION["Email_User"])){
header("Location: http://localhost/Mr.%20Quoc/OutSide/login.php");
exit(); 
}
?>