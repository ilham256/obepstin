<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends CI_Controller {

	public function __construct() {
        parent::__construct();
    	$this->load->model('matakuliah_model');
    	$this->load->model('semester_model');
    	if ($this->session->userdata('loggedin') != true || $_SESSION['level'] != 0) {
      redirect('auth/login');}
	}

	public function index()
	{
		$arr['breadcrumbs'] = 'kurikulum';
		$arr['content'] = 'vw_kurikulum';

		$semesters = $this->semester_model->get_semesters("asc"); 
		$dictionary = Array();

		foreach($semesters as $semester) {
			$mata_kuliah = $this->matakuliah_model->get_select_matakuliah($semester->id_semester);
			$dictionary[$semester->id_semester] = $mata_kuliah;
		}

		$arr['dictionary'] = $dictionary; 
		$arr['semesters'] = $semesters;

		$this->load->view('vw_template', $arr);
	}
}
   