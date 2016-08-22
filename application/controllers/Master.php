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
		$this->load->helper('download');
		$this->load->helper('file');
		//$this->load->library('cpanelDB');
		$this->load->dbutil();
		$this->load->model('login_model');
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	}

 	/* Function for login Admin area view.......................................................................*/
 	function index()
 	{
 		$this->parser->parse('include/header',$this->data);
 		$this->load->view('admin_login',$this->data);
 	}
 	
 
	
	/* Start Function For View Registratio Report......................................................................... */
	function profileList()
	{	error_reporting(0);
		$genders=$this->input->post('gender');
		$incomes=$this->input->post('income');
		$birthPlaces=$this->input->post('city');
		$highestQualifications=$this->input->post('education');
		if(!empty($genders) or !empty($ages) or !empty($incomes) or !empty($birthPlaces) or !empty($highestQualifications))
		{
			$ages=$this->input->post('age');$explode=explode('-',$ages);$firstYear=$explode[0];if(isset($explode[1])){ $secondYear=$explode[1]; };
			//$ages=$this->input->post('age');$explode=explode('-',$ages);$firstYear=$explode[0]-1;if(isset($explode[1])){ $secondYear=$explode[1]+1; };
			//$minYear=date('Y',strtotime("-$firstYear year"));
			//$maxYear=date('Y',strtotime("-$secondYear year"));
			if(!empty($genders)){ $query =" gender='$genders'"; }
			//if(!empty($ages)){ $query.=" and  YEAR(dateOfBirth) <= YEAR('$maxYear') and YEAR(dateOfBirth) >= YEAR('$minYear')"; }
			if(!empty($incomes)){ $query.=" and income='$incomes'"; }
			if(!empty($birthPlaces)){ $query.=" and birthPlace='$birthPlaces'"; }
			if(!empty($highestQualifications)){ $query.=" and highestQualification='$highestQualifications'"; }
			$profileLists=$this->data['profileLists']=$this->MasterModel->ProfilesListGet($query);// echo $firstYear;echo $secondYear;
			if(!isset($secondYear)){$secondYear='';}
			foreach($profileLists as $list)
			{
				$age=date('Y')-date('Y',strtotime($list->dateOfBirth)); 
				if($firstYear <= $age && $age <= $secondYear)
				{	//echo $firstYear; echo $age;echo $secondYear;echo'</br>';
					$profileList=$this->data['profileList'][]=$list;
				}
			}//die;
			//echo'<pre>';print_r($profileList);echo'</pre>';die;
		}
		else
		{
			$profileList=$this->data['profileList']=$this->MasterModel->get('Profiles');
		}
		$city=$this->data['city']=$this->MasterModel->getDistinct('Profiles','birthPlace');
		$education=$this->data['education']=$this->MasterModel->getDistinct('Profiles','highestQualification');
		$income=$this->data['income']=$this->MasterModel->getDistinct('Profiles','income');
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/left_menu',$this->data);
		$this->load->view('profileList',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	/* End Function For View Registratio Report......................................................................... */
	
	function profile($id)
	{ 
		$profile=$this->data['profile']=$this->MasterModel->getfilter('Profiles',array('no'=>$id));//print_r($profile[0]);die;
		$this->parser->parse('include/header',$this->data);
		$this->parser->parse('include/left_menu',$this->data);
		$this->load->view('profile',$this->data);
		$this->parser->parse('include/footer',$this->data);
	}
	
 }
