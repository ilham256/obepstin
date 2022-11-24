<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Perbaikan_matakuliah extends CI_Controller {

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
    	$this->load->model('Matakuliah_model');
    	$this->load->model('perbaikan_model');
    	
    	if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');
 		 }
    }

	public function index()
	{ 
		$arr['breadcrumbs'] = 'perbaikan'; 
		$arr['content'] = 'vw_perbaikan_matakuliah';
		$arr['datas'] =  $this->perbaikan_model->get_perbaikan_mata_kuliah();
		//	echo '<pre>';  var_dump($arr); echo '</pre>';

		//echo '<pre>';  var_dump($arr['datas']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['data']); echo '</pre>';
		$this->load->view('vw_template', $arr); 
	}
  
 
		public function tambah()
	{
		$arr['breadcrumbs'] = 'dosen'; 
		$arr['content'] = 'perbaikan_matakuliah/tambah';

		$arr['dosen'] =  $this->dosen_model->get_dosen();
		$arr['mata_kuliah'] =  $this->Matakuliah_model->get_matakuliah();
		//	echo '<pre>';  var_dump($arr); echo '</pre>';
		$this->load->view('vw_template', $arr);
	}


	public function submit_tambah()
	{ 
	    if (($this->input->post('simpan', TRUE))) {
	        $save_data = [
	        	  'id' => $this->input->post('dosen', TRUE)."_".$this->input->post('mata_kuliah', TRUE)."_".$this->input->post('tahun', TRUE),
	        	  'NIP' => $this->input->post('dosen', TRUE),
	              'kode_mk' => $this->input->post('mata_kuliah', TRUE),
	              'tahun' => $this->input->post('tahun', TRUE),
	              'analisis' => $this->input->post('analisis', TRUE),
	              'perbaikan' => $this->input->post('perbaikan', TRUE),
	        ];
	      $query = $this->perbaikan_model->submit_tambah($save_data);
	      if ($query) {
	        redirect('perbaikan_matakuliah','refresh');
	      }
	    } 
	}

	public function submit_edit() 
		{
		if (($this->input->post('simpan', TRUE))) {
        $save_data = [
	              'analisis' => $this->input->post('analisis', TRUE),
	              'perbaikan' => $this->input->post('perbaikan', TRUE),
	        ];
	    $id_edit = $this->input->post('id', TRUE);

	    $query = $this->perbaikan_model->submit_edit($save_data,$id_edit);
	    
	    if ($query) {
          redirect('perbaikan_matakuliah','refresh');
      	}
	 }
	}

	public function edit($id)
	  {
	    $edit = $this->perbaikan_model->edit_perbaikan_mata_kuliah($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['breadcrumbs'] = 'perbaikan_matakuliah';
		$arr['content'] = 'perbaikan_matakuliah/edit';
	    $this->load->view('vw_template', $arr);

	  }

	 public function Hapus($id)
	  {
	    $delete = $this->perbaikan_model->hapus($id);
	    if ($delete) {
	      redirect('perbaikan_matakuliah','refresh');
	    }
	  }
 
 public function export_excel(){

 			
			// mengubah JSON menjadi array
			$data_dosen = $this->perbaikan_model->get_dosen();

           $data = array( 
           		'title' => 'Data dosen',
                'data' => $data_dosen); 
 
           $this->load->view('vw_excel_dosen',$data);
      } 
   
 
}

 


 