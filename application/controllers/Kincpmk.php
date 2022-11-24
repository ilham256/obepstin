<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kincpmk extends CI_Controller {

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
  		if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');
      }
    	$this->load->model('Matakuliah_model');
    	$this->load->model('mahasiswa_model'); 
    	$this->load->model('kincpmk_model'); 
    	$this->load->model('kinumum_model');
    	

    }
 
   

	public function index()
	{
		$arr['breadcrumbs'] = 'kincpmk';
		$arr['content'] = 'vw_kinerja_cpmk';
		$arr['data_semester'] =  $this->Matakuliah_model->get_semester();
		$arr['tahun_masuk'] =  $this->mahasiswa_model->get_tahun_masuk();
		$arr['cpmklang'] =  $this->kincpmk_model->get_cpmklang();

		$semester = ($arr['data_semester']["2"]->id_semester);
		$tahun = ($arr['tahun_masuk']["0"]->tahun_masuk);
		$tahun = 2018;

        $arr['simpanan_tahun'] = $tahun;
        $arr['simpanan_semester'] = $semester; 
        $arr['t_simpanan_tahun'] = ((int)$tahun)+1;
 
        $arr['mk_cpmk'] = [];
        $arr['nilai_cpmk'] = [];

        if (!empty($this->input->post('pilih', TRUE))) {

			$tahun = $this->input->post('tahun_masuk', TRUE); 
			$arr['simpanan_tahun'] = $tahun;
        	$arr['t_simpanan_tahun'] = ((int)$tahun)+1;
 
        	$semester = $this->input->post('semester', TRUE);
        	$arr['simpanan_semester'] = $semester;
		}
 		
		$mahasiswa_2 = $this->kinumum_model->get_mahasiswa_tahun($tahun);
        $mahasiswa = [];

        //echo '<pre>';  var_dump($mahasiswa_2); echo '</pre>';
 
        foreach ($mahasiswa_2 as $key) { 
            $data_m = array(
                        "Nim" => $key->nim,
                        "Nama" => $key->nama ,
                        "SemesterMahasiswa" => $key->SemesterMahasiswa,
                        "StatusAkademik" => $key->StatusAkademik,
                        "tahun" => $key->tahun_masuk

                    );
            array_push($mahasiswa , $data_m);
        }
 



		$arr['mata_kuliah'] =  $this->Matakuliah_model->get_select_matakuliah($semester);
		$kode_mk = [];
		foreach ($arr['mata_kuliah'] as $key) {
			      array_push($kode_mk, $key->kode_mk);
    				}

    	foreach ($kode_mk as $key ) {
    		$mk_cpmk = $this->kincpmk_model->get_mk_cpmk($key);

    		$t_mk_cpmk = [];
    		$t_n_cpmk = [];
    		
	    		foreach ($mk_cpmk as $key) {
	    			array_push($t_mk_cpmk, $key->id_cpmk_langsung);
	    			$n_cpmk = [];
	    			foreach ($mahasiswa_2 as $key_4) {
	    				$n_cpmk_1 = $this->kincpmk_model->get_nilai_cpmk_select($key_4->nim."_".$key->id_matakuliah_has_cpmk);

	    				if (!empty($n_cpmk_1)) {
	    					$n_cpmk_2 = $n_cpmk_1["0"];
	    					$n_cpmk_1 = $n_cpmk_2;
	    				}
	    				
	    				array_push($n_cpmk, $n_cpmk_1);
	    			}
	    			
	    			if (empty($n_cpmk)) { 
					  $n_cpmk = 0;
					}		
 					
 					//echo '<pre>';  var_dump($n_cpmk); echo '</pre>'; 

					if ($n_cpmk == 0) {
						array_push($t_n_cpmk, $n_cpmk);
					} else {

						$nilai_sementara = [];
						foreach ($n_cpmk as $key_2) {
							if (!empty($key_2)) {
								array_push($nilai_sementara, $key_2->nilai_langsung);
							}
							
						}
						if (count($nilai_sementara) == 0) {
							$average = 0;
						}else { 
							$average = array_sum($nilai_sementara)/count($nilai_sementara);
						}
						
						array_push($t_n_cpmk, round($average));
					}
	    		} 

	    	array_push($arr['mk_cpmk'],$t_mk_cpmk);
	    	array_push($arr['nilai_cpmk'],$t_n_cpmk);

    	} 



		//echo '<pre>';  var_dump($arr['mk_cpmk']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nilai_cpmk']); echo '</pre>';
		$this->load->view('vw_template', $arr);
	} 
}
 