+<?php
class Apimodel extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/* Function for Verify Organization Admin user id and password.......................................................................*/
	function get()
	{
		$this->db->order_by('firstName','asc');
		$qry=$this->db->get('Profiles');
		return $qry->result();
	}
	

	function getfilter($table,$filter)
	{
		$qry=$this->db->get_where($table,$filter); 
		return $qry->result();
	}
	
	function getfilterOrderBy($table,$filter)
	{
		$qry=$this->db->query("SELECT * FROM `requestContact` WHERE requestRegisterUserID='$filter' ORDER BY status DESC");
		return $qry->result();
	}
	
	function put($table,$data,$filter)
	{
		$this->db->where($filter);
		$qry=$this->db->update($table,$data);
		if($qry)
		{
			return $qry;
		}
	}
	
	function post($table,$data)
	{
		$qry=$this->db->insert($table,$data);
		return $qry;
	}
	
}
