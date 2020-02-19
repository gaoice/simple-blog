<?php
/*统一导航栏样式,背景样式
使用本文件前确保已经引入../conf/conf.php
<style>body,nav{background:url(/i/conf/night.jpg);}</style>background-attachment:fixed;https://bing-1252779123.cos.ap-shanghai.myqcloud.com/bj/v-31.png  rgba(0,0,0,0.8)
*/
?>
<style>
.bodybg{background:#ededef;}
.navbg{background:rgba(36,36,36,0.8);}
{background:url(https://bing-1252779123.cos.ap-shanghai.myqcloud.com/bj/v-21.png);}
.article p{line-height:36px;color:#333}
</style>

	
<nav class="navbar navbar-expand-sm navbar-dark navbg">
	<a class="navbar-brand font-weight-light" href="#"><?php echo $site_name; ?></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
    <ul class="navbar-nav">
		<li class="nav-item"><a class="nav-link" href="<?php echo $site_loca; ?>/index.php">首页</a></li>
		<li class="nav-item"><a class="nav-link <?php if(strpos($_SERVER['PHP_SELF'],"list.php")) echo 'active';?>" href="<?php echo $site_loca; ?>/list.php/">目录</a></li>
		<li class="nav-item"><a class="nav-link <?php if(strpos($_SERVER['PHP_SELF'],"bingimg.php")) echo 'active';?>" href="<?php echo $site_loca; ?>/bingimg.php/">壁纸</a></li>
		<li class="nav-item"><a class="nav-link" target="_blank" href="http://bing123.org">关于</a></li>
		<li class="nav-item"><a class="nav-link" target="_blank" href="<?php echo $site_loca; ?>/login.php">&nbsp;&nbsp;&nbsp;</a></li>
	</ul>
	</div>
</nav>

<br>