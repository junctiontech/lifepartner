<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Api extends CI_Controller{
 	function __construct()
 	{
 		parent::__construct();
 		$this->data[]='';
 		$this->load->helper('url');
 		$this->data['url']=base_url();
		$this->load->model('Apimodel');
		$timezone = "Asia/Calcutta";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	}

 	/* Start Function for request contact api.......................................................................*/
 	function request()
 	{
 		$request=$_POST['request'];//echo $request;
 		if(isset($request))
 		{
 			$json=json_decode($request,true);//print_r($json);die; 
 			$registerUserID=$json['registerUserID'];
 			$requestRegisterUserID=$json['requestRegisterUserID'];
 			$profileId=$json['profileId'];
 			$filter=array('registerUserID'=>$registerUserID,'profileID'=>$profileId);
 			$getRequest=$this->data['getRequest']=$this->Apimodel->getfilter('requestContact',$filter);//print_r($getRequest);//die;
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
 				$data=array('registerUserID'=>$registerUserID,'profileID'=>$profileId,'requestRegisterUserID'=>$requestRegisterUserID);//print_r($data);
 				$requestUpdate=$this->data['requestUpdate']=$this->Apimodel->post('requestContact',$data);
 				if($requestUpdate)
 				{
 					$result=array('code'=>'200','message'=>'request successfully');echo json_encode($result);die;
 				}
 				else
 				{
 					$result=array('code'=>'400','message'=>'request failure');echo json_encode($result);die;
 				}
 			}
 		}
 	}
 	/* End Function for request contact api.......................................................................*/
 	
 	
 	/* Start Function for request list get.......................................................................*/
 	function requestList()
 	{
 		$registerUserID=$_POST['registerUserID'];
 		$result=array();
 		$response=array();
 		if(isset($registerUserID))
 		{
 			$filter=array('registerUserID'=>$registerUserID);
 			$getRequestList=$this->data['getRequestList']=$this->Apimodel->getfilter('requestContact',$filter);
 			if(count($getRequestList)>0)
 			{
 				foreach ($getRequestList as $list)
 				{
 					if($list->status=='N' || $list->status=='')
 					{
	 					$filter=array('registerUserID'=>$list->requestRegisterUserID);
	 					$getRegisterList=$this->data['getRegisterList']=$this->Apimodel->getfilter('RegisteredUser',$filter);
	 					if(count($getRegisterList)>0)
	 					{
	 						$response[]=array(
	 								'profileID'=>$list->profileID,
	 								'registerUserID'=>$list->registerUserID,
	 								'name'=>$getRegisterList[0]->userName,
	 								'EmailID'=>$getRegisterList[0]->EmailID,
	 								'MobileNumber'=>$getRegisterList[0]->MobileNumber
	 						);
	 					}
 					}
 				}
 				$result=array('code'=>'200','response'=>$response,'message'=>'Success');
 				echo json_encode($result);die;
 			}
 			else 
 			{
 				$response=array('code'=>'400','message'=>'No Request Found');echo json_encode($response);die;
 			}
 		}
 	}
 	/* End Function for request list get.......................................................................*/

    
 	/* Start Function for approval............................................................................*/
    function approval()
    {
    	$request=$_POST['approval'];
    	if(isset($json))
    	{
    		$json=json_decode($json,true);
    		$requestRegisterUserID=$json['requestRegisterUserID'];
    		$registerUserID=$json['registerUserID'];
    		$profileId=$json['profileId'];
    		$status=$json['status'];
    		$filter=array('registerUserID'=>$registerUserID,'profileID'=>$profileId,'requestRegisterUserID'=>$requestRegisterUserID);
   			$data=array('status'=>$status);
   			$approval=$this->data['approval']=$this->Apimodel->put('requestContact',$data,$filter);
   			if($approval)
   			{
    			$result=array('code'=>'200','message'=>'request submit');echo json_encode($result);die;
    		}
    		else 
    		{
    			$result=array('code'=>'400','message'=>'request failure');echo json_encode($result);die;
    		}
    	}
    }
    /* End Function for approval..............................................................................*/
 
 
 }
