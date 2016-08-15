<?php 
class Curl
{
	function PostCurl($username,$password,$method,$url=false,$param=false,$param2=false)
	{	  //echo $url;echo $method;echo $param;echo $param2;die;
		  $ch = curl_init(); // create curl handle
		  $url = $url;
		  curl_setopt($ch,CURLOPT_URL,$url); 
		  curl_setopt($ch,CURLOPT_POST, true);
		  curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query(array( 'OrganizationData'=>$param,'ApplicationData'=>$param2 )));
		  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true); 
		  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,1800); //timeout in seconds
		  curl_setopt($ch,CURLOPT_TIMEOUT,1800 ); // same for here. Timeout in seconds.
		  $response = curl_exec($ch);
		  curl_close ($ch); 
		  $result=json_decode($response,true);//print_r($result);
		  return $result;
	}
	
	
	function DeleteGetCurl($method,$url=false)
	{		
	      $ch = curl_init(); // create curl handle
		  $url = $url;
		 // curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
		  curl_setopt($ch,CURLOPT_URL,$url); 
		  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true); 
		  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,1800); //timeout in seconds
		  curl_setopt($ch,CURLOPT_TIMEOUT,1800 ); // same for here. Timeout in seconds.
		  $response = curl_exec($ch);
		  curl_close ($ch); 
		  $result=json_decode($response,true);
		  return $result;
	}
	
	function PutCurl($method,$url=false)
	{		//echo $method;echo $url;die;
		  $ch = curl_init(); // create curl handle
		  $url = $url;
		  curl_setopt($ch,CURLOPT_URL,$url); 
		  curl_setopt($ch,CURLOPT_POST, true);
		  //curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query(array( 'password'=>$data)));
		  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true); 
		  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,1800); //timeout in seconds
		  curl_setopt($ch,CURLOPT_TIMEOUT,1800 ); // same for here. Timeout in seconds.
		  $response = curl_exec($ch);
		  curl_close ($ch); 
		  $result=json_decode($response,true);//print_r($result);
		  return $result;
	}
	
	
	
}