<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = $this->setting;
		
		//get kategori
		$kategori = $this->Mdirektori->get_kategori();
		$kat_arr = array();
		$kat_arr[''] = ' - Kategori - ';
		foreach ($kategori as $row) {
			$kat_arr[$row['id']] = $row['nama'];
		}
		$data['kategori'] = $kat_arr;
		
		//get negeri
		$negeri = $this->Mnegeri->get_all();
		$negeri_arr = array();
		$negeri_arr[''] = ' - Negeri - ';
		foreach ($negeri as $row) {
			$negeri_arr[$row['id']] = $row['nama'];
		}
		$data['negeri'] = $negeri_arr;
		
		$data['content']	= 'welcome_message';
		$this->load->view('template/index',$data);
	}
	
	public function informasi()
	{
		$data = $this->setting;
		$data['content']	= 'informasi';
		$this->load->view('template/index',$data);
	}
	
	public function contactus()
	{
		$data = $this->setting;
		$data['content']	= 'contactus';
		$this->load->view('template/index',$data);
	}
	
	public function noaccess()
	{
		$data = $this->setting;
		$data['content']	= 'noaccess';
		$this->load->view('template/index',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */