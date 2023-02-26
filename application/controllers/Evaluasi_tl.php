<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasi_tl extends CI_Controller {

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
    	$this->load->model('mahasiswa_model'); 
    	$this->load->model('evaluasi_tl_model'); 
    	$this->load->model('katkin_model'); 
        
        if ($this->session->userdata('loggedin') != true || $_SESSION['level'] != 0) {
      redirect('auth/login');
      }

    	

    }
 
	public function index() 
	{
		$arr['breadcrumbs'] = 'evaluasi_tl';
		$arr['content'] = 'vw_evaluasi_tl';

		$arr['data_semester'] =  $this->Matakuliah_model->get_semester();
		$arr['tahun_masuk'] =  $this->mahasiswa_model->get_tahun_masuk();
		$arr['tahun_masuk_max'] =  $this->mahasiswa_model->get_tahun_masuk_max();
		$arr['katkin'] =  $this->katkin_model->get_katkin();

		$tahun_min = ($arr['tahun_masuk']["0"]->tahun_masuk);
		$tahun_max = ($arr['tahun_masuk_max']["0"]->tahun_masuk);

        $arr['simpanan_tahun_min'] = $tahun_min;
        $arr['t_simpanan_tahun_min'] = ((int)$tahun_min)+1;
        $arr['simpanan_tahun_max'] = $tahun_max;
        $arr['t_simpanan_tahun_max'] = ((int)$tahun_max)+1;

        if (!empty($this->input->post('pilih', TRUE))) {

			$tahun_min = $this->input->post('tahun_masuk_min', TRUE);
			$arr['simpanan_tahun_min'] = $tahun_min;
        	$arr['t_simpanan_tahun_min'] = ((int)$tahun_min)+1;

        	$tahun_max = $this->input->post('tahun_masuk_max', TRUE);
			$arr['simpanan_tahun_max'] = $tahun_max;
        	$arr['t_simpanan_tahun_max'] = ((int)$tahun_max)+1;

		}
 
		$arr['tahun_masuk_select'] =  $this->evaluasi_tl_model->get_tahun_masuk_select($tahun_min,$tahun_max);
		$select_tahun = [];
		foreach ($arr['tahun_masuk_select'] as $key) {
			      array_push($select_tahun, $key->tahun_masuk);
    				}

    	$arr['cpl_1'] = [];
    	$arr['cpl_2'] = [];
    	$arr['cpl_3'] = [];
    	$arr['cpl_4'] = [];  
    	$arr['cpl_5'] = [];
    	$arr['cpl_6'] = [];
    	$arr['cpl_7'] = [];
    	$arr['cpl_8'] = [];

    	foreach ($select_tahun as $key ) {

    		$nilai_cpl_1 = $this->evaluasi_tl_model->get_avg_cpl_1($key);
    		$nilai_cpl_2 = $this->evaluasi_tl_model->get_avg_cpl_2($key);
    		$nilai_cpl_3 = $this->evaluasi_tl_model->get_avg_cpl_3($key);
    		$nilai_cpl_4 = $this->evaluasi_tl_model->get_avg_cpl_4($key);
    		$nilai_cpl_5 = $this->evaluasi_tl_model->get_avg_cpl_5($key);
    		$nilai_cpl_6 = $this->evaluasi_tl_model->get_avg_cpl_6($key);
    		$nilai_cpl_7 = $this->evaluasi_tl_model->get_avg_cpl_7($key);
    		$nilai_cpl_8 = $this->evaluasi_tl_model->get_avg_cpl_8($key);

    		$t_1 = ((int)($nilai_cpl_1["0"]->cpl_1));
    		$t_2 = ((int)($nilai_cpl_2["0"]->cpl_2));
    		$t_3 = ((int)($nilai_cpl_3["0"]->cpl_3));
    		$t_4 = ((int)($nilai_cpl_4["0"]->cpl_4));
    		$t_5 = ((int)($nilai_cpl_5["0"]->cpl_5));
    		$t_6 = ((int)($nilai_cpl_6["0"]->cpl_6));
    		$t_7 = ((int)($nilai_cpl_7["0"]->cpl_7));
    		$t_8 = ((int)($nilai_cpl_8["0"]->cpl_8));


    		array_push($arr['cpl_1'],$t_1);
    		array_push($arr['cpl_2'],$t_2);
    		array_push($arr['cpl_3'],$t_3);
    		array_push($arr['cpl_4'],$t_4);
    		array_push($arr['cpl_5'],$t_5);
    		array_push($arr['cpl_6'],$t_6);
    		array_push($arr['cpl_7'],$t_7);
    		array_push($arr['cpl_8'],$t_8);
    	}


    	//echo '<pre>';  var_dump($arr['cpl_1']); echo '</pre>';
        //echo '<pre>';  var_dump($arr['cpl_2']); echo '</pre>';
        //echo '<pre>';  var_dump($arr['cpl_3']); echo '</pre>';
		$this->load->view('vw_template', $arr);
	}
} 
