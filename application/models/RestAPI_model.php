<?php
include(APPPATH.'libraries/CpanelDb.php');
 class RestAPI_model extends CI_Model
 {
	  
	  function __construct()
	  {
		  parent::__construct();
		  $this->load->database();
		  //$this->load->library('CpanelDb');
	  }
	  
	  /* Start Funtion For Insert........................................................................................................... */  
	  function insert_data($table,$data)
	  { 
			$this->db->insert($table, $data);
			$id= $this->db->insert_id();
			return $id;
	  }
	  /* End Funtion for insert............................................................................................................... */  
	  

	  /* Start Funtion For Count Master SQL Table Length..................................................................................... */  
	  function countMasterSQLLength($DATABASE)
	  {
			$instance=new CpanelDb();
			$connect=$instance->connection($DATABASE);
			//$connect=CpanelDb::connection($DATABASE);
			$sql="SELECT count(*) as 'Tables', table_schema as 'Database' FROM information_schema.TABLES WHERE table_schema='".$DATABASE."' GROUP BY table_schema";
			$result=mysqli_query($connect,$sql);
			$TablesLength=mysqli_fetch_assoc($result);
			if(isset($TablesLength['Tables']) && !empty($TablesLength['Tables']))
		    {
    	   		return $TablesLength['Tables'];
		    }
			else
			{
				return 0;
			}
	   }	  
	  /* End Funtion For Count Master SQL Table Length..................................................................................... */  
	  
	  
	  /* Start Funtion For Clone Master SQL File.......................................................................................... */  
	  function cloneDB($DATABASE=false)
	  { 
		    $this->db->query('CREATE DATABASE '.$DATABASE);
			$instance=new CpanelDb();
			$connect=$instance->connection($DATABASE);
			//$connect=CpanelDb::connection($DATABASE);
			$db_file=file_get_contents('school_mgt.sql');
			mysqli_multi_query($connect, $db_file);
			do {
					mysqli_store_result($connect);
			   }
		   while(mysqli_more_results($connect) && mysqli_next_result($connect));
    	   $query="SELECT count(*) as 'Tables', table_schema as 'Database' FROM information_schema.TABLES WHERE table_schema= '".$DATABASE."' GROUP BY table_schema";
		   $result=mysqli_query($connect,$query);
		   $countTable=mysqli_fetch_assoc($result);
		  $CountMasterSqlLength =$this->countMasterSQLLength('MASTERSQL');
		   if(isset($countTable['Tables']) && $countTable['Tables']==$CountMasterSqlLength)
		   {
    	   		return 'success';
		   }
		   else
		   {
			   return 'error';
		   }
	  }
	  /* End Funtion For Clone Master SQL File.......................................................................................... */ 

	  
		/* Start Funtion For User Insert Behalf on Create Database .............................................................. */ 
		function set_user($data1=false,$data2=false,$DATABASE=false)
		{	
			$instance=new CpanelDb();
			$connect=$instance->connection($DATABASE);
			//$connect=CpanelDb::connection($DATABASE);
			$result = " INSERT INTO user (UserId,StaffId,Username,Password,UserType,DOE,DOL,Staff_terms,DOLUsername) VALUES('1','','$data1','$data2','0','','','Accepted','')";
			$response=mysqli_query($connect,$result);
			if($response)
			{
				return 'success';
			}
			else
			{
				return 'error';
			}
		}
		/* End Funtion For User Insert Behalf on Create Database ..................................................................... */ 
		
		
		/* Start Funtion For Insert License Key Date on Create Database .............................................................. */ 
		function set_license($licenceExpiry,$DATABASE)
		{	
			$instance=new CpanelDb();
			$connect=$instance->connection($DATABASE);
			//$connect=CpanelDb::connection($DATABASE);
			$result = " INSERT INTO license (licenseID,licenceExpiry,applicationStatus) VALUES('1','$licenceExpiry','suspend') ";
			$response=mysqli_query($connect,$result);
			if($response)
			{
				return 'success';
			}
			else
			{
				return 'error';
			}
			
		}
		/* End Funtion For Insert License Key Date on Create Database.............................................................. */ 
		
		
		/* Start Funtion For Check Database Name On Server Exist Or Not.............................................................. */ 
		function DBCheck($database)
		{
			//$connect=mysqli_connect('localhost','root','','');
			//$connect=CpanelDb::DBListCheck($DATABASE);
			$instance=new CpanelDB();
			$connect=$instance->DBListCheck();
			$DatabaseList=mysqli_query($connect,"SHOW DATABASES");
			while($result=mysqli_fetch_object($DatabaseList))
			{
				if($result->Database==$database)
				{
					return 'exist';
				}
			}
		}
		/* End Funtion For Check Database Name On Server Exist Or Not.............................................................. */
		
		
		/* Start Funtion For Drop Database........................................................................................ */
		function DropDatabase($database)
		{
			$this->db->query('DROP DATABASE '.$database);
			return true; 
		}
		/* End Funtion For Drop Database........................................................................................ */
		
		
		/* Start Funtion For Get Data Behalf On Filter................................................................................ */
		function get($table,$filter)
		{
			$query=$this->db->get_where($table,$filter);
			return $query->result();
		}
		/* End Funtion For Get Data Behalf On Filter................................................................................ */
		
		
		/* Start Funtion For Delete Data Behalf On Filter................................................................................ */
		function delete($table,$filter)
		{
			$this->db->where($filter);
			$query=$this->db->delete($table);
			if($query)
			{
				return 'success';
			}
			else
			{
				return 'error';
			}
			
		}
		/* End Funtion For Delete Data Behalf On Filter................................................................................ */
		
		
		/* Start Funtion For Update Data Behalf On Filter................................................................................ */
		function put($table,$filter,$data)
		{
			$this->db->where($filter);
			$this->db->update($table,$data);
		}
		/* End Funtion For Update Data Behalf On Filter................................................................................ */
		
		
		/* Start Funtion For Update OTP Code Behalf On Filter................................................................................ */
		function UpdateCodeUser($DATABASE,$table,$code,$email)
		{
			$instance=new CpanelDb();
			$connect=$instance->connection($DATABASE);
			//$connect=CpanelDb::connection($DATABASE);
			$sql="update user SET Password='$code' where Username='$email'";
			$query=mysqli_query($connect,$sql);
			if($query)
			{
				return 'success';
			}
			else
			{
				return 'error';
			}
		}
		/* End Funtion For Update OTP Code Behalf On Filter................................................................................ */
		
		
		/* Start Funtion For Update OTP Code Behalf On Filter................................................................................ */
		function UpdateCodeOrganization($DATABASE,$table,$code,$email)
		{
			$instance=new CpanelDb();
			$connect=$instance->connection($DATABASE);
			//$connect=CpanelDb::connection($DATABASE);
			$sql="update organizations SET password='$code' where email='$email'";
			$query=mysqli_query($connect,$sql);
			if($query)
			{
				return 'success';
			}
			else
			{
				return 'error';
			}
		}
		/* Start Funtion For Update OTP Code Behalf On Filter................................................................................ */
		

		function CheckOtp($DATABASE,$code)
		{
			$instance=new CpanelDb();
			$connect=$instance->connection($DATABASE);
			//$connect=CpanelDb::connection($DATABASE);
			$sql="select * from user where Password='$code'";
			$query=mysqli_query($connect,$sql);
			$result=mysqli_fetch_array($query);
			if($result)
			{
				return $result;
			}
			else
			{
				return 'error';
			}
		}
		
		function CheckEmail($DATABASE,$email)
		{
			$instance=new CpanelDb();
			$connect=$instance->connection($DATABASE);
			//$connect=CpanelDb::connection($DATABASE);
			$sql="select * from user where Username='$email'";
			$query=mysqli_query($connect,$sql);
			$result=mysqli_fetch_array($query);
			if($result)
			{
				return $result;
			}
			else
			{
				return 'error';
			}
		}
		
 }