<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Katkin extends CI_Controller {

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
    	$this->load->model('katkin_model');
    	
  		if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');
      }
    } 

	public function index()
	{
	    $edit = $this->katkin_model->get_katkin();
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
		$arr['breadcrumbs'] = 'katkin';
		$arr['content'] = 'vw_kategori_kinerja_info';

		$this->load->view('vw_template', $arr);
	}
	public function edit_katkin()
	{
	    $edit = $this->katkin_model->get_katkin();
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
		$arr['breadcrumbs'] = 'katkin';
		$arr['content'] = 'vw_kategori_kinerja';

		$this->load->view('vw_template', $arr);
	}
	public function simpan_data()
	{
		if (($this->input->post('simpan', TRUE))) {
        $save_data = [
              'batas_bawah_kategori_cukup_cpl' => $this->input->post('batas_bawah_kategori_cukup_cpl', TRUE),
	          'target_jumlah_mahasiswa_cukup_cpl' => $this->input->post('target_jumlah_mahasiswa_cukup_cpl', TRUE),
	          'batas_bawah_kategori_baik_cpl' => $this->input->post('batas_bawah_kategori_baik_cpl', TRUE),
	          'target_jumlah_mahasiswa_baik_cpl' => $this->input->post('target_jumlah_mahasiswa_baik_cpl', TRUE),
	          'batas_bawah_kategori_sangat_baik_cpl' => $this->input->post('batas_bawah_kategori_sangat_baik_cpl', TRUE),
	          'target_jumlah_mahasiswa_sangat_baik_cpl' => $this->input->post('target_jumlah_mahasiswa_sangat_baik_cpl', TRUE),
	          'nilai_target_pencapaian_cpl' => $this->input->post('nilai_target_pencapaian_cpl', TRUE),
	          'batas_bawah_kategori_cukup_cpmk' => $this->input->post('batas_bawah_kategori_cukup_cpmk', TRUE),
	          'batas_bawah_kategori_baik_cpmk' => $this->input->post('batas_bawah_kategori_baik_cpmk', TRUE),
	          'batas_bawah_kategori_sangat_baik_cpmk' => $this->input->post('batas_bawah_kategori_sangat_baik_cpmk', TRUE),
	          'nilai_target_pencapaian_cpmk' => $this->input->post('nilai_target_pencapaian_cpmk', TRUE)
	    ];	
	    $id = $this->input->post('id', TRUE);
	    $query = $this->katkin_model->submit_edit($save_data,$id);
	    if ($query) {
	    	//echo '<pre>';  var_dump($save_data); echo '</pre>';
	        redirect('katkin/sukses_simpan','refresh');
	   		}
	  	} 
	 }

	public function sukses_simpan()
	{

		$arr['breadcrumbs'] = 'katkin';
		$arr['content'] = 'vw_data_berhasil_disimpan';

		$this->load->view('vw_template', $arr);
	} 
}
