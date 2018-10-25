<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

	}
	
	public function index()
	{
		#Settings									
		$data = $this->setting;
		
		#Setting Validation Rules
		$this->form_validation->set_rules(	'username', 
											'Nama', 
											'required|min_length[3]|max_length[20]|alpha_dash|callback_username_duplicate');
		$this->form_validation->set_rules(	'password', 
											'Kata laluan', 
											'required|min_length[6]|max_length[15]|matches[repassword]');
		$this->form_validation->set_rules(	'repassword', 
											'Ulang kata laluan', 
											'required|min_length[6]|max_length[15]');
		$this->form_validation->set_rules(	'email', 
											'Emel', 
											'required|valid_email|max_length[60]|callback_email_duplicate');
											
		#Setting Error Messages
		$this->form_validation->set_message('required', '%s mesti diisi.');
	    $this->form_validation->set_message('max_length', '%s mesti mengandungi tidak lebih daripada %d aksara.');
	    $this->form_validation->set_message('min_length', '%s mesti mengandungi sekurang-kurangnya %d aksara.');
	    $this->form_validation->set_message('matches', '%s mesti sama.');
	    $this->form_validation->set_message('valid_email', '%s tidak mengikut format yang sah.');
	    $this->form_validation->set_message('alpha_dash', '%s hanya boleh mengandungi aksara alpha-numeric, underscores, dan dashes sahaja.');
	    
		#Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		
		if ($this->form_validation->run() == FALSE):
		
			$data['content']	= 'register/form';
			$this->load->view('template/index',$data);
			
		else:
			//activation code
			$kod_sah  = md5(date('Ymdhis'));
	        $emel   = $this->input->post('email');
			
			$daftar = array(
				'username'		=> $this->input->post('username'),
				'password'		=> md5($this->input->post('password')),
				'email'			=> $this->input->post('email'),
				'created_on'	=> date('Y-m-d H:i:s a'),
				'activation_code' => $kod_sah,
				'active' 		=> 0,
				'group_id' 		=> 2, //2 user biasa
			);
			
          	$newid = $this->Muser->insert($daftar);
			
			if($newid):
	            #Emel
	            $config = Array(
				  'protocol' 	=> 'mail',
				  'charset' 	=> 'iso-8859-1',
				  'smtp_host' 	=> 'smtp.projektee.com',
				  'smtp_user' 	=> 'admin@indeks.my', // your email
				  'smtp_pass' 	=> 'indeks23570', // your email password
				  'smtp_port' 	=> 25, //25, //587,
				  'validate' 	=> TRUE, 
				  'wordwrap' 	=> TRUE,
				  'newline' 	=> "\r\n"
				);
				
	            $this->load->library('email',$config);
	            $this->email->from($data['contact_email'], $data['title']);
	            $this->email->to($emel);
	            $this->email->subject('Sila aktifkan akaun');
	            $msg = "
Salam sejahtera,

Sila aktifkan akaun anda dengan klik pada url berikut:

".base_url()."auth/sah/".$kod_sah."

Atau:

Copy & paste url tersebut ke dalam kotak url pada browser anda dan tekan enter.

Terima kasih.       
	            ";
	            $this->email->message($msg);
	            $this->email->send();
	            #echo $this->email->print_debugger();
	            
				$this->session->set_flashdata('notice','<div class="alert alert-success">
															Tahniah! Proses pendaftaran berjaya.<br> 
															Namun, akaun anda perlu diaktifkan terlebih dahulu sebelum anda boleh log masuk.<br> 
															Kod pengaktifan telah dihantar ke emel anda. Sila semak emel anda sekarang.<br>
															Jika tiada, sila semak folder <strong>SPAM</strong>.
															</div>');
				redirect('auth/login','refresh');
			else:
				
				$this->session->set_flashdata('notice','<div class="alert alert-error">
															Proses pendaftaran gagal.. Berkemungkinan nama atau emel sudah digunakan oleh 
															pengguna lain. Sila cuba lagi.. 
															</div>');
				redirect('register','refresh');
			endif;
		endif;
			
	}
	
	function email_duplicate()
	{
		$email = $this->input->post('email');
		if($emel = $this->Muser->check_email($email)):
			//emel dah ada.. tak boleh insert
			$this->form_validation->set_message('email_duplicate', 'Emel sudah digunakan. ');
			return FALSE;
		else:
			//emel belum ada.. boleh insert
			return TRUE;
		endif;
	}
	
	
	function username_duplicate()
	{
		$username = $this->input->post('username');
		if($u = $this->Muser->check_username($username)):
			//username dah ada.. tak boleh insert
			$this->form_validation->set_message('username_duplicate', 'Nama sudah digunakan. ');
			return FALSE;
		else:
			//emel belum ada.. boleh insert
			return TRUE;
		endif;
	}
}