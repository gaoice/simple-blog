<?php 
require '../conf/conf.php';
require './islogin.php';
require '../conf/conn.mysql.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>控制台</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php echo $bootstrap_cdn; ?>
</head>
<body class="bg-light">
<?php require './consolebar.php'; ?>
<div class="container-fluid">
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-2">
		<br/>
		<div class="card rounded-0">
			<div class="card-body">
				<big><p class="card-text">
				<a href="<?php echo $site_loca; ?>/console/edit.php">写文章</a>
				</p></big>
			</div>
		</div>
		<br/>
	</div>
	<div class="col-md-6 bg-white border">
		<br/>
		<table class="table">
		 <thead class="thead-light">
		  <tr>
			<th class="font-weight-light">文章标题</th>
			<th class="font-weight-light">日期</th>
			<th class="font-weight-light">分类</th>
			<th class="font-weight-light">状态</th>
		  </tr>
		</thead>
		<tbody>
		<?php
		//生成操作按钮的函数
		function make_button($aID,$btype)
		{
			global $site_loca;
			if($btype==1)
			{
				?>
				<a class="btn btn-sm text-muted dropdown-toggle" data-toggle="dropdown">操作</a>
				<div class="dropdown-menu">
					<a class="dropdown-item text-warning" href="<?php echo $site_loca; ?>/console/trash.php?change_status=0&aID=<?php echo $aID; ?>">移至草稿箱</a>
					<a class="dropdown-item text-danger" href="<?php echo $site_loca; ?>/console/trash.php?change_status=-1&aID=<?php echo $aID; ?>">移至回收站</a>
					<a class="dropdown-item text-dark" href="<?php echo $site_loca; ?>/read.php/article/<?php echo $aID; ?>">查看</a>
				</div>
				<?php
			}
			else if($btype==0)
			{
				?>
				<a class="btn btn-sm text-muted dropdown-toggle" data-toggle="dropdown">操作</a>
				<div class="dropdown-menu">
					<a class="dropdown-item text-success" href="<?php echo $site_loca; ?>/console/trash.php?change_status=1&aID=<?php echo $aID; ?>">移至已发布</a>
					<a class="dropdown-item text-danger" href="<?php echo $site_loca; ?>/console/trash.php?change_status=-1&aID=<?php echo $aID; ?>">移至回收站</a>
				</div>
				<?php
			}
			else if($btype==-1)
			{
				?>
				<a class="btn btn-sm text-muted dropdown-toggle" data-toggle="dropdown">操作</a>
				<div class="dropdown-menu">
					<a class="dropdown-item text-success" href="<?php echo $site_loca; ?>/console/trash.php?change_status=1&aID=<?php echo $aID; ?>">移至已发布</a>
					<a class="dropdown-item text-warning" href="<?php echo $site_loca; ?>/console/trash.php?change_status=0&aID=<?php echo $aID; ?>">移至草稿箱</a>
					<a class="dropdown-item text-danger" href="<?php echo $site_loca; ?>/console/trash.php?change_status=del&aID=<?php echo $aID; ?>">永久删除</a>
				</div>
				<?php
			}
		}
		//查询的条件
		if(isset($_GET['status']))
			$sqlwhere=" AND a_status=".$_GET['status'];
		else
			$sqlwhere=' AND a_status=1 OR a_status=0';
		//查询出总页数
		$sql="SELECT count(*) as total FROM ".$db_name.".articles WHERE 1=1 ".$sqlwhere;
		$articles_num = $conn->query($sql)->fetch_assoc()["total"];//文章总条数
		$articles_num_page=20;//控制台每页显示的条数
		$page_num=ceil($articles_num/$articles_num_page);  //计算总页数
		//查询的条件
		$page_id=1;
		if(isset($_GET['paged']))// 后台管理参数不用安全检查&& is_numeric($_GET['paged']) && $_GET['paged']>=1 && $_GET['paged']<=$page_num
			$page_id=$_GET['paged'];
		$limitnum=($page_id-1)*$articles_num_page;
		//查询出符合条件的文章
		$sql = "SELECT a_ID, a_title , a_time , a_cate, a_status FROM ".$db_name.".articles WHERE 1=1 ".$sqlwhere." ORDER BY a_time DESC LIMIT ".$limitnum.",".$articles_num_page;
		$result = $conn->query($sql);		
		// 输出每篇文章
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				if($row["a_status"]==1)
				{
					$status='已发布';
					$class='text-success';
				}
				else if($row["a_status"]==0)
				{
					$status='草稿';
					$class='text-warning';
				}
				else if($row["a_status"]==-1)
				{
					$status='回收站';
					$class='text-danger';
				}
				?>
				<tr>
				<td>
					<a class="text-dark" href="<?php echo $site_loca; ?>/console/edit.php?aID=<?php echo $row["a_ID"]; ?>"><?php echo $row["a_title"]; ?></a>
					<?php make_button($row["a_ID"],$row["a_status"]); ?>
				</td>
				<td class="text-muted"><?php echo substr($row["a_time"],0,10); ?></td>
				<td class="text-muted"><?php echo $row["a_cate"]; ?></td>
				<td class="<?php echo $class; ?>"><?php echo $status; ?></td>
				</tr>
				<?php 
			}
		}
		?>
		</tbody>
		</table>
		<?php
		require '../parts/pagination.php';
		if(isset($_GET['status']))
			pagination($site_loca.'/console/index.php?status='.$_GET['status'].'&paged=',$page_id,$page_num);//输出分页标签
		else
			pagination($site_loca.'/console/index.php?paged=',$page_id,$page_num);//输出分页标签
		
		$conn->close();
		?>
	</div>
	<div class="col-md-2">
		<br/>
		<div class="card rounded-0">
			<div class="card-body">
				<big><p class="card-text">
				<?php 
				if(!isset($_GET['status']))
					$sidebarTitle='全部文章';
				else if($_GET['status']==-1)	
					$sidebarTitle='回收站';
				else if($_GET['status']==0)
					$sidebarTitle='草稿';
				else if($_GET['status']==1)
					$sidebarTitle='已发布';
				echo $sidebarTitle.'共'.$articles_num.'篇'; 
				?>
				</p></big>
			</div>
		</div>
		<br/>
		<div class="card rounded-0">
			<div class="card-body">
				<big><p class="card-text">
				<a href="<?php echo $site_loca; ?>/exit.php">登出</a>
				</p></big>
			</div>
		</div>
	</div>
</div>

</div>
</body>
</html>