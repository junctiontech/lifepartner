<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Api extends CI_Controller{
 	function __construct()
 	{
 		parent::__construct();
 		$this->data[]='';
 		$this->load->helper('url');
 		$this->data['url']=base_url();
		$this->load->library('parser');
		$this->load->library('session');
		$this->load->model('Apimodel');
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	}

 	/* Function for login Admin area view.......................................................................*/
 	function request()
 	{
 		$request=$_POST['request'];//echo $request;
 		if(isset($request))
 		{
 			$json=json_decode($request,true);//print_r($json);die; 
 			$registerUserID=$json['registerUserID'];
 			$profileId=$json['profileId'];
 			$filter=array('registerUserID'=>$registerUserID,'profileID'=>$profileId);
 			$getRequest=$this->data['getRequest']=$this->Apimodel->getfilter('requestContact',$filter);print_r($getRequest);//die;
 			if(count($getRequest)>0)
 			{
 				/* $data=array('registerUserID'=>$registerUserID,'profileID'=>$profileId);
 				$filter=array('registerUserID'=>$registerUserID,'profileID'=>$profileId);
 				$requestUpdate=$this->data['requestUpdate']=$this->Apimodel->put('requestContact',$data,$filter);
 				if($requestUpdate)
 				{*/
 					$response=array('code'=>'200','message'=>'request successfully');echo json_encode($response);
 				/*}
 				else
 				 {*/
 					//$response=array('code'=>'400','message'=>'request failure');echo json_encode($response);
 				/*}*/
 			} 
 			else 
 			{
 				$data=array('registerUserID'=>$registerUserID,'profileID'=>$profileId);print_r($data);
 				$requestUpdate=$this->data['requestUpdate']=$this->Apimodel->post('requestContact',$data);
 				if($requestUpdate)
 				{
 					$response=array('code'=>'200','message'=>'request successfully');echo json_encode($response);
 				}
 				else
 				{
 					$response=array('code'=>'400','message'=>'request failure');echo json_encode($response);
 				}
 			}
 		}
 	}
 	
    function approval()
    {
    	$request=$_POST['approval'];
    	if(isset($json))
    	{
    		$json=json_decode($json,true);
    		$registerUserID=$json['registerUserID'];
    		$profileId=$json['profileId'];
    		$status=$json['status'];
    		$data=array('status'=>$status);
    		$approval=$this->data['approval']=$this->Apimodel->put('requestContact',$data,array('registerUserID'=>$registerUserID,'profileID'=>$profileId));
    	}
    }
	
 }
