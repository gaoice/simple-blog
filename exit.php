<?php 
session_start();
unset($_SESSION["thisBlogUser"]);
Header("Location:./login.php");
exit; 