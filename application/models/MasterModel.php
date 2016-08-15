<?php
class MasterModel extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/* Function for Verify Organization Admin user id and password.......................................................................*/
	function get()
	{
		$qry=$this->db->get('Profiles');
		return $qry->result();
	}
	
	function getDistinct($table,$calumn)
	{
		$this->db->distinct();
		$this->db->select($calumn);
		$this->db->order_by($calumn,'asc');
		$qry=$this->db->get($table);
		return $qry->result();
	}
	
	function ProfilesListGet($query)
	{	//echo "select * from Profiles where $query";//die;
		$query=$this->db->query("select * from Profiles where $query");// print_r($query);die;
		return $query->result();
	}
	
	function getfilter($table,$filter)
	{
		$qry=$this->db->get_where($table,$filter);
		return $qry->result();
	}
}
