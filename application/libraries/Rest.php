<?php
include(APPPATH.'libraries/Curl.php');
//include(APPPATH.'libraries/Email.php');
Class Rest extends Curl
{
	function __construct($config)
	{
		$this->data['']=$config;
		
	} 
/* Start function for calling CURL -------------------------------------------------------------*/
	  function callToCurl($method,$data1,$data2=false)
	  {
		  if($method=='GET')
		 {	
			$host= $this->data['']['server']; 
			$response=$this->RestGetInformation('registered_application',$data1);
			$url = "$host/RestAPI/data?Info=$response";
			$response= $this->DeleteGetCurl($method,$url); 
			if($response['status']=='success')
			{
				$json=json_encode($response['result'],true);//echo $json;die;
				$json1=json_decode($json,true);
				$tempCode=substr(md5(microtime()),rand(0,26),5);
				$method='PUT';
				$data=array('Password'=>$tempCode);
				$filter=array('Username'=>$json1[0]['email']);
				$response=$this->RestPutInformation($json1[0]['db_name'],'user',$json1[0]['email'],$tempCode);
				//$result=json_encode($data);
				$url="$host/RestAPI/data?Info=$response";
				$response= $this->PutCurl($method,$url);
				$emails=new Email();
				$emails->sendResetPassword($json1[0]['db_name'],$json1[0]['email'],$tempCode);die;
			}
			else
			{	echo 'email not match';die;
				// send error email
			}
			
		 } 
		 $username= $this->data['']['http_user'];
		 $password= $this->data['']['http_pass'];
		 $host= $this->data['']['server']; 
		 $url = "$host/RestAPI/data";
		 $response= $this->PostCurl($username,$password,$method,$url,$data1,$data2);//print_r($response);die;
		 if($response==NULL)
		 { 	
			$applicationInfo =$_GET['ApplicationData'];
			$ApplicationJson=json_decode($applicationInfo,true);//print_r($ApplicationJson);die;
			$url = "$host/RestAPI/data?Info=$applicationInfo";
			$method='DELETE';
			$response= $this->DeleteGetCurl($method,$url);//print_r($response);die;
			$emails=new Email();
			$emails->sendErrorMsg($applicationInfo);
		 }
		 else
		 {
			 $status=json_decode($response['status'],true);
			 if($status['status']=='success')
			 {	//echo 'success';die;
				 $emails=new Email();
				 $emails->send($response['organizationsInfo'],$response['applicationInfo']);
			 }
			 else
			 {
				 $applicationInfo =$_GET['ApplicationData'];
				 $ApplicationJson=json_decode($applicationInfo,true);
				 $url = "$host/RestAPI/data?Info=$applicationInfo";
				 $method='DELETE';
				 $response= $this->DeleteGetCurl($method,$url);
				 $emails=new Email();
				 $emails->sendErrorMsg($applicationInfo);
			 }
		 }
	 }
/* End function for calling CURL ------------------------------------------------------------------*/
	  	
	  
	function RestGetInformation($table,$filter)
	{
		$Info=array('table'=>$table,'filter'=>$filter);
		return json_encode($Info);
	}
	
	function RestPutInformation($DBName,$table,$filter,$data)
	{
		$Info=array('DBName'=>$DBName,'table'=>$table,'filter'=>$filter,'data'=>$data);
		return json_encode($Info);
	}
	
	function putPassword($method,$DBName,$filter,$data)
	{	//echo $filter;die;
		$host= $this->data['']['server'];
		$response=$this->RestPutInformation($DBName,'user',$filter,md5($data));//print_r($response);die;
		$url = "$host/RestAPI/data?Info=$response";
		$response= $this->PutCurl($method,$url); //print_r($response['status']);die;
		if($response['status']=='success')
		{
			$emails=new Email();
			$emails->sendPassword($DBName,$filter,$data);//die;
		}
		else
		{
			echo'request fiald for reset password';
		}
		
	}
}