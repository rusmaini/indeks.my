<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//control group user yg boleh access
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		//check permission
		//module id = 5
		if(!$this->Mpermission->check($this->session->userdata('group_id'),5)) redirect('home/noaccess');
	}
	
	public function index()
	{
		#Settings									
		$data = $this->setting;
		
		$data['module'] 		= $this->Mmodule->get_all();
		$data['content']	= 'module/index';
		$this->load->view('template/index',$data);
	}
	
	//$id=0 insert; $id!=0 update. (add & update guna borang yang sama)
	function edit($id=0)
	{		
		#Settings									
		$data = $this->setting;
		
		#Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		
		#Setting Validation Rules
		$this->form_validation->set_rules(	'name', 
											'Nama modul', 
											'required|max_length[100]|min_length[3]|alpha_dash');
		$this->form_validation->set_rules(	'description', 
											'Keterangan', 
											'required|max_length[255]');	
		if ($this->form_validation->run() == FALSE):
			$data['id']			= $id;
			$data['module']		= $this->Mmodule->get($id);
			$data['content']	= 'module/edit';
			$this->load->view('template/index',$data);
		else:
			$module = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description')
			);
			if($id==0):
				$this->Mmodule->insert($module);
				$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya disimpan..</p>');	
			else:
				$this->Mmodule->update($module,$id);
				$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya dikemaskini..</p>');	
			endif;
						
			redirect('module');
		endif;
	}

	function delete($id=0)
	{
		$this->Mmodule->delete($id);
		$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya dibuang..</p>');				
		redirect('module');
	}
	
}

/* End of file module.php */
/* Location: ./application/controllers/module.php */