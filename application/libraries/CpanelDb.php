<?php
Class CpanelDb
{
	public function connection($databaseName)
	{	
		if($_SERVER['HTTP_HOST']=='192.168.1.151')
		{
			$username='root';
			$password='initial1$';
		}
		if($_SERVER['HTTP_HOST']=='192.168.1.161')
		{
			$username='root';
			$password='initial1$';
		}
		if($_SERVER['HTTP_HOST']=='192.168.1.171')
		{
			$username='root';
			$password='initial1$';
		}
		if($_SERVER['HTTP_HOST']=='cpanel.zeroerp.com')
		{
			$username='root';
			$password='initial1$';
		}
		if($_SERVER['HTTP_HOST']=='localhost:8080' || $_SERVER['HTTP_HOST']=='localhost')
		{
			$username='root';
			$password='';
		}	
		$connect=mysqli_connect('localhost',$username,$password,$databaseName);
		return $connect;
	}
	
	public function DBListCheck()
	{
		if($_SERVER['HTTP_HOST']=='192.168.1.151')
		{
			$username='root';
			$password='initial1$';
			$databaseName='';
		}
		if($_SERVER['HTTP_HOST']=='192.168.1.161')
		{
			$username='root';
			$password='initial1$';
			$databaseName='';
		}
		if($_SERVER['HTTP_HOST']=='192.168.1.171')
		{
			$username='root';
			$password='initial1$';
			$databaseName='';
		}
		if($_SERVER['HTTP_HOST']=='cpanel.zeroerp.com')
		{
			$username='root';
			$password='initial1$';
			$databaseName='';
		}
		if($_SERVER['HTTP_HOST']=='localhost:8080' || $_SERVER['HTTP_HOST']=='localhost')
		{
			$username='root';
			$password='';
			$databaseName='';
		}	
		$connect=mysqli_connect('localhost',$username,$password,$databaseName);
		return $connect;
	}
}