<?php


$CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
if(!$CONNECTION)
{
	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
	exit();
}else{
	//isset($_GET['action'])?$_GET['action']:'';
	if(isset($_GET['action'])&& $_GET['action']=="upload"){
		$Totaldata=json_decode($_POST['json'],true);
		$registerID= $_POST['registeredId'];//echo $registerID;
	//	print_r($data);
		
		$resultUpload=array();
		foreach ($Totaldata['profileData'] as $data){
		
		$id=substr(md5(microtime()),rand(0,26),5);
		$name = $id.'_'.$registerID.'_'.date('d-m-Y_H:i:s').'.jpeg';
				
		$queryInsert= "insert into Profiles(`registerUserID`, `gender`, `firstName`, `lastName`, `fatherName`, `dateOfBirth`, `birthPlace`, `heightOfUser`, `birthTime`, `highestQualification`, `TypeOfBusiness`, `business`, `income`, `TypeOfFatherBusiness`, `fatherBusiness`, `fatherIncome`, `gautr`, `gautrNanihal`, `zodiacSign`, `star`, `saturn`, `manglik`, `currentAddress`, `permanentAddress`, `emailId`, `mobileNumber`, `WhatsAppNumber`, `dateOfCreation`, `lastUpdationDate`, `imageName` ) values('$registerID','".$data['gender']."','".$data['firstName']."','".$data['lastName']."','".$data['fatherName']."','".$data['dateOfBirth']."','".$data['birthPlace']."','".$data['heightOfUser']."','".$data['birthTime']."','".$data['highestQualification']."','".$data['TypeOfBusiness']."','".$data['business']."','".$data['income']."','".$data['TypeOfFatherBusiness']."','".$data['fatherBusiness']."','".$data['fatherIncome']."','".$data['gautr']."','".$data['gautrNanihal']."','".$data['zodiacSign']."','".$data['star']."','".$data['saturn']."','".$data['manglik']."','".$data['currentAddress']."','".$data['permanentAddress']."','".$data['emailId']."','".$data['mobileNumber']."','".$data['WhatsAppNumber']."','".date('d-m-Y H:i:s')."','".date('d-m-Y H:i:s')."','$name') ";
	
		$a=mysqli_query($CONNECTION,$queryInsert);
		$profile_no=mysqli_insert_id($CONNECTION);
		
		 if ($a>0){
				$path = "images/$name";
	   $image= $data['profilePhoto'];
		file_put_contents($path,base64_decode($image));
		
				
		 
		 $resultUpload[] = array('result'=>"success", 'profileID'=>$profile_no);
		 }
				else {
						 $resultUpload[] = array('result'=>"error");
				} 
		}
		
		print_r(json_encode($resultUpload));
		
	
// 		$sql = "INSERT INTO imagedata (imageName) VALUES ('$name')";
//  		//echo $sql;
// 		$path = "images/$name";
// 	    mysqli_query($CONNECTION,$sql);
// 		file_put_contents($path,base64_decode($_POST['image']));
// 		echo "Successfully Uploaded";
		
			
// 		$queryInsert="insert into imagedata(imageName)values('$image')";
// 		mysqli_query($CONNECTION,$queryInsert);
			
		
// 		print_r(mysqli_affected_rows());
// 		if (mysqli_affected_rows()>0){
// 			$path = "images/$name.png";
// 			file_put_contents($path,base64_decode($image));
// 			echo "Successfully Uploaded";
// 		}
// 		else {
// 			echo "failled Insertion";
// 		}
			
		
		
	
	}else if(isset($_GET['action'])&& $_GET['action']=="download"){
		//echo 'hii';die;
		$countrow= mysqli_query($CONNECTION,"select imageName from imagedata where s_no='12'");
	//echo $countrow;	
	$data1 = mysqli_fetch_array($countrow);//print_r($data1);
	
			echo 'http://192.168.1.151/lifepartner/images/'.$data1['imageName'];
		 
	
	}
else if(isset($_GET['action'])&& $_GET['action']=="Search"){
		//echo 'hii';die;
		$countrow= mysqli_query($CONNECTION,"select imageName from imagedata where s_no='12'");
	//echo $countrow;	
	$data1 = mysqli_fetch_array($countrow);//print_r($data1);
	
			echo 'http://192.168.1.151/lifepartner/images/'.$data1['imageName'];
		 
	
	}
}





// $KEY_IMAGE = $_FILES['KEY_IMAGE']['name'];
// //print_r($data);
// $CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
// if(!$CONNECTION)
// {
// 	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
// 	exit();
// }else{
// move_uploaded_file($_FILES['KEY_IMAGE']['tmp_name'],'image/'.$KEY_IMAGE['tmp_name']);
		
// $sql="inser into tbl_name fields(image) values('$KEY_IMAGE')";
// mysqli_query($CONNECTION,$sql);


//}