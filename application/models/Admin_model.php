<?php
include(APPPATH.'libraries/CpanelDb.php');
class Admin_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		//$this->load->library('CpanelDB');
	}
	
	/* Function for Verify Organization Admin user id and password.......................................................................*/
	function verify_admin($table,$data)
	{
		$qry=$this->db->get_where($table,$data);
		return $qry->result();
	}
	
	/* Function for show organization list for particular organization Admin and super admin.....................................................*/
	function getOrganizationDetails($data=false)
	{
		
		if($data)			// when organization admin login admin panel and create session in admin login part
		{ 
			$qry=$this->db->query("select organizations.*,registered_application.* from organizations,registered_application where organizations.organization_id=$data && registered_application.organization_id=$data");
			return $qry->result();
		}
		else
		{
			$qry=$this->db->query("select organizations.*,registered_application.* from organizations,registered_application where organizations.organization_id=registered_application.organization_id");
			return $qry->result();
		}
	}
	
	/* function for sorting..............................................................................*/
	function sorting($id=false)
	{
		$qry=$this->db->query("select sw_registration.*,registered_application.* from sw_registration,registered_application where sw_registration.organization_id=registered_application.organization_id ORDER BY $id ASC ");
		return $qry->result();
	}
	
	/* Function for get single application information for organization .......................................................................*/
	function get_single_org_app_info($table=false,$id=false)
	{
		$qry=$this->db->get_where($table,array('registration_id'=>$id));
		return $qry->result();
	}
	
	/* Function for update information for organization registered application.......................................................................*/
	function set_update_org_app_info($table,$data,$filter)
	{
		$this->db->where($filter);
		$this->db->update($table,$data);
		return true;
	}
	
	/* Function For insert application by super admin*/
	function set_application($table=false,$data=false)
	{
		$this->db->insert($table,$data);
		return true;
	}
	

	
	/* Function For retrive data from registration application behalf on registration id in update case status by super admin */
	function update_status_org($table,$data)
	{
		$qry=$this->db->get_where($table,$data);
		return $qry->result();
	}
	
	
	 function UpdateLicenseDate($date,$DATABASE=false)
	 {
		$instance=new CpanelDB();
		$connection=$instance->connection($database);
		//$connect=CpanelDB::connection($DATABASE);
		$sql="UPDATE license SET licenceExpiry='$date' WHERE licenseID='1' "; 
		$query=mysqli_query($connection,$sql);
		//$result=mysqli_fetch_array($query);
		return $query;
	 }
	
	function insert($table,$data)
	{
		$this->db->insert($table,$data);
		return true;
	}
	
	function put($table,$data,$filter)
	{
		$this->db->where($filter);
		$this->db->update($table,$data);
		return true;
	}
	
	function GetDetails($table,$filter)
	{
		$query=$this->db->get_where($table,$filter);
		return $query->result();
	}
	
	 function DeleteDatabase($db_name=false)
    {	
    	$this->db->query('DROP DATABASE '.$db_name);
    	return true;
    }
	
	/* Function for delete organization application detail in consaole manage application................*/
	function DeleteInformation($table=false,$filter=false)
	{
		$this->db->delete($table,$filter);
		return true;
	}
	
	function GetSqlVersion($CurrentDate)
	{	//echo $CurrentDate;
		$query=$this->db->query("select sqlVersionName from sqlChanges where status='new' or status='pending' and createdON<= '$CurrentDate'");
		return $query->result();
	}
	
	 function ServerDBList()
	{
		//$connect=mysqli_connect('localhost','root','','');
		//$connect=CpanelDB::DBListCheck();
		$instance=new CpanelDB();
		$connect=$instance->DBListCheck();
		$DatabaseList=mysqli_query($connect,"SHOW DATABASES");
		while($result=mysqli_fetch_object($DatabaseList))
		{
			if($result->Database)
			{ 
				$dbList[]=$result->Database;
			}
		}
		return $dbList;
	}
	
	 function CpanelDBList()
	{
		$this->db->db_select('cpanel');
		$query=$this->db->get('registered_application');
		return $query->result();
	}
	
	
	function get($table)
	{
		$query=$this->db->get($table);
		return $query->result();
	}
	
	
	function updateDB($DATABASE,$SQLFile)
	{
		//$connect=mysqli_connect('localhost','root','',$DATABASE);
		//$connect=CpanelDB::connection($DATABASE);
		$instance=new CpanelDB();
		$connect=$instance->connection($DATABASE);
		$result=mysqli_multi_query($connect, $SQLFile);
		do {
				mysqli_store_result($connect);
		   }
	   while(mysqli_more_results($connect) && mysqli_next_result($connect));
	   return $result;
	}
	
	function MASTERSQL($QUERY)
	{
		//$connect=mysqli_connect('localhost','root','','TESTQUERY');
		//$connect=CpanelDB::connection('MASTERSQL');//print_r($connect);die;
		$instance=new CpanelDB();
		$connect=$instance->connection('MASTERSQL');
		$result=mysqli_multi_query($connect, $QUERY);
		do {
				mysqli_store_result($connect);
		  }
	   while(mysqli_more_results($connect) && mysqli_next_result($connect));
	   return $result;
	}
	
	function QueryTest($QUERY)
	{
		//$connect=mysqli_connect('localhost','root','','TESTQUERY');
		//$connect=CpanelDB::connection('TESTQUERY');//print_r($connect);die;
		$instance=new CpanelDB();
		$connect=$instance->connection('TESTQUERY');
		$result=mysqli_multi_query($connect, $QUERY);
		do {
				mysqli_store_result($connect);
		  }
	   while(mysqli_more_results($connect) && mysqli_next_result($connect));
	   return $result;
	}
	
	/* function OrganizationName($DBName)
	{
		$query=$this->db->query("select organizations.organization_name from organizations,registered_application where registered_application.db_name='$DBName' and registered_application.organization_id=organizations.organization_id ");
		return $query->result();
	} */
	
}
