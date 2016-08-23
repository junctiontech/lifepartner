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
		$incomeIdentity=$this->input->post('incomeIdentity');
		$highestQualifications=$this->input->post('education');
		if($this->input->post('maleAge')!=='')
		{
			$ages=$this->input->post('maleAge');
		}
		if($this->input->post('feMaleAge')!=='')
		{
			$ages=$this->input->post('feMaleAge');
		}
		if(!empty($genders)  or !empty($incomes) or !empty($birthPlaces) or !empty($highestQualifications))
		{	
			if(!empty($genders)){ $query =" gender='$genders'"; }
			if(!empty($incomes)){ $query.=" and income$incomeIdentity='$incomes'"; }
			if(!empty($birthPlaces)){ $query.=" and birthPlace='$birthPlaces'"; }
			if(!empty($highestQualifications)){ $query.=" and highestQualification='$highestQualifications'"; }
			$profileList=$this->data['profileList']=$this->MasterModel->ProfilesListGet($query);
			if(!empty($ages))
			{ 
				$explode=explode('-',$ages);$firstYear=$explode[0];if(isset($explode[1])){ $secondYear=$explode[1]; }; 
				if(!isset($secondYear)){$secondYear='';}
				foreach($profileList as $list)
				{	//echo'<pre>';print_r($list);echo'</pre>';
					$age=date('Y')-date('Y',strtotime($list->dateOfBirth));
					if($firstYear <= $age && $age <= $secondYear)
					{	
						$profileList=$this->data['profileList'][]=$list;
					}
				}//die;
				//echo'<pre>';print_r($profileList);echo'</pre>';die;
			}
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
