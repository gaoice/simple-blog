<?php
$conn="";

$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);// 创建连接
if ($conn->connect_error) die("连接失败: " . $conn->connect_error);// 检测连接
$conn->query("set names 'utf8'");//设置数据的字符集utf-8