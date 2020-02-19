<?php
require '../conf/conf.php';
require './islogin.php';

if(!isset($_POST['title']) || !isset($_POST['content']) || !isset($_POST['time']) || !isset($_POST['cate']) || !isset($_POST['status']))
{
	die ('Access Denied.');
}
//通过全部合法性检查，将信息添加到数据库
require '../conf/conn.mysql.php';
if(isset($_GET['aID']))//修改文章
{
	$stmt = $conn->prepare("UPDATE ".$db_name.".articles SET a_title=?, a_content=?, a_time=?, a_cate=?, a_status=? WHERE a_ID=?");
	$stmt->bind_param("ssssii", $title, $content, $time, $cate, $status, $id);
	$id=$_GET['aID'];
}
else
{
	$stmt = $conn->prepare("INSERT INTO ".$db_name.".articles (a_title, a_content, a_time, a_cate, a_status) VALUES (?, ?, ?, ?, ?)");//预处理及绑定
	$stmt->bind_param("ssssi", $title, $content, $time, $cate, $status);
}
// 设置参数并执行
$title=$_POST['title'];
$content=$_POST['content'];
if($_POST['time']=='')
{
	date_default_timezone_set('PRC');
	$time=date('Y-m-d H:i:s',time());
}
else
	$time=$_POST['time'];
$cate=$_POST['cate'];
$status=$_POST['status'];

$stmt->execute();

$stmt->close();
$conn->close();
Header("Location:./"); 