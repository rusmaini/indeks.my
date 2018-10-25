<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//control group user yg boleh access
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		$this->load->library('gravatar');
		
	}
	
	public function index()
	{
		#Settings									
		$data = $this->setting;
		
		$data['user']		= $this->Muser->get($this->session->userdata('user_id'));
		$data['content']	= 'profile/index';
		$this->load->view('template/index',$data);
	}
	
	
	public function test($id=100)
	{
		#Settings									
		$data = $this->setting;
		$data['user']		= $this->Muser->get($this->session->userdata('user_id'));
		$data['content']	= 'profile/index';
		$this->load->view('template/index',$data);
	}
	
	//untuk paparan public dengan username http://www.web.com/maini
	function view($username='')
	{
		#Settings									
		$data = $this->setting;
		
		if(!$user = $this->Muser->get_where('username',$username)):
			$this->session->set_flashdata('notis', '<p class="alert alert-warning">Opsss...</p>');
			redirect('');
		endif;
			
		$data['user']		= $user = $this->Muser->get_where('username',$username);
		$data['bio']		= $this->Mbiodata->get($user['id']);
		$data['content']	= 'profile/profile';
		$this->load->view('template/index',$data);
	}
	
	function edit()
	{
		/*
		 * Edit profail sendiri
		 * */
		 #Settings									
		$data = $this->setting;
		
		#Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<span class="help-inline label label-important">', '</span>');
		
		#Setting Validation Rules
		$this->form_validation->set_rules(	'password', 
											'Kata laluan', 
											'trim|matches[passconf]|md5');
		$this->form_validation->set_rules(	'passconf', 
											'Pengesahan kata laluan', 
											'trim');	
		
		$data['id']			= $id = $this->session->userdata('user_id');
		
		if ($this->form_validation->run() == FALSE):					
			$data['user']		= $this->Muser->get($this->session->userdata('user_id'));
			$data['content']	= 'profile/edit';
			$this->load->view('template/index',$data);
		else:
			
			if($this->input->post('password')!=''):
				$user = array(
					'password' 	=> $this->input->post('password')
				);
				$this->Muser->update($user,$id);
			endif;
			
			$this->session->set_flashdata('notis', '<p class="alert alert-success">Data berjaya dikemaskini..</p>');
			redirect('profile');
		endif;
		 
	}
	
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */