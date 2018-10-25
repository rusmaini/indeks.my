<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		//control group user yg boleh access
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		//check permission
		$module_id = 7;
		if(!$this->Mpermission->check($this->session->userdata('group_id'),$module_id)) redirect('home/noaccess');
	}
	
	public function index()
	{
		#Settings									
		$data = $this->setting;
		
		$data['user']		= $this->Muser->get($this->session->userdata('user_id'));
		$data['bio']		= $this->Mbiodata->get($this->session->userdata('user_id'));
		$data['content']	= 'profile/profile';
		$this->load->view('template/index',$data);
	}
	
	function setlatlon()
	{
		#Settings									
		$data = $this->setting;
		
		$data['content']	= 'map/setlatlon';
		$this->load->view('template/index',$data);
		
	}
	
}

/* End of file Biodata.php */
/* Location: ./application/controllers/Biodata.php */