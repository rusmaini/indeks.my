<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mbiodata extends MY_Model
{
	protected $_table = 'biodata';
	
	
	function get($uid)
	{
		return $this->db->get_where($this->_table,array('user_id'=>$uid))->row_array();
	}
	
	function get_where($field,$value)
	{
		return $this->db->get_where($this->_table,array($field=>$value))->row_array();
	}
	
	function insert($data)
	{
		$this->db->insert($this->_table, $data); 
		return $this->db->insert_id();
	}
	
	function update($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_table, $data); 
	}
	
	
	
	
	
	
	
	
	/********************************************** beum pakai **********************************************/
	function get_all()
	{	
		return $this->db->select('users.*, groups.name')
						->from('users')
						->join('groups','groups.id = users.group_id','left')
						->get()
						->result_array();	
	}
	
	
	
	
	
	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->_table); 
	}
	
	function check_email($email)
	{
		return $this->db->get_where($this->_table,array('email'=>$email))->row_array();
	}
	
	function check_username($username)
	{
		return $this->db->get_where($this->_table,array('username'=>$username))->row_array();
	}
	
	function aktif($kod)
	{
		$this->db->select('id');
		$this->db->where('activation_code',$kod);
		$this->db->where('active',0);
		$this->db->limit(1);
		$q = $this->db->get($this->_table);
		if($q->num_rows() > 0):
			$data = array('active' 	=> 1);
			$this->db->where('activation_code', $kod);
			$this->db->update($this->_table, $data);
			return true;
		else:
			return false;
		endif;
	}
	
}
	