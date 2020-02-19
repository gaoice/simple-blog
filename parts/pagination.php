<?php
/*输出页码
$ahref 页码链接
$page_id 当前页面
$page_num 总页数
*/
function pagination($ahref,$page_id,$page_num)
{
	echo '<br><ul class="pagination justify-content-center">';
	if($page_id!=1)
		echo '<li class="page-item"><a class="page-link text-success" href="'.$ahref.($page_id-1).'"><</a></li>';
	for($i=$page_id-2;$i<=$page_id+2;$i++)
	{
		if($i>=1&&$i<=$page_num)
		{
			if($i==$page_id)
				echo '<li class="page-item"><a class="page-link text-muted bg-light" href="'.$ahref.$i.'">'.$i.'</a></li>';
			else
				echo '<li class="page-item"><a class="page-link text-success" href="'.$ahref.$i.'">'.$i.'</a></li>';
		}
	}
	if($page_num!=0&&$page_id!=$page_num)
		echo '<li class="page-item"><a class="page-link text-success" href="'.$ahref.($page_id+1).'">></a></li>';
	echo "</ul>";
}