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
		
		$querySearch="Select * from RegisteredUser where EmailID='$EmailID' OR MobileNumber='$MobileNumber'";
		echo $querySearch;
		if (mysqli_query($CONNECTION,$querySearch)){
		echo 'hii';
			$result=mysqli_fetch_array(mysqli_query($CONNECTION,$querySearch));print_r($result);
			echo $result['registerUserID']; echo 'byee';die;
			
			//mysqli_fetch_array($querySearch); 
			//$result=mysqli_fetch_array($querySearch);
		
			$aa= $result['registerUserID'];
			$re= array('code'=>"100",
					'result'=>"success",				
					'registeredId'=>$aa
			);
			
			print_r(json_encode($re));
		}else {
			$queryInsert="insert into RegisteredUser(userName,EmailID,MobileNumber) values('$userName','$EmailID','$MobileNumber') ";
		
			mysqli_query($CONNECTION,$queryInsert);
			$id=mysqli_insert_id($CONNECTION);		
			
			if (mysqli_affected_rows()>=0){
				$result=mysqli_fetch_array($queryInsert);
				$re=array('code'=>"100",
						'result'=>"success",
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