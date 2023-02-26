<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kinumum extends CI_Controller {

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
  		
    	
    	$this->load->model('mahasiswa_model');
    	$this->load->model('katkin_model');
    	$this->load->model('kinumum_model');

    	if ($this->session->userdata('loggedin') != true || $_SESSION['level'] != 0) {
      redirect('auth/login'); 

      } 
    } 
 

	public function index() 
	{
		$arr['breadcrumbs'] = 'kinumum';
		$arr['content'] = 'vw_kinerja_umum_rev_3'; 
		$arr['tahun_masuk'] =  $this->mahasiswa_model->get_tahun_masuk();

		$simpan_tahun = $this->mahasiswa_model->get_tahun_masuk_min();
		$tahun = 2018;

        $arr['simpanan_tahun'] = $tahun;
        $arr['t_simpanan_tahun'] = ($simpan_tahun["0"]->tahun_masuk)+1;
        $arr['data_cpl'] = $this->kinumum_model->get_cpl();

        $rumus_cpl = $this->kinumum_model->get_cpl_rumus_deskriptor();
        $rumus_deskriptor = $this->kinumum_model->get_deskriptor_rumus_cpmk();
        $nilai_cpmk = $this->kinumum_model->get_nilai_cpmk();

        if (!empty($this->input->post('pilih', TRUE))) {
			$tahun= $this->input->post('tahun_masuk', TRUE); 
			$arr['simpanan_tahun'] = $tahun;
        	$arr['t_simpanan_tahun'] = ((int)$tahun)+1;
		}

		

		$nilai_std_max = [];
		$nilai_std_min = [];
		$nilai_cpl_average = []; 
		$nilai_cpl_mahasiswa = [];
		$arr['jumlah'] =  [];

		$simpan = [];
		//$mahasiswa = $this->kinumum_model->get_mahasiswa_tahun($tahun);



		//dari Database

		$mahasiswa_2 = $this->kinumum_model->get_mahasiswa_tahun($tahun);
		$mahasiswa = [];

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
		// Menentukan Nilai yang dimasukan kedalam diagram

		foreach ($arr['data_cpl'] as $key_0) { 
			$dt = [];
			foreach ($mahasiswa as $key ) {
				$n = 0;
				foreach ($nilai_cpmk as $key_2) {
					if ($key["Nim"] == $key_2->nim) {
						$n_1 = 0;
							foreach ($rumus_cpl as $key_4) {
								if ($key_0->id_cpl_langsung == $key_4->id_cpl_langsung) {
									foreach ($rumus_deskriptor as $key_3) {
										if ($key_4->id_deskriptor == $key_3->id_deskriptor) {
											if ($key_2->id_matakuliah_has_cpmk == $key_3->id_matakuliah_has_cpmk) {
												$n_1 += $key_4->persentasi*$key_2->nilai_langsung*$key_3->persentasi;
												//echo '<pre>';  var_dump($n_1); echo '</pre>';
											}
										}											
									}
								}
							}
						$n += $n_1;
					}
				}
				array_push($dt, $n);
			}
			$j = 0;
			foreach ($dt as $k) {
				if ($k > 0.0) {
					$j += 1;
				}
			}

			if ($j == 0) {
				$j = 1;
			}

			$dt_avg = array_sum($dt)/$j;

			if($dt_avg < 50){
				$dt_avg = 50;
			}

			array_push($nilai_cpl_mahasiswa, $dt);
			array_push($nilai_cpl_average, $dt_avg);
			array_push($nilai_std_max, $dt_avg+5);
			array_push($nilai_std_min, $dt_avg-5);
			array_push($arr['jumlah'], $j);
		}
 
 

		$target = $this->katkin_model->get_katkin();
		$arr['target'] =  ($target["0"]->nilai_target_pencapaian_cpl);
		$arr['target_cpl'] =  $target;
		$arr['nilai_cpl'] = $nilai_cpl_average;
		$arr['nilai_std_max'] = $nilai_std_max;
		$arr['nilai_std_min'] = $nilai_std_min;
		$arr['nilai_cpl_mahasiswa'] = $nilai_cpl_mahasiswa;
		$this->load->view('vw_template', $arr);

		//echo '<pre>';  var_dump($tahun); echo '</pre>';
		//echo '<pre>';  var_dump($mahasiswa_2); echo '</pre>';
		//echo '<pre>';  var_dump($mahasiswa["0"]["Nim"]); echo '</pre>';
		//echo '<pre>';  var_dump($mahasiswa); echo '</pre>';
		//echo '<pre>';  var_dump($nilai_cpmk); echo '</pre>';
		
		//echo '<pre>';  var_dump($nilai_cpl_min); echo '</pre>';
		//echo '<pre>';  var_dump($nilai_cpl_average); echo '</pre>';
		//echo '<pre>';  var_dump($nilai_cpl); echo '</pre>';
		//echo '<pre>';  var_dump($simpan); echo '</pre>';
		//echo '<pre>';  var_dump($nilai_cpl_mahasiswa); echo '</pre>';
		//echo '<pre>';  var_dump($nilai_cpl_average); echo '</pre>';
		//echo '<pre>';  var_dump($mahasiswa); echo '</pre>';

		//echo "nlai CPMK";
		//echo '<pre>';  var_dump($nilai_cpmk); echo '</pre>';
		//echo '<pre>';  var_dump($this->kinumum_model->get_nilai_cpmk()); echo '</pre>';

	}
 	
 	



	 
}
