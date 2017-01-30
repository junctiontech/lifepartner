
<?php

$CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
if(!$CONNECTION)
{
	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
	exit();
}else{
		$Totaldata=json_decode($_POST['json'],true);//print_r($Totaldata);die;
		$registerID= $_POST['registeredId'];
		$resultUpload=array();
		$income = $Totaldata['profileData'][0]['income'];
		$income = str_replace(',', '',$income);//echo $income;die;
		$ProfileData = $Totaldata['profileData'];
		foreach ($ProfileData as $data){	
		$id=substr(md5(microtime()),rand(0,26),5);
		$name = $id.'_'.$registerID.'_'.date('dmy_H:i:s').'.jpeg';
		$aadharName = $id.'_'.$registerID.'_uniqueId'.'_'.date('dmy_H:i:s').'.jpeg';
		$serverProfileId= $data['serverProfileId'];
        $s_no=$data['S_no'];
        if ($serverProfileId==''){
       		/************************ check profile category wise not more than 3 ********************************/
       		/*$queryProfileData="select category from Profiles where registerUserID='$registerID' and category='".$data['category']."'";
       		$query=mysqli_query($CONNECTION,$queryProfileData);
       		while($rowProfileData=mysqli_fetch_array($query))
       		{
       			$result[]=$rowProfileData['category'];
       		}*/
       		/************************ check profile category wise not more than 3 ********************************/
			$queryInsert= "insert into Profiles(`registerUserID`,`category` ,`gender`, `firstName`, `lastName`, `fatherName`, `dateOfBirth`,`noOfKids`,`maritalStatus`, `birthPlace`, `heightOfUser`, `birthTime`, `highestQualification`, `userJobProfile`,`TypeOfBusiness`, `business`, `income`,`fatherJobProfile`, `TypeOfFatherBusiness`, `fatherBusiness`, `fatherIncome`, `gautr`, `gautrNanihal`, `zodiacSign`, `star`, `saturn`, `manglik`, `currentAddress`, `permanentAddress`, `emailId`, `mobileNumber`, `WhatsAppNumber`, `dateOfCreation`, `lastUpdationDate`, `imageName`,`uniqueImageId`, `city`, `caste`, `subcaste`,`status`) values('$registerID','".$data['category']."','".$data['gender']."','".$data['firstName']."','".$data['lastName']."','".$data['fatherName']."','".$data['dateOfBirth']."','".$data['no_of_kids']."','".$data['marital_status']."','".$data['birthPlace']."','".$data['heightOfUser']."','".$data['birthTime']."','".$data['highestQualification']."','".$data['userJobProfile']."','".$data['TypeOfBusiness']."','".$data['business']."','$income','".$data['fatherJobProfile']."','".$data['TypeOfFatherBusiness']."','".$data['fatherBusiness']."','".$data['fatherIncome']."','".$data['gautr']."','".$data['gautrNanihal']."','".$data['zodiacSign']."','".$data['star']."','".$data['saturn']."','".$data['manglik']."','".$data['currentAddress']."','".$data['permanentAddress']."','".$data['emailId']."','".$data['mobileNumber']."','".$data['WhatsAppNumber']."','".date('d-m-Y H:i:s')."','".date('d-m-Y H:i:s')."','$name','$aadharName','".$data['city']."','".$data['caste']."','".$data['subcaste']."','unblock')";
			$a=mysqli_query($CONNECTION,$queryInsert);
			$profile_no=mysqli_insert_id($CONNECTION);
			if ($a>0){
				$path = "images/$name";
				$image= $data['profilePhoto'];
				$aadharPath = "images/$aadharName";
			    $aadharImage= $data['userAadharIdPath'];
				file_put_contents($path,base64_decode($image));
				file_put_contents($aadharPath,base64_decode($aadharImage));
				
				$resultUpload[] = array('result'=>"success", 'S_no'=>$s_no,'profileID'=>$profile_no."");
			}
			else {
				$resultUpload[] = array('result'=>"error",'S_no'=>$s_no);
			}
			
		}else {	 
			$querySearch="Select imageName,uniqueImageId from Profiles where no='$serverProfileId'";				
		$ress=	mysqli_query($CONNECTION,$querySearch);
			//echo $querySearch;die;
		$imagename=mysqli_fetch_assoc($ress);
			// $imagename =mysqli_result_assoc($ress);
			$tempName =$imagename['imageName']; 
			$filepath = "images/$tempName";
			
			$tempNameAadhar =$imagename['uniqueImageId'];
			$filepathAdhar = "images/$tempNameAadhar";
			
				if (unlink($filepath) && unlink($filepathAdhar)){
					$path = "images/$name";
					$image= $data['profilePhoto'];
					file_put_contents($path,base64_decode($image));
					$aadharPath = "images/$aadharName";
					$aadharImage= $data['userAadharIdPath'];
					file_put_contents($aadharPath,base64_decode($aadharImage));
					$sql = "UPDATE Profiles SET gender='".$data['gender']."', city= '".$data['city']."' , caste= '".$data['caste']."' , subcaste= '".$data['subcaste']."' , firstName= '".$data['firstName']."' , lastName='".$data['lastName']."',`fatherName`='".$data['fatherName']."', `dateOfBirth`='".$data['dateOfBirth']."',`noOfKids`='".$data['no_of_kids']."',`maritalStatus`='".$data['marital_status']."', `birthPlace`='".$data['birthPlace']."', `heightOfUser`='".$data['heightOfUser']."', `birthTime`='".$data['birthTime']."', `highestQualification`='".$data['highestQualification']."',`userJobProfile`='".$data['userJobProfile']."', `TypeOfBusiness`='".$data['TypeOfBusiness']."', `business`='".$data['business']."',`income`='$income',`fatherJobProfile`='".$data['fatherJobProfile']."', `TypeOfFatherBusiness`='".$data['TypeOfFatherBusiness']."', `fatherBusiness`='".$data['fatherBusiness']."', `fatherIncome`='".$data['fatherIncome']."', `gautr`='".$data['gautr']."', `gautrNanihal`='".$data['gautrNanihal']."', `zodiacSign`='".$data['zodiacSign']."', `star`='".$data['star']."', `saturn`='".$data['saturn']."', `manglik`='".$data['manglik']."', `currentAddress`='".$data['currentAddress']."', `permanentAddress`='".$data['permanentAddress']."', `emailId`='".$data['emailId']."', `mobileNumber`='".$data['mobileNumber']."', `WhatsAppNumber`='".$data['WhatsAppNumber']."', `lastUpdationDate`='".date('d-m-Y H:i:s')."', `imageName`='$name',`uniqueImageId`='$aadharName' WHERE registerUserID='$registerID' AND no='$serverProfileId'";
					//echo "hiiii";print_r($sql);die;
					$resultupdate =	mysqli_query($CONNECTION,$sql);
						
					if ($resultupdate){
						$path = "images/$name";
						$image= $data['profilePhoto'];
						file_put_contents($path,base64_decode($image));
						$resultUpload[] = array('result'=>"success", 'S_no'=>$s_no,'profileID'=>$serverProfileId);
					}
			  }else $resultUpload[] =  array('result'=>"image deletion failled");				
				
			}
			
	  }
		
		print_r(json_encode($resultUpload));	
}

