<?php 
require '../conf/conf.php';
require './islogin.php';

$editTitle='写文章';
$aTitle="";
$aContent="";
$aTime="";
$aCate="";
$aStatus="";

$formaction=$site_loca.'/console/save.php';
$buttontext='&nbsp;发&nbsp;&nbsp;&nbsp;布&nbsp;';

if(isset($_GET['aID']) && is_numeric($_GET['aID']))//修改文章
{
	require '../conf/conn.mysql.php';
	$sql = "SELECT a_title, a_content, a_time, a_cate ,a_status FROM ".$db_name.".articles WHERE a_ID=".$_GET['aID'];
	$result = $conn->query($sql);
	if ($result->num_rows > 0) 
	{
		$row = $result->fetch_assoc();
		$aTitle=$row["a_title"];
		$aContent=$row["a_content"];
		$aTime=$row["a_time"];
		$aCate=$row["a_cate"];
		$aStatus=$row["a_status"];
		$editTitle='修改文章';
		
		$formaction=$site_loca.'/console/save.php?aID='.$_GET['aID'];
		$buttontext='&nbsp;更&nbsp;&nbsp;&nbsp;新&nbsp;';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $editTitle; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php echo $bootstrap_cdn; ?>
	<script src="fwb.js"></script>
	<style>
	.form-control:focus{box-shadow:none;}
	</style>
</head>
<body class="bg-light">
<?php require './consolebar.php'; ?>
<div class="container-fluid">
<br/><br/>
<form action="<?php echo $formaction; ?>" method="post">
	<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="form-group">
			<input class="form-control rounded-0" placeholder="在此输入标题" id="title" name="title" value="<?php echo $aTitle; ?>">
		</div>
		<div class="form-group">
			<div class="border border-bottom-0" style="padding:5px;background:#f1f1f1">
				<button type="button" class="btn btn-sm text-muted" id="strong">b</button>
				<button type="button" class="btn btn-sm text-muted" id="em">i</button>
				<button type="button" class="btn btn-sm text-muted" id="code">code</button>
				<button type="button" class="btn btn-sm text-muted" id="blockquote">b-quote</button>
				<button type="button" class="btn btn-sm text-muted" id="del">del</button>
				<button type="button" class="btn btn-sm text-muted" id="ins">ins</button>
				<button type="button" class="btn btn-sm text-muted" id="a">link</button>
				<button type="button" class="btn btn-sm text-muted" id="img">img</button>
				<button type="button" class="btn btn-sm text-muted" id="ul">ul</button>
				<button type="button" class="btn btn-sm text-muted" id="ol">ol</button>
				<button type="button" class="btn btn-sm text-muted" id="li">li</button>
			</div>
			<textarea class="form-control rounded-0 border" style="resize:none;" rows="22" id="content" name="content"><?php echo $aContent; ?></textarea>
			<div class="border border-top-0" style="padding:2px 5px 2px 5px;background:#f1f1f1"><small>正在<?php echo $editTitle.'《'.$aTitle.'》'; ?></small></div>
		</div>
	</div>
	<div class="col-md-2">
		<input class="form-control rounded-0" placeholder="留空为当前时间" name="time" value="<?php echo $aTime; ?>">
		<label class="text-muted"><small>YYYY-MM-DD hh:mm:ss</small></label>
		<br>
		<input class="form-control rounded-0" placeholder="分类" name="cate" value="<?php echo $aCate; ?>">
		<br>
		<select class="form-control rounded-0" name="status">
			<option value="1"<?php if($editTitle=='修改文章' && $aStatus==1) echo 'selected'; ?>>直接发布</option>
			<option value="0"<?php if($editTitle=='修改文章' && $aStatus==0) echo 'selected'; ?>>存为草稿</option>
		</select>
		<br>
	</div>
	</div>		
	<div class="row justify-content-center"><button type="submit" class="btn btn-dark"><?php echo $buttontext; ?></button></div>
</form>
<br><br>
</div>

</body>
</html>