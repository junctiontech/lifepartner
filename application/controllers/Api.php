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
 		
 		$request=$_POST['request'];
 		if(isset($request))
 		{
 			$json=json_decode($request,true);
 			$registerUserID=$json['registerUserID'];
 			$requestRegisterUserID=$json['requestRegisterUserID'];
 			$profileId=$json['profileId'];
 			$requestProfileID=$json['requestProfileID'];
 			$filter=array('registerUserID'=>$registerUserID,'profileID'=>$profileId);
 			
 			$filter_track_record=array('requestRegisterUserID'=>$requestRegisterUserID);
 			$getCount=$this->data['getCount']=$this->Apimodel->getfilter('requestContact',$filter_track_record);
 			if(count($getCount)>299)
 			{
 				$response=array('code'=>'400','message'=>'You reached my maximum limit, Request Failure');echo json_encode($response);die;
 			}
 			
 			
 			$getRequest=$this->data['getRequest']=$this->Apimodel->getfilter('requestContact',$filter);
 			if(count($getRequest)>0)
 			{
 				$data=array('status'=>'','requestProfileID'=>$requestProfileID,'registerUserID'=>$registerUserID,'profileID'=>$profileId);
 				$filter=array('registerUserID'=>$registerUserID,'profileID'=>$profileId);
 				$requestUpdate=$this->data['requestUpdate']=$this->Apimodel->put('requestContact',$data,$filter);
 				if($requestUpdate)
 				  {
 					$response=array('code'=>'200','message'=>'request updated successfully');echo json_encode($response);
 				  }
 				else
 				  {
 					$response=array('code'=>'400','message'=>'request failure');echo json_encode($response);die;
 				  }
 			} 
 			else 
 			{
 				$data=array('registerUserID'=>$registerUserID,'requestProfileID'=>$requestProfileID,'profileID'=>$profileId,'requestRegisterUserID'=>$requestRegisterUserID);
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
 		$registerUserID=$_POST['registerUserID'];//print_r($registerUserID);die;
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
	 					
	 					 {
	 						$filterNew=array('no'=>$list->profileID,'registerUserID'=>$list->registerUserID);
	 						$getData=$this->data['getData']=$this->Apimodel->getfilter('Profiles',$filterNew);
	 						echo "hiiii ";print_r($filterNew);die;
	 						if(count($getData)>0)
	 						 {
	 							foreach ($getData as $list1)
	 							{
	 							
			 						$response[]=array(
			 								'profileName'=>$list1->firstName." ".$list1->lastName,
			 								'profileID'=>$list->profileID,
			 								'registerUserID'=>$list->registerUserID,
			 								'requestRegisterUserID'=>$list->requestRegisterUserID,
			 								'name'=>$getRegisterList[0]->userName,
			 								'EmailID'=>$getRegisterList[0]->EmailID,
			 								'MobileNumber'=>$getRegisterList[0]->MobileNumber
			 						);print_r($response);
	 							}
	 						}
	 					}
	 					$requestProfileIdFilter=array('no'=>$list->requestProfileID);//print_r($requestProfileIdFilter);//die;
	 					$getRequestProfileList=$this->data['getRequestProfileList']=$this->Apimodel->getfilter('Profiles',$requestProfileIdFilter);
	 					
 						if(count($getRequestProfileList)>0)
 						{   
 							$profileDetail[]=array(
 									'profileId'=>$getRequestProfileList[0]->no,
 									'registerUserID'=>$getRequestProfileList[0]->registerUserID,
 									'gender'=>$getRequestProfileList[0]->gender,
 									'firstName'=>$getRequestProfileList[0]->firstName,
 									'lastName'=>$getRequestProfileList[0]->lastName,
 									'fatherName'=>$getRequestProfileList[0]->fatherName,
 									'dateOfBirth'=>$getRequestProfileList[0]->dateOfBirth,
 									'birthPlace'=>$getRequestProfileList[0]->birthPlace,
 									'heightOfUser'=>$getRequestProfileList[0]->heightOfUser,
 									'birthTime'=>$getRequestProfileList[0]->birthTime,
 									'no_of_kids'=>$getRequestProfileList[0]->noOfKids,
 									'marital_status'=>$getRequestProfileList[0]->maritalStatus,
 									'highestQualification'=>$getRequestProfileList[0]->highestQualification,
 									'TypeOfBusiness'=>$getRequestProfileList[0]->TypeOfBusiness,
 									'business'=>$getRequestProfileList[0]->business,
 									'income'=>$getRequestProfileList[0]->income,
 									'fatherJobProfile'=>$getRequestProfileList[0]->fatherJobProfile,
 									'TypeOfFatherBusiness'=>$getRequestProfileList[0]->TypeOfFatherBusiness,
 									'fatherBusiness'=>$getRequestProfileList[0]->fatherBusiness,
 									'fatherIncome'=>$getRequestProfileList[0]->fatherIncome,
 									'gautr'=>$getRequestProfileList[0]->gautr,
 									'gautrNanihal'=>$getRequestProfileList[0]->gautrNanihal,
 									'zodiacSign'=>$getRequestProfileList[0]->zodiacSign,
 									'star'=>$getRequestProfileList[0]->star,
 									'saturn'=>$getRequestProfileList[0]->saturn,
 									'manglik'=>$getRequestProfileList[0]->manglik,
 									'currentAddress'=>$getRequestProfileList[0]->currentAddress,
 									'permanentAddress'=>$getRequestProfileList[0]->permanentAddress,
 									'emailId'=>$getRequestProfileList[0]->emailId,
 									'mobileNumber'=>$getRequestProfileList[0]->mobileNumber,
 									'WhatsAppNumber'=>$getRequestProfileList[0]->WhatsAppNumber,
 									'imageName'=>"http://lifepartner.zeroerp.com/images/".$getRequestProfileList[0]->imageName,
 									//'uniqueImageId'=>"http://".$_SERVER['HTTP_HOST']."/images/".$result['uniqueImageId'],
 									//'imageName'=>"http://lifepartner.zeroerp.com/images/".$result['imageName'],
 									'city'=>$getRequestProfileList[0]->city,
 									'caste'=>$getRequestProfileList[0]->caste,
 									'subcaste'=>$getRequestProfileList[0]->subcaste,
 									//'message'=>$msg
 									);//print_r($profileDetail);
 							}
 					}
 				}
 				if(isset($response) && count($response)>0)
 				{
					$result=array('code'=>'200','response'=>$response,'profileData'=>$profileDetail,'message'=>'Success');
 					echo json_encode($result);die;
 				}
 				else 
 				{
 					$response=array('code'=>'400','message'=>'No Request Found');echo json_encode($response);die;
 				}
 			}
 			else 
 			{
 				$response=array('code'=>'400','message'=>'No Request Found');echo json_encode($response);die;
 			}
 		}
 	}
 	/* End Function for request list get.......................................................................*/

    

 	/* Start Function for request list get.......................................................................*/
 	function approvedProfileList()
 	 {
 		$registerUserID=$_POST['registerUserID'];
 		$result=array();
 		$response=array();
 		if(isset($registerUserID))
 		{
 			$filter=array('registerUserID'=>$registerUserID,'status'=>'Y');
 			$getRequestList=$this->data['getRequestList']=$this->Apimodel->getfilter('requestContact',$filter);
 			
 			if(count($getRequestList)>0)
 			{
 				foreach ($getRequestList as $list)
 				{
 					print_r($list);die;
 					$filter=array('no'=>$list->requestProfileID);
 					$getProfileDetails=$this->data['getProfileDetails']=$this->Apimodel->getfilter('Profiles',$filter);
 					if(count($getProfileDetails)>0)
 					{
 						$response[]= array(
 								'profileId'=>$getProfileDetails[0]->no,
 								'registerUserID'=>$getProfileDetails[0]->registerUserID,
 								'gender'=>$getProfileDetails[0]->gender,
 								'firstName'=>$getProfileDetails[0]->firstName,
 								'lastName'=>$getProfileDetails[0]->lastName,
 								'fatherName'=>$getProfileDetails[0]->fatherName,
 								'dateOfBirth'=>$getProfileDetails[0]->dateOfBirth,
 								'birthPlace'=>$getProfileDetails[0]->birthPlace,
 								'heightOfUser'=>$getProfileDetails[0]->heightOfUser,
 								'birthTime'=>$getProfileDetails[0]->birthTime,
 								'no_of_kids'=>$getProfileDetails[0]->noOfKids,
 								'marital_status'=>$getProfileDetails[0]->maritalStatus,
 								'highestQualification'=>$getProfileDetails[0]->highestQualification,
 								'TypeOfBusiness'=>$getProfileDetails[0]->TypeOfBusiness,
 								'business'=>$getProfileDetails[0]->business,
 								'income'=>$getProfileDetails[0]->income,
 								'fatherJobProfile'=>$getProfileDetails[0]->fatherJobProfile,
 								'TypeOfFatherBusiness'=>$getProfileDetails[0]->TypeOfFatherBusiness,
 								'fatherBusiness'=>$getProfileDetails[0]->fatherBusiness,
 								'fatherIncome'=>$getProfileDetails[0]->fatherIncome,
 								'gautr'=>$getProfileDetails[0]->gautr,
 								'gautrNanihal'=>$getProfileDetails[0]->gautrNanihal,
 								'zodiacSign'=>$getProfileDetails[0]->zodiacSign,
 								'star'=>$getProfileDetails[0]->star,
 								'saturn'=>$getProfileDetails[0]->saturn,
 								'manglik'=>$getProfileDetails[0]->manglik,
 								'currentAddress'=>$getProfileDetails[0]->currentAddress,
 								'permanentAddress'=>$getProfileDetails[0]->permanentAddress,
 								'emailId'=>$getProfileDetails[0]->emailId,
 								'mobileNumber'=>$getProfileDetails[0]->mobileNumber,
 								'WhatsAppNumber'=>$getProfileDetails[0]->WhatsAppNumber,
 								'imageName'=>"http://lifepartner.zeroerp.com/images/".$getProfileDetails[0]->imageName,
 								//'uniqueImageId'=>"http://".$_SERVER['HTTP_HOST']."/images/".$result['uniqueImageId'],
 								//'imageName'=>"http://lifepartner.zeroerp.com/images/".$result['imageName'],
 								'city'=>$getProfileDetails[0]->city,
 								'caste'=>$getProfileDetails[0]->caste,
 								'subcaste'=>$getProfileDetails[0]->subcaste,
 								//'message'=>$msg
 							);
 					 }
 				}
 				if(isset($response) && count($response)>0)
 				{
 					$result=array('code'=>'200','data'=>$response,'message'=>'Success');
 					echo json_encode($result);die;
 				}
 				else
 				{
 					$response=array('code'=>'400','message'=>'No Approved List Found');echo json_encode($response);die;
 				}
 			}
 			else
 			{
 				$response=array('code'=>'400','message'=>'No Approved List Found');echo json_encode($response);die;
 			}
 		}
 	}
 	/* End Function for request list get.......................................................................*/
 	
 	
 	/* Start Function for approval............................................................................*/
    function approval()
    {
    	$request=$_POST['approval'];
    	if(isset($request))
    	{
    		$json=json_decode($request,true);//print_r($json);
    		$requestRegisterUserID=$json['requestRegisterUserID'];
    		$registerUserID=$json['registerUserID'];
    		$profileId=$json['profileId'];
    		$status=$json['status'];
    		$filter=array('registerUserID'=>$registerUserID,'profileID'=>$profileId,'requestRegisterUserID'=>$requestRegisterUserID);
   			$data=array('status'=>$status);
   			$approval=$this->data['approval']=$this->Apimodel->put('requestContact',$data,$filter);
   			if($approval)
   			{
   				if($status=='N')
   				{
   					$result=array('code'=>'200','message'=>'Request Disapproved Successfully');echo json_encode($result);die;
   				}
   				else 
   				{
   					$result=array('code'=>'200','message'=>'Request Approved Successfully');echo json_encode($result);die;
   				}
    		}
    		else 
    		{
    			$result=array('code'=>'400','message'=>'request failure');echo json_encode($result);die;
    		}
    	}
    }
    /* End Function for approval..............................................................................*/
 
    function requestProfile()
    {
    	$request=$_POST['requestProfile'];
    	if(isset($request))
    	{
    		$profileResult=array();
    		$json=json_decode($request,true);//print_r($json);
    		$registerUserID=$json['registerUserID'];
    		//$filter=array('requestRegisterUserID'=>$registerUserID);
    		$getRequestStatus=$this->data['getRequestStatus']=$this->Apimodel->getfilterOrderBy('requestContact',$registerUserID);
    		//print_r($getRequestStatus);
    		if(count($getRequestStatus)>0)
    		{
    			foreach($getRequestStatus as $list)
    			{
//     				if($list->status=='Y')
//     				{
    					$filter=array('no'=>$list->profileID);
    					$getProfileDetails=$this->data['getProfileDetails']=$this->Apimodel->getfilter('Profiles',$filter);//print_r($getProfileDetails);die;
    					if(count($getProfileDetails)>0)
    					{
    						if ($list->status=='Y')
    							$msg= "Success";
    						else if ($list->status=='N')
    							$msg= "Your request not approved";
    						else $msg= "Your request is under processed";
    						
    						$profileResult[]= array(
    								'profileId'=>$getProfileDetails[0]->no,
    								'registerUserID'=>$getProfileDetails[0]->registerUserID,
    								'gender'=>$getProfileDetails[0]->gender,
    								'firstName'=>$getProfileDetails[0]->firstName,
    								'lastName'=>$getProfileDetails[0]->lastName,
    								'fatherName'=>$getProfileDetails[0]->fatherName,
    								'dateOfBirth'=>$getProfileDetails[0]->dateOfBirth,
    								'birthPlace'=>$getProfileDetails[0]->birthPlace,
    								'heightOfUser'=>$getProfileDetails[0]->heightOfUser,
    								'birthTime'=>$getProfileDetails[0]->birthTime,
    								'no_of_kids'=>$getProfileDetails[0]->noOfKids,
    								'marital_status'=>$getProfileDetails[0]->maritalStatus,
    								'highestQualification'=>$getProfileDetails[0]->highestQualification,
    								//'userJobProfile'=>$getProfileDetails['userJobProfile'],
    								'TypeOfBusiness'=>$getProfileDetails[0]->TypeOfBusiness,
    								'business'=>$getProfileDetails[0]->business,
    								'income'=>$getProfileDetails[0]->income,
    								'fatherJobProfile'=>$getProfileDetails[0]->fatherJobProfile,
    								'TypeOfFatherBusiness'=>$getProfileDetails[0]->TypeOfFatherBusiness,
    								'fatherBusiness'=>$getProfileDetails[0]->fatherBusiness,
    								'fatherIncome'=>$getProfileDetails[0]->fatherIncome,
    								'gautr'=>$getProfileDetails[0]->gautr,
    								'gautrNanihal'=>$getProfileDetails[0]->gautrNanihal,
    								'zodiacSign'=>$getProfileDetails[0]->zodiacSign,
    								'star'=>$getProfileDetails[0]->star,
    								'saturn'=>$getProfileDetails[0]->saturn,
    								'manglik'=>$getProfileDetails[0]->manglik,
    								'currentAddress'=>$getProfileDetails[0]->currentAddress,
    								'permanentAddress'=>$getProfileDetails[0]->permanentAddress,
    								'emailId'=>$getProfileDetails[0]->emailId,
    								'mobileNumber'=>$getProfileDetails[0]->mobileNumber,
    								'WhatsAppNumber'=>$getProfileDetails[0]->WhatsAppNumber,
    								'imageName'=>"http://lifepartner.zeroerp.com/images/".$getProfileDetails[0]->imageName,
    								//'uniqueImageId'=>"http://".$_SERVER['HTTP_HOST']."/images/".$result['uniqueImageId'],
    								//'imageName'=>"http://lifepartner.zeroerp.com/images/".$result['imageName'],
    								'city'=>$getProfileDetails[0]->city,
    								'caste'=>$getProfileDetails[0]->caste, 
    								'subcaste'=>$getProfileDetails[0]->subcaste,
    								'message'=>$msg
    								
    						);
    					}
    				//}
    			}
    			if(count($profileResult)>0 && $list->status=='Y')
    			{
    				$result=array('code'=>'200','data'=>$profileResult);echo json_encode($result);die;
    			}
    			else if(count($profileResult)>0 && $list->status=='N')
    			{
    				$result=array('code'=>'200','data'=>$profileResult);echo json_encode($result);die;
    			}
    			else 
    			{
    				$result=array('code'=>'200','data'=>$profileResult);echo json_encode($result);die;
    			}
    		}
    		else 
    		{
    			$result=array('code'=>'400','message'=>'You have not requested to any profile');echo json_encode($result);die;
    		}
    	}
    }
    
    
 }
