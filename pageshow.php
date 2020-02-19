<?php
if(!isset($page_id))
	die ('Access Denied.');
require_once './conf/conf.php';
require_once './conf/conn.mysql.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $site_name; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php echo $bootstrap_cdn; ?>
</head>
<body class="bodybg">
<?php require './parts/navbar.php'; ?>
<div class="container-fluid">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-5">
	<?php
	//查询的条件
	if(isset($category_zh))
		$sqlwhere=" AND a_cate='".$category_zh."'";
	else
		$sqlwhere='';
	//查询出符合条件的总页数
	$sql="SELECT count(*) as total FROM ".$db_name.".articles WHERE a_status=1 ".$sqlwhere;
	$articles_num = $conn->query($sql)->fetch_assoc()["total"];//文章总条数
	$articles_num_page=$page_anum;//每页显示的条数
	$page_num=ceil($articles_num/$articles_num_page);  //计算总页数
	//查询的条件
	if($page_id<1 || $page_id>$page_num)
		$page_id=1;
	$limitnum=($page_id-1)*$articles_num_page;
	//查询出符合条件的文章
	$sql = "SELECT a_ID, a_title, a_content, a_time, a_cate FROM ".$db_name.".articles WHERE a_status=1 ".$sqlwhere." ORDER BY a_time DESC LIMIT ".$limitnum.",".$articles_num_page;
	$result = $conn->query($sql);		
	// 输出每篇文章
	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc()) 
		{
			$content=str_replace("\r\n"," ",$row["a_content"]);//$content=str_replace(" ","&nbsp;",$content);
			$content=strip_tags($content);//去除html标签
			$content=mb_substr($content,0,90,'utf-8').'...';//生成摘要
			//$content=str_replace("\r\n","<br/>",$row["a_content"]);//转换换行符<div class="card"></div>
			?>
			<div class="card rounded-0">
			<div class="card-body article">
				<h4><a class="text-dark font-weight-light" href="<?php echo $site_loca.'/read.php/article/'.$row["a_ID"]; ?>"><?php echo $row["a_title"]; ?></a></h4>
				<p class="text-muted"><i class="fa fa-calendar-o"></i>&nbsp;<?php echo substr($row["a_time"],0,10); if($row["a_cate"]!=''){?>&nbsp;&nbsp;<i class="fa fa-tag"></i>&nbsp;<?php echo $row["a_cate"];} ?></p>
				<p><?php echo $content; ?></p>
			</div>
			</div>
			<br/>
			<?php
		}
	}
	$ahref=$site_loca.'/index.php/';
	if(isset($category_en))
		$ahref=$site_loca.'/category.php/'.$category_en.'/';
		
	require './parts/pagination.php';pagination($ahref,$page_id,$page_num);//输出分页标签
	
	$conn->close();
	?>
	<br/>
</div>
<?php require "./parts/sidebar.php"; ?>
</div>
</div>
<?php require "./parts/footer.php"; ?>
</body>
</html>