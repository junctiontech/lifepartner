<?php 
//include(APPPATH.'PHPMailer/Curl.php');
Class Email
{	
	 
	function hostUrl()
	{	//echo 'hiii';die;
		if($_SERVER['HTTP_HOST']=='localhost:8080')
		{
			return $host=array('zeroerpURL'=>'http://localhost:8080/zeroerp.com','cpanelURL'=>'http://localhost:8080/cpanel','SchoolURL'=>'http://localhost:8080/schoolerp'
			);
		}
		if($_SERVER['HTTP_HOST']=='192.168.1.151')
		{
			return $host=array('zeroerpURL'=>'http://192.168.1.151/zeroerp.com','cpanelURL'=>'http://192.168.1.151/cpanel','SchoolURL'=>'http://192.168.1.151/schoolerp'
			);
		}
		if($_SERVER['HTTP_HOST']=='cpanel.zeroerp.com')
		{
			return $host=array('zeroerpURL'=>'http://zeroerp.com','cpanelURL'=>'http://cpanel.zeroerp.com','SchoolURL'=>'http://education.zeroerp.com'
			);
		}
	}
	
    function send($OrganizationInfo,$ApplicationInfo)
	{	
		$host=$this->hostUrl();
		$zeroerp=$host['zeroerpURL'];
		$cpanel=$host['cpanelURL'];
		$schoolERP=$host['SchoolURL'];
		$organizationJson=json_decode($OrganizationInfo);
		$ApplicationJson=json_decode($ApplicationInfo);
		//$application_id=$this->data['application_id']=$this->login_model->app_id($json->registration_id);
		//$json=json_decode($_GET['json']);
		$registration_id=$ApplicationJson->applicationID;
		$code_application_id=md5($registration_id);
		$subject=" Zero ERP :- Your Application Registered Successfully ";
		$message= " <html><body><h3>Hello: Organization Administrator </h3><p>Your Application is Successfully Registered Some Important Details Are <br> Organization Name:- <b>$organizationJson->organization_name</b> <br> User Name:- <b>$ApplicationJson->email</b> <br> Password:- <b>$ApplicationJson->password </b> <br> Mobile Number:- <b>$ApplicationJson->mobile </b> <br><br><p><h4>Please click in this link and activate your account  :)</h3></p><p> $cpanel/Login/activate_org/$registration_id/$code_application_id/$ApplicationJson->db_name</p> <br> </p></body></html>";
		$name='Junction Software Pvt Ltd';
		date_default_timezone_set('Etc/UTC');
		require 'PHPMailer/PHPMailerAutoload.php';
		//Create a new PHPMailer instance
			$mail = new PHPMailer;
			
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			
			//Set the hostname of the mail server
			$mail->Host = 'smtp.gmail.com';
			
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;
			
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';
			
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = "dev4junction@gmail.com";
			
			//Password to use for SMTP authentication
			$mail->Password = 'initial1$';
			
			//Set who the message is to be sent from
			$mail->setFrom($organizationJson->email,$name);
			
			//Set an alternative reply-to address
			$mail->addReplyTo('dev4junction@gmail.com', $name);
			
			//Set who the message is to be sent to
			$mail->addAddress($organizationJson->email);
			
			//Set the subject line
			$mail->Subject = $subject;
			
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($message);
			
			//Replace the plain text body with one created manually
			$mail->AltBody = 'This is a plain-text message body';
			
			//Attach an image file
			//$mail->addAttachment($uploadfile,$filename);
			
			//send the message, check for errors
			
			
			if (!$mail->send())
			{
				print "We encountered an error sending your mail";
					
			}
			elseif($application_id='School')
			{
				?><script> alert('Your Application Registered Successfully Please Activate Your Application With Help Of Registered Email !!!!');</script><?php
					redirect("$schoolERP/login/smsLogin?organizationKey=$ApplicationJson->db_name","refresh");
			}	
	}
	
	
	function applicationAdminEmail($applicationDetails)
	{	
		$host=$this->hostUrl();
		$zeroerp=$host['zeroerpURL'];
		$cpanel=$host['cpanelURL'];
		$schoolERP=$host['SchoolURL'];
		$ApplicationJson=json_decode($applicationDetails,true);//print_r($ApplicationJson); echo $ApplicationJson[0]['email'];
		$email=$ApplicationJson[0]['email'];
		$dbName=$ApplicationJson[0]['db_name'];
		$mobile=$ApplicationJson[0]['mobile'];
		//$password=$ApplicationJson[0]['password'];
		$subjects=" Zero ERP :- Your Application Activated Successfully ";
		$messages= " <html><body><h3>Hello: Application Administrator </h3><p>Your Application is Successfully Registered Some Important Details Are <br> Organization Key:- <b>$dbName</b> <br> Username/Email:- <b>$email</b> <br> Mobile Number:- <b>$mobile </b> <br> </p><p><h3>Please Click In This Link And Login With Use Of Those Userid, Password  :)</h3>$schoolERP/login/smsLogin?organizationKey=$dbName</p></body></html>";
		$names='Junction Software Pvt Ltd';
		date_default_timezone_set('Etc/UTC');
		require 'PHPMailer/PHPMailerAutoload.php';
		//Create a new PHPMailer instance
			$mail = new PHPMailer;
			
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			
			//Set the hostname of the mail server
			$mail->Host = 'smtp.gmail.com';
			
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;
			
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';
			
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = "dev4junction@gmail.com";
			
			//Password to use for SMTP authentication
			$mail->Password = 'initial1$';
			
			//Set who the message is to be sent from
			$mail->setFrom($email,$names);
			
			//Set an alternative reply-to address
			$mail->addReplyTo('dev4junction@gmail.com', $names);
			
			//Set who the message is to be sent to
			$mail->addAddress($email);
			
			//Set the subject line
			$mail->Subject = $subjects;
			
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($messages);
			
			//Replace the plain text body with one created manually
			$mail->AltBody = 'This is a plain-text message body';
			
			//Attach an image file
			//$mail->addAttachment($uploadfile,$filename);
			
			//send the message, check for errors
			
			
			if (!$mail->send())
			{
				print "We encountered an error sending your mail";
			}
			elseif($ApplicationJson[0]['application_id']='School')
			{ //echo 'success';die;
				?><script> alert('Your application activate successfully please login with your email and password !!!!');</script><?php
					redirect("$schoolERP/login/smsLogin?organizationKey=$dbName","refresh");
			}	
	}
	
	 function sendErrorMsg($OrganizationInfo)
	{	
		$host=$this->hostUrl();
		$zeroerp=$host['zeroerpURL'];
		$cpanel=$host['cpanelURL'];
		$schoolERP=$host['SchoolURL'];
		$organizationJson=json_decode($OrganizationInfo);
		//	$ApplicationJson=json_decode($param2);
		//$application_id=$this->data['application_id']=$this->login_model->app_id($json->registration_id);
		//$json=json_decode($_GET['json']);
		$subject=" Zero ERP :- Your Application Registration Fail ";
		$message= " <html><body><h3>Hello: Organization Administrator </h3><br><p>Your application is not registered successfully please registered again!!!! <br> if any query so please contact to info@junctiontech.in!!  :(  </h3></p><br> </p></body></html>";
		$name='Junction Software Pvt Ltd';
		date_default_timezone_set('Etc/UTC');
		require 'PHPMailer/PHPMailerAutoload.php';
		//Create a new PHPMailer instance
			$mail = new PHPMailer;
			
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			
			//Set the hostname of the mail server
			$mail->Host = 'smtp.gmail.com';
			
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;
			
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';
			
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = "dev4junction@gmail.com";
			
			//Password to use for SMTP authentication
			$mail->Password = 'initial1$';
			
			//Set who the message is to be sent from
			$mail->setFrom($organizationJson->email,$name);
			
			//Set an alternative reply-to address
			$mail->addReplyTo('dev4junction@gmail.com', $name);
			
			//Set who the message is to be sent to
			$mail->addAddress($organizationJson->email);
			
			//Set the subject line
			$mail->Subject = $subject;
			
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($message);
			
			//Replace the plain text body with one created manually
			$mail->AltBody = 'This is a plain-text message body';
			
			//Attach an image file
			//$mail->addAttachment($uploadfile,$filename);
			
			//send the message, check for errors
			
			
			if (!$mail->send())
			{
				print "We encountered an error sending your mail";
					
			}
			elseif($application_id='School')
			{
				?><script> alert('Your Application Not Registered Successfully Please Check Registered Email !!!!');</script><?php
					redirect("$zeroerp/Front/registration.html","refresh");
			}	
	}
	
	
	function sendResetPassword($DBName,$email,$tempCode)
	{	
		$host=$this->hostUrl();
		$zeroerp=$host['zeroerpURL'];
		$cpanel=$host['cpanelURL'];
		$schoolERP=$host['SchoolURL'];
		$subject=" Zero ERP :- Rest Password ";
		$message= " <html><body><h3>Hello: Organization Administrator </h3><p>Please click in below link and reset your password....<br> Your OTP Code is:- <b>$tempCode</b> <br> Your reset password link is $cpanel/Login/acc_setting/$DBName<br><br> if any query so please contact to info@junctiontech.in!!  :(  </h3></p><br> </p></body></html>";
		$name='Junction Software Pvt Ltd';
		date_default_timezone_set('Etc/UTC');
		require 'PHPMailer/PHPMailerAutoload.php';
		//Create a new PHPMailer instance
			$mail = new PHPMailer;
			
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			
			//Set the hostname of the mail server
			$mail->Host = 'smtp.gmail.com';
			
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;
			
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';
			
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = "dev4junction@gmail.com";
			
			//Password to use for SMTP authentication
			$mail->Password = 'initial1$';
			
			//Set who the message is to be sent from
			$mail->setFrom($email,$name);
			
			//Set an alternative reply-to address
			$mail->addReplyTo('dev4junction@gmail.com', $name);
			
			//Set who the message is to be sent to
			$mail->addAddress($email);
			
			//Set the subject line
			$mail->Subject = $subject;
			
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($message);
			
			//Replace the plain text body with one created manually
			$mail->AltBody = 'This is a plain-text message body';
			
			//Attach an image file
			//$mail->addAttachment($uploadfile,$filename);
			
			//send the message, check for errors
			
			
			if (!$mail->send())
			{
				print "We encountered an error sending your mail";
					
			}
			else
			{
				?><script> alert('Kindly check your email for your OTP code !!!!');</script><?php
					redirect("$schoolERP","refresh");
			}	
	}
	
	function sendPassword($dbName,$email,$password)
	{	
		$host=$this->hostUrl();
		$zeroerp=$host['zeroerpURL'];
		$cpanel=$host['cpanelURL'];
		$schoolERP=$host['SchoolURL'];
		$subject=" Zero ERP :-Password Rest Successfully ";
		$message= " <html><body><h3>Hello: Application Administrator </h3><p>Your Application Password Is Successfully Reset  Some Important Details Are <br> Organization Key:- <b>$dbName</b> <br> Username/Email:- <b>$email</b> <br> Password:- <b>$password </b> <br> </p><p><h3>Please Click In This Link And Login With Use Of Those Userid, Password  :)</h3>$schoolERP/login/smsLogin?organizationKey=$dbName</p></body></html>";
		$name='Junction Software Pvt Ltd';
		date_default_timezone_set('Etc/UTC');
		require 'PHPMailer/PHPMailerAutoload.php';
		//Create a new PHPMailer instance
			$mail = new PHPMailer;
			
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			
			//Set the hostname of the mail server
			$mail->Host = 'smtp.gmail.com';
			
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;
			
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';
			
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = "dev4junction@gmail.com";
			
			//Password to use for SMTP authentication
			$mail->Password = 'initial1$';
			
			//Set who the message is to be sent from
			$mail->setFrom($email,$name);
			
			//Set an alternative reply-to address
			$mail->addReplyTo('dev4junction@gmail.com', $name);
			
			//Set who the message is to be sent to
			$mail->addAddress($email);
			
			//Set the subject line
			$mail->Subject = $subject;
			
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($message);
			
			//Replace the plain text body with one created manually
			$mail->AltBody = 'This is a plain-text message body';
			
			//Attach an image file
			//$mail->addAttachment($uploadfile,$filename);
			
			//send the message, check for errors
			
			
			if (!$mail->send())
			{
				print "We encountered an error sending your mail";
					
			}
			else
			{
				?><script> alert('Kindly check your registered email !!!!');</script><?php
					redirect("$schoolERP","refresh");
			}	
	}
	
	function sendBckp($param1,$ApplicationJson)
	{	//die;
		$organizationJson=json_decode($param1);
	//	$ApplicationJson=json_decode($param2);
		//$application_id=$this->data['application_id']=$this->login_model->app_id($json->registration_id);
		//$json=json_decode($_GET['json']);
		$registration_id=$ApplicationJson->applicationID;
		$code_application_id=md5($registration_id);
		$subject="Zero ERP:-  Please Activate Your Account ";
		$message= " <html><body><h3>Hello:  Organization Administrator </h3><p> Your Organization is Successfully Registered Some Important Details Are <br> Organization Name:- <b>$organizationJson->organization_name  </b><br> Database Name-: <b>$ApplicationJson->db_name  </b><br>  User Name-: <b>$organizationJson->email  </b><br> Password:- <b>$organizationJson->password </b><br> Mobile:-  <b>$organizationJson->mobile </b><br> </p><p><h3>Please Click In This Link And Activate Your Account  :)</h3></p><p> http://cpanel.zeroerp.com/Login/activate_org/$registration_id/$code_application_id/$ApplicationJson->db_name</p></body></html>";
		$name='Junction Software Pvt Ltd';
		date_default_timezone_set('Etc/UTC');
		require 'PHPMailer/PHPMailerAutoload.php';
		//Create a new PHPMailer instance
			$mail = new PHPMailer;
			
			//Tell PHPMailer to use SMTP
			$mail->isSMTP();
			
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			
			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';
			
			//Set the hostname of the mail server
			$mail->Host = 'smtp.gmail.com';
			
			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;
			
			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';
			
			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;
			
			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = "dev4junction@gmail.com";
			
			//Password to use for SMTP authentication
			$mail->Password = 'initial1$';
			
			//Set who the message is to be sent from
			$mail->setFrom($organizationJson->email,$name);
			
			//Set an alternative reply-to address
			$mail->addReplyTo('dev4junction@gmail.com', $name);
			
			//Set who the message is to be sent to
			$mail->addAddress($organizationJson->email);
			
			//Set the subject line
			$mail->Subject = $subject;
			
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($message);
			
			//Replace the plain text body with one created manually
			$mail->AltBody = 'This is a plain-text message body';
			
			//Attach an image file
			//$mail->addAttachment($uploadfile,$filename);
			
			//send the message, check for errors
			
			
			if (!$mail->send())
			{
				print "We encountered an error sending your mail";
					
			}
			elseif($application_id='School')
			{
				$subjects=" Zero ERP :- Your Application Registered Successfully ";
				$messages= " <html><body><h3>Hello: Application Administrator </h3><p>Your Application is Successfully Registered Some Important Details Are <br> Organization Name:- <b>$organizationJson->organization_name</b> <br> User Name:- <b>$ApplicationJson->email</b> <br> Password:- <b>$ApplicationJson->password <br> </b> Database Name:- <b>$ApplicationJson->db_name</b> <br> Mobile Number:- <b>$ApplicationJson->mobile </b> <br> </p><p><h3>Please Click In This Link And Login With Use Of Those Userid, Password And Database :)</h3>'http://education.zeroerp.com/login/smsLogin?db_name=$ApplicationJson->db_name'</p></body></html>";
				$names='Junction Software Pvt Ltd';
				
				$mail->setFrom($ApplicationJson->email,$names);
					
				//Set an alternative reply-to address
				$mail->addReplyTo('dev4junction@gmail.com', $names);
			
				//Set who the message is to be sent to
				$mail->addAddress($ApplicationJson->email);
			
				//Set the subject line
				$mail->Subject = $subjects;
			
				//Read an HTML message body from an external file, convert referenced images to embedded,
				//convert HTML into a basic plain-text alternative body
				$mail->msgHTML($messages);
			
				//Replace the plain text body with one created manually
				$mail->AltBody = 'This is a plain-text message body';
			
				//Attach an image file
				//$mail->addAttachment($uploadfile,$filename);
			
				//send the message, check for errors
				
				
				if (!$mail->send()) 
				{
					print "We encountered an error sending your mail";
						
				}
				elseif($application_id='School')
				{
					?><script> alert('Your Application Registered Successfully Please Activate Your Application With Help Of Registered Email !!!!');</script><?php
					redirect("http://education.zeroerp.com/login/smsLogin?db_name=$ApplicationJson->db_name","refresh");
				}
				else{
					?><script> alert('Your Application Registered Successfully Please Activate Your Application With Help Of Registered Email !!!!');</script><?php
					redirect('http://junctiondev.cloudapp.net/appmanager/','refresh');
				}
			}	
			
			else
			{
				$subjects=" Zero ERP :- Your Application Registered Successfully ";
				$messages= " <html><body><h3>Hello: Application Administrator </h3><p>Your Application is Successfully Registered Some Important Details Are <br> Organization Name:- <b>$ApplicationJson->db_name</b> <br> User Name:- <b>$ApplicationJson->email</b> <br> Password:- <b>$ApplicationJson->password <br> </b> Database Name:- <b>$ApplicationJson->db_name</b> <br> Mobile Number:- <b>$ApplicationJson->mobile </b> <br> </p><p><h3>Please Click In This Link And Login With Use Of Those Userid, Password And Database :)</h3>
				'http://junctiondev.cloudapp.net/appmanager/login/school/$ApplicationJson->db_name'</p></body></html>";
				$names='Junction Software Pvt Ltd';
				
				//Set who the message is to be sent from
				$mail->setFrom($ApplicationJson->email,$names);
				
				//Set an alternative reply-to address
				$mail->addReplyTo('dev4junction@gmail.com', $names);
			
				//Set who the message is to be sent to
				$mail->addAddress($ApplicationJson->email);
			
				//Set the subject line
				$mail->Subject = $subjects;
				$mail->msgHTML($messages);
				//Replace the plain text body with one created manually
				$mail->AltBody = 'This is a plain-text message body';
				if (!$mail->send()) 
				{
					print "We encountered an error sending your mail";
				}
				elseif($application_id='School')
				{
					?><script> alert('Your Application Registered Successfully Please Activate Your Application With Help Of Registered Email !!!!');</script><?php
					redirect("http://junctiondev.cloudapp.net/sms/login/schoolLogin?databaseName=$ApplicationJson->db_name",'refresh');
				}
				else{
					?><script> alert('Your Application Registered Successfully Please Activate Your Application With Help Of Registered Email !!!!');</script><?php
					redirect('http://junctiondev.cloudapp.net/cpanel','refresh');
				}
			}
		
	}	
}