<?php
//cdn<link href="https://cdn.bootcss.com/material-design-icons/3.0.1/iconfont/material-icons.css" rel="stylesheet">
$bootstrap_cdn=
'
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
'
;
//站点信息
$site_loca='';//网站所在目录
$db_name='simple-blog';//网站数据库

$site_name='blog name';//网站名字
$admin_name='admin';//管理员账号
$admin_pass='admin';//管理员密码

//侧边栏标签控制
$carray_zh=['编程语言','算法','数据结构','数据库','前端','后端','区块链','人工智能','杂谈'];//允许检索的目录中文
$carray_en=['pl','cc','ds','database','frontend','backend','bc','ai','zatan'];//允许检索的目录英文
$c_count=count($carray_zh);

//每页文章数控制
$page_anum=5;

//个人信息
$self_touxiang='./test.jpg';
$self_name='name';
$self_mail='mymail@gmail.com';
$self_github='https://github.com';