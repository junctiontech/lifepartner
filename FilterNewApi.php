<?php

$data = json_decode($_POST['json'],true);
$CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
if(!$CONNECTION)
{
	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
	exit();
}else{
	
	print_r("Hello");die();
	if(isset($_GET['action'])&&!empty($_GET['action']) &&$_GET['action']=='searchCaste')
	{
		$param=json_decode($_POST['data'],true);
	}
}