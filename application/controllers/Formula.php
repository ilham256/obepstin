<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formula extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
    	$this->load->model('formula_model');
    	$this->load->model('formula_deskriptor_model');
    	
  		if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');
      }
	}

	public function index()
	{
		$arr['breadcrumbs'] = 'formula';
		$arr['content'] = 'vw_formula';
 
		$arr['datas'] =  $this->formula_model->get_formula_cpl();
		$arr['rumus_deskriptor'] =  $this->formula_model->get_cpl_rumus_deskriptor();
		$arr['data_deskriptor'] =  $this->formula_deskriptor_model->get_deskriptor();
		$arr['rumus'] =  $this->formula_deskriptor_model->get_deskriptor_rumus_cpmk();
		
		$this->load->view('vw_template', $arr);
	} 

	public function tambah()  
	{
		$arr['breadcrumbs'] = 'formula';
		$arr['content'] = 'formula/tambah';

		$this->load->view('vw_template', $arr);
	}
 
	public function tambah_rumus_deskriptor($id)  
	{


		$edit = $this->formula_model->get_data_cpl($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['data_deskriptor'] =  $this->formula_model->get_deskriptor();
	    $arr['breadcrumbs'] = 'formula';
		$arr['content'] = 'formula/tambah_rumus_deskriptor';
		//echo '<pre>';  var_dump($arr); echo '</pre>';
	    $this->load->view('vw_template', $arr);
	}


	public function submit_tambah()  
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
              'id_cpl_langsung' => str_replace(' ', '_', $this->input->post('nama_cpl', TRUE)),
	          'nama' => $this->input->post('nama_cpl', TRUE),
	          'deskripsi' => $this->input->post('deskripsi', TRUE),
	    ];	

	    $query = $this->formula_model->submit_tambah_cpl($save_data);
	    if ($query) {
	        redirect('formula','refresh');
	   		}
	  	} 
	 }


	public function edit($id)  
	{
		$edit = $this->formula_model->edit_cpl($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['breadcrumbs'] = 'formula';
		$arr['content'] = 'formula/edit';
		//echo '<pre>';  var_dump($arr); echo '</pre>';
	    $this->load->view('vw_template', $arr);
	}


	public function submit_edit()  
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
	          'nama' => $this->input->post('nama_cpl', TRUE),
	          'deskripsi' => $this->input->post('deskripsi', TRUE),
	    ];	

	    $id_edit = $this->input->post('id', TRUE);

	    $query = $this->formula_model->submit_edit_cpl($save_data,$id_edit);
	    if ($query) {
	        redirect('formula','refresh');
	        
	   		}	   		
	  	} 
	 }




	public function detail()
	{
		$arr['breadcrumbs'] = 'formula';
		$arr['content'] = 'vw_formula_detail';

		$this->load->view('vw_template', $arr);
	}

	public function deskriptor()
	{
		$arr['breadcrumbs'] = 'formula';
		$arr['content'] = 'vw_formula_deskriptor';

		$this->load->view('vw_template', $arr); 
	}

	public function deskriptorn()
	{
		$arr['breadcrumbs'] = 'formula';
		$arr['content'] = 'vw_formula_deskriptorn';

		$this->load->view('vw_template', $arr);
	}




	public function edit_rumus_deskriptor($id)  
	{

		$edit = $this->formula_model->edit_cpl_rumus_deskriptor($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['data_deskriptor'] =  $this->formula_model->get_deskriptor();
	    $arr['breadcrumbs'] = 'formula';
		$arr['content'] = 'formula/edit_rumus_deskriptor';
		//echo '<pre>';  var_dump($arr); echo '</pre>';
	    $this->load->view('vw_template', $arr);


	}





	public function submit_tambah_rumus_deskriptor()  
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
              'id_cpl_rumus_deskriptor' => $this->input->post('id_cpl', TRUE).'_'.$this->input->post('deskriptor', TRUE),
	          'id_cpl_langsung' => $this->input->post('id_cpl', TRUE),
	          'id_deskriptor' => $this->input->post('deskriptor', TRUE),
	          'persentasi' => $this->input->post('persentasi', TRUE),
	    ];	

	    $query = $this->formula_model->submit_tambah_formula_deskriptor($save_data);
	    if ($query) {
	        redirect('cpmk_cpl','refresh');
	        
	   		}
	   		
	  	} 
	 }

	public function submit_edit_rumus_deskriptor()  
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
	          'id_deskriptor' => $this->input->post('deskriptor', TRUE),
	          'persentasi' => $this->input->post('persentasi', TRUE),
	    ];	

	    $id_edit = $this->input->post('id', TRUE);

	    $query = $this->formula_model->submit_edit_formula_deskriptor($save_data,$id_edit);
	    if ($query) {
	        redirect('cpmk_cpl','refresh');
	        
	   		}	   		
	  	} 
	 }

		public function Hapus_rumus_deskriptor($id)
	  {
	    $delete = $this->formula_model->hapus_formula_deskriptor($id);
	    if ($delete) {
	      redirect('cpmk_cpl','refresh');
	    }
	  }

		public function Hapus_cpl($id)
	  {
	    $delete = $this->formula_model->hapus_cpl($id);
	    if ($delete) {
	      redirect('formula','refresh');
	    }
	  }


}
