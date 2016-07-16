<?php

$KEY_IMAGE = $_FILES['KEY_IMAGE']['name'];
//print_r($data);
$CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
if(!$CONNECTION)
{
	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
	exit();
}else{
move_uploaded_file($_FILES['KEY_IMAGE']['tmp_name'],'image/'.$KEY_IMAGE['tmp_name']);
		
$sql="inser into tbl_name fields(image) values('$KEY_IMAGE')";
mysqli_query($CONNECTION,$sql);
}