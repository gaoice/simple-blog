<?php
/*统一控制台栏样式
使用本文件前确保已经引入../conf/conf.php
<style>body,nav{background:url(https://bing-1252779123.cos.ap-shanghai.myqcloud.com/bj/v-35.png); background-attachment:fixed;}</style>
*/

?>
<style>.rgba{background:rgba(66,66,66,0.9);}</style>
<nav class="navbar navbar-expand-sm navbar-dark rgba">
	<a class="navbar-brand" href="<?php echo $site_loca; ?>/index.php">管理中心</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
    <ul class="navbar-nav">
		<li class="nav-item"><a class="nav-link <?php if(strpos($_SERVER['PHP_SELF'],"index.php") && !isset($_GET['status'])) echo 'active'; ?>" href="<?php echo $site_loca; ?>/console/index.php">全部文章</a></li>
		<li class="nav-item"><a class="nav-link <?php if(isset($_GET['status']) && $_GET['status']==1) echo 'active'; ?>" href="<?php echo $site_loca; ?>/console/index.php?status=1">已发布</a></li>
		<li class="nav-item"><a class="nav-link <?php if(isset($_GET['status']) && $_GET['status']==0) echo 'active'; ?>" href="<?php echo $site_loca; ?>/console/index.php?status=0">草稿</a></li>
		<li class="nav-item"><a class="nav-link <?php if(isset($_GET['status']) && $_GET['status']==-1) echo 'active'; ?>" href="<?php echo $site_loca; ?>/console/index.php?status=-1">回收站</a></li>
		<li class="nav-item"><a class="nav-link" href="#">&nbsp;&nbsp;&nbsp;</a></li>
		<li class="nav-item"><a class="nav-link <?php if(strpos($_SERVER['PHP_SELF'],"edit.php") && !isset($_GET['aID'])) echo 'active'; ?>" href="<?php echo $site_loca; ?>/console/edit.php">写文章</a></li>
    </ul>
	</div>  
</nav>