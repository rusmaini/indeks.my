<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noaccess extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

	}
	
	public function index()
	{
		#Settings									
		$data = $this->setting;
		$data['content']	= 'noaccess';
		$this->load->view('template/index',$data);	
	}
	
}
