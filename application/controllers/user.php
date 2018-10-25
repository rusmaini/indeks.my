<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//control group user yg boleh access
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		//check permission
		//user id = 1
		if(!$this->Mpermission->check($this->session->userdata('group_id'),1)) redirect('home/noaccess');
	}
	
	public function index()
	{
		#Settings									
		$data = $this->setting;
		
		$data['user']		= $this->Muser->get_all();
		$data['content']	= 'user/index';
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
		$this->form_validation->set_rules(	'email', 
											'Emel', 
											'trim|required|valid_email');
		$this->form_validation->set_rules(	'username', 
											'Nama pengguna', 
											'trim|required|min_length[5]|max_length[12]|alpha_dash');	
		$this->form_validation->set_rules(	'password', 
											'Kata laluan', 
											'trim|matches[passconf]|md5');
		$this->form_validation->set_rules(	'passconf', 
											'Pengesahan kata laluan', 
											'trim');
											
		$data['active']	= array(
			1	=> 'Aktif',
			0	=> 'Tidak aktif'
		);
		
		$group_arr = $this->Mgroup->get_all();
		foreach($group_arr as $gr):
			$group_list[$gr['id']] = $gr['name'];
		endforeach;
		$data['group'] = $group_list;
		
		if ($this->form_validation->run() == FALSE):
			$data['id']			= $id;
			$data['user']		= $this->Muser->get($id);
			$data['content']	= 'user/edit';
			$this->load->view('template/index',$data);
		else:
			if($id==0):
				//check uniqe email
				if($this->Muser->get_where('email',$this->input->post('email'))):
					$this->session->set_flashdata('notice', '<p class="alert alert-error">Maaf, emel sudah digunakan..</p>');	
					redirect('user/edit');
					exit();
				endif;
				
				$user = array(
					'email' 	=> $this->input->post('email'),
					'username' 	=> $this->input->post('username'),
					'password' 	=> $this->input->post('password'),
					'group_id' 	=> $this->input->post('group_id'),
					'active' 	=> $this->input->post('active'),
					'created_on' => date('Y-m-d H-i-s')
				);
				$this->Muser->insert($user);
				$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya disimpan..</p>');	
			else:
				$user = array(
					'email' 	=> $this->input->post('email'),
					'username' 	=> $this->input->post('username'),
					'group_id' 	=> $this->input->post('group_id'),
					'active' 	=> $this->input->post('active'),
					'created_on' => date('Y-m-d H-i-s')
				);
				$this->Muser->update($user,$id);
				
				if($this->input->post('password')!=''):
					$user = array(
						'password' 	=> $this->input->post('password')
					);
					$this->Muser->update($user,$id);
				endif;
				
				$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya dikemaskini..</p>');	
			endif;
						
			redirect('user');
		endif;
	}

	function delete($id=0)
	{
		$this->Muser->delete($id);
		$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya dibuang..</p>');				
		redirect('user');
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */