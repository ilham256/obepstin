<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class akun_dosen extends CI_Controller {

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
  		//$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    	$this->load->model('dosen_model');
    	$this->load->model('user_model'); 
    	
    	if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');
 		 }
    }
 
	public function index()	
	{ 
		$arr['breadcrumbs'] = 'akun'; 
		$arr['content'] = 'vw_akun_dosen';
		$arr['datas'] =  $_SESSION;

		//echo '<pre>';  var_dump($_SESSION); echo '</pre>';

		$this->load->view('vw_template_dosen', $arr); 
	}

	public function ganti_password()
	{
		$arr['breadcrumbs'] = 'akun'; 
		$arr['content'] = 'vw_akun_ganti_password_dosen';
		$arr['konfirmasi'] = 'masuk';
		//	echo '<pre>';  var_dump($arr); echo '</pre>';
		$this->load->view('vw_template_dosen', $arr);
	}
 
	public function submit_ganti_password()
	{ 
	    if (($this->input->post('simpan', TRUE))) {

	    	$password_baru = $this->input->post('password_baru', TRUE);
	    	$konfirmasi_password_baru = $this->input->post('konfirmasi_password_baru', TRUE);

	    	if($password_baru != $konfirmasi_password_baru){
	    		
				$arr['konfirmasi'] = 'salah';
	    	} else {
	    		$save_data = [
	              'password' => password_hash($password_baru, PASSWORD_DEFAULT),
			        ];
			    $id = $_SESSION['id'];
			    $query = $this->user_model->update_password($save_data,$id);

				$arr['konfirmasi'] = 'benar';
	    	}

	    	$arr['breadcrumbs'] = 'akun'; 
			$arr['content'] = 'vw_akun_ganti_password_dosen';
			//	echo '<pre>';  var_dump($arr); echo '</pre>';
			$this->load->view('vw_template_dosen', $arr);
	    }
	}


}

 


 