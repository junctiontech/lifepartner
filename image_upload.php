<?php


$CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
if(!$CONNECTION)
{
	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
	exit();
}else{
	//isset($_GET['action'])?$_GET['action']:'';
	if(isset($_GET['action'])&& $_GET['action']=="upload"){
	
		$image = $_POST['image'];
		$name= $_POST['name'];
		
		$sql = "INSERT INTO imagedata (imageName) VALUES ('$image')";
		print_r($CONNECTION);die;
		echo $CONNECTION;die;
		echo mysqli_query($CONNECTION,$sql);die;
		if(mysqli_query($CONNECTION,$sql)){
			file_put_contents($path,base64_decode($image));
			echo "Successfully Uploaded";
		}else {
			echo "failled Insertion";
		}
		
		
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
		$countrow=mysqli_query($CONNECTION,"select imageName from imagedata where s_no='1'");
		$data1 = mysqli_fetch_array($countrow);
		echo $data1['imageName'];
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