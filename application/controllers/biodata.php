<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Biodata extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		//control group user yg boleh access
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		//check permission
		$module_id = 6;
		if(!$this->Mpermission->check($this->session->userdata('group_id'),$module_id)) redirect('home/noaccess');
	}
	
	public function index()
	{
		#Settings									
		$data = $this->setting;
		
		$data['user']		= $this->Muser->get($this->session->userdata('user_id'));
		$data['bio']		= $this->Mbiodata->get($this->session->userdata('user_id'));
		$data['content']	= 'biodata/index';
		$this->load->view('template/index',$data);
	}
	
	function edit()
	{
		#Settings									
		$data = $this->setting;
		
		//get negeri
		$negeri = $this->Mnegeri->get_all();
		$negeri_arr = array();
		$negeri_arr[''] = ' - Sila pilih - ';
		foreach ($negeri as $row) {
			$negeri_arr[$row['nama']] = $row['nama'];
		}
		$data['negeri'] = $negeri_arr;
		
		
		#Setting Validation Rules
		$this->form_validation->set_rules(	'nama_penuh', 
											'Nama Penuh', 
											'required');
		$this->form_validation->set_rules(	'alamat', 
											'Alamat', 
											'required');
		$this->form_validation->set_rules(	'poskod', 
											'Poskod', 
											'required|integer|min_length[5]|max_length[5]');
		$this->form_validation->set_rules(	'bandar', 
											'Bandar', 
											'required');
		$this->form_validation->set_rules(	'negeri', 
											'Negeri', 
											'required');
		$this->form_validation->set_rules(	'no_telefon', 
											'No. Telefon', 
											'required');
		$this->form_validation->set_rules(	'tarikh_lahir', 
											'Tarikh Lahir', 
											'required');
											
		#Setting Error Messages
		$this->form_validation->set_message('required', '%s mesti diisi.');
	    $this->form_validation->set_message('max_length', '%s mesti mengandungi tidak lebih daripada %d aksara.');
	    $this->form_validation->set_message('min_length', '%s mesti mengandungi sekurang-kurangnya %d aksara.');
	   
		#Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
		
		$data['bio']	= $bio = $this->Mbiodata->get($this->session->userdata('user_id'));
			
		if ($this->form_validation->run() == FALSE):
			$data['user']		= $this->Muser->get($this->session->userdata('user_id'));
			$data['content']	= 'biodata/edit';
			$this->load->view('template/index',$data);
		else:
			//tukar format tarikh lahir dmy ke mdy
			$tl = explode('/',$this->input->post('tarikh_lahir'));
			$tarikh_lahir = $tl[1].'/'.$tl['0'].'/'.$tl[2];
			
			if($bio):
				//update
				$bio_update = array(
					'nama_penuh'	=> $this->input->post('nama_penuh'),
					'alamat'		=> $this->input->post('alamat'),
					'poskod'		=> $this->input->post('poskod'),
					'bandar'		=> $this->input->post('bandar'),
					'negeri'		=> $this->input->post('negeri'),
					'no_telefon'	=> $this->input->post('no_telefon'),
					'tarikh_lahir'	=> date('Y-m-d H:i:s a',strtotime($tarikh_lahir)),
					'url'			=> $this->input->post('url'),
					'pekerjaan'		=> $this->input->post('pekerjaan'),
					'updated_on'	=> date('Y-m-d H:i:s a')
				);
				$this->Mbiodata->update($bio_update,$bio['id']);
			else:
				//insert
				$bio_insert = array(
					'user_id'		=> $this->session->userdata('user_id'),
					'nama_penuh'	=> $this->input->post('nama_penuh'),
					'alamat'		=> $this->input->post('alamat'),
					'poskod'		=> $this->input->post('poskod'),
					'bandar'		=> $this->input->post('bandar'),
					'negeri'		=> $this->input->post('negeri'),
					'no_telefon'	=> $this->input->post('no_telefon'),
					'tarikh_lahir'	=> date('Y-m-d H:i:s a',strtotime($tarikh_lahir)),
					'url'			=> $this->input->post('url'),
					'pekerjaan'		=> $this->input->post('pekerjaan'),
					'created_on'	=> date('Y-m-d H:i:s a')
				);
				$this->Mbiodata->insert($bio_insert);
			endif;
			$this->session->set_flashdata('notice', '<p class="alert alert-success">Biodata berjaya dikemaskini.. '.anchor('biodata/','lihat biodata.').'</p>');
			redirect('biodata/edit');
		endif;
		
	}
	
}

/* End of file Biodata.php */
/* Location: ./application/controllers/Biodata.php */