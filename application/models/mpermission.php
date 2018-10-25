<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpermission extends MY_Model
{
	protected $_table = 'permissions';
	
	public function get_all()
	{
		$this->db->select('
			'.$this->_table.'.id as id,
			modules.name as mod_name, 
			modules.description as mod_desc,
			groups.name as group_name,
			groups.description as group_desc
		');
		$this->db->from($this->_table);
		$this->db->join('modules', 'modules.id = '.$this->_table.'.module_id');
		$this->db->join('groups', 'groups.id = '.$this->_table.'.group_id');
		
		return $this->db->get()->result_array();	
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
	
	function check($gid,$mid)
	{
		$data = array(
			'group_id'	=>$gid,
			'module_id'	=> $mid);
		return $this->db->get_where($this->_table,$data)->row_array();
	}
}
	