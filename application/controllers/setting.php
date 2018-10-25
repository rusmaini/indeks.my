<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//control group user yg boleh access
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		//check permission
		//module id = 4
		if(!$this->Mpermission->check($this->session->userdata('group_id'),4)) redirect('home/noaccess');
	}
	
	//$id=0 insert; $id!=0 update. (add & update guna borang yang sama)
	function index()
	{		
		#Settings									
		$data = $this->setting;
			
		if (!$_POST):
			$data['setting']	= $this->Msetting->get_all();
			$data['content']	= 'setting/edit';
			$this->load->view('template/index',$data);
		else:
			//$set = $this->input->post('seting');
			/*
			echo '<pre>';
			print_r($_POST);
			echo '</pre>';
			*/
			foreach ($_POST as $key => $value):
				$this->Msetting->update($key,$value);
			endforeach;
			
			$this->session->set_flashdata('notice', '<p class="alert alert-success">Data berjaya dikemaskini..</p>');	
			
			redirect('setting');
		endif;
	}

}

/* End of file module.php */
/* Location: ./application/controllers/module.php */