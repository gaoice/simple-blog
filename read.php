<?php
if(isset($_GET['c']))
{
	$getArray=explode('/',$_GET['c']);
	$getCount=count($getArray);
	if($getCount>=2 && 'article'==$getArray[0] && is_numeric($getArray[1]))
	{
		$aID=$getArray[1];
	}
}
if(!isset($aID))
{
	//Header("Location:/index.php"); 
	exit;
}
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
	<script>
	$(document).ready(function()
	{
		$("img").attr("class","img-fluid rounded");
	});
	</script>
</head>
<body class="bodybg">
<?php require './parts/navbar.php'; ?>
<div class="container-fluid">
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-5">
	<?php
	//查询出符合条件的文章
	$sql = "SELECT a_title, a_content, a_time, a_cate FROM ".$db_name.".articles WHERE a_status=1 AND a_ID=".$aID;
	$result = $conn->query($sql);		
	// 输出文章
	if ($result->num_rows > 0) 
	{
		$row = $result->fetch_assoc();
		$content=$row["a_content"];
		//$content=str_replace("\r\n<","<",$content);//删除html标签前面的换行
		//$content=str_replace(">\r\n",">",$content);//删除html标签后面的换行
		$content=str_replace("\r\n","<br/>",$content);//转换换行符
		//$content=str_replace("<br/><br/>","</p><p>",$content);//转换段落
		//$content=str_replace("<p></p>","",$content);//删除空段落
		?>
		<div class="card rounded-0">
		<div class="card-body article">
			<h3 class="font-weight-light"><?php echo $row["a_title"]; ?></h3>
			<p class="text-muted"><i class="fa fa-calendar-o"></i>&nbsp;<?php echo substr($row["a_time"],0,4).' 年 '.substr($row["a_time"],5,2).' 月 '.substr($row["a_time"],8,2).' 日';if($row["a_cate"]!=''){?>&nbsp;&nbsp;<i class="fa fa-tag"></i>&nbsp;<?php echo $row["a_cate"];} ?></p>
			<p><?php echo $content; ?></p>
		</div>
		</div>
		<?php
	}
	$conn->close();
	?>
	<br/><br/>
	<?php require './comment/comment.php'; ?>
</div>
<?php require "./parts/sidebar.php"; ?>
</div>
</div>
<?php require "./parts/footer.php"; ?>
</body>
</html>