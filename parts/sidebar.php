<?php
/*
统一侧边栏样式
使用本文件前确保已经引入./conf/conf.php
*/
?>
<div class="col-md-3">
	<br/>
	<div class="card rounded-0">
		<div class="card-body">
			<p>文章分类</p>
			<?php
			//输出自定义标签分类
			for($i=0;$i<$c_count;$i++)
			{
				if(isset($category_en) && $category_en==$carray_en[$i])
					echo '<a class="btn bg-info text-white" href="'.$site_loca.'/index.php">'.$carray_zh[$i].'</a>';
				else
					echo '<a class="btn text-info" href="'.$site_loca.'/category.php/'.$carray_en[$i].'">'.$carray_zh[$i].'</a>';
			}
			?>
		</div>
	</div>
	<br/>
	<div class="card rounded-0">
		<div class="card-body">
			<p class="card-text">
			小工具
			</p>
		</div>
	</div>
	<br/>
	<div class="card rounded-0">
		<div class="card-body border-bottom">
			<img class="" src="<?php echo $self_touxiang; ?>" alt="card image" style="width:100%">
		</div>
		<div class="card-body">
		  <h5 class="card-text"><?php //echo $self_name; ?></h5>
		  <i class="fa fa-envelope-o"></i>&nbsp;<a class="text-muted" href="mailto:<?php echo $self_mail; ?>"><?php echo $self_mail; ?></a>
		  <br><br>
		  <i class="fa fa-github"></i>&nbsp;<a class="text-muted" href="<?php echo $self_github; ?>"><?php echo $self_github; ?></a>
		</div>
	</div>
	<br/>
</div>