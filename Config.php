<?php
class Config
{
	/* protected  $hostName;
	protected $userName;
	protected $password;
	protected $databaseName;
	
	if(mysqli_connect_errno())
	{
		con not 
	}
	else
	{
		connection stablish
	}
	
	
	 */
/* 	function host()
	{
		$host=$_SERVER['HTTP_HOST'];
		if(isset($host) && $host=='localhost:8080'||$host=='localhost' )
		{
			$userName='root';
			$password='';
			return $result=array('userName'=>'root','password'=>'');
		}
		elseif(isset($host) && $host=='192.168.1.181' )
		{
			$userName='root';
			$password='initial1$';
			return $result=array('userName'=>'root','password'=>'initial1$');
		}
		elseif(isset($host) && $host=='apijobs.zeroerp.com' )
		{
			$userName='root';
			$password='initial1$';
			return $result=array('userName'=>'root','password'=>'initial1$');
		}
	}
	
	function connection()
	{
		$data=$this->host();
		$connection=mysqli_connect('localhost',$data['userName'],$data['password'],'LifePartner');
		if (mysqli_connect_error())
		{
			return 0;
		}
		else{ return $connection; }
	
	} */
	 function connection()
	{
		$connection=mysqli_connect('localhost','root','initial1$','LifePartner');
		if(isset($connection))
		{
			return $connection;
		}
	} 
	
	function projectCredential()
	{
		
	}
}
