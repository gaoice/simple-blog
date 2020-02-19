<?php
require './conf/conf.php';
$category_zh='';
$category_en='';
$page_id=1;
if(isset($_GET['c']))
{
	$getArray=explode('/',$_GET['c']);
	//确定category
	for($i=0;$i<$c_count;$i++)
	{
		if($getArray[0]==$carray_en[$i])
		{
			$category_zh=$carray_zh[$i];
			$category_en=$carray_en[$i];
			break;
		}
	}
	if(count($getArray)>=2)
	{
		if(is_numeric($getArray[1]))
			$page_id=$getArray[1];
	}
}
//echo $category_en.'<br>'.$category_zh.'<br>'.$page_id;
require './pageshow.php';