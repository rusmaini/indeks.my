<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//control group user yg boleh access
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		//check permission
		//permission id = 3
		#if(!$this->Mpermission->check($this->session->userdata('group_id'),3)) redirect('home/noaccess');
		//kes khas - hanya admin boleh capai
		if($this->session->userdata('group_id')!=1) redirect('home/noaccess');
	}
	
	public function index()
	{
		#Settings									
		$data = $this->setting;
		
		$data['permission'] 		= $this->Mpermission->get_all();
		$data['content']	= 'permission/index';
		$this->load->view('template/index',$data);
	}
	
	//$id=0 insert; $id!=0 update. (add & update guna borang yang sama)
	function edit($id=0)
	{								
		#Settings	
		$data = $this->setting;
		
		//get module
		$module = $this->Mmodule->get_all();
		$mod_arr = array();
		$mod_arr[''] = ' - Sila pilih - ';
		foreach ($module as $row) {
			$mod_arr[$row['id']] = $row['name'].' - '.$row['description'];
		}
		$data['module'] = $mod_arr;
		
		//get group
		$group = $this->Mgroup->get_all();
		$group_arr = array();
		$group_arr[''] = ' - Sila pilih - ';
		foreach ($group as $row) {
			$group_arr[$row['id']] = $row['name'];
		}
		$data['group'] = $group_arr;
		
		#Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<span class="help-inline label label-important">', '</span>');
		
		#Setting Validation Rules
		$this->form_validation->set_rules(	'module_id', 
											'Nama modul', 
											'required');
		$this->form_validation->set_rules(	'group_id', 
											'Nama kumpulan pengguna', 
											'required');	
		if ($this->form_validation->run() == FALSE):
			$data['id']				= $id;
			$data['permission']		= $this->Mpermission->get($id);
			$data['content']		= 'permission/edit';
			$this->load->view('template/index',$data);
		else:
			$permission = array(
				'module_id' => $this->input->post('module_id'),
				'group_id' 	=> $this->input->post('group_id')
			);
			if($id==0):
				$this->Mpermission->insert($permission);
				$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya disimpan..</p>');	
			else:
				$this->Mpermission->update($permission,$id);
				$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya dikemaskini..</p>');	
			endif;
						
			redirect('permission');
		endif;
	}

	function delete($id=0)
	{
		$this->Mpermission->delete($id);
		$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya dibuang..</p>');				
		redirect('permission');
	}
	
}

/* End of file permission.php */
/* Location: ./application/controllers/permission.php */