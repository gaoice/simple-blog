<?php 
session_start();
//if(isset($_SESSION["thisBlogUser"]))
//{
//	Header("Location:./console"); 
//	exit;
//}
require './conf/conf.php';
if(isset($_POST['email']) && isset($_POST['pwd']) && $_POST['email']==$admin_name && $_POST['pwd']==$admin_pass)
{
	$_SESSION["thisBlogUser"]=$admin_name;
	Header("Location:./console"); 
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>登录</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php echo $bootstrap_cdn; ?>
</head>
<body class="bg-white">
<?php require './parts/navbar.php'; ?>
<div class="container-fluid">
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
	<br/><br/><br/><br/>
	<div class="card bg-light">
		<div class="card-body">
			<form action="login.php" method="post">
				<div class="form-group">
				  <input type="" class="form-control" placeholder="用户名" name="email">
				</div>
				<div class="form-group">
				  <input type="password" class="form-control" placeholder="密码" name="pwd">
				</div>
				<div class="row justify-content-center">
					<button type="submit" class="btn btn-secondary">&nbsp;登&nbsp;&nbsp;&nbsp;录&nbsp;</button>
				</div>
			</form>
		</div>
	</div>
	</div>
</div>
</div>
</body>
</html>