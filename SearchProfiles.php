<?php

$CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
if(!$CONNECTION)
{
	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
	exit();
}else{

	/* 
	$searchResult = $_POST;
	
	print_r(json_encode($searchResult));
	die();
	 */
	
	
	$min_age= $_POST['min_age'];
	$max_age= $_POST['max_age'];//echo $min_age;echo $max_age;die;
	$bride_groom= $_POST['bride_groom'];
	$manglik= $_POST['manglik'];
	$city= $_POST['city'];
	$minHeight=$_POST['min_height'];
	$maxHeight=$_POST['max_height'];
	$income=$_POST['income'];
	$income_above_below=$_POST['income_above_below'];
	$explode=explode(' ',$income);
	$incomes=$explode[0].'00000';
	$caste=$_POST['caste'];
	$subCaste=$_POST['subcaste'];
	$registeredId = $_POST['registeredId'];//echo $registeredId;die;
	if(!empty($registeredId)){ $query =" registerUserID!='$registeredId' and status='unblock' "; }
	if(!empty($bride_groom)){ $query .=" and gender='$bride_groom'"; }
	if(isset($manglik) && !empty($manglik))
	{
		$query .=" and manglik='$manglik'";
	}
	
	if(isset($income_above_below)&&!empty($income_above_below))
	{
		if(strcasecmp($income_above_below,'above')==0)
		{
			$incomeIdentity='>';
			if(!empty($incomes) && $incomes!=='Select'){ $query .=" and income!='0' and income>=$incomes "; }
		}
		if(strcasecmp($income_above_below,'below')==0)
		{
			$incomeIdentity='<'; $none='none';
			if(!empty($incomes) && $incomes!=='Select'){ $query .=" and income<=$incomes "; }
		}
	}
	
	if(!empty($city && $city!=='Select'))
	{ 
		$query .=" and city='$city'"; 
	}
	if(!empty($caste && $caste!=='Select'))
	{ 
		$query .=" and caste='$caste'";
	}
	if(!empty($subCaste && $subCaste!=='Select'))
	{ 
		$query .=" and subcaste='$subCaste'"; 
	}
	/* if(!empty($minHeight) && $minHeight!=='Select')
	{ 
		$query .=" and heightOfUser>='$minHeight' and heightOfUser<='$maxHeight'"; 
		//$query .=" and ROUND(heightOfUser, 1) and heightOfUser>='$minHeight' and heightOfUser<='$maxHeight'";
	} */
	$querySearch="Select * from Profiles where $query LIMIT 100";
	
//	print_r($querySearch);die();
	
	$query=mysqli_query($CONNECTION,$querySearch); 
 	$searchResult=array();
 	if(mysqli_num_rows($query)!=0)
 	 {   
 	 	while($result=mysqli_fetch_array($query))
		 {   
		 	
		 //	print_r("test");
		 //	print_r($result['dateOfBirth']);
		 
		 	
		 	if(isset($result['gender'])&& !empty($result['gender'])&& $result['gender']==$bride_groom)
		 	{
		 		print_r("Hello");
		 		$queryRequestContact="select * from requestContact where requestRegisterUserID = 1 and profileID='".$result['no']."'";
				$sql=mysqli_query($CONNECTION,$queryRequestContact);
				if(mysqli_num_rows($sql))
				{
					//print_r($result['city']);
					print_r("entry in requestcontact");
				}
				else 
				{ 
					
					//print_r("in else");
					if($result['dateOfBirth'] == 'Select Date')
					{
						print_r("continue");
						continue;
						//goto withoutDate;
					}
					
					$from = new DateTime($result['dateOfBirth']);
					$to   = new DateTime('today');
					$age = $from->diff($to)->y;
					
					//print_r($age."\n");
					$min_age_ex = explode(" ",$min_age);
					$max_age_ex = explode(" ",$max_age);
					
					
					if ($min_age_ex[0]<=$age && $age <=$max_age_ex[0])
					 {		
					 	//withoutDate:
					 //	print_r("in if min age");
					
					 	 $none = $result['income']=='0';
    					if(isset($none)&& !empty($none))
    					  {
    						$incomes='none';
    					   }
    					else
    					   {
    					   	$incomes =$result['income'];
    					   } 
    					   
    					   if(!empty($minHeight) && $minHeight!=='Select')
    					   {
    					   	$max_height_arr = explode('.', $maxHeight);
    					   	$res_max = (($max_height_arr[0]*12)+$max_height_arr[1])*2.54;
    					   	
    					   	$min_height_arr = explode('.', $minHeight);
    					   	$res_min = (($min_height_arr[0]*12)+$min_height_arr[1])*2.54;
    					   	
    					   	
    					   	$heightOfUser = $result['heightOfUser'];
    					   	if($heightOfUser !='' && $heightOfUser!='Select')
    					   	{
    					   	$heightOfUser_arr = explode('.', $heightOfUser);
    					   	$heightOfUser_max = (($heightOfUser_arr[0]*12)+$heightOfUser_arr[1])*2.54;
    					   	
    					  // 	print_r($res_max);
    					  // 	print_r($res_min);
    					   	
    					  // 	print_r($heightOfUser_max);
    					   	
    					   	if($res_min<=$heightOfUser_max and $res_max>=$heightOfUser_max)
    					   	{
    					   	
    					   	}
    					   	else continue;
    					   	}
    					   	
    					   
    					   	
    					    	
    					   
    					   }
    					   
    					   
				 	//echo "testing ";print_r($age);echo $min_age;echo $max_age;//die;
					$searchResult[]= array(
							'profileId'=>$result['no'],
							'registerUserID'=>$result['registerUserID'],
							'gender'=>$bride_groom,
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
							'income'=>$incomes,
						//	'income'=>$result['income'],
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
							'imageName'=>"http://".$_SERVER['HTTP_HOST']."/images/".$result['imageName'],
							'age'=>	$age,
							'city'=>$result['city'],
							'caste'=>$result['caste'],
							'subcaste'=>$result['subcaste']
							);
				//	print_r($searchResult);
				 
				}
				/* else 
					print_r("in else min age"); */
			} 
		  }
		  /* else
		  	print_r("gender issue"); */
		}
	}//echo count($searchResult);
	//'imageName'=>"http://192.168.1.151/lifepartner/images/".$result['imageName']
	print_r(json_encode($searchResult));

	
	
}