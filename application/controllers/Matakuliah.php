<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends CI_Controller { 
 
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
    	$this->load->model('Matakuliah_model');
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
		$arr['breadcrumbs'] = 'matakuliah';
		$arr['content'] = 'vw_matakuliah';
		$arr['data_semester'] =  $this->Matakuliah_model->get_semester();
		
		if (!empty($this->input->post('pilih', TRUE))) {
			$semester = $this->input->post('semester', TRUE);
			$arr['datas'] =  $this->Matakuliah_model->get_select_matakuliah($semester);
		} else {
			$arr['datas'] =  $this->Matakuliah_model->get_matakuliah();
		}
		//echo '<pre>';  var_dump($id_semester); echo '</pre>';
		$this->load->view('vw_template', $arr);
	}


 
	public function tambah()
	{
		$arr['breadcrumbs'] = 'matakuliah';
		$arr['content'] = 'matakuliah/tambah';
		$arr['datas'] =  $this->Matakuliah_model->get_semester();
		//	echo '<pre>';  var_dump($arr); echo '</pre>';
		$this->load->view('vw_template', $arr);
	}

	public function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public function submit_tambah()
	{
		if (($this->input->post('simpan', TRUE))) {
        $save_data = [
        	  'kode_mk' => str_replace(' ', '', $this->input->post('kode_mata_kuliah', TRUE)),
              'nama_kode_2' => $this->input->post('kode_mata_kuliah', TRUE),
	          'id_semester' => $this->input->post('semester', TRUE),
	          'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah', TRUE),
	          'sks' => $this->input->post('sks', TRUE),
	          'dosen' => $this->input->post('dosen', TRUE),


	          
	    ];	

	    $name_image = '';
 		
	    

	    if (isset($_FILES['rps']['name'])) {
	    	$alpa = $this->generateRandomString(); 
	    	$name_image = date('Ymd').'-'.$alpa.'.pdf';
	    } else {
	    	 $name_image = 'No Data upload';
	    }

	    $save_data['rps'] = $name_image;


	    $query = $this->Matakuliah_model->submit_tambah($save_data);




	    $cpmk = $this->Matakuliah_model->get_cpmk();

	    foreach ($cpmk as $key) {
	    	$save_data = [
              'id_matakuliah_has_cpmk' => str_replace(' ', '', $this->input->post('kode_mata_kuliah', TRUE)).'_'.$key->id_cpmk_langsung,
	          'id_cpmk_langsung' => $key->id_cpmk_langsung,
	          'kode_mk' => str_replace(' ', '', $this->input->post('kode_mata_kuliah', TRUE)),
	    	];

	    	$query = $this->Matakuliah_model->submit_tambah_matakuliah_has_cpmk($save_data);
	    }


	    echo '<pre>';  var_dump($save_cpmk); echo '</pre>';

	    if ($query) {
	    	$config['upload_path'] = './uploads/';
	    	$config['allowed_types'] = 'pdf';
	    	$config['max_size']  = '10000';
	    	$config['file_name']  = $name_image;

	    	
	    	$this->load->library('upload', $config);
	    	
	    	if ( ! $this->upload->do_upload('rps')){
	    		$error = array('error' => $this->upload->display_errors());
	    	}
	    	else{
	    		$data = array('upload_data' => $this->upload->data());
	    		
	    	}
	        redirect('Matakuliah','refresh');
	   		}
	  	} 
	 }

	 public function submit_edit() 
		{
		if (($this->input->post('simpan', TRUE))) {
        $save_data = [
              'nama_kode' => $this->input->post('kode_mata_kuliah', TRUE),
              'nama_kode_2' => $this->input->post('kode_mata_kuliah_2', TRUE),
	          'id_semester' => $this->input->post('semester', TRUE),
	          'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah', TRUE),
	          'sks' => $this->input->post('sks', TRUE),
	          'dosen' => $this->input->post('dosen', TRUE),
	    ];
	    $id_edit = $this->input->post('kode_mk', TRUE);

	    $query = $this->Matakuliah_model->submit_edit($save_data,$id_edit);
	    
	    if ($query) {
          redirect('Matakuliah','refresh');
      	}
	 }
	}
 
	public function detail()
	{
		$arr['breadcrumbs'] = 'matakuliah';
		$arr['content'] = 'vw_matakuliah_detail';

		$this->load->view('vw_template', $arr);
	}
	public function edit($id)
	  {
	    $edit = $this->Matakuliah_model->edit_matakuliah($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['cpmk'] = $this->Matakuliah_model->get_matakuliah_has_cpmk_by_mk($id); 
	    $arr['breadcrumbs'] = 'matakuliah';
		$arr['content'] = 'matakuliah/edit';
	    $this->load->view('vw_template', $arr);

	  }
	public function cetak_edit($id)
	  {
	    $edit = $this->Matakuliah_model->edit_matakuliah($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['cpmk'] = $this->Matakuliah_model->get_matakuliah_has_cpmk_by_mk($id); 
	    $arr['breadcrumbs'] = 'matakuliah';
		$arr['content'] = 'matakuliah/cetak_edit';
	    $this->load->view('matakuliah/cetak_edit', $arr);

	  }


	public function edit_matakuliah_has_cpmk($id)
	  {
	    $edit = $this->Matakuliah_model->edit_matakuliah_has_cpmk($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['data_cpmk'] =  $this->Matakuliah_model->get_cpmk();
	    $arr['breadcrumbs'] = 'matakuliah';
		$arr['content'] = 'matakuliah/edit_matakuliah_has_cpmk';
	    $this->load->view('vw_template', $arr);

	  }



	  public function Hapus($id)
	  {
	    $delete = $this->Matakuliah_model->hapus($id);
	    if ($delete) {
	      redirect('Matakuliah','refresh');
	    }
	  }
 

	public function lihat_rps($id){
		$arr =  $this->Matakuliah_model->get_rps($id);
			//echo '<pre>';  var_dump($arr->["rps"]); echo '</pre>';
		force_download($arr,NULL);
	}	

	public function tambah_matakuliah_has_cpmk($id)  
	{


		$edit = $this->Matakuliah_model->edit_matakuliah($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['data_cpmk'] =  $this->Matakuliah_model->get_cpmk();
	    $arr['breadcrumbs'] = 'Matakuliah';
		$arr['content'] = 'Matakuliah/tambah_matakuliah_has_cpmk';
		//echo '<pre>';  var_dump($arr); echo '</pre>';
	    $this->load->view('vw_template', $arr);
	} 

	public function submit_tambah_matakuliah_has_cpmk()  
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
              'id_matakuliah_has_cpmk' => $this->input->post('mk', TRUE).'_'.$this->input->post('cpmk', TRUE),
	          'id_cpmk_langsung' => $this->input->post('cpmk', TRUE),
	          'kode_mk' => $this->input->post('mk', TRUE),
	          'deskripsi_matakuliah_has_cpmk' => $this->input->post('deskripsi', TRUE),
	    ];	
	    $kode_mk = $this->input->post('mk', TRUE); 

	    $query = $this->Matakuliah_model->submit_tambah_matakuliah_has_cpmk($save_data);
	    if ($query) {
	        redirect('matakuliah/edit/'.$kode_mk,'refresh');
	   		}
	  	} 
	 }


	public function submit_edit_matakuliah_has_cpmk()  
	{
		if (($this->input->post('simpan', TRUE))) {

		
        $save_data = [
	          'id_cpmk_langsung' => $this->input->post('cpmk', TRUE),
	          'deskripsi_matakuliah_has_cpmk' => $this->input->post('deskripsi', TRUE),
	    ];	
	    $kode_mk = $this->input->post('mk', TRUE); 

	    $id_edit = $this->input->post('id_matakuliah_has_cpmk', TRUE);

	    $query = $this->Matakuliah_model->submit_edit_matakuliah_has_cpmk($save_data,$id_edit);
	    if ($query) {
	        redirect('matakuliah/edit/'.$kode_mk,'refresh');
	   		}
	  	} 
	 }

	 public function hapus_matakuliah_has_cpmk($id)
	  {
	    

	    $kode_mk = $this->Matakuliah_model->get_mk_matakuliah_has_cpmk($id);
	    $k = $kode_mk["0"]->kode_mk;

	    //echo '<pre>';  var_dump($k); echo '</pre>';

	    $delete = $this->Matakuliah_model->hapus_matakuliah_has_cpmk($id);

	    if ($delete) {
	    	
	      redirect('matakuliah/edit/'.$k,'refresh');
	    }
	  }



}
