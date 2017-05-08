<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
 class login extends CI_Controller{
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
		$userdata=$this->data['userdata']= $this->session->userdata('username');
		$this->load->model('login_model');
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		$this->host='localhost';
		$this->userName='root';
	}

 	/* Function for login Admin area view.......................................................................*/
	function index()
	 {
		$this->parser->parse('include/header',$this->data);
		$this->load->view('admin_login',$this->data);
	 }
 	/* function adminLogin()
 	{
 		$this->parser->parse('include/header',$this->data);
 		$this->load->view('admin_login',$this->data);
 		$this->parser->parse('include/footer',$th	is->data);
 	} */
 	
 	function verifyUser_Info($username=false,$password=false)
 	{
 		//
 		$username = $this->input->post('username');
 		$password = $this->input->post('password');
 		if(isset($username) && !empty($username)&& $username!=='' && isset($password) && !empty($password)&& $password!=='')
 		{  
 			$data = array(
 					 'username'=>$username,
 					 'password'=>$password,
 					); 
 		$user_id = $this->data['user_id']=$this->MasterModel->getfilter('userInfo',$data);//print_r($user_id);die;
 		if(count($user_id)>0)
 			{
	 			$sessionArray=array(
	 							'username'=>$user_id[0]->username,
	 					          'userID'=>$user_id[0]->userID,
	 							);
	 			 $this->session->set_userdata('username',$sessionArray);
	 			 $this->session->userdata('username');
	 			redirect('Master/profileList');
 			}
 		else
 			{	
 		  	  $this->session->set_flashdata('category_error','message');
 		      $this->session->set_flashdata('message','please enter correct user id and password');
 		 	  redirect('login');
 		    }
 		}
 		else
 		{
 			$this->session->set_flashdata('category_error','message');
 			$this->session->set_flashdata('message','Please enter username and password');
 			redirect('login');
 		}
 	 }
 	 function logout()
 	 {
 	 	$url=$this->session->userdata('url');//echo$url;die;
 	 	$this->data['username']=$this->session->userdata('username');
 	 	$userdata=$this->session->userdata('username');
 	 	$unset_userdata=$this->session->unset_userdata($userdata);
 	 	$this->session->sess_destroy();
 	 	redirect('login');
 	 }
  }