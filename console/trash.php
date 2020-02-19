<?php
require '../conf/conf.php';
require './islogin.php';

if(!isset($_GET['change_status']) || !isset($_GET['aID']))
{
	die ('Access Denied.');
}

require '../conf/conn.mysql.php';
if($_GET['change_status']=='del')
{
	$sql="DELETE FROM ".$db_name.".articles WHERE a_ID=".$_GET['aID'];
	$conn->query($sql);
	$conn->close();
	Header("Location:./index.php?status=-1");
}
else
{
	$sql="UPDATE ".$db_name.".articles SET a_status=".$_GET['change_status']." WHERE a_ID=".$_GET['aID'];
	$conn->query($sql);
	$conn->close();
	Header("Location:./index.php?status=".$_GET['change_status']);
}