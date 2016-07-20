<?php

//print_r($data);
$CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
if(!$CONNECTION)
{
	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
	exit();
}else{
	$min_age= $_POST['min_age'];
	$max_age= $_POST['max_age'];
	$bride_groom= $_POST['bride_groom'];
	$gautr= $_POST['gautr'];
	$gautr_nanihal= $_POST['gautr_nanihal'];
	$manglik= $_POST['manglik'];
	$income= $_POST['income'];
	
// 	$querySearch="Select * from Profiles where EmailID='$EmailID' or MobileNumber='$MobileNumber'";
// 	$query=mysqli_query($CONNECTION,$querySearch);
	$from = new DateTime('1993-07-31');
	$to   = new DateTime('today');
	echo $from->diff($to)->y;
	
	
	
}