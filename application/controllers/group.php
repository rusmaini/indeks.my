<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//control group user yg boleh access
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		
		//check permission
		//module id = 2
		if(!$this->Mpermission->check($this->session->userdata('group_id'),2)) redirect('home/noaccess');
	}
	
	public function index()
	{
		#Settings									
		$data = $this->setting;
		
		$data['group'] 		= $this->Mgroup->get_all();
		$data['content']	= 'group/index';
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
											'Nama kumpulan', 
											'required|max_length[100]|min_length[3]');
		$this->form_validation->set_rules(	'description', 
											'Keterangan', 
											'required|max_length[255]');	
		if ($this->form_validation->run() == FALSE):
			$data['id']			= $id;
			$data['group']		= $this->Mgroup->get($id);
			$data['content']	= 'group/edit';
			$this->load->view('template/index',$data);
		else:
			$group = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description')
			);
			if($id==0):
				$this->Mgroup->insert($group);
				$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya disimpan..</p>');	
			else:
				$this->Mgroup->update($group,$id);
				$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya dikemaskini..</p>');	
			endif;
						
			redirect('group');
		endif;
	}

	function delete($id=0)
	{
		$this->Mgroup->delete($id);
		$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya dibuang..</p>');				
		redirect('group');
	}
	
}

/* End of file group.php */
/* Location: ./application/controllers/group.php */