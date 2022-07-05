<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formula_Deskriptor extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
    	$this->load->model('formula_deskriptor_model');
    	$this->load->model('formula_model');
    	
  		if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');
      }
	}

	public function index()
	{
		$arr['breadcrumbs'] = 'formula_deskriptor';
		$arr['content'] = 'vw_formula_deskriptor';

		$arr['data_deskriptor'] =  $this->formula_deskriptor_model->get_deskriptor();
		$arr['rumus'] =  $this->formula_deskriptor_model->get_deskriptor_rumus_cpmk();
		
		$this->load->view('vw_template', $arr);
	}

 


	public function tambah_formula_deskriptor($id)  
	{


		$edit = $this->formula_deskriptor_model->get_data_deskriptor($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['data_formula_cpmk'] =  $this->formula_deskriptor_model->get_matakuliah_has_cpmk();
	    $arr['breadcrumbs'] = 'formula_deskriptor';
		$arr['content'] = 'formula_deskriptor/tambah_formula';
		//echo '<pre>';  var_dump($arr); echo '</pre>';
	    $this->load->view('vw_template', $arr);
	}


	public function submit_tambah_deskriptor()  
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
              'id_deskriptor' => str_replace(' ', '_', $this->input->post('nama', TRUE)),
	          'nama_deskriptor' => $this->input->post('nama', TRUE),
	          'deskripsi' => $this->input->post('deskripsi', TRUE),
	    ];	

	    $query = $this->formula_deskriptor_model->submit_tambah_deskriptor($save_data);

	    $save_data = [
              'id_cpl_rumus_deskriptor' => $this->input->post('id_cpl', TRUE).'_'.str_replace(' ', '_', $this->input->post('nama', TRUE)),
	          'id_cpl_langsung' => $this->input->post('id_cpl', TRUE),
	          'id_deskriptor' => str_replace(' ', '_', $this->input->post('nama', TRUE)),
	          'persentasi' => $this->input->post('persentasi', TRUE),
	    ];	

	    $query = $this->formula_model->submit_tambah_formula_deskriptor($save_data);

	    if ($query) {
	        redirect('cpmk_cpl','refresh');
	   		}
	  	} 
	 }


	public function edit_deskriptor($id)  
	{
		$edit = $this->formula_deskriptor_model->edit_deskriptor($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['breadcrumbs'] = 'formula_deskriptor';
		$arr['content'] = 'formula_deskriptor/edit_deskriptor';
		//echo '<pre>';  var_dump($arr); echo '</pre>';
	    $this->load->view('vw_template', $arr);
	}
 
	public function submit_edit_deskriptor()  
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
	          'nama_deskriptor' => $this->input->post('nama', TRUE),
	          'deskripsi' => $this->input->post('deskripsi', TRUE),
	    ];	

	    $id_edit = $this->input->post('id', TRUE);

	    $query = $this->formula_deskriptor_model->submit_edit_deskriptor($save_data,$id_edit);
	    if ($query) {
	        redirect('cpmk_cpl','refresh');
	        
	   		}	   		
	  	} 
	 }




	public function detail()
	{
		$arr['breadcrumbs'] = 'formula_deskriptor';
		$arr['content'] = 'vw_formula_detail';

		$this->load->view('vw_template', $arr);
	}

	public function deskriptor()
	{
		$arr['breadcrumbs'] = 'formula_deskriptor';
		$arr['content'] = 'vw_formula_deskriptor';

		$this->load->view('vw_template', $arr); 
	}

	public function deskriptorn()
	{
		$arr['breadcrumbs'] = 'formula_deskriptor';
		$arr['content'] = 'vw_formula_deskriptorn';

		$this->load->view('vw_template', $arr);
	}




	public function edit_formula_deskriptor($id)  
	{

		$edit = $this->formula_deskriptor_model->edit_formula_deskriptor($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['data_formula'] =  $this->formula_deskriptor_model->get_matakuliah_has_cpmk();
	    $arr['breadcrumbs'] = 'formula_deskriptor';
		$arr['content'] = 'formula_deskriptor/edit_formula';
		//echo '<pre>';  var_dump($arr); echo '</pre>';
	    $this->load->view('vw_template', $arr);


	} 


	public function submit_tambah_formula()  
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
              'id_deskriptor_rumus_cpmk' => $this->input->post('id', TRUE).'_'.$this->input->post('cpmk', TRUE),
	          'id_matakuliah_has_cpmk' => $this->input->post('cpmk', TRUE),
	          'id_deskriptor' => $this->input->post('id', TRUE),
	          'persentasi' => $this->input->post('persentasi', TRUE),
	    ];	

	    $query = $this->formula_deskriptor_model->submit_tambah_formula($save_data);
	    if ($query) {
	        redirect('formula','refresh');
	        
	   		}
	   		
	  	} 
	 }

	public function submit_edit_formula_deskriptor()  
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
	          'id_matakuliah_has_cpmk' => $this->input->post('cpmk', TRUE),
	          'persentasi' => $this->input->post('persentasi', TRUE),
	    ];	

	    $id_edit = $this->input->post('id', TRUE);

	    $query = $this->formula_deskriptor_model->submit_edit_formula_deskriptor($save_data,$id_edit);
	    if ($query) {
	        redirect('formula','refresh');
	        
	   		}	   		
	  	} 
	 }

		public function Hapus_formula_deskriptor($id)
	  {
	    $delete = $this->formula_deskriptor_model->hapus_formula_deskriptor($id);
	    if ($delete) {
	      redirect('formula','refresh');
	    }
	  }
 
		public function Hapus_deskriptor($id)
	  { 
	    $delete = $this->formula_deskriptor_model->hapus_deskriptor($id);
	    if ($delete) {
	      redirect('formula','refresh');
	    }
	  }




}
