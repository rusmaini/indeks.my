<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	
	public function login()
	{
		if($this->session->userdata('logged_in')) redirect('');
			
		#Settings									
		$data = $this->setting;
		
		#Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		
		#Setting Validation Rules
		$this->form_validation->set_rules(	'email', 
											'Emel', 
											'required|valid_email');
		$this->form_validation->set_rules(	'password', 
											'Kata Laluan', 
											'required');	
			
		
		if ($this->form_validation->run() == FALSE):
			$data['content']	= 'auth/login';
			$this->load->view('template/index',$data);
		else:
			$email 		= $this->input->post('email');
			$password 	= $this->input->post('password');
			$user 		= $this->Muser->login($email,$password);
			if($user):
				
				$newdata = array(
				   'user_id'  		=> $user['id'],
				   'email'  		=> $user['email'],
				   'username'     	=> $user['username'],
				   'group_id'     	=> $user['group_id'],
				   'logged_in' 		=> TRUE
				);
				
				$this->session->set_userdata($newdata);
				
				//update last login
				$last_login = array(
					'last_login' => date('Y-m-d H-i-s')
				);
				$this->Muser->update($last_login,$user['id']);

				$this->session->set_flashdata('notice', '<p class="alert alert-success">Selamat datang, '.$this->session->userdata('username').'. Log masuk berjaya..</p>');
				redirect('');
			else:
				$this->session->set_flashdata('notice', '<p class="alert alert-danger">Emel atau kata laluan tidak tepat, cuba lagi..</p>');
				redirect('auth/login');
			endif;
		endif;
	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('','refresh');
	}	
	
	function sah()
	{
		#Settings									
		$data = $this->setting;
		
		$kod = $this->uri->segment(3);
		if($kod):
			$sah = $this->Muser->aktif($kod);
			if($sah):
				$data['notis'] 			= "	<p class='alert alert-success'>
											Pendaftaran akaun anda telah disahkan. 
											Sila log masuk ".anchor('auth/login','di sini')."
											</p>";
			else:
				$data['notis'] 			= "	<p class='alert alert-error'>
											Akaun anda gagal disahkan!
											</p>";
			endif;
		else:
			$data['notis'] 			= "	<p class='alert alert-error'>
										Ralat!
										</p>";
		endif;		
		
		$data['content'] 	= 'auth/sah';
		$this->load->view('template/index',$data);
	}
	
	function lupa()
	{
		if($this->session->userdata('logged_in')) redirect('');
			
		#Settings									
		$data = $this->setting;
		
		#Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		
		#Setting Validation Rules
		$this->form_validation->set_rules(	'email', 
											'Emel', 
											'required|valid_email');
		
		if ($this->form_validation->run() == FALSE):
			$data['content']	= 'auth/lupa';
			$this->load->view('template/index',$data);
		else:
			$email 		= $this->input->post('email');
			$user 		= $this->Muser->get_where('email',$email);
			if($user):
				
				//generate random password
				$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
			    $pass = array(); //remember to declare $pass as an array
			    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			    for ($i = 0; $i < 8; $i++) {
			        $n = rand(0, $alphaLength);
			        $pass[] = $alphabet[$n];
			    }
			    $new_temp_pass = implode($pass);
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
	            $this->email->to($email);
	            $this->email->subject('Kata laluan sementara');
	            $msg = "
Salam sejahtera,

Anda atau mungkin orang lain telah meminta untuk reset kata laluan anda.
Kata laluan sementara anda ialah : ".$new_temp_pass."

Sila log masuk dengan kata laluan ini dan tukarkannya dengan kata laluan yang baru.

Terima kasih.       
	            ";
	            $this->email->message($msg);
	            $this->email->send();
				
				//update last login
				$temp_pass = array(
					'password' => md5($new_temp_pass),
					'forgotten_password_code' => $new_temp_pass
				);
				$this->Muser->update($temp_pass,$user['id']);

				$this->session->set_flashdata('notice', '<p class="alert alert-success">Kata laluan sementara anda telah dihantar ke emel, '.$email.'. Semak di dalam folder SPAM jika tiada. Selepas log masuk, tukar kata laluan anda kepada yang baru.</p>');
				redirect('auth/login');
			else:
				$this->session->set_flashdata('notice', '<p class="alert alert-danger">Maaf, emel yang anda berikan tiada dalam rekod kami. Sila cuba lagi..</p>');
				redirect('auth/lupa');
			endif;
		endif;
	}
	
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */