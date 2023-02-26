<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cpmk_cpl extends CI_Controller { 
 
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
    	$this->load->model('Cpmk_cpl_model');
    	$this->load->model('formula_model');

    	
  		if ($this->session->userdata('loggedin') != true || $_SESSION['level'] != 0) {
      redirect('auth/login');}
      
    }
    /*$this->load->model('auth_model');
    if(!$this->auth_model->current_user()){ 
      redirect('auth/login');
    }*/
    //Codeigniter : Write Less Do More
 
  
	public function index()
	{ 
		$arr['breadcrumbs'] = 'cpmk_cpl';
		$arr['content'] = 'vw_cpmk_cpl';

		$arr['data_cpl'] =  $this->Cpmk_cpl_model->get_cpl();
		$arr['data_cpmk'] =  $this->Cpmk_cpl_model->get_cpmk();
		$arr['rumus_deskriptor'] =  $this->Cpmk_cpl_model->get_cpl_rumus_deskriptor();
		//echo '<pre>';  var_dump($id_semester); echo '</pre>';



		$arr['status_aktif'] = 'show active';
		$arr['naf'] = 'active';

		


		$this->load->view('vw_template', $arr);
	}

//CPL
public function tambah_cpl()
	{
		$arr['breadcrumbs'] = 'cpmk_cpl';
		$arr['content'] = 'cpl/tambah';
		//	echo '<pre>';  var_dump($arr); echo '</pre>';
		$this->load->view('vw_template', $arr);
	}


	public function submit_tambah_cpl()
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
              'id_cpl_langsung' => str_replace(' ', '_', $this->input->post('nama_cpl', TRUE)),
	          'nama' => $this->input->post('nama_cpl', TRUE),
	          'deskripsi' => $this->input->post('deskripsi', TRUE),
	    ]; 


	    $query =  $this->Cpmk_cpl_model->submit_tambah_cpl($save_data);

	   
	    
	    if ($query) {
	        redirect('cpmk_cpl','refresh');
	   		}
	  	} 
	 } 
 


 public function edit_cpl($id)  
	{
		$edit = $this->Cpmk_cpl_model->edit_cpl($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['breadcrumbs'] = 'cpmk_cpl';
		$arr['content'] = 'cpl/edit';
		//echo '<pre>';  var_dump($arr); echo '</pre>';
	    $this->load->view('vw_template', $arr);
	}


	 public function submit_edit_cpl()  
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
	          'nama' => $this->input->post('nama_cpl', TRUE),
	          'deskripsi' => $this->input->post('deskripsi', TRUE),
	    ];	 

	    $id_edit = $this->input->post('id', TRUE);

	    $query = $this->Cpmk_cpl_model->submit_edit_cpl($save_data,$id_edit);
	    if ($query) {
	        redirect('cpmk_cpl','refresh');
	        
	   		}	   		
	  	} 
	 }
 
	
	  public function Hapus_cpl($id)
	  {
	    $delete = $this->Cpmk_cpl_model->hapus_cpl($id);
	    if ($delete) {
	      redirect('cpmk_cpl','refresh');
	    }
	  }
 


//cpmk
public function tambah_cpmk()
	{
		$arr['breadcrumbs'] = 'cpmk_cpl';
		$arr['content'] = 'cpmk/tambah';
		//	echo '<pre>';  var_dump($arr); echo '</pre>';
		$this->load->view('vw_template', $arr);
	}


	public function submit_tambah_cpmk()
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
              'id_cpmk_langsung' => str_replace(' ', '_', $this->input->post('nama_cpmk', TRUE)),
	          'nama' => $this->input->post('nama_cpmk', TRUE),
	          'deskripsi' => $this->input->post('deskripsi', TRUE),
	    ]; 


	    $query =  $this->Cpmk_cpl_model->submit_tambah_cpmk($save_data);
	    if ($query) {
	        redirect('cpmk_cpl','refresh');
	   		}
	  	} 
	 } 
 


 public function edit_cpmk($id)  
	{
		$edit = $this->Cpmk_cpl_model->edit_cpmk($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['breadcrumbs'] = 'cpmk_cpl';
		$arr['content'] = 'cpmk/edit';
		//echo '<pre>';  var_dump($arr); echo '</pre>';
	    $this->load->view('vw_template', $arr);
	}


	 public function submit_edit_cpmk()  
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
	          'nama' => $this->input->post('nama_cpmk', TRUE),
	          'deskripsi' => $this->input->post('deskripsi', TRUE),
	    ];	 

	    $id_edit = $this->input->post('id', TRUE);

	    $query = $this->Cpmk_cpl_model->submit_edit_cpmk($save_data,$id_edit);
	    if ($query) {
	        redirect('cpmk_cpl','refresh');
	        
	   		}	   		
	  	} 
	 }
 
	
	  public function Hapus_cpmk($id)
	  {
	    $delete = $this->Cpmk_cpl_model->hapus_cpmk($id);
	    if ($delete) {
	      redirect('cpmk_cpl','refresh');
	    }
	  }




 
	public function tambah_deskriptor($id)  
	{ 
		$edit = $this->formula_model->get_data_cpl($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }

		$arr['breadcrumbs'] = 'formula_deskriptor';
		$arr['content'] = 'formula_deskriptor/tambah_deskriptor';

		$this->load->view('vw_template', $arr);
	}


}
