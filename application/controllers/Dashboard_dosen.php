<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_dosen extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */ 
	public function __construct()
  { 
    parent::__construct(); 
    if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');
      
  } 
}
 
	public function index()
	{
		$arr['breadcrumbs'] = 'Dashboard';

		$arr['content'] = 'vw_Beranda';

		//print_r($this->session->userdata());
		$this->load->view('vw_template_dosen', $arr); 
	}
	public function infumum()
	{
		$arr['breadcrumbs'] = 'infumum';

		$arr['content'] = 'vw_informasi_umum';

		$this->load->view('vw_template_dosen', $arr); 
	}
}