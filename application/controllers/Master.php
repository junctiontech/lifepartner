<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  class Master extends CI_Controller{
 	function __construct()
 	{
 		parent::__construct();
 		$this->data[]='';
 		$this->load->helper('url');
 		$this->data['url']=base_url();
		$this->load->library('parser');
		$this->load->library('session');
		$this->load->model('MasterModel');
		$this->load->model('Apimodel');
		$this->load->helper('download');
		$this->load->helper('file');
		//$this->load->library('cpanelDB');
		$this->load->dbutil();
		$this->load->model('login_model');
		$userdata=$this->data['userdata']= $this->session->userdata('username');
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	}

	function Register_UserList()
	{
		$Register_User=$this->data['Register_User']=$this->MasterModel->get('RegisteredUser');//print_r($Register_User);die;
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/left_menu',$this->data);
		$this->load->view('registeruserList',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
   function Register_Userinfo($id)
	  {			
	  	$Userinfo=$this->data['Userinfo']=$this->MasterModel->getfilter('RegisteredUser',array('registerUserID'=>$id));//print_r($profile[0]);die;
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/left_menu',$this->data);
		$this->load->view('registeruserInfo',$this->data);
		$this->parser->parse('include/footer',$this->data);
	  } 

/* Start Function For View Registratio Report......................................................................... */
	function profileList()
	{	//echo "test";die;
		error_reporting('0');
		//$a =$this->session->userdata('username');print_r($a);die;
	    //if (!$this->session->userdata('username')){ $this->session->set_flashdata('category_error_login', " Your Session Is Expired!! Please Login Again. "); redirect(base_url());}
	    $genders=$this->input->post('gender');
		$incomes=$this->input->post('income');
	  	$date=$this->input->post('dateOfCreation');//print_r($date);die;
		$date_profile_create = explode('-',$date);
		$start_date = date('m/d/Y' ,strtotime($date_profile_create[0]));//print_r($date_profile_create);die;
		$start_date_formate = strtotime('-1 day',strtotime($start_date));
		//print_r($start_date_formate);die;
		
		$start_date_create = date('d/m/Y' ,$start_date_formate);//print_r($start_date_create);die;
		//$end_date = date('d/m/Y' ,strtotime($date_profile_create[1]));//print_r($start_date_create);die;
		//$end_date_time = $end_date .' 12:00:00';
		
		$citys=$this->input->post('city');
		$castes=$this->input->post('caste');
		$subCastes=$this->input->post('subCaste');
		$minHeight=$this->input->post('minHeight');
		$maxHeight=$this->input->post('maxHeight');
		$incomeIdentity=$this->input->post('incomeIdentity');
		$highestQualifications=$this->input->post('education');
		//$first_date_find = strtotime($date);
		//echo $first_date_find;die;
		//print_r($status);die;
		if($this->input->post('maleAge')!=='')
		{
			$ages=$this->input->post('maleAge');
		}
		if($this->input->post('feMaleAge')!=='')
		{
			$ages=$this->input->post('feMaleAge');
		}
		
		if(!empty($genders) or !empty($ages)  or !empty($minHeight)  or !empty($maxHeight)  or  !empty($incomes) or !empty($citys) or !empty($highestQualifications) or !empty($date))
		{	
			$query =" status='unblock'";
			
			if(isset($incomeIdentity)&&!empty($incomeIdentity))
			{
				if(strcasecmp($incomeIdentity,'>')==0)
				{
					if(!empty($incomes) && $incomes!=='Select'){ $query.=" and income!='none' and income$incomeIdentity=$incomes ";}
					
				}
				if(strcasecmp($incomeIdentity,'<')==0)
				{
					if(!empty($incomes) && $incomes!=='Select'){ $query.=" and income$incomeIdentity=$incomes OR 'none'";}
				}
			}
			//if(!empty($incomes)){ $query.=" and income$incomeIdentity='$incomes'"; }
			
			if(isset($genders) && !empty($genders) && $genders !=='all')
			{
				if(!empty($genders)){ $query.=" and gender='$genders'"; }
			}
			if(!empty($citys)){ $query.=" and city='$citys'"; }
			if(!empty($date)){ $query.=" and dateOfCreation>='$start_date_create' and dateOfCreation<='$end_date_time'"; }
			if(!empty($castes)){ $query.=" and caste='$castes'"; }
			if(!empty($subCastes)){ $query.=" and subcaste='$subCastes'"; }
			if(!empty($minHeight)){ $query.=" and heightOfUser>='$minHeight' and heightOfUser<='$maxHeight'"; }
			if(!empty($highestQualifications)){ $query.=" and highestQualification='$highestQualifications'"; }
			//print_r($query);die;
			$profileLists=$this->data['profileLists']=$this->MasterModel->ProfilesListGet($query);
			//echo "<pre>";print_r($profileLists);die;
			if(!empty($ages))
			 { 
				$explode=explode('-',$ages);$firstYear=$explode[0];if(isset($explode[1])){ $secondYear=$explode[1]; }; 
				if(!isset($secondYear)){$secondYear='';}
				foreach($profileLists as $list)
				{	//echo'<pre>';print_r($list);echo'</pre>';
					$age=date('Y')-date('Y',strtotime($list->dateOfBirth));
					if($firstYear <= $age && $age <= $secondYear)
					{	
						$profileList=$this->data['profileList'][]=$list;
					}
				}
				//echo'<pre>';print_r($profileList);echo'</pre>';die;
			}
			else 
			{
				$this->data['profileList']=$profileLists;
			}
		}
		else
			{
				$profileList=$this->data['profileList']=$this->MasterModel->get('Profiles');
			}
		/* $userDetail=$this->data['userDetail']=$this->MasterModel->get('Profiles');
		$filter = $userDetail[0]->registerUserID;
		$user_Id = $this->data['user_Id']=$this->MasterModel->getData('Profiles',array('registerUserID'=>$filter));
		//print_r($user_Id);die;
		foreach($user_Id as $list)
		{
			$registerUser_ID=$this->data['registerUser_ID'][]=$list->registerUserID;
		} */
		$city=$this->data['city']=$this->MasterModel->getDistinct('Profiles','city');//print_r($city);die;
		$education=$this->data['education']=$this->MasterModel->getDistinct('Profiles','highestQualification');
		$income=$this->data['income']=$this->MasterModel->getDistinct('Profiles','income');
		$caste=$this->data['caste']=$this->MasterModel->getDistinct('Profiles','caste');
		$subCaste=$this->data['subCaste']=$this->MasterModel->getDistinct('Profiles','subcaste');
		$status=$this->data['status']=$this->MasterModel->getDistinct('Profiles','status');//print_r($status);die;
		
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/left_menu',$this->data);
		$this->load->view('profileList',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	/* End Function For View Registratio Report......................................................................... */
	
	function profile($id)
	 { 
	 	$userDetail=$this->data['userDetail']=$this->MasterModel->get('Profiles');
	 	$filter = $userDetail[0]->registerUserID;
	 	$user_Id = $this->data['user_Id']=$this->MasterModel->getData('Profiles',array('registerUserID'=>$filter));
	 	//print_r($user_Id);die;
	 	foreach($user_Id as $list)
	 	 {
	 		$registerUser_ID=$this->data['registerUser_ID'][]=$list->registerUserID;
	 	 }
		$profile=$this->data['profile']=$this->MasterModel->getfilter('Profiles',array('no'=>$id));//print_r($profile[0]);die;
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/left_menu',$this->data);
		$this->load->view('profile',$this->data);
		$this->parser->parse('include/footer',$this->data);
	 }
	/* Start Function For Delete profileList Report......................................................................... */
		
	 function deleteProfileList($id)
	 {
	 	$delete=$this->data['delete']=$this->MasterModel->delete('Profiles',array('no'=>$id));
	 	$this->session->set_flashdata('category_error','message');
	 	$this->session->set_flashdata ('message',"Your Record successfully  delete !!!" );
	 	redirect('Master/profileList');
	}
	/*Start Function For userBlock profileList Report......................................................................... */
	
   function approve($id= false)
    { 	
      if(isset($id) && !empty($id) && isset($_GET['no']))
	    {
		  $dataArray=array('status'=>'block');
		  $update= $this->data['update']=$this->MasterModel->put('Profiles',$dataArray,array('no'=>$_GET['no']));
		  $this->session->set_flashdata('category_error','message');
		  $this->session->set_flashdata('message','Profile block successfully');
		  redirect($_SERVER['HTTP_REFERER']);
	    }
	 else
	    {
		  $this->session->set_flashdata('category_error','message');
		  $this->session->set_flashdata('message','Profile not block successfully');
		  redirect($_SERVER['HTTP_REFERER']);
	    }
    }
	
	function disapprove($id = false)
   	  {
   		if(isset($id) && !empty($id) && isset($_GET['no']))
	     {
	     	$dataArray=array('status'=>'unblock');
	     	$update_User = $this->data['update_User']=$this->MasterModel->put('Profiles',$dataArray,array('no'=>$_GET['no']));
	     	$this->session->set_flashdata('category_success','message');
		    $this->session->set_flashdata('message','Profile Un-block successfully');
		    redirect($_SERVER['HTTP_REFERER']);
		 }
	   else
		 {
		  $this->session->set_flashdata('category_error','message');
		  $this->session->set_flashdata('message','Profile not Un-block successfully');
		  redirect($_SERVER['HTTP_REFERER']);
		 }
	}
  
	function heightMaxDropdown()
	{	
		$minHeight=$this->input->post('value');
		if(isset($minHeight) &&$minHeight!=='')
		{
			$value=explode('.',$minHeight);
			?>
				<?php for($i=$value[0];$i<=6;$i++){ for($k=$value[1];$k<12;$k++){ ?>
						<option value="<?php echo $i.".".$k;?>"><?php echo $i.".".$k;?></option>
					<?php  } } ?>
			<?php
		}
	}
	
	function registration()
	{
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/left_menu',$this->data);
		$this->load->view('registration',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	
	
	function registerData()
	{	
		$totalValue='';
		$loopValue=$this->input->post('loopValue');//echo $loopValue;die;
		if(isset($loopValue) && !empty($loopValue))
		{
			for($i=1;$i<=$loopValue;$i++)
			{
				$chartor='abcdefghijklmnopqrstuvwxyz';
				$number="0123456789";
				$dataRegister=array(
									'userName'=>substr(str_shuffle($chartor),0,5),
									'EmailID'=>substr(str_shuffle($chartor),0,5).'@gmail.com',
									'MobileNumber'=>substr(str_shuffle($number),0,10)
									);
				$insertRandomRegisterID=$this->data['insertRandomRegisterID']=$this->MasterModel->postLastId('RegisteredUser',$dataRegister);
				for($k=0;$k<=15;$k++)
				{
					if($k==0)
					{
						$category='self';
						$gender='M';
					}
					if($k==1||$k==2||$k==3)
					{
						$category='son';
						$gender='M';
					}
					if($k==4||$k==5||$k==6)
					{
						$category='sister';
						$gender='F';
					}
					if($k==7||$k==8||$k==9)
					{
						$category='brother';
						$gender='M';
					}
					if($k==10||$k==11||$k==12)
					{
						$category='daughter';
						$gender='F';
					}
					if($k==13||$k==14||$k==15)
					{
						$category='friend';
						$gender='M';
					}

					$registerUserID=$this->data['registerUserID']=$this->MasterModel->getDistinct('Profiles','registerUserID');$randomRegisterUserID=$registerUserID[array_rand($registerUserID)];
					$firstName=$this->data['firstName']=$this->MasterModel->getDistinct('Profiles','firstName');$randomFirstName=$firstName[array_rand($firstName)];
					//$gender=$this->data['gender']=$this->MasterModel->getDistinct('Profiles','gender');$randomGender=$gender[array_rand($gender)];
					$city=$this->data['city']=$this->MasterModel->getDistinct('Profiles','city');$randomCity=$city[array_rand($city)];
					$birthPlace=$this->data['birthPlace']=$this->MasterModel->getDistinct('Profiles','birthPlace');$randomBirthPlace=$birthPlace[array_rand($birthPlace)];
					$heightOfUser=$this->data['heightOfUser']=$this->MasterModel->getDistinct('Profiles','heightOfUser');$randomHeightOfUser=$heightOfUser[array_rand($heightOfUser)];
					$dateOfBirth=$this->data['dateOfBirth']=$this->MasterModel->getDistinct('Profiles','dateOfBirth');$randomDateOfBirth=$dateOfBirth[array_rand($dateOfBirth)];
					$highestQualification=$this->data['highestQualification']=$this->MasterModel->getDistinct('Profiles','highestQualification');$randomHighestQualification=$highestQualification[array_rand($highestQualification)];
					$income=$this->data['income']=$this->MasterModel->getDistinct('Profiles','income');$randomIncome=$income[array_rand($income)];
					$zodiacSign=$this->data['zodiacSign']=$this->MasterModel->getDistinct('Profiles','zodiacSign');$randomZodiacSign=$zodiacSign[array_rand($zodiacSign)];
					$imageName=$this->data['imageName']=$this->MasterModel->getDistinct('Profiles','imageName');$randomImageName=$imageName[array_rand($imageName)];
					$uniqueImageId=$this->data['uniqueImageId']=$this->MasterModel->getDistinct('Profiles','uniqueImageId');$randomUniqueImageId=$uniqueImageId[array_rand($uniqueImageId)];
					$subcaste=$this->data['subcaste']=$this->MasterModel->getDistinct('Profiles','subcaste');$randomSubcaste=$subcaste[array_rand($subcaste)];
					$chartor='abcdefghijklmnopqrstuvwxyz';
					$number="0123456789";
					$data=array(
							'category'=>$category,
							'gender'=>$gender,
							'registerUserID'=>$insertRandomRegisterID,
							'firstName'=>$randomFirstName->firstName,
							'lastName'=>substr(str_shuffle($chartor),0,10),
							'fatherName'=>substr(str_shuffle($chartor),0,10),
							'dateOfBirth'=>$randomDateOfBirth->dateOfBirth,
							'birthPlace'=>$randomBirthPlace->birthPlace,
							'heightOfUser'=>$randomHeightOfUser->heightOfUser,
							'birthTime'=>substr(str_shuffle($chartor),0,10),
							'highestQualification'=>$randomHighestQualification->highestQualification,
							'userJobProfile'=>substr(str_shuffle($chartor),0,10),
							'TypeOfBusiness'=>substr(str_shuffle($chartor),0,10),
							'business'=>substr(str_shuffle($chartor),0,10),
							'income'=>$randomIncome->income,
							'TypeOfFatherBusiness'=>substr(str_shuffle($chartor),0,10),
							'fatherBusiness'=>substr(str_shuffle($chartor),0,10),
							'fatherIncome'=>$randomIncome->income,
							'gautr'=>substr(str_shuffle($chartor),0,5),
							'gautrNanihal'=>substr(str_shuffle($chartor),0,5),
							'zodiacSign'=>$randomZodiacSign->zodiacSign,
							'manglik'=>'true',
							'currentAddress'=>substr(str_shuffle($chartor),0,20),
							'permanentAddress'=>substr(str_shuffle($chartor),0,20),
							'emailId'=>substr(str_shuffle($chartor),0,5).'@gmail.com',
							'mobileNumber'=>substr(str_shuffle($number),0,10),
							'WhatsAppNumber'=>substr(str_shuffle($number),0,10),
							'dateOfCreation'=>date('d-m-Y H:i:s'),
							'lastUpdationDate'=>date('d-m-Y H:i:s'),
							'imageName'=>$randomImageName->	imageName,
							'uniqueImageId'=>$randomUniqueImageId->uniqueImageId,
							'city'=>$randomCity->city,
							'caste'=>'Brahmin',
							'subcaste'=>$randomSubcaste->subcaste,
							'status'=>'unblock',
					);
					$totalValue=$i;
					$insertRandom=$this->data['insertRandom']=$this->MasterModel->post('Profiles',$data);
				}
					
			}
			if($insertRandom)
			{
				$this->session->set_flashdata('category_success','message');
				$this->session->set_flashdata('message',"$totalValue Record Succssfully Insert");
				redirect('Master/profileList');
			}
		}
		else
		{
			$this->session->set_flashdata('category_error','message');
			$this->session->set_flashdata('message',"Please Enter Valid Value");
			redirect('Master/registration');
		}
	}
 }
