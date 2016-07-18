<?php


$CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
if(!$CONNECTION)
{
	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
	exit();
}else{
	//isset($_GET['action'])?$_GET['action']:'';
	if(isset($_GET['action'])&& $_GET['action']=="upload"){
		
		$id=substr(md5(microtime()),rand(0,26),5);	
		$name = $id.$_POST['name'].'jpeg';
		$sql = "INSERT INTO imagedata (imageName) VALUES ('$name')";
 		//echo $sql;
		$path = "images/$name.jpeg";
	    mysqli_query($CONNECTION,$sql);
		file_put_contents($path,base64_decode($_POST['image']));
		echo "Successfully Uploaded";
		
			
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
		$countrow= mysqli_query($CONNECTION,"select imageName from imagedata where s_no='10'");
	//echo $countrow;	
	$data1 = mysqli_fetch_array($countrow);//print_r($data1);
	
			echo 'http://192.168.1.151/images'.$data1['imageName'];
		 
	
	}
	else {}
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