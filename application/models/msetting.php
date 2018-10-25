<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msetting extends MY_Model
{
	protected $_table = 'settings';
	
	public function get_where($value)
	{	
		return $this->db
					->get_where(
							$this->_table, 
							array('slug' => $value)
						)
					->row()
					->value;
	}
	
	public function get_all()
	{	
		return $this->db->get($this->_table)->result_array();	
	}
	
	function update($slug,$value)
	{
		$data = array(
			'value'	=> $value
		);
		$this->db->where('slug', $slug);
		$this->db->update($this->_table, $data); 
	}
}
	