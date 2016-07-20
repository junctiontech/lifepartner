<?php

//print_r($data);
$CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
if(!$CONNECTION)
{
	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
	exit();
}else{
		
//	$min_age= 21;
//	$max_age= 35;
	$min_age= $_POST['min_age'];
	$max_age= $_POST['max_age'];
	$bride_groom= $_POST['bride_groom'];
	$gautr= $_POST['gautr'];
// 	$gautr_nanihal= $_POST['gautr_nanihal'];
	$manglik= $_POST['manglik'];
	$income= $_POST['income'];
	
	
	
$querySearch="Select * from Profiles where gender='$bride_groom' AND manglik='$manglik' AND income='$income' AND gautr='$gautr'";

//print_r($querySearch);
 	$query=mysqli_query($CONNECTION,$querySearch);
 $searchResult=array();
 	if($query){
		//print_r(mysqli_fetch_array($query));die;
	
		while($result=mysqli_fetch_array($query)){
			$from = new DateTime($result['dateOfBirth']);
			$to   = new DateTime('today');
			$age = $from->diff($to)->y;
			//	print_r($age);die;
			if ($min_age<=$age && $age <=$max_age){
				
				$searchResult[]= array('gender'=>$bride_groom,
						'firstName'=>$result['firstName'],
						'lastName'=>$result['lastName'],
						'fatherName'=>$result['fatherName'],
						'dateOfBirth'=>$result['dateOfBirth'],
						'birthPlace'=>$result['birthPlace'],
						'heightOfUser'=>$result['heightOfUser'],
						'birthTime'=>$result['birthTime'],
						'highestQualification'=>$result['highestQualification'],
						'TypeOfBusiness'=>$result['TypeOfBusiness'],
						'business'=>$result['business'],
						'income'=>$result['income'],
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
						'imageName'=>"http://192.168.1.151/lifepartner/images/".$result['imageName']
							
			
				);
			}
		}
		
	
		
	}
	//'imageName'=>"http://192.168.1.151/lifepartner/images/".$result['imageName']
	print_r(json_encode($searchResult));

	
	
	
}