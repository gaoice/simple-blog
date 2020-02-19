<?php
$page_id=1;
if(isset($_GET['c']))
{
	$getArray=explode('/',$_GET['c']);
	if(is_numeric($getArray[0]))
		$page_id=$getArray[0];
}
require './pageshow.php';