<?php //$userdata=$this->session->userdata('username'); ?>
<?php

//print_r($data);
$CONNECTION=mysqli_connect("localhost","root","initial1$","LifePartner");
if(!$CONNECTION)
{
	echo "Database not found or There is an error in connecting to DB!! Please fix this!!!";
	exit();
}else{
	//error_reporting('0');
	$abc = json_decode($_POST['data'],true);//print_r($abc);die;
	$min_age= $abc['min_age']; echo $min_age;//die;
	$max_age=$abc['max_age']; //echo $min_age; echo $max_age;die;
	$bride_groom= $abc['bride_groom'];
	$manglik=$abc['manglik'];
	$city= $abc['city'];
	$minHeight=$abc['min_height'];
	$maxHeight=$abc['max_height'];
	$income=$abc['income'];
	$income_above_below=$abc['income_above_below'];//echo $income_above_below;die;
	$explode=explode(' ',$income); //echo $explode;die;
	$incomes=$explode[0].'00000';
	$incomes = str_replace(',', '', $incomes);
	$caste=$abc['caste'];
	$subCaste=$abc['subcaste'];
	$registeredId = $abc['registeredId'];//echo $registeredId;
	if(!empty($registeredId)){ $query=" registerUserID!='$registeredId'"; }
	if(!empty($bride_groom)){ $query.=" and gender='$bride_groom'"; }
	if(isset($income_above_below)&&!empty($income_above_below)) 
	 {  
		if(strcasecmp($income_above_below,'above')==0)
		{ 
			$incomeIdentity='>';
			if(!empty($incomes) && $incomes!=='Select'){ $query.=" and income!='none' and income>=$incomes "; }
		}
		if(strcasecmp($income_above_below,'below')==0)
		 {  
			$incomeIdentity='<';$none='none';
			if(!empty($incomes) && $incomes!=='Select'){ $query.=" and income<=$incomes or income='$none' "; }
		 }	
	 }
	if(isset($manglik) && !empty($manglik)){ $query.=" and manglik='$manglik'"; }
	if(!empty($city && $city!=='Select')){ $query.=" and city='$city'"; }
	if(!empty($caste && $caste!=='Select')){ $query.=" and caste='$caste'"; }
	if(!empty($subCaste && $subCaste!=='Select')){ $query.=" and subcaste='$subCaste'"; }
	if(!empty($minHeight) && $minHeight!=='Select'){ $query.=" and heightOfUser>='$minHeight' and heightOfUser<='$maxHeight'"; }
	$querySearch="Select * from Profiles where $query LIMIT 100";//echo $querySearch;die;
	$query=mysqli_query($CONNECTION,$querySearch);//print_r($query);die;
 	$searchResult=array();
 	if(mysqli_num_rows($query)!=0)
 	{
		while($result=mysqli_fetch_array($query))
		{   //print_r($result);//die;
			$queryRequestContact="select * from requestContact where profileID='".$result['no']."'";
			$sql=mysqli_query($CONNECTION,$queryRequestContact);
			if(mysqli_num_rows($sql)!=0)
			{
				
			}
				$from = new DateTime($result['dateOfBirth']);
				$to   = new DateTime('today');
				$age = $from->diff($to)->y;
				if ($min_age<=$age && $age <=$max_age)
				{		//print_r($age);"<br>" ;echo $min_age;"<br>"; echo $max_age;die;
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
							'imageName'=>"http://".$_SERVER['HTTP_HOST']."/images/".$result['imageName'],
							'age'=>	$age,
							'city'=>$result['city'],
							'caste'=>$result['caste'],
							'subcaste'=>$result['subcaste'], 
					); 
				}
			//}
			
		}
	}//echo count($searchResult);
	//'imageName'=>"http://192.168.1.151/lifepartner/images/".$result['imageName']
	print_r(json_encode($searchResult));

	
	
	
}