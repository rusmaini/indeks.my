<?php

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//global
		$this->setting = array(
            'title' 			=> $this->Msetting->get_where('site_name'),
            'slogan' 			=> $this->Msetting->get_where('site_slogan'),
            'currency' 			=> $this->Msetting->get_where('currency'),
            'date_format' 		=> $this->Msetting->get_where('date_format'),
            'per_page' 			=> $this->Msetting->get_where('records_per_page'),
            'contact_email' 	=> $this->Msetting->get_where('contact_email'),
            'kategori_id'		=> 0, //0 - semua; rujuk table direktori_kategori 1=Bilik/Homestay
            'theme' 			=> $this->Msetting->get_where('theme')
        );
	}
	
	
	
	
	
	
}

