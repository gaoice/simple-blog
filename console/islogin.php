<?php
/*此文件统一判断 是否登录
使用此文件前先包含/conf/conf.php
*/
session_start();
if(!isset($_SESSION["thisBlogUser"]) || $_SESSION["thisBlogUser"]!==$admin_name)
{
	Header("Location:../login.php");
	exit;
}
