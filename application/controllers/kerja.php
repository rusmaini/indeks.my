<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kerja extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//control group user yg boleh access
		#if(!$this->session->userdata('logged_in')) redirect('auth/login');
		//check permission
		#$module_id = 11;
		#if(!$this->Mpermission->check($this->session->userdata('group_id'),$module_id)) redirect('home/noaccess');
	}
	
	
	function index()
	{
		#Settings									
		$data = $this->setting;	
		
		$data['title_page']		= 'Jawatan Kosong'; //page title
		
		//get negeri
		$data['negeri_tepi'] = $negeri = $this->Mnegeri->get_all();
		$negeri_arr = array();
		$negeri_arr[''] = ' - Negeri - ';
		foreach ($negeri as $row) {
			$negeri_arr[$row['id']] = $row['nama'];
		}
		$data['negeri'] = $negeri_arr;
		
		//pagination
		$page_mula	 		= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['page'] 		= $page_mula;
		
		//pagination
		$config = array();
        $config["base_url"] 	= base_url() . "kerja/index/";
        $config["total_rows"] 	= $data['kerja_jumlah'] = $this->Mkerja->count_get_all();
        $config["per_page"] 	= $this->setting['per_page'];
        $config["uri_segment"] 	= 3;
		
		//pagination css
		$config['query_string_segment'] = 'page';
		$config['full_tag_open'] = '<div><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';
		$config['first_link'] = '&laquo; Awal';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Akhir &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Berikut &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&larr; Kembali';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		
        $this->pagination->initialize($config);
		$data["links"] 		= $this->pagination->create_links();
		
		$data['kerja']	= $this->Mkerja->get_all($config["per_page"],$data['page']);
		
		$data['content']		= 'kerja/index';
		$this->load->view('template/index',$data);
	}
	
	//papar
	function p($url=0) 
	{
		#Settings									
		$data = $this->setting;
		
		$data['url'] = $url;
		$item_array = explode('-', $url);
		$id = $item_array[0];
		
		if($item = $this->Mkerja->get($id)):
			$data['item'] 			= $item;
			$data['content']		= 'kerja/papar';
			$data['title_page']		= 'Jawatan Kosong di '.$item['negeri'].' - '.$item['nama']; //page title
		else:
			$data['content']		= 'no_data';
		endif;
		$this->load->view('template/index',$data);
	}
	
	//negeri
	function n($neg=0)
	{
		#Settings									
		$data = $this->setting;
		
		$neg_array = explode('-', $neg);
		$nid = $neg_array[0];
		$negeri_display = str_replace('%20', ' ', $neg_array[1]);
		
		$slug_negeri = $neg_array[0].'-'.$neg_array[1];
		$slug_negeri = str_replace(' ', '-', $slug_negeri);
		$slug_negeri = preg_replace('/[^A-Za-z0-9\-]/', '', $slug_negeri); // Removes special chars.
		$slug_negeri = preg_replace('/-+/', '-', $slug_negeri); // Replaces multiple hyphens with single one.
   
   		//get negeri
		$data['negeri_tepi'] = $negeri = $this->Mnegeri->get_all();
		$negeri_arr = array();
		$negeri_arr[''] = ' - Negeri - ';
		foreach ($negeri as $row) {
			$negeri_arr[$row['id']] = $row['nama'];
		}
		$data['negeri'] = $negeri_arr;
		
				
		//pagination
		$page_mula	 		= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] 		= $page_mula;
		
		//pagination
		$config = array();
        $config["base_url"] 	= base_url() . "kerja/index/";
        $config["total_rows"] 	= $data['kerja_jumlah'] = $this->Mkerja->bynegeri_count_all($nid);
        $config["per_page"] 	= $this->setting['per_page'];
        $config["uri_segment"] 	= 4;
		
		//pagination css
		$config['query_string_segment'] = 'page';
		$config['full_tag_open'] = '<div><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';
		$config['first_link'] = '&laquo; Awal';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Akhir &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Berikut &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&larr; Kembali';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		
        $this->pagination->initialize($config);
		$data["links"] 		= $this->pagination->create_links();
		
		$data['kerja']	= $this->Mkerja->bynegeri_get_all($nid,$config["per_page"],$data['page']);
		
		$data['content']		= 'kerja/senarai';
		$this->load->view('template/index',$data);
	}

	/****************************************************************************************************************
	 * My Iklan (Kerja) - iklan jawatan kosong pengguna sendiri
	 ****************************************************************************************************************/
	function my()
	{
		//check permission - user yg login je yg boleh access
		if(!$this->session->userdata('logged_in')) redirect('auth/login');

		#Settings									
		$data = $this->setting;
		
		$data['title_page']		= 'My Perjawatan - Senarai Jawatan Kosong'; //page title
		
		//pagination
		$page_mula	 		= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['page'] 		= $page_mula;
		
		//pagination
		$config = array();
        $config["base_url"] 	= base_url() . "kerja/my/";
        $config["total_rows"] 	= $data['kerja_jumlah'] = $this->Mkerja->byuser_count_all($this->session->userdata('user_id'));
        $config["per_page"] 	= $this->setting['per_page'];
        $config["uri_segment"] 	= 3;
		
		//pagination css
		$config['query_string_segment'] = 'page';
		$config['full_tag_open'] = '<div><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';
		$config['first_link'] = '&laquo; Awal';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Akhir &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Berikut &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&larr; Kembali';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		
        $this->pagination->initialize($config);
		$data["links"] 		= $this->pagination->create_links();
		
		//senarai penuh
		$data['kerja'] = $this->Mkerja->byuser_get_all($this->session->userdata('user_id'),$config["per_page"],$data['page']);;
		
		$data['content']		= 'kerja/my';
		$this->load->view('template/index',$data);
	}
	
	function my_edit($id=0)
	{
		//check permission
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		
		//kalau belum ada syarikat, daftar dulu..
		if(!$syarikat = $this->Mkerja->syarikat_byuser_get($this->session->userdata('user_id'))):
			redirect('kerja/my_syarikat');
		endif;
		
		#Settings									
		$data = $this->setting;
	
		$this->form_validation->set_rules(	'nama', 
											'Jawatan', 
											'required|max_length[255]');
		$this->form_validation->set_rules(	'keterangan', 
											'Keterangan', 
											'required');
		$this->form_validation->set_rules(	'peringkat_id', 
											'Peringkat', 
											'required');
		$this->form_validation->set_rules(	'pengkhususan_id', 
											'Pengkhususan', 
											'required');
		$this->form_validation->set_rules(	'industri_id', 
											'industri', 
											'required');
		$this->form_validation->set_rules(	'imbuhan_id', 
											'Imbuhan / Gaji', 
											'required');
		$this->form_validation->set_rules(	'terma_id', 
											'Terma', 
											'required');
		$this->form_validation->set_rules(	'tarikh_tutup', 
											'Tarikh Tutup', 
											'required');
		
		#Setting Error Messages
		$this->form_validation->set_message('required', '%s mesti diisi.');
	    $this->form_validation->set_message('max_length', '%s mesti mengandungi tidak lebih daripada %d aksara.');
	    $this->form_validation->set_message('min_length', '%s mesti mengandungi sekurang-kurangnya %d aksara.');
	    $this->form_validation->set_message('valid_email', '%s mestilah mengikut format yang sah.');
		
	    $this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		
		//get $peringkat
		$peringkat = $this->Mkerja->get_peringkat();
		$data_arr = array();
		$data_arr[''] = ' - Sila pilih - ';
		foreach ($peringkat as $row) {
			$data_arr[$row['id']] = $row['nama'];
		}
		$data['peringkat'] = $data_arr;
		
		//get pengkhususan
		$pengkhususan = $this->Mkerja->get_pengkhususan();
		$data_arr = array();
		$data_arr[''] = ' - Sila pilih - ';
		foreach ($pengkhususan as $row) {
			$data_arr[$row['id']] = $row['nama'];
		}
		$data['pengkhususan'] = $data_arr;
		
		//get industri
		$industri = $this->Mkerja->get_industri();
		$data_arr = array();
		$data_arr[''] = ' - Sila pilih - ';
		foreach ($industri as $row) {
			$data_arr[$row['id']] = $row['nama'];
		}
		$data['industri'] = $data_arr;
		
		//get imbuhan
		$imbuhan = $this->Mkerja->get_imbuhan();
		$data_arr = array();
		$data_arr[''] = ' - Sila pilih - ';
		foreach ($imbuhan as $row) {
			$data_arr[$row['id']] = $row['nama'];
		}
		$data['imbuhan'] = $data_arr;
		
		//get terma
		$terma = $this->Mkerja->get_terma();
		$data_arr = array();
		$data_arr[''] = ' - Sila pilih - ';
		foreach ($terma as $row) {
			$data_arr[$row['id']] = $row['nama'];
		}
		$data['terma'] = $data_arr;
		
		//get negeri
		$negeri = $this->Mnegeri->get_all();
		$negeri_arr = array();
		$negeri_arr[''] = ' - Sila pilih - ';
		foreach ($negeri as $row) {
			$negeri_arr[$row['id']] = $row['nama'];
		}
		$data['negeri'] = $negeri_arr;
		
		$data['syarikat'] = $syarikat;
		
		if ($this->form_validation->run() == FALSE):
			//edit
			if($item = $this->Mkerja->byuser_get($this->session->userdata('user_id'),$id)):
				$data['item'] 			= $item;
				
				$data['id']				= $item['id'];
				$data['title_page']		= 'Kemaskini '.$item['negeri'].' - '.$item['nama']; //page title
				$data['content']		= 'kerja/my_edit';
			
			//insert new
			else:
				$data['id']				= 0;
				$data['title_page']		= 'Tambah Perjawatan'; //page title
				$data['content']		= 'kerja/my_edit';
			
			endif;
			$this->load->view('template/index',$data);
		else:
			$tl = explode('/',$this->input->post('tarikh_tutup'));
			$tarikh_tutup = $tl[1].'/'.$tl['0'].'/'.$tl[2];
			
			if($this->input->post('id')==0):
				$insert = array(	'user_id'			=> $this->input->post('user_id'),
									'syarikat_id' 		=> $this->input->post('syarikat_id'),
									'nama'				=> $this->input->post('nama'),
									'peringkat_id' 		=> $this->input->post('peringkat_id'),
									'pengkhususan_id' 	=> $this->input->post('pengkhususan_id'),
									'industri_id' 		=> $this->input->post('industri_id'),
									'imbuhan_id' 		=> $this->input->post('imbuhan_id'),
									'terma_id' 			=> $this->input->post('terma_id'),
									'keterangan'		=> $this->input->post('keterangan'),
									'tarikh_tutup'		=> date('Y-m-d',strtotime($tarikh_tutup)),
									'kekosongan'		=> $this->input->post('kekosongan'),
									'created_by'		=> $this->session->userdata('username'),
									'created_at'		=> date('Y-m-d h:i:s a'),
									'updated_by'		=> $this->session->userdata('username'),
									'updated_at'		=> date('Y-m-d h:i:s a') 	
								);
				$this->Mkerja->insert($insert);
				$this->session->set_flashdata('notis','<p class="alert alert-success">Maklumat berjaya disimpan.</p>');
			else:
				$update = array(	'user_id'			=> $this->input->post('user_id'),
									'syarikat_id' 		=> $this->input->post('syarikat_id'),
									'nama'				=> $this->input->post('nama'),
									'peringkat_id' 		=> $this->input->post('peringkat_id'),
									'pengkhususan_id' 	=> $this->input->post('pengkhususan_id'),
									'industri_id' 		=> $this->input->post('industri_id'),
									'imbuhan_id' 		=> $this->input->post('imbuhan_id'),
									'terma_id' 			=> $this->input->post('terma_id'),
									'keterangan'		=> $this->input->post('keterangan'),
									'tarikh_tutup'		=> date('Y-m-d',strtotime($tarikh_tutup)),
									'kekosongan'		=> $this->input->post('kekosongan'),
									'updated_by'		=> $this->session->userdata('username'),
									'updated_at'		=> date('Y-m-d h:i:s a') 	
							);			
				
				$this->Mkerja->update($update,$this->input->post('id'));
				$this->session->set_flashdata('notis','<p class="alert alert-success">Maklumat berjaya dikemaskini.</p>');
			endif;
			
			redirect('kerja/my_edit/'.$id);
			
		endif;
	}

	function my_delete($id=0)
	{
		//check permission
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
			
		//padam dari table
		$this->Mkerja->delete($this->session->userdata('user_id'),$id);		
		$this->session->set_flashdata('notis','<p class="alert alert-success">Maklumat berjaya dipadam.</p>');
		redirect('kerja/my/');
	}

	function my_syarikat($id=0)
	{
		//check permission
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		
		#Settings									
		$data = $this->setting;
		$this->form_validation->set_rules(	'nama', 
											'Nama Syarikat', 
											'required|max_length[255]');
		
		$this->form_validation->set_rules(	'alamat', 
											'Alamat', 
											'required|max_length[255]');
		$this->form_validation->set_rules(	'poskod', 
											'Poskod', 
											'required|max_length[5]');
		$this->form_validation->set_rules(	'bandar', 
											'Kawasan / Bandar', 
											'required|max_length[255]');
		$this->form_validation->set_rules(	'negeri_id', 
											'Negeri', 
											'required');
		$this->form_validation->set_rules(	'emel', 
											'Emel', 
											'required|valid_email|max_length[50]');
		$this->form_validation->set_rules(	'telefon', 
											'Telefon', 
											'required|max_length[50]');
		$this->form_validation->set_rules(	'orang_dihubungi', 
											'Individu Untuk Dihubungi', 
											'required|max_length[255]');
		
		#Setting Error Messages
		$this->form_validation->set_message('required', '%s mesti diisi.');
	    $this->form_validation->set_message('max_length', '%s mesti mengandungi tidak lebih daripada %d aksara.');
	    $this->form_validation->set_message('min_length', '%s mesti mengandungi sekurang-kurangnya %d aksara.');
	    $this->form_validation->set_message('valid_email', '%s mestilah mengikut format yang sah.');
		
	    $this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
			
		//get negeri
		$negeri = $this->Mnegeri->get_all();
		$negeri_arr = array();
		$negeri_arr[''] = ' - Sila pilih - ';
		foreach ($negeri as $row) {
			$negeri_arr[$row['id']] = $row['nama'];
		}
		$data['negeri'] = $negeri_arr;
		
		if ($this->form_validation->run() == FALSE):
			//edit
			if($item = $this->Mkerja->syarikat_byuser_get($this->session->userdata('user_id'))):
				$data['item'] 			= $item;
				
				$data['id']				= $item['id'];
				$data['title_page']		= 'Kemaskini Syarikat: '.$item['nama']; //page title
				$data['content']		= 'kerja/my_syarikat';
			
			//insert new
			else:
				$data['id']				= 0;
				$data['title_page']		= 'Simpan Maklumat Syarikat'; //page title
				$data['content']		= 'kerja/my_syarikat';
			
			endif;
			$this->load->view('template/index',$data);
		else:

			if($this->input->post('id')==0):
				$insert = array(	
									'nama'				=> $this->input->post('nama'),
									'no_pendaftaran'	=> $this->input->post('no_pendaftaran'),
									'alamat'			=> $this->input->post('alamat'),
									'poskod'			=> $this->input->post('poskod'),
									'bandar'			=> $this->input->post('bandar'),
									'negeri_id'			=> $this->input->post('negeri_id'),
									'emel'				=> $this->input->post('emel'),
									'telefon'			=> $this->input->post('telefon'),
									'faks'				=> $this->input->post('faks'),
									'laman_web'			=> $this->input->post('laman_web'),
									'orang_dihubungi'	=> $this->input->post('orang_dihubungi'),
									'user_id'			=> $this->session->userdata('user_id'));
				$this->Mkerja->syarikat_insert($insert);
				$this->session->set_flashdata('notis','<p class="alert alert-success">Maklumat berjaya disimpan.</p>');
			else:
				$update = array(	
									'nama'				=> $this->input->post('nama'),
									'no_pendaftaran'	=> $this->input->post('no_pendaftaran'),
									'alamat'			=> $this->input->post('alamat'),
									'poskod'			=> $this->input->post('poskod'),
									'bandar'			=> $this->input->post('bandar'),
									'negeri_id'			=> $this->input->post('negeri_id'),
									'emel'				=> $this->input->post('emel'),
									'telefon'			=> $this->input->post('telefon'),
									'faks'				=> $this->input->post('faks'),
									'laman_web'			=> $this->input->post('laman_web'),
									'orang_dihubungi'	=> $this->input->post('orang_dihubungi'));			
				
				$this->Mkerja->syarikat_update($update,$this->input->post('id'));
				$this->session->set_flashdata('notis','<p class="alert alert-success">Maklumat berjaya dikemaskini.</p>');
			endif;
			
			redirect('kerja/my_syarikat/'.$id);
			
		endif;
	}
}


/* End of file kerja.php */
/* Location: ./application/controllers/kerja.php */