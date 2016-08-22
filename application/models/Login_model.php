<?php
//include(APPPATH.'libraries/CpanelDb.php');
class Login_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
		/*.......................... function for select data for behalf on database name .....................................*/
	function login($filter,$data)
	{
		$this->db->select('*');
		$qry=$this->db->get_where($filter,$data);
		return $qry->result();
	}
	
		/*............................ function for select data for behalf on database name ...................................*/
	function getRows($table,$filter)
	{
		$qry=$this->db->get_where($table,$filter);
		return $qry->result();
	}
	
	/*.................................. function for result for application .......................................*/
	function result_application($organization_id=false)
	{
		//$this->db->trans_start();
		$filter=array(
						'organization_id'=>$organization_id
					);
		$qry=$this->db->delete('registered_application',$filter);
		if($qry)
		{
			$qry=$this->db->delete('organizations',$filter);
			return true;
		}
		//$this->db->trans_rollback();
		//$this->db->trans_complete();
	}
	
	/*function for count application in application list*/
	function app_list($filter=false)
	{ 
		if($filter)
		{
			$qry=$this->db->get_where('applications',array('application_id'=>$filter));
			return $qry->result();
		}
		else
		{
		$this->db->select('*');
		$qry=$this->db->get('applications');
		return $qry->result();
		}
	}
	
	 function clone_db($database_name=false)
    { //echo $database_name; return;
		
    	$this->db->query('CREATE DATABASE '.$database_name);
    	if($_SERVER['HTTP_HOST']=="localhost"){
    		//$dbname=$database_name;
    		$password="";
    		$username="root";
    	}
    	if($_SERVER['HTTP_HOST']=="junctiondev.cloudapp.net"){
    		//$dbname=$database_name;
    		$password="bitnami";
    		$username="root";
    	}
    	if($_SERVER['HTTP_HOST']=="junctiontech.in"){
    		//$dbname=$database_name;
    		$password="junction4$";
    		$username="junctwhx";
    	}
    	$connect=mysqli_connect('localhost',$username,$password,$database_name);
    	$db_file=file_get_contents('school_mgt.sql');
    	mysqli_multi_query($connect, $db_file);
    	do {
    			mysqli_store_result($connect);
    	   }
    	   while(mysqli_more_results($connect) && mysqli_next_result($connect));
		 $query="SELECT count(*) as 'Tables', table_schema as 'Database' FROM information_schema.TABLES WHERE table_schema= '".$database_name."' GROUP BY table_schema";
		
		   $result=mysqli_query($connect,$query);
		   $countTable=mysqli_fetch_assoc($result); //echo $countTable['Tables'];die;
		   if(isset($countTable['Tables']) && $countTable['Tables']=='76')
		   {	
    	   		return true;
		   }
		   else
		   {	
		   		//$CII =& get_instance();
			  // 	$CII->load->library('session'); //if it's not autoloaded in your CI setup
			 //  	$database_name=$CII->session->userdata('db_name');
			  // 	$CII->session->unset_userdata($database_name);
			  // 	$CII->session->sess_destroy();
			   	echo 'database does not exist';return;die;
		   } 
    }
   
    function set_user($data=false)
    {	//echo 'model';die;
	//echo	$this->session->userdata('db_name');die;
    	$this->load->database('default',TRUE);
    	$qry=	$this->db->insert('user',$data);
   	   	return true;
    }
	
	
	 /* function for list of database name from central database */
    function list_dbname($table=false,$data=false)
    {
    	$this->db->select('db_name');
    	$this->db->where('app_name',$data);
    	$qry=$this->db->get($table);
    	return $qry->result();
    } 
	
	/* function for get application information */
	function get_application_info()
	{
		$this->db->select('*');
		$qry=$this->db->get('application_manage');
		return $qry->result();
	}
	
	/* function for new user create */
	function set_registration_application($table=false,$data=false)
	{
		$this->db->insert($table,$data);
		$id= $this->db->insert_id();
		return $id;	
	}
	
	// connect for server database particular organization 
	function daynamic_db($data,$db_name)
	{	
		$con=mysqli_connect('localhost','root','',$db_name);
		if($con)
		{
			$qry="select * from user where Username='".$data['Username']."' and Password='".$data['Password']."'";
			$query=mysqli_query($con,$qry);
			$result=mysqli_fetch_array($query);
			return $result;
		}
	}
	
	/*	function for check organization	*/
	function verification_new_user($val,$field_name)
	{
		if($field_name=='Organization')
		{
			$data=array('organization_name'=>$val);
		}
		if($field_name=='Email')
		{
			$data=array('email'=>$val);
		}
		if($field_name=='Username')
		{	
			$data=array('Username'=>$val);
		}
		if($field_name=='Database name')
		{
			$qry=$this->db->get_where('registered_application',array('db_name'=>$val));
			return $qry->result();
		}
		$qry=$this->db->get_where('organizations',$data);
		return $qry->result();
	}
	
	/*	function for check organization	*/
	function get_organization_id($org_name)
	{
		$this->db->select('*');
		$qry=$this->db->get_where('organizations',array('organization_name'=>$org_name));
		//print_r($qry);die;
		return $qry->result();
	}
	
	/* function for update application status by gmail */
	function activate_org($table=false,$filter=false)
	{
		$this->db->where($filter);
		$qry=$this->db->update($table,array('applicationStatus'=>'active'));
		return true;
	}
	/* function for fetching application_id from registered_application table*/
	function app_id($table,$filter)
	{
		$qry=$this->db->get_where($table,$filter);
		return $qry->result();
	}                                       
	
	 function UpdateLicenseStatus($database=false,$dbpwd)
	 {
		$instance=new CpanelDB();
		$connection=$instance->connection($database,$dbpwd);
		$sql="UPDATE license SET applicationStatus='active' WHERE licenseID='1' "; 
		$query=mysqli_query($connection,$sql);
		//$result=mysqli_fetch_array($query);
		return $query;
	 }
	
	/* function for Get Data Organization And Application Admin */
	function get_reset_password($table=false,$filter=false)
	{
		$this->db->select('*');
		$qry=$this->db->get_where($table,$filter);
		return $qry->result();
	}
	
	/* function for update Password Organization And Application Admin */
	function set_reset_password($table=false,$filter=false,$data=false)
	{
		$this->db->where($filter);
		$qry=$this->db->update($table,$data);
		return true;
	}
	
	function schooldetail($schoolname=false)
	{
		
		 $this->db->select('organization_name');
		$this->db->from('organizations');
		$this->db->where(array('organization_name'=>$schoolname));
		$qry=$this->db->get();
		return $qry->result(); 
	}
	
	function schoolinfo()
	{
		$school=$this->load->database('school',true);
		$qry=$school->query("select SchoolName,SchoolMoto,Logo from generalsetting");
		return $qry->result();
	}

	
	function DeleteDatabase($db_name=false)
    {	
    	$this->db->query('DROP DATABASE '.$db_name);
    	return true;
    }
	
	function post($table,$data)
	{
		$query=$this->db->insert($table,$data);
		return $query;
	}
}