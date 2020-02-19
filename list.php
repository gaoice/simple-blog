<?php 
require './conf/conf.php';
require './conf/conn.mysql.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $site_name; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php echo $bootstrap_cdn; ?>
</head>
<body class="bg-light">
<?php require './parts/navbar.php'; ?>
<div class="container-fluid">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6 bg-white border">
	<br/>
		<table class="table">
		 <thead class="thead-light">
		  <tr>
			<th class="font-weight-light">文章标题</th>
			<th class="font-weight-light">发表时间</th>
			<th class="font-weight-light">分类</th>
		  </tr>
		</thead>
		<tbody>
		<?php
		//查询出总页数
		$sql="SELECT count(*) as total FROM ".$db_name.".articles WHERE a_status=1";
		$articles_num = $conn->query($sql)->fetch_assoc()["total"];//文章总条数
		$articles_num_page=20;//控制台每页显示的条数
		$page_num=ceil($articles_num/$articles_num_page);  //计算总页数
		//查询的条件
		$page_id=1;
		if(isset($_GET['c']) && is_numeric($_GET['c']) && $_GET['c']>=1 && $_GET['c']<=$page_num)
			$page_id=$_GET['c'];
		$limitnum=($page_id-1)*$articles_num_page;
		//查询出符合条件的文章
		$sql = "SELECT a_ID, a_title , a_time , a_cate, a_status FROM ".$db_name.".articles WHERE a_status=1 ORDER BY a_time DESC LIMIT ".$limitnum.",".$articles_num_page;
		$result = $conn->query($sql);		
		// 输出每篇文章
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				echo '<tr><td><a class="text-dark" href="'.$site_loca.'/read.php/article/'.$row["a_ID"].'">'.$row["a_title"].'</a></td>
				<td>'.substr($row["a_time"],0,10).'</td><td>'.$row["a_cate"].'</td></tr>
				';
			}
		}
		?>
		</tbody>
		</table>
		<?php
		require './parts/pagination.php';pagination($site_loca.'/list.php/',$page_id,$page_num);//输出分页标签
		
		$conn->close();
		?>
</div>
<?php //require "./parts/sidebar.php"; ?>
</div>
</div>
</body>
</html>