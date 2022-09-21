<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_Matakuliah extends CI_Controller { 

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
    	$this->load->model('formula_deskriptor_model');
    	if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');}
    }
    /*$this->load->model('auth_model');
    if(!$this->auth_model->current_user()){
      redirect('auth/login');
    }*/
    //Codeigniter : Write Less Do More
  
  
	public function index()
	{
		$arr['breadcrumbs'] = 'profil_matakuliah';
		$arr['content'] = 'vw_profil_matakuliah';
		$arr['data_semester'] =  $this->Matakuliah_model->get_semester();

		$arr['rumus'] =  $this->Matakuliah_model->get_mk_matakuliah_has_cpmk_all();
		
		if (!empty($this->input->post('pilih', TRUE))) {
			$semester = $this->input->post('semester', TRUE);
			$arr['datas'] =  $this->Matakuliah_model->get_select_matakuliah($semester);
		} else {
			$arr['datas'] =  $this->Matakuliah_model->get_matakuliah();
		}

		//echo '<pre>';  var_dump($id_semester); echo '</pre>';
		$this->load->view('vw_template', $arr);
	}
 
}  
