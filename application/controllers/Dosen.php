<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class dosen extends CI_Controller {

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
    	
    	if ($this->session->userdata('loggedin') != true  || $_SESSION['level'] != 0) {
      redirect('auth/login');
 		 }
    }

	public function index()
	{ 
		$arr['breadcrumbs'] = 'dosen'; 
		$arr['content'] = 'vw_dosen';
		$arr['datas'] =  $this->dosen_model->get_dosen();
		//	echo '<pre>';  var_dump($arr); echo '</pre>';

		//echo '<pre>';  var_dump($arr['datas']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['data']); echo '</pre>';
		$this->load->view('vw_template', $arr); 
	}
 
 
		public function tambah()
	{
		$arr['breadcrumbs'] = 'dosen'; 
		$arr['content'] = 'dosen/tambah';
		//	echo '<pre>';  var_dump($arr); echo '</pre>';
		$this->load->view('vw_template', $arr);
	}


	public function submit_tambah()
	{ 
	    if (($this->input->post('simpan', TRUE))) {
	        $save_data = [
	        	  'NIP' => $this->input->post('nip', TRUE),
	              'nama_dosen' => $this->input->post('nama_dosen', TRUE),
	        ];
	      $query = $this->dosen_model->submit_tambah_dosen($save_data);
	      if ($query) {
	        redirect('dosen','refresh');
	      }
	    } 
	}

 public function export_excel(){

 			
			// mengubah JSON menjadi array
			$data_dosen = $this->dosen_model->get_dosen();

           $data = array( 
           		'title' => 'Data dosen',
                'data' => $data_dosen); 
 
           $this->load->view('vw_excel_dosen',$data);
      } 
   
 
}

 


 