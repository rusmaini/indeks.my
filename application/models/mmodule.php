<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mmodule extends MY_Model
{
	protected $_table = 'modules';
	
	public function get_all()
	{	
		return $this->db->get($this->_table)->result_array();	
	}
	
	function get($id)
	{
		return $this->db->get_where($this->_table,array('id'=>$id))->row_array();
	}
	
	function insert($data)
	{
		$this->db->insert($this->_table, $data); 
	}
	
	function update($data,$id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_table, $data); 
	}
	
	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->_table); 
	}
}
	