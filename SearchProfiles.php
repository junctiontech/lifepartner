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
	$manglik= $_POST['manglik'];
	$city= $_POST['city'];
	$minHeight=$_POST['min_height'];
	$maxHeight=$_POST['max_height'];
	$caste=$_POST['caste'];
	$subCaste=$_POST['subcaste'];
	$registeredId = $_POST['registeredId'];
	if(!empty($registeredId)){ $query=" registerUserID!='$registeredId'"; }
	if(!empty($bride_groom)){ $query.=" and gender='$bride_groom'"; }
	if(!empty($city && $city!=='Select')){ $query.=" and city='$city'"; }
	if(!empty($caste && $caste!=='Select')){ $query.=" and caste='$caste'"; }
	if(!empty($subCaste && $subCaste!=='Select')){ $query.=" and subcaste='$subCaste'"; }
	if(!empty($minHeight) && $minHeight!=='Select'){ $query.=" and heightOfUser>='$minHeight' and heightOfUser<='$maxHeight'"; }
	$querySearch="Select * from Profiles where $query LIMIT 100";
	$query=mysqli_query($CONNECTION,$querySearch);
 	$searchResult=array();
 	if($query){
			while($result=mysqli_fetch_array($query)){
			$from = new DateTime($result['dateOfBirth']);
			$to   = new DateTime('today');
			$age = $from->diff($to)->y;
			//	print_r($age);die;
			if ($min_age<=$age && $age <=$max_age){
				
				$searchResult[]= array(
						'profileId'=>$result['no'],
						'registerUserID'=>$result['registerUserID'],
						'gender'=>$bride_groom,
						'firstName'=>$result['firstName'],
						'lastName'=>$result['lastName'],
						'fatherName'=>$result['fatherName'],
						'dateOfBirth'=>$result['dateOfBirth'],
						'birthPlace'=>$result['birthPlace'],
						'heightOfUser'=>$result['heightOfUser'],
						'birthTime'=>$result['birthTime'],
						'highestQualification'=>$result['highestQualification'],
						'userJobProfile'=>$result['userJobProfile'],
						'TypeOfBusiness'=>$result['TypeOfBusiness'],
						'business'=>$result['business'],
						'income'=>$result['income'],
						'fatherJobProfile'=>$result['fatherJobProfile'],
						'TypeOfFatherBusiness'=>$result['TypeOfFatherBusiness'],
						'fatherBusiness'=>$result['fatherBusiness'],
						'fatherIncome'=>$result['fatherIncome'],
						'gautr'=>$result['gautr'],
						'gautrNanihal'=>$result['gautrNanihal'],
						'zodiacSign'=>$result['zodiacSign'],
						'star'=>$result['star'],
						'saturn'=>$result['saturn'],
						'manglik'=>$result['manglik'],
						'currentAddress'=>$result['currentAddress'],
						'permanentAddress'=>$result['permanentAddress'],
						'emailId'=>$result['emailId'],
						'mobileNumber'=>$result['mobileNumber'],
						'WhatsAppNumber'=>$result['WhatsAppNumber'],
						'imageName'=>"http://".$_SERVER['HTTP_HOST']."/images/".$result['imageName'],
						'age'=>	$age,
					    'city'=>$result['city'],
						'caste'=>$result['caste'],
						'subcaste'=>$result['subcaste']
			
				);
			}
		}
		
	
		
	}
	//'imageName'=>"http://192.168.1.151/lifepartner/images/".$result['imageName']
	print_r(json_encode($searchResult));

	
	
	
}