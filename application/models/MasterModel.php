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
		$this->db->order_by('firstName','asc');
		$qry=$this->db->get('Profiles');
		return $qry->result();
	}
	
	function postLastId($table,$data)
	{
		$this->db->insert($table,$data);
		$id=$this->db->insert_id();
		return $id;
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
	{	 
			echo "select * from Profiles where $query";die;
		$query=$this->db->query("select * from Profiles where $query");// print_r($query);die;
		return $query->result();
	}
	
	function post($table,$data)
	{
		$query=$this->db->insert($table,$data);
		return $query;
	}
	
	function getfilter($table,$filter)
	{
		$qry=$this->db->get_where($table,$filter);
		return $qry->result();
	}
	
	function getData($table,$filter)
	{
		$qry=$this->db->get_where($table,$filter);
	
		return $qry->result();
	}
	function put($table,$data,$filter)
	{
		$this->db->where($filter);
		$query=$this->db->update($table,$data);
		return $query;
	}
	function delete($table,$filter)
	{
		$query=$this->db->delete($table,$filter);
		return $query;
	}
}
