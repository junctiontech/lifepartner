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
		
		$querySearch="Select * RegisteredUser where EmailID='$EmailID' OR MobileNumber='$MobileNumber'";
		if (mysqli_query($CONNECTION,$querySearch)){
			$result=mysqli_fetch_array($querySearch);
			print_r(array('code'=>"100",
					'result'=>"success",				
					'registeredId'=>$result['registerUserID']
			));
		}
		
		$queryInsert="insert into RegisteredUser(userName,EmailID,MobileNumber) values('$userName','$EmailID','$MobileNumber') ";
		mysqli_query($CONNECTION,$queryInsert);
		$id=mysqli_insert_id($CONNECTION);
	
		
		if (mysqli_affected_rows()>=0){
			$result=mysqli_fetch_array($querySearch);
			print_r(array('code'=>"100",
					'result'=>"success",
					'msg'=>'',
					'registeredId'=>$id
			));
		}else {
			$result=mysqli_fetch_array($querySearch);
			print_r(array('code'=>"200",
					'result'=>"failled",				
					'registeredId'=>0
			));
		}
	
	}elseif ($action=="addProfile"){ 
		 
		
	}

	
	
}