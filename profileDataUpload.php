<?php


$CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
if(!$CONNECTION)
{
	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
	exit();
}else{
		$Totaldata=json_decode($_POST['json'],true);
		$registerID= $_POST['registeredId'];//echo $registerID;
		
		$resultUpload=array();
		foreach ($Totaldata['profileData'] as $data){
		
		$id=substr(md5(microtime()),rand(0,26),5);
		$name = $id.'_'.$registerID.'_'.date('dmy_H:i:s').'.jpeg';
        $serverProfileId= $data['serverProfileId'];
        $s_no=$data['S_no'];
		if ($serverProfileId==''){
			$queryInsert= "insert into Profiles(`registerUserID`,`category` ,`gender`, `firstName`, `lastName`, `fatherName`, `dateOfBirth`, `birthPlace`, `heightOfUser`, `birthTime`, `highestQualification`, `userJobProfile`,`TypeOfBusiness`, `business`, `income`,`fatherJobProfile`, `TypeOfFatherBusiness`, `fatherBusiness`, `fatherIncome`, `gautr`, `gautrNanihal`, `zodiacSign`, `star`, `saturn`, `manglik`, `currentAddress`, `permanentAddress`, `emailId`, `mobileNumber`, `WhatsAppNumber`, `dateOfCreation`, `lastUpdationDate`, `imageName` ) values('$registerID','".$data['category']."','".$data['gender']."','".$data['firstName']."','".$data['lastName']."','".$data['fatherName']."','".$data['dateOfBirth']."','".$data['birthPlace']."','".$data['heightOfUser']."','".$data['birthTime']."','".$data['highestQualification']."','".$data['userJobProfile']."','".$data['TypeOfBusiness']."','".$data['business']."','".$data['income']."','".$data['fatherJobProfile']."','".$data['TypeOfFatherBusiness']."','".$data['fatherBusiness']."','".$data['fatherIncome']."','".$data['gautr']."','".$data['gautrNanihal']."','".$data['zodiacSign']."','".$data['star']."','".$data['saturn']."','".$data['manglik']."','".$data['currentAddress']."','".$data['permanentAddress']."','".$data['emailId']."','".$data['mobileNumber']."','".$data['WhatsAppNumber']."','".date('d-m-Y H:i:s')."','".date('d-m-Y H:i:s')."','$name') ";
			
			
			$a=mysqli_query($CONNECTION,$queryInsert);
			$profile_no=mysqli_insert_id($CONNECTION);
			
			
			if ($a>0){
				$path = "images/$name";
				$image= $data['profilePhoto'];
				file_put_contents($path,base64_decode($image));
					
				$resultUpload[] = array('result'=>"success", 'S_no'=>$s_no,'profileID'=>$profile_no."");
			}
			else {
				$resultUpload[] = array('result'=>"error",'S_no'=>$s_no);
			}
			
		}else {	
			$querySearch="Select imageName from Profiles where no='$s_no'";				
			mysqli_query($CONNECTION,$querySearch);
			 $resultsearch =mysqli_fetch_array($querySearch);
			 $imagename=$resultsearch['imageName'];
			 $filepath="images/$imagename";
			 
				if (unlink($filepath)){
					echo "deleted";
					$path = "images/$name";
					$image= $data['profilePhoto'];
					file_put_contents($path,base64_decode($image));
						
					$resultUpload[] = array('result'=>"success", 'S_no'=>$s_no,'profileID'=>$profile_no."");
					
					$sql = "UPDATE Profiles SET gender='".$data['gender']."', firstName= '".$data['firstName']."' , lastName='".$data['lastName']."',`fatherName`='".$data['fatherName']."', `dateOfBirth`='".$data['dateOfBirth']."', `birthPlace`='".$data['birthPlace']."', `heightOfUser`='".$data['heightOfUser']."', `birthTime`='".$data['birthTime']."', `highestQualification`='".$data['highestQualification']."',`userJobProfile`='".$data['userJobProfile']."', `TypeOfBusiness`='".$data['TypeOfBusiness']."', `business`='".$data['business']."', `income`='".$data['income']."',`fatherJobProfile`='".$data['fatherJobProfile']."', `TypeOfFatherBusiness`='".$data['TypeOfFatherBusiness']."', `fatherBusiness`='".$data['fatherBusiness']."', `fatherIncome`='".$data['fatherIncome']."', `gautr`='".$data['gautr']."', `gautrNanihal`='".$data['gautrNanihal']."', `zodiacSign`='".$data['zodiacSign']."', `star`='".$data['star']."', `saturn`='".$data['saturn']."', `manglik`='".$data['manglik']."', `currentAddress`='".$data['currentAddress']."', `permanentAddress`='".$data['permanentAddress']."', `emailId`='".$data['emailId']."', `mobileNumber`='".$data['mobileNumber']."', `WhatsAppNumber`='".$data['WhatsAppNumber']."', `lastUpdationDate`='".date('d-m-Y H:i:s')."', `imageName`='$name' WHERE registerUserID='$registerID' AND no='$serverProfileId'";
					//print_r($sql);die;
					$resultupdate =	mysqli_query($CONNECTION,$sql);
						
					if ($resultupdate){
						$path = "images/$name";
						$image= $data['profilePhoto'];
						file_put_contents($path,base64_decode($image));
					
						$resultUpload[] = array('result'=>"success", 'S_no'=>$s_no,'profileID'=>$serverProfileId);
					
					}else $resultUpload[] =  array('result'=>"success");
						
		}else $resultUpload[] =  array('result'=>"image deletion failled");				
				
			
			}
		}
		
		
		
		print_r(json_encode($resultUpload));
		
	
		
		
	
	
}

