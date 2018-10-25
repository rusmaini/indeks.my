<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Direktori extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//control group user yg boleh access
		#if(!$this->session->userdata('logged_in')) redirect('auth/login');
		//check permission
		#$module_id = 10;
		#if(!$this->Mpermission->check($this->session->userdata('group_id'),$module_id)) redirect('home/noaccess');
	}
	
	
	function index()
	{
		#Settings									
		$data = $this->setting;
		$data['title_page']		= 'Direktori'; //page title
		
		//get negeri
		$data['negeri_tepi'] = $negeri = $this->Mnegeri->get_all();
		$negeri_arr = array();
		$negeri_arr[''] = ' - Negeri - ';
		foreach ($negeri as $row) {
			$negeri_arr[$row['id']] = $row['nama'];
		}
		$data['negeri'] = $negeri_arr;
		
		//get kategori
		$kategori = $this->Mdirektori->get_kategori();
		$kat_arr = array();
		$kat_arr[''] = ' - Kategori - ';
		foreach ($kategori as $row) {
			$kat_arr[$row['id']] = $row['nama'];
		}
		$data['kategori'] = $kat_arr;
		
		//direktori
		$kategori_id 	= $data['kategori_id']; //rujuk table direktori_kategori 1=Bilik/Homestay
		$limit			= $this->setting['per_page'];
		$start  		= 0;
		$data['direktori'] = $this->Mdirektori->get_by_kategori($kategori_id,$limit,$start);
		
		$data['content']		= 'direktori/index';
		$this->load->view('template/index',$data);
	}
	
	function senarai()
	{
		#Settings									
		$data = $this->setting;
		
		$data['title_page']		= 'Direktori - Senarai'; //page title
		
		//direktori
		$kategori_id = $data['kategori_id']; //rujuk table direktori_kategori 1=Bilik/Homestay
		
		//get negeri
		$data['negeri_tepi'] = $negeri = $this->Mnegeri->get_all();
		$negeri_arr = array();
		$negeri_arr[''] = ' - Negeri - ';
		foreach ($negeri as $row) {
			$negeri_arr[$row['id']] = $row['nama'];
		}
		$data['negeri'] = $negeri_arr;
		
		//get kategori
		$kategori = $this->Mdirektori->get_kategori();
		$kat_arr = array();
		$kat_arr[''] = ' - Kategori - ';
		foreach ($kategori as $row) {
			$kat_arr[$row['id']] = $row['nama'];
		}
		$data['kategori'] = $kat_arr;
		
		if(isset($_GET['cari'])):
			$data["links"] 		= '';
			
			if(isset($_GET['n']) && $_GET['n']):
				$n = $_GET['n'];
			else: 
				$n = 0;
			endif;
			
			if(isset($_GET['k']) && $_GET['k']):
				$k = $_GET['k'];
			else: 
				$k = 0;
			endif;
			
			//senarai carian
			$data['cari'] = $cari = $_GET['cari'];
			$data['direktori'] = $dir = $this->Mdirektori->get_by_kategori_cari($k,$cari,$n);
			$data['jumlah_carian'] = count($dir);
		else:
			//pagination
			$page_mula	 		= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data['page'] 		= $page_mula;
			
			//pagination
			$config = array();
	        $config["base_url"] 	= base_url() . "direktori/senarai/";
	        $config["total_rows"] 	= $data['direktori_jumlah'] = $this->Mdirektori->count_by_kategori($kategori_id);
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
			$data['direktori'] = $this->Mdirektori->get_by_kategori($kategori_id,$config["per_page"],$data['page']);
		endif;
		
		
		$data['content']		= 'direktori/senarai';
		$this->load->view('template/index',$data);
	}

	//negeri
	function n($neg=0)
	{
		#Settings									
		$data = $this->setting;
		
		$kategori_id = $data['kategori_id']; //rujuk table direktori_kategori 1=Bilik/Homestay
		
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
		
		//get kategori
		$kategori = $this->Mdirektori->get_kategori();
		$kat_arr = array();
		$kat_arr[''] = ' - Kategori - ';
		foreach ($kategori as $row) {
			$kat_arr[$row['id']] = $row['nama'];
		}
		$data['kategori'] = $kat_arr;
		
		//pagination
		$page_mula	 		= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['page'] 		= $page_mula;
		
		//pagination
		$config = array();
        $config["base_url"] 	= base_url() . "direktori/n/" . $slug_negeri .'/';
        $config["total_rows"] 	= $data['direktori_jumlah'] = $this->Mdirektori->count_by_kategori_negeri($kategori_id,$nid);
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
		
		$data['title_page']		= 'Direktori - '.$negeri_display; //page title
		
		//data negeri
		$data['id_negeri'] 		= $nid;
		$data['negeri_display'] = $negeri_display;
		
		//data direktori
		
		//direktori
		$data['direktori'] = $this->Mdirektori->get_by_kategori_negeri($kategori_id,$nid,$config["per_page"],$data['page']);
		
		$data['content']		= 'direktori/senarai';
		$this->load->view('template/index',$data);
	}
	
	//carian
	function c()
	{
		$this->form_validation->set_rules(	'cari', 
											'Teks carian', 
											'required');
		
		#Setting Error Messages
		$this->form_validation->set_message('required', '%s mesti diisi.');
	    
		#Changing the Error Delimiters
		$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		
		if ($this->form_validation->run() == FALSE):
			$this->session->set_flashdata('notis','<div class="alert alert-danger">
														Teks carian mesti diisi.
													</div>');
			redirect('direktori/senarai/','refresh');
		else:
			$cari 	= $this->input->post('cari');
			$k 		= $this->input->post('kategori_id');
			$n 		= $this->input->post('negeri_id');
			redirect('direktori/senarai/?cari='.$cari.'&n='.$n.'&k='.$k);
		endif;
			
		
		
	}
	
	//papar
	function p($url=0) 
	{
		#Settings									
		$data = $this->setting;
		
		$data['url'] = $url;
		$item_array = explode('-', $url);
		$id = $item_array[0];
		
		if($item = $this->Mdirektori->get($id)):
			$data['item'] 			= $item;
		
			if($item['kategori_id']==1): 	//1 = bilik/homestay
				$data['atribut'] 		= $this->Mdirektori->get_bilik($id);
				$data['atribut_view']	= 'direktori/kategori_bilik';
			elseif($item['kategori_id']==2): 	//2 = restoran/medan selera
				$data['atribut'] 		= $this->Mdirektori->get_restoran($id);
				$data['atribut_view']	= 'direktori/kategori_restoran';
			endif;
			
			$data['gambar'] 		= $this->Mdirektori->get_gambar_all($id);
			$data['title_page']		= $item['perkara'].' - '.$item['kategori'].' di '.$item['negeri']; //page title
			$data['content']		= 'direktori/papar';
		
		else:
			$data['content']		= 'no_data';
		endif;
		$this->load->view('template/index',$data);
	}
	
	
	function hubungi($url=0)
	{		
		#Settings									
		$data = $this->setting;
		
		$data['url'] = $url;
		$item_array = explode('-', $url);
		$id = $item_array[0];
		
		if($item = $this->Mdirektori->get($id)):
			$data['item'] 			= $item;
			$this->form_validation->set_rules(	'nama', 
												'Nama', 
												'required');
			$this->form_validation->set_rules(	'subjek', 
												'Subjek', 
												'required');
			$this->form_validation->set_rules(	'mesej', 
												'Mesej', 
												'required');
			$this->form_validation->set_rules(	'email', 
												'Emel', 
												'required|valid_email|max_length[60]');
			
			#Setting Error Messages
			$this->form_validation->set_message('required', '%s mesti diisi.');
		    $this->form_validation->set_message('max_length', '%s mesti mengandungi tidak lebih daripada %d aksara.');
		    $this->form_validation->set_message('min_length', '%s mesti mengandungi sekurang-kurangnya %d aksara.');
		    $this->form_validation->set_message('valid_email', '%s mestilah mengikut format yang sah.');
		    
			#Changing the Error Delimiters
			$this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
			
			if ($this->form_validation->run() == FALSE):
				$data['title_page']		= $item['kategori'].' di '.$item['negeri'].' - '.$item['perkara']; //page title
				$data['content']		= 'direktori/hubungi';
				$this->load->view('template/index',$data);
			else:
				//proses hantar emel / hubungi
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
	            #$this->load->library('email');
	            $this->email->from($this->input->post('email'), $this->input->post('nama'));
	            $this->email->to($this->input->post('emel_penerima'));
	            $this->email->subject('['.$data['title'].'] '.$this->input->post('subjek'));
	            $this->email->message($this->input->post('mesej'));
	            $this->email->send();
				$this->session->set_flashdata('notis','<div class="alert alert-success">
															Mesej anda berjaya dihantar.
															</div>');
				redirect('direktori/p/'.$url,'refresh');
			endif;
		else:
			$data['content']		= 'no_data';
			$this->load->view('template/index',$data);
		endif;
		
	}
	
	/****************************************************************************************************************
	 * My Direktori - iklan pengguna sendiri
	 ****************************************************************************************************************/
	function my()
	{
		//check permission - user yg login je yg boleh access
		if(!$this->session->userdata('logged_in')) redirect('auth/login');

		#Settings									
		$data = $this->setting;
		
		$data['title_page']		= 'My Direktori - Senarai Item'; //page title
		
		//direktori
		$kategori_id = $data['kategori_id']; //rujuk table direktori_kategori 1=Bilik/Homestay
		
		//pagination
		$page_mula	 		= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['page'] 		= $page_mula;
		
		//pagination
		$config = array();
        $config["base_url"] 	= base_url() . "direktori/my/";
        $config["total_rows"] 	= $data['direktori_jumlah'] = $this->Mdirektori->my_count_by_kategori($kategori_id);
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
		
		if(isset($_GET['cari'])):
			//senarai carian
			$data['cari'] = $cari = $_GET['cari'];
			$data['direktori'] = $this->Mdirektori->my_get_by_kategori_cari($kategori_id,$cari);
		else:
			//senarai penuh
			$data['direktori'] = $this->Mdirektori->my_get_by_kategori($kategori_id,$config["per_page"],$data['page']);
		endif;
		
		$data['content']		= 'direktori/my';
		$this->load->view('template/index',$data);
	}
	
	function my_edit($id=0)
	{
		//check permission
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		
		#Settings									
		$data = $this->setting;
		$this->form_validation->set_rules(	'user_id', 
											'Pemilik Iklan', 
											'required');
		$this->form_validation->set_rules(	'kategori_id', 
											'Kategori', 
											'required');
		$this->form_validation->set_rules(	'jenisurusniaga_id', 
											'Jenis Urusniaga', 
											'required');
		$this->form_validation->set_rules(	'jenistempoh_id', 
											'Jenis Tempoh', 
											'required');
		$this->form_validation->set_rules(	'perkara', 
											'Perkara', 
											'required|max_length[255]');
											
		$this->form_validation->set_rules(	'keterangan', 
											'Keterangan', 
											'required');
		$this->form_validation->set_rules(	'alamat', 
											'Alamat', 
											'required|max_length[255]');
		$this->form_validation->set_rules(	'poskod', 
											'Poskod', 
											'required|max_length[5]');
		$this->form_validation->set_rules(	'kawasan', 
											'Kawasan / Bandar', 
											'required|max_length[255]');
		$this->form_validation->set_rules(	'negeri_id', 
											'Negeri', 
											'required');
		$this->form_validation->set_rules(	'emel', 
											'Emel', 
											'valid_email|max_length[50]');
		$this->form_validation->set_rules(	'telefon', 
											'Telefon', 
											'required|max_length[50]');
		
		#Setting Error Messages
		$this->form_validation->set_message('required', '%s mesti diisi.');
	    $this->form_validation->set_message('max_length', '%s mesti mengandungi tidak lebih daripada %d aksara.');
	    $this->form_validation->set_message('min_length', '%s mesti mengandungi sekurang-kurangnya %d aksara.');
	    $this->form_validation->set_message('valid_email', '%s mestilah mengikut format yang sah.');
		
	    $this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		
		//get kategori
		$kategori = $this->Mdirektori->get_kategori();
		$kat_arr = array();
		$kat_arr[''] = ' - Sila pilih - ';
		foreach ($kategori as $row) {
			$kat_arr[$row['id']] = $row['nama'];
		}
		$data['kategori'] = $kat_arr;
		
		//get status
		$status_arr = array('1'=>'Aktif','0'=>'Tidak Aktif');
		$data['status'] = $status_arr;
		
		//get jenisurusniaga
		$jenisurusniaga = $this->Mdirektori->get_jenisurusniaga();
		$jun_arr = array();
		$jun_arr[''] = ' - Sila pilih - ';
		foreach ($jenisurusniaga as $row) {
			$jun_arr[$row['id']] = $row['nama'];
		}
		$data['jenisurusniaga'] = $jun_arr;
		
		//get jenistempoh
		$jenistempoh = $this->Mdirektori->get_jenistempoh();
		$jt_arr = array();
		$jt_arr[''] = ' - Sila pilih - ';
		foreach ($jenistempoh as $row) {
			$jt_arr[$row['id']] = $row['nama'];
		}
		$data['jenistempoh'] = $jt_arr;
		
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
			if($item = $this->Mdirektori->my_get($id)):
				$data['item'] 			= $item;
				
				$data['id']				= $item['id'];
				if($item['kategori_id']==1): 	//1 = bilik/homestay
					$data['atribut'] 		= $this->Mdirektori->get_bilik($id);
					$data['atribut_view']	= 'direktori/kategori_bilik';
				elseif($item['kategori_id']==2): 	//2 = restoran/medan selera
					$data['atribut'] 		= $this->Mdirektori->get_restoran($id);
					$data['atribut_view']	= 'direktori/kategori_restoran';
				endif;
				
				$data['gambar'] 		= $this->Mdirektori->get_gambar_all($id);
				$data['title_page']		= $item['kategori'].' di '.$item['negeri'].' - '.$item['perkara']; //page title
				$data['content']		= 'direktori/my_edit';
			
			//insert new
			else:
				$data['id']				= 0;
				$data['title_page']		= 'Tambah Item'; //page title
				$data['content']		= 'direktori/my_edit';
			
			endif;
			$this->load->view('template/index',$data);
		else:

			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '3000'; //1000kb @ 1mb
			$config['max_width']  = '1600';
			$config['max_height']  = '1600';
			$config['remove_spaces'] = TRUE;
	
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload()):
				#$error = array('error' => $this->upload->display_errors());
				$error = $this->upload->display_errors('<span>', '</span>');
				$this->session->set_flashdata('notis_upload','<p class="alert alert-danger">Gambar tidak dimuatnaik. '.$error.'</p>');
				$gambar_nama = '';
			else:
				$gambar = $this->upload->data();
				$this->session->set_flashdata('notis_upload','<p class="alert alert-success">Muat naik gambar berjaya.</p>');
				$gambar_nama = $gambar['file_name'];
			endif;
		
			if($this->input->post('id')==0):
				$insert = array(	
									'gambar' 		=> $gambar_nama,
									'kategori_id' 	=> $this->input->post('kategori_id'),
									'status'		=> $this->input->post('status'),
									'jenisurusniaga_id' => $this->input->post('jenisurusniaga_id'),
									'jenistempoh_id' 	=> $this->input->post('jenistempoh_id'),
									'perkara'		=> $this->input->post('perkara'),
									'keterangan'	=> $this->input->post('keterangan'),
									'harga'			=> $this->input->post('harga'),
									'alamat'		=> $this->input->post('alamat'),
									'poskod'		=> $this->input->post('poskod'),
									'kawasan'		=> $this->input->post('kawasan'),
									'negeri_id'		=> $this->input->post('negeri_id'),
									'emel'			=> $this->input->post('emel'),
									'telefon'		=> $this->input->post('telefon'),
									'user_id'		=> $this->session->userdata('user_id'),
									'created_by'	=> $this->session->userdata('username'),
									'created_at'	=> date('Y-m-d h:i:s a'));
				$this->Mdirektori->insert($insert);
				$this->session->set_flashdata('notis','<p class="alert alert-success">Item anda berjaya didaftarkan.</p>');
			else:
				//masa update kena cek, ada muat naik gambar baru atau tak?
				if($gambar_nama==''):
					//tak update gambar
					$update = array(	'kategori_id' 	=> $this->input->post('kategori_id'),
										'status'		=> $this->input->post('status'),
										'jenisurusniaga_id' => $this->input->post('jenisurusniaga_id'),
										'jenistempoh_id' 	=> $this->input->post('jenistempoh_id'),
										'perkara'		=> $this->input->post('perkara'),
										'keterangan'	=> $this->input->post('keterangan'),
										'harga'			=> $this->input->post('harga'),
										'alamat'		=> $this->input->post('alamat'),
										'poskod'		=> $this->input->post('poskod'),
										'kawasan'		=> $this->input->post('kawasan'),
										'negeri_id'		=> $this->input->post('negeri_id'),
										'emel'			=> $this->input->post('emel'),
										'telefon'		=> $this->input->post('telefon'),
										'user_id'		=> $this->session->userdata('user_id'),
										'updated_by'	=> $this->session->userdata('username'),
										'updated_at'	=> date('Y-m-d h:i:s a'));			
				else:
					//ada update gambar
					$update = array(	'gambar' 		=> $gambar_nama,
										'kategori_id' 	=> $this->input->post('kategori_id'),
										'status'		=> $this->input->post('status'),
										'jenisurusniaga_id' => $this->input->post('jenisurusniaga_id'),
										'jenistempoh_id' 	=> $this->input->post('jenistempoh_id'),
										'perkara'		=> $this->input->post('perkara'),
										'keterangan'	=> $this->input->post('keterangan'),
										'harga'			=> $this->input->post('harga'),
										'alamat'		=> $this->input->post('alamat'),
										'poskod'		=> $this->input->post('poskod'),
										'kawasan'		=> $this->input->post('kawasan'),
										'negeri_id'		=> $this->input->post('negeri_id'),
										'emel'			=> $this->input->post('emel'),
										'telefon'		=> $this->input->post('telefon'),
										'user_id'		=> $this->session->userdata('user_id'),
										'updated_by'	=> $this->session->userdata('username'),
										'updated_at'	=> date('Y-m-d h:i:s a'));	
				endif;
				
					
				$this->Mdirektori->update($update,$this->input->post('id'));
				$this->session->set_flashdata('notis','<p class="alert alert-success">Item anda berjaya dikemaskini.</p>');
			endif;
			
			redirect('direktori/my_edit/'.$id);
			
		endif;
	}
	
	function my_gambarutama_delete($id=0)
	{
		//check permission
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		
		//get data dulu - dapatkan nama fail utk delete kat bawah
		$dir = $this->Mdirektori->get($id);
		$gambar = $dir['gambar'];
		
		//update table direktori - set gambar = ''
		$update = array(	'gambar' 		=> '',
							'updated_by'	=> $this->session->userdata('username'),
							'updated_at'	=> date('Y-m-d h:i:s a'));
		$this->Mdirektori->my_update($update,$id);					
							
		//delete gambar/fail fizikal $config['upload_path'] = './images/';
		$file = './images/'.$gambar;
		if (!unlink($file)):
			$this->session->set_flashdata('notis','<p class="alert alert-danger">Gambar gagal dihapuskan.</p>');
		else:
			$this->session->set_flashdata('notis','<p class="alert alert-success">Gambar berjaya dihapuskan.</p>');
		endif;
		redirect('direktori/my_edit/'.$id);
	}
	
	function my_gambarextra_delete($dir_id=0)
	{
		//check permission
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		
		//get data dulu - dapatkan nama fail utk delete kat bawah
		
		$id = $this->uri->segment(4,0);
		$dir = $this->Mdirektori->get_gambar($id);
		$gambar = $dir['gambar'];
		
		//delete - table direktori_gambar
		$this->Mdirektori->delete_gambar($id);					
							
		//delete gambar/fail fizikal $config['upload_path'] = './images/';
		$file = './images/'.$gambar;
		if (!unlink($file)):
			$this->session->set_flashdata('notis','<p class="alert alert-danger">Gambar gagal dihapuskan.</p>');
		else:
			$this->session->set_flashdata('notis','<p class="alert alert-success">Gambar berjaya dihapuskan.</p>');
		endif;
		redirect('direktori/my_edit/'.$dir_id);
	}
	
	function my_upload_gambar($id=0)
	{
		//check permission
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		
		#Settings									
		$data = $this->setting;
		
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '3000'; //1000kb @ 1mb
		$config['max_width']  = '1600';
		$config['max_height']  = '1600';
		$config['remove_spaces'] = TRUE;

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload()):
			#$error = array('error' => $this->upload->display_errors());
			$error = $this->upload->display_errors('<span>', '</span>');
			$this->session->set_flashdata('notis_upload','<p class="alert alert-danger">Gambar tidak dimuatnaik. '.$error.'</p>');
			$gambar_nama = '';
		else:
			$gambar = $this->upload->data();
			$this->session->set_flashdata('notis_upload','<p class="alert alert-success">Muat naik gambar berjaya.</p>');
			$gambar_nama = $gambar['file_name'];
			
			//proses insert ke table extra
			$insert = array(
				'direktori_id' 	=> $this->input->post('id'),
				'gambar'		=> $gambar_nama
			);
			$this->Mdirektori->insert_gambar($insert);
		endif;
		redirect('direktori/my_edit/'.$id);
	}
	
	function my_delete($id=0)
	{
		//check permission
		if(!$this->session->userdata('logged_in')) redirect('auth/login');
		
		//get data dulu - dapatkan nama fail utk delete kat bawah
		$dir 	= $this->Mdirektori->my_get($id);
		$gambar = $dir['gambar'];
		$id 	= $dir['id'];
		
		//delete gambar/fail fizikal $config['upload_path'] = './images/';
		if($gambar):
			$file = './images/'.$gambar;
			if (!unlink($file)):
				$this->session->set_flashdata('notis','<p class="alert alert-danger">Gambar gagal dihapuskan.</p>');
			else:
				$this->session->set_flashdata('notis','<p class="alert alert-success">Gambar berjaya dihapuskan.</p>');
			endif;
		endif;
		
		
		//baca table gambar extra
		$gambar_extra = $this->Mdirektori->get_gambar_all($id);
		foreach($gambar_extra as $row):
			$gambar = $row['gambar'];
			//padam semua gambar extra 
			//delete gambar/fail fizikal $config['upload_path'] = './images/';
			if($gambar):
				$file = './images/'.$gambar;
				if (!unlink($file)):
					$this->session->set_flashdata('notis','<p class="alert alert-danger">Gambar gagal dihapuskan.</p>');
				else:
					$this->session->set_flashdata('notis','<p class="alert alert-success">Gambar berjaya dihapuskan.</p>');
				endif;
			endif;
		endforeach;
			
		//padam dari table
		$this->Mdirektori->delete($id);		
		
		//padam dari table gambar extra
		$this->Mdirektori->delete_gambar_all($id);	
		
		redirect('direktori/my/');
	}


	/****************************************************************************************************************
	 * ADMIN : URUS DIREKTORI
	 *****************************************************************************************************************/
	function urus()
	{
		//check permission
		if($this->session->userdata('group_id')!=1) redirect('home/noaccess'); 
		//module id = 10
		if(!$this->Mpermission->check($this->session->userdata('group_id'),10)) redirect('home/noaccess');

		#Settings									
		$data = $this->setting;
		
		$data['title_page']		= 'Direktori - Senarai'; //page title
		
		//direktori
		$kategori_id = $data['kategori_id']; //rujuk table direktori_kategori 1=Bilik/Homestay
		
		//pagination
		$page_mula	 		= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['page'] 		= $page_mula;
		
		//pagination
		$config = array();
        $config["base_url"] 	= base_url() . "direktori/urus/";
        $config["total_rows"] 	= $data['direktori_jumlah'] = $this->Mdirektori->admin_count_by_kategori($kategori_id);
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
		
		if(isset($_GET['cari'])):
			//senarai carian
			$data['cari'] = $cari = $_GET['cari'];
			$data['direktori'] = $this->Mdirektori->admin_get_by_kategori_cari($kategori_id,$cari);
		else:
			//senarai penuh
			$data['direktori'] = $this->Mdirektori->admin_get_by_kategori($kategori_id,$config["per_page"],$data['page']);
		endif;
		
		$data['content']		= 'direktori/admin_urus';
		$this->load->view('template/index',$data);
	}
	
	function urus_edit($id=0)
	{
		//check permission
		if($this->session->userdata('group_id')!=1) redirect('home/noaccess'); 
		//module id = 10
		if(!$this->Mpermission->check($this->session->userdata('group_id'),10)) redirect('home/noaccess');
		
		#Settings									
		$data = $this->setting;
		$this->form_validation->set_rules(	'user_id', 
											'Pemilik Iklan', 
											'required');
		$this->form_validation->set_rules(	'kategori_id', 
											'Kategori', 
											'required');
		$this->form_validation->set_rules(	'jenisurusniaga_id', 
											'Jenis Urusniaga', 
											'required');
		$this->form_validation->set_rules(	'jenistempoh_id', 
											'Jenis Tempoh', 
											'required');
		$this->form_validation->set_rules(	'perkara', 
											'Perkara', 
											'required|max_length[255]');
											
		$this->form_validation->set_rules(	'keterangan', 
											'Keterangan', 
											'required');
		$this->form_validation->set_rules(	'alamat', 
											'Alamat', 
											'required|max_length[255]');
		$this->form_validation->set_rules(	'poskod', 
											'Poskod', 
											'required|max_length[5]');
		$this->form_validation->set_rules(	'kawasan', 
											'Kawasan / Bandar', 
											'required|max_length[255]');
		$this->form_validation->set_rules(	'negeri_id', 
											'Negeri', 
											'required');
		$this->form_validation->set_rules(	'emel', 
											'Emel', 
											'valid_email|max_length[50]');
		$this->form_validation->set_rules(	'telefon', 
											'Telefon', 
											'required|max_length[50]');
		
		#Setting Error Messages
		$this->form_validation->set_message('required', '%s mesti diisi.');
	    $this->form_validation->set_message('max_length', '%s mesti mengandungi tidak lebih daripada %d aksara.');
	    $this->form_validation->set_message('min_length', '%s mesti mengandungi sekurang-kurangnya %d aksara.');
	    $this->form_validation->set_message('valid_email', '%s mestilah mengikut format yang sah.');
		
	    $this->form_validation->set_error_delimiters('<p class="alert alert-danger">', '</p>');
		
		//get user - pemilik iklan
		$user	= $this->Muser->get_all();
		$user_arr = array();
		$user_arr[''] = ' - Sila pilih - ';
		foreach ($user as $row) {
			$user_arr[$row['id']] = $row['username'];
		}
		$data['user'] = $user_arr;
		
		//get kategori
		$kategori = $this->Mdirektori->get_kategori();
		$kat_arr = array();
		$kat_arr[''] = ' - Sila pilih - ';
		foreach ($kategori as $row) {
			$kat_arr[$row['id']] = $row['nama'];
		}
		$data['kategori'] = $kat_arr;
		
		//get status
		$status_arr = array('1'=>'Aktif','0'=>'Tidak Aktif');
		$data['status'] = $status_arr;
		
		//get jenisurusniaga
		$jenisurusniaga = $this->Mdirektori->get_jenisurusniaga();
		$jun_arr = array();
		$jun_arr[''] = ' - Sila pilih - ';
		foreach ($jenisurusniaga as $row) {
			$jun_arr[$row['id']] = $row['nama'];
		}
		$data['jenisurusniaga'] = $jun_arr;
		
		//get jenistempoh
		$jenistempoh = $this->Mdirektori->get_jenistempoh();
		$jt_arr = array();
		$jt_arr[''] = ' - Sila pilih - ';
		foreach ($jenistempoh as $row) {
			$jt_arr[$row['id']] = $row['nama'];
		}
		$data['jenistempoh'] = $jt_arr;
		
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
			if($item = $this->Mdirektori->admin_get($id)):
				$data['item'] 			= $item;
				
				$data['id']				= $item['id'];
				if($item['kategori_id']==1): 	//1 = bilik/homestay
					$data['atribut'] 		= $this->Mdirektori->get_bilik($id);
					$data['atribut_view']	= 'direktori/kategori_bilik';
				elseif($item['kategori_id']==2): 	//2 = restoran/medan selera
					$data['atribut'] 		= $this->Mdirektori->get_restoran($id);
					$data['atribut_view']	= 'direktori/kategori_restoran';
				endif;
				
				$data['gambar'] 		= $this->Mdirektori->get_gambar_all($id);
				$data['title_page']		= $item['kategori'].' di '.$item['negeri'].' - '.$item['perkara']; //page title
				$data['content']		= 'direktori/admin_edit';
			
			//insert new
			else:
				$data['id']				= 0;
				$data['title_page']		= 'Tambah Item'; //page title
				$data['content']		= 'direktori/admin_edit';
			
			endif;
			$this->load->view('template/index',$data);
		else:

			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '3000'; //1000kb @ 1mb
			$config['max_width']  = '1600';
			$config['max_height']  = '1600';
			$config['remove_spaces'] = TRUE;
	
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload()):
				#$error = array('error' => $this->upload->display_errors());
				$error = $this->upload->display_errors('<span>', '</span>');
				$this->session->set_flashdata('notis_upload','<p class="alert alert-danger">Gambar tidak dimuatnaik. '.$error.'</p>');
				$gambar_nama = '';
			else:
				$gambar = $this->upload->data();
				$this->session->set_flashdata('notis_upload','<p class="alert alert-success">Muat naik gambar berjaya.</p>');
				$gambar_nama = $gambar['file_name'];
			endif;
		
			if($this->input->post('id')==0):
				$insert = array(	
									'gambar' 		=> $gambar_nama,
									'kategori_id' 	=> $this->input->post('kategori_id'),
									'status'		=> $this->input->post('status'),
									'jenisurusniaga_id' => $this->input->post('jenisurusniaga_id'),
									'jenistempoh_id' 	=> $this->input->post('jenistempoh_id'),
									'perkara'		=> $this->input->post('perkara'),
									'keterangan'	=> $this->input->post('keterangan'),
									'harga'			=> $this->input->post('harga'),
									'alamat'		=> $this->input->post('alamat'),
									'poskod'		=> $this->input->post('poskod'),
									'kawasan'		=> $this->input->post('kawasan'),
									'negeri_id'		=> $this->input->post('negeri_id'),
									'emel'			=> $this->input->post('emel'),
									'telefon'		=> $this->input->post('telefon'),
									'user_id'		=> $this->input->post('user_id'),
									'created_by'	=> $this->session->userdata('username'),
									'created_at'	=> date('Y-m-d h:i:s a'));
				$this->Mdirektori->insert($insert);
				$this->session->set_flashdata('notis','<p class="alert alert-success">Item anda berjaya didaftarkan.</p>');
			else:
				//masa update kena cek, ada muat naik gambar baru atau tak?
				if($gambar_nama==''):
					//tak update gambar
					$update = array(	'kategori_id' 	=> $this->input->post('kategori_id'),
										'status'		=> $this->input->post('status'),
										'jenisurusniaga_id' => $this->input->post('jenisurusniaga_id'),
										'jenistempoh_id' 	=> $this->input->post('jenistempoh_id'),
										'perkara'		=> $this->input->post('perkara'),
										'keterangan'	=> $this->input->post('keterangan'),
										'harga'			=> $this->input->post('harga'),
										'alamat'		=> $this->input->post('alamat'),
										'poskod'		=> $this->input->post('poskod'),
										'kawasan'		=> $this->input->post('kawasan'),
										'negeri_id'		=> $this->input->post('negeri_id'),
										'emel'			=> $this->input->post('emel'),
										'telefon'		=> $this->input->post('telefon'),
										'user_id'		=> $this->input->post('user_id'),
										'updated_by'	=> $this->session->userdata('username'),
										'updated_at'	=> date('Y-m-d h:i:s a'));			
				else:
					//ada update gambar
					$update = array(	'gambar' 		=> $gambar_nama,
										'kategori_id' 	=> $this->input->post('kategori_id'),
										'status'		=> $this->input->post('status'),
										'jenisurusniaga_id' => $this->input->post('jenisurusniaga_id'),
										'jenistempoh_id' 	=> $this->input->post('jenistempoh_id'),
										'perkara'		=> $this->input->post('perkara'),
										'keterangan'	=> $this->input->post('keterangan'),
										'harga'			=> $this->input->post('harga'),
										'alamat'		=> $this->input->post('alamat'),
										'poskod'		=> $this->input->post('poskod'),
										'kawasan'		=> $this->input->post('kawasan'),
										'negeri_id'		=> $this->input->post('negeri_id'),
										'emel'			=> $this->input->post('emel'),
										'telefon'		=> $this->input->post('telefon'),
										'user_id'		=> $this->input->post('user_id'),
										'updated_by'	=> $this->session->userdata('username'),
										'updated_at'	=> date('Y-m-d h:i:s a'));	
				endif;
				
					
				$this->Mdirektori->update($update,$this->input->post('id'));
				$this->session->set_flashdata('notis','<p class="alert alert-success">Item anda berjaya dikemaskini.</p>');
			endif;
			
			redirect('direktori/urus_edit/'.$id);
			
		endif;
	}

	function upload_gambar($id=0)
	{
		//check permission
		if($this->session->userdata('group_id')!=1) redirect('home/noaccess'); 
		//module id = 10
		if(!$this->Mpermission->check($this->session->userdata('group_id'),10)) redirect('home/noaccess');
		#Settings									
		$data = $this->setting;
		
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '3000'; //1000kb @ 1mb
		$config['max_width']  = '1600';
		$config['max_height']  = '1600';
		$config['remove_spaces'] = TRUE;

		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload()):
			#$error = array('error' => $this->upload->display_errors());
			$error = $this->upload->display_errors('<span>', '</span>');
			$this->session->set_flashdata('notis_upload','<p class="alert alert-danger">Gambar tidak dimuatnaik. '.$error.'</p>');
			$gambar_nama = '';
		else:
			$gambar = $this->upload->data();
			$this->session->set_flashdata('notis_upload','<p class="alert alert-success">Muat naik gambar berjaya.</p>');
			$gambar_nama = $gambar['file_name'];
			
			//proses insert ke table extra
			$insert = array(
				'direktori_id' 	=> $this->input->post('id'),
				'gambar'		=> $gambar_nama
			);
			$this->Mdirektori->insert_gambar($insert);
		endif;
		redirect('direktori/urus_edit/'.$id);
	}
	
	function urus_delete($id=0)
	{
		//check permission
		if($this->session->userdata('group_id')!=1) redirect('home/noaccess'); 
		//module id = 10
		if(!$this->Mpermission->check($this->session->userdata('group_id'),10)) redirect('home/noaccess');
		
		//get data dulu - dapatkan nama fail utk delete kat bawah
		$dir = $this->Mdirektori->get($id);
		$gambar = $dir['gambar'];
		
		//delete gambar/fail fizikal $config['upload_path'] = './images/';
		$file = './images/'.$gambar;
		if (!unlink($file)):
			$this->session->set_flashdata('notis','<p class="alert alert-danger">Gambar gagal dihapuskan.</p>');
		else:
			$this->session->set_flashdata('notis','<p class="alert alert-success">Gambar berjaya dihapuskan.</p>');
		endif;
		
		//baca table gambar extra
		$gambar_extra = $this->Mdirektori->get_gambar_all($id);
		foreach($gambar_extra as $row):
			$gambar = $row['gambar'];
			//padam semua gambar extra 
			//delete gambar/fail fizikal $config['upload_path'] = './images/';
			$file = './images/'.$gambar;
			if (!unlink($file)):
				$this->session->set_flashdata('notis','<p class="alert alert-danger">Gambar gagal dihapuskan.</p>');
			else:
				$this->session->set_flashdata('notis','<p class="alert alert-success">Gambar berjaya dihapuskan.</p>');
			endif;
		endforeach;
			
		//padam dari table
		$this->Mdirektori->delete($id);		
		
		//padam dari table gambar extra
		$this->Mdirektori->delete_gambar_all($id);	
		
		redirect('direktori/urus/');
	}
	
	function urus_gambarutama_delete($id=0)
	{
		//check permission
		if($this->session->userdata('group_id')!=1) redirect('home/noaccess'); 
		//module id = 10
		if(!$this->Mpermission->check($this->session->userdata('group_id'),10)) redirect('home/noaccess');
		
		//get data dulu - dapatkan nama fail utk delete kat bawah
		$dir = $this->Mdirektori->get($id);
		$gambar = $dir['gambar'];
		
		//update table direktori - set gambar = ''
		$update = array(	'gambar' 		=> '',
							'updated_by'	=> $this->session->userdata('user_id'),
							'updated_at'	=> date('Y-m-d h:i:s a'));
		$this->Mdirektori->update($update,$id);					
							
		//delete gambar/fail fizikal $config['upload_path'] = './images/';
		$file = './images/'.$gambar;
		if (!unlink($file)):
			$this->session->set_flashdata('notis','<p class="alert alert-danger">Gambar gagal dihapuskan.</p>');
		else:
			$this->session->set_flashdata('notis','<p class="alert alert-success">Gambar berjaya dihapuskan.</p>');
		endif;
		redirect('direktori/urus_edit/'.$id);
	}
	
	function urus_gambarextra_delete($dir_id=0)
	{
		//check permission
		if($this->session->userdata('group_id')!=1) redirect('home/noaccess'); 
		//module id = 10
		if(!$this->Mpermission->check($this->session->userdata('group_id'),10)) redirect('home/noaccess');
		
		//get data dulu - dapatkan nama fail utk delete kat bawah
		
		$id = $this->uri->segment(4,0);
		$dir = $this->Mdirektori->get_gambar($id);
		$gambar = $dir['gambar'];
		
		//delete - table direktori_gambar
		$this->Mdirektori->delete_gambar($id);					
							
		//delete gambar/fail fizikal $config['upload_path'] = './images/';
		$file = './images/'.$gambar;
		if (!unlink($file)):
			$this->session->set_flashdata('notis','<p class="alert alert-danger">Gambar gagal dihapuskan.</p>');
		else:
			$this->session->set_flashdata('notis','<p class="alert alert-success">Gambar berjaya dihapuskan.</p>');
		endif;
		redirect('direktori/urus_edit/'.$dir_id);
	}
}

/* End of file direktori.php */
/* Location: ./application/controllers/direktori.php */