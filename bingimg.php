<?php
require './conf/conf.php';
require './conf/conn.mysql.php';

//存取今天的图片
date_default_timezone_set('PRC');
$today=str_replace('-','',date("Y-m-d"));
$result = $conn->query('SELECT id FROM '.$db_name.'.bingimg WHERE enddate='.$today);
if ($result->num_rows == 0) 
{
	//获取当日bing图片
	$bingimgxml=file_get_contents("https://cn.bing.com/HPImageArchive.aspx?format=xml&idx=0&n=1");
	$xml=simplexml_load_string($bingimgxml);
	$xmlarray=array($xml->image->enddate,"https://cn.bing.com".$xml->image->url,"https://cn.bing.com".$xml->image->urlBase."_1920x1080.jpg",$xml->image->copyright);
	//存入数据库
	$stmt = $conn->prepare("INSERT INTO ".$db_name.".bingimg (enddate, url, urlBase, copyright) VALUES (?, ?, ?, ?)");//预处理及绑定
	$stmt->bind_param("isss", $enddate, $url, $urlBase, $copyright);
	$enddate=$xmlarray[0];
	$url=$xmlarray[1];
	$urlBase=$xmlarray[2];
	$copyright=$xmlarray[3];
	$stmt->execute();
	
	$stmt->close();
}
/*function getaweek($conn,$db_name)//存入一周的数据到数据库
{
	$stmt = $conn->prepare("INSERT INTO ".$db_name.".bingimg (enddate, url, urlBase, copyright) VALUES (?, ?, ?, ?)");//预处理及绑定
	$stmt->bind_param("isss", $enddate, $url, $urlBase, $copyright);
	for($i=7;$i>=0;$i--)
	{
		$bingimgxml=file_get_contents("https://cn.bing.com/HPImageArchive.aspx?format=xml&idx=".$i."&n=1");
		$xml=simplexml_load_string($bingimgxml);
		$xmlarray=array($xml->image->enddate,"https://cn.bing.com".$xml->image->url,"https://cn.bing.com".$xml->image->urlBase."_1920x1080.jpg",$xml->image->copyright);
		$enddate=$xmlarray[0];
		$url=$xmlarray[1];
		$urlBase=$xmlarray[2];
		$copyright=$xmlarray[3];
		$stmt->execute();
	}
	$stmt->close();
}*/
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
<div class="col-md-6">
	<br/>
	<?php
	$page_id=1;
	if(isset($_GET['c']))
	{
		$getArray=explode('/',$_GET['c']);
		if(is_numeric($getArray[0]))
			$page_id=$getArray[0];
	}
	//查询出总页数
	$sql="SELECT count(*) as total FROM ".$db_name.".bingimg";
	$img_num = $conn->query($sql)->fetch_assoc()["total"];//img总条数
	$img_num_page=$page_anum;//每页显示的条数
	$page_num=ceil($img_num/$img_num_page);  //计算总页数
	//检查要查询的页面是否合理
	if($page_id<1 || $page_id>$page_num)
		$page_id=1;
	$limitnum=($page_id-1)*$img_num_page;
	//查询页面
	$sql = 'SELECT distinct enddate, url, urlBase, copyright FROM '.$db_name.'.bingimg  ORDER BY enddate DESC LIMIT '.$limitnum.','.$img_num_page;
	$result = $conn->query($sql);		
	//输出
	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc()) 
		{
			?>
			<div class="card border-0">
				<img src="<?php echo str_replace('1920x1080','640x360',$row["urlBase"]); ?>" alt="card image" style="width:100%;">
				<div class="card-body">
					<p class="card-text"><?php echo $row["enddate"].'&nbsp;&nbsp;&nbsp;'.$row["copyright"]; ?><br>
					<a target="_blank" href="<?php echo str_replace('1920x1080','1366x768',$row["urlBase"]); ?>" class="card-link">1366x768</a>
					<a target="_blank" href="<?php echo $row["urlBase"]; ?>" class="card-link">1920x1080</a>
					</p>
				</div>
			</div>
			<br>
			<?php
		}
	}
	
	require './parts/pagination.php';pagination($site_loca.'/bingimg.php/',$page_id,$page_num);//输出分页标签
	
	$conn->close();
	?>
	<br><br>
</div>
<?php //require "./parts/sidebar.php"; ?>
</div>
</div>
</body>
</html>