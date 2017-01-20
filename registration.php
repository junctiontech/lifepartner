<?php //$userdata=$this->session->userdata('username'); ?>
<?php

$data = json_decode($_POST['json'],true);
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
		
		$querySearch="Select * from RegisteredUser,Profiles where RegisteredUser.MobileNumber='$MobileNumber' and RegisteredUser.registerUserID=Profiles.registerUserID";//echo $querySearch;
		$query=mysqli_query($CONNECTION,$querySearch);
		//print_r($query);die;
		$count=mysqli_num_rows($query);
		while($result=mysqli_fetch_assoc($query))
		{    
			$row[]=$result;
		}
		if(count($row)>0) 
		{   //echo $row;die;
			$updateRegistrationInfo="UPDATE RegisteredUser SET EmailID='$EmailID',userName='$userName' WHERE MobileNumber='$MobileNumber'";
			mysqli_query($CONNECTION,$updateRegistrationInfo);
			foreach ($row as $result)
			{
				$aa= $result['registerUserID'];
				$searchResult[]= array('serverProfileId'=>$result['no'],
					'category'=>$result['category'],
					'gender'=>$result['gender'],
					'firstName'=>$result['firstName'],
					'lastName'=>$result['lastName'],
					'fatherName'=>$result['fatherName'],
					'dateOfBirth'=>$result['dateOfBirth'],
					'no_of_kids'=>$result['noOfKids'],
					'marital_status'=>$result['maritalStatus'],
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
					'city'=>$result['city'],
					'caste'=>$result['caste'],
					'subcaste'=>$result['subcaste'],
					'status'=>$result['unblock'],
					//'imageName'=>"http://".$_SERVER['HTTP_HOST']."/images/".$result['imageName'],
					//'uniqueImageId'=>"http://".$_SERVER['HTTP_HOST']."/images/".$result['uniqueImageId'],
						
 					'imageName'=>"http://lifepartner.zeroerp.com/images/".$result['imageName'],
 					'uniqueImageId'=>"http://lifepartner.zeroerp.com/images/".$result['uniqueImageId'],
 					);
			
			}
			
						
			$re= array('code'=>"100",
					'result'=>"search",				
					'registeredId'=>$aa,
					'profiles'=>$searchResult
			);
			
			print_r(json_encode($re));
			
		}else { 	
			$queryInsert="insert into RegisteredUser(userName,EmailID,MobileNumber) values('$userName','$EmailID','$MobileNumber') ";
			mysqli_query($CONNECTION,$queryInsert);
			$id=mysqli_insert_id($CONNECTION);		
			if (mysqli_affected_rows()>=0){
				$result=mysqli_fetch_array($queryInsert);
				$re=array('code'=>"200",
						'result'=>"inserted",
						'msg'=>'',
						'registeredId'=>$id
				);
				
				print_r(json_encode($re));
			}else {
			
				$re=array('code'=>"300",
						'result'=>"failled",
						'registeredId'=>0
				);
				print_r(json_encode($re));
			}
		}
		
	}elseif ($action=="addProfile"){ 
		 
	}
}