<?php
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
	
	function put($table,$data,$filter)
	{
			 $this->db->where($filter);
		$qry=$this->db->update($table,$data);
	}
	
	function post($table,$data)
	{
		$qry=$this->db->inset($table,$data);
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
	
	function getfilter($table,$filter)
	{
		$qry=$this->db->get_where($table,$filter);
		return $qry->result();
	}
}