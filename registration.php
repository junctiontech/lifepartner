<?php

$data = json_decode($_POST['json'],true);
//print_r($data);
$CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
if(!$CONNECTION)
{
	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
	exit();
}else{
	//isset($_GET['action'])?$_GET['action']:'';
	
	if(isset($_GET['action'])&& $_GET['action']=="register"){
		
		$userName = $data['userName'];
		$EmailID = $data['EmailID'];
		$MobileNumber = $data['MobileNumber'];
		
		$querySearch="Select * from RegisteredUser,Profiles where RegisteredUser.MobileNumber='$MobileNumber' AND RegisteredUser.registerUserID=Profiles.registerUserID";
		$query=mysqli_query($CONNECTION,$querySearch);
		$result=mysqli_fetch_array($query);
		if(count($result)>0) 
		{
			$aa= $result['registerUserID'];
		
			foreach ($result as $proData){			
				
			print_r($proData);
			$searchResult= array('serverProfileId'=>$proData['no'],
					'category'=>$proData['category'],
					'gender'=>$proData['gender'],
					'firstName'=>$proData['firstName'],
					'lastName'=>$proData['lastName'],
					'fatherName'=>$proData['fatherName'],
					'dateOfBirth'=>$proData['dateOfBirth'],
					'birthPlace'=>$proData['birthPlace'],
					'heightOfUser'=>$proData['heightOfUser'],
					'birthTime'=>$proData['birthTime'],
					'highestQualification'=>$proData['highestQualification'],
					'TypeOfBusiness'=>$proData['TypeOfBusiness'],
					'business'=>$proData['business'],
					'income'=>$proData['income'],
					'TypeOfFatherBusiness'=>$proData['TypeOfFatherBusiness'],
					'fatherBusiness'=>$proData['fatherBusiness'],
					'fatherIncome'=>$proData['fatherIncome'],
					'gautr'=>$proData['gautr'],
					'gautrNanihal'=>$proData['gautrNanihal'],
					'zodiacSign'=>$proData['zodiacSign'],
					'star'=>$proData['star'],
					'saturn'=>$proData['saturn'],
					'manglik'=>$proData['manglik'],
					'currentAddress'=>$proData['currentAddress'],
					'permanentAddress'=>$proData['permanentAddress'],
					'emailId'=>$proData['emailId'],
					'mobileNumber'=>$proData['mobileNumber'],
					'WhatsAppNumber'=>$proData['WhatsAppNumber'],
					'imageName'=>"http://192.168.1.151/lifepartner/images/".$proData['imageName'],
					
						
			);print_r($searchResult);die;
			
			}
			
			
			
			
			$re= array('code'=>"100",
					'result'=>"search",				
					'registeredId'=>$aa,
					'profiles'=>$searchResult
			);
			
			//print_r(json_encode($re));
			
		}else {
			$queryInsert="insert into RegisteredUser(userName,EmailID,MobileNumber) values('$userName','$EmailID','$MobileNumber') ";
		//print_r($queryInsert);
			mysqli_query($CONNECTION,$queryInsert);
			$id=mysqli_insert_id($CONNECTION);		
			
			if (mysqli_affected_rows()>=0){
				$result=mysqli_fetch_array($queryInsert);
				$re=array('code'=>"100",
						'result'=>"inserted",
						'msg'=>'',
						'registeredId'=>$id
				);
				
				print_r(json_encode($re));
			}else {
			
				$re=array('code'=>"200",
						'result'=>"failled",
						'registeredId'=>0
				);
				print_r(json_encode($re));
			}
		}
		
	
	
		
		
	}elseif ($action=="addProfile"){ 
		 
		
	}

	
	
}