<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_guest extends CI_Controller {

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
    $this->load->model('Matakuliah_model');
    $this->load->model('kincpmk_model');        
    $this->load->model('kincpl_model');
    

    if ($this->session->userdata('loggedin') != true || $_SESSION['level'] != 4) {
      redirect('auth/login');
      
  }
}
 
	public function index()
	{
		$arr['breadcrumbs'] = 'Dashboard';

		$arr['content'] = 'vw_Beranda';

		//print_r($this->session->userdata());
		$this->load->view('vw_template_guest', $arr); 
	}

	public function infumum()
	{
		$arr['breadcrumbs'] = 'infumum';

		$arr['content'] = 'vw_informasi_umum';

		$this->load->view('vw_template_guest', $arr); 
	}

	public function kinumum() 
	{
		$arr['breadcrumbs'] = 'kinumum';
		$arr['content'] = 'login_guest/vw_kinerja_umum_rev_3'; 
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
		$this->load->view('vw_template_guest', $arr);

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

	public function kincpmk()
	{
		$arr['breadcrumbs'] = 'kincpmk';
		$arr['content'] = 'login_guest/vw_kinerja_cpmk';
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
 		
		function curl($url){
		    $ch = curl_init(); 
		    $headers = array(
			   'accept: text/plain',
			   'X-IPBAPI-TOKEN: Bearer 86f2760d-7293-36f4-833f-1d29aaace42e'
			 );
		    curl_setopt($ch, CURLOPT_URL, $url); 
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
 			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		    $output = curl_exec($ch);
 			curl_close($ch);   
		    return $output;
		}

		$send = curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=".$tahun);

		// mengubah JSON menjadi array
		$mahasiswa = json_decode($send, TRUE);
 



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
	    			foreach ($mahasiswa as $key_4) {
	    				$n_cpmk_1 = $this->kincpmk_model->get_nilai_cpmk($key->id_matakuliah_has_cpmk,$key_4["Nim"]);

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
		$this->load->view('vw_template_guest', $arr);
	} 

	public function kincpl()
	{ 
		$arr['breadcrumbs'] = 'kincpl';

		$arr['content'] = 'login_guest/vw_kinerja_cpl';

		$arr['semester'] =  $this->kincpl_model->get_semester();


		$arr['cpl'] =  $this->kincpl_model->get_cpl();
		$arr['simpanan_cpl'] = ($arr['cpl']["7"]->id_cpl_langsung);

		$rumus_cpl = $this->kinumum_model->get_cpl_rumus_deskriptor();
        $rumus_deskriptor = $this->kinumum_model->get_deskriptor_rumus_cpmk();
        $nilai_cpmk = $this->kinumum_model->get_nilai_cpmk();

		$arr['tahun_masuk'] =  $this->mahasiswa_model->get_tahun_masuk();
		$arr['simpanan_tahun'] = ($arr['tahun_masuk']["0"]->tahun_masuk);
		$arr['t_simpanan_tahun'] = ($arr['tahun_masuk']["0"]->tahun_masuk)+1;

		$target = $this->katkin_model->get_katkin();
		$target_cpl =  ($target["0"]->nilai_target_pencapaian_cpl);



		$arr['tahun'] = 2017;
		

		//$url="https://api.ipb.ac.id/v1/Referensi/Fakultas/86f2760d-7293-36f4-833f-1d29aaace42e";
		//$data = ['accept'=>'text/plain', 'X-IPBAPI-TOKEN'=>'itsolutionstuff@gmail.com'];
		//$get_url = file_get_contents($url);
		//$data = json_decode($get_url);

		//$data_array = array( 
		//'datalist' => $data
		//);
		if (!empty($this->input->post('pilih', TRUE))) { 

			$tahun = $this->input->post('tahun', TRUE); 
			$arr['tahun'] = $tahun;
			$cpl_1 = $this->input->post('cpl', TRUE); 
			$arr['simpanan_cpl'] = $cpl_1;

		}



		function curl($url){
		    $ch = curl_init(); 
		    $headers = array(
			   'accept: text/plain',
			   'X-IPBAPI-TOKEN: Bearer 86f2760d-7293-36f4-833f-1d29aaace42e'
			 );
		    curl_setopt($ch, CURLOPT_URL, $url); 
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
 			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		    $output = curl_exec($ch);
 			curl_close($ch);    
		    return $output;
		}

		$send = curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=".$arr['tahun']);

		// mengubah JSON menjadi array
		$mahasiswa = json_decode($send, TRUE);
 
		// perhitungan nilai target
		$nilai_target = [];
		$persentase_nilai_target = [];

		foreach ($arr['semester'] as $key_0) {
			
			$n_target = 0;
			foreach ($rumus_cpl as $key_4) {
				if ($arr['simpanan_cpl'] == $key_4->id_cpl_langsung) {
					foreach ($rumus_deskriptor as $key_3) {
						if ($key_4->id_deskriptor == $key_3->id_deskriptor) {
							if ($key_0->id_semester == $key_3->id_semester) {

								$n_target += $key_4->persentasi*$target_cpl*$key_3->persentasi;

							}
							
						}											
					}
				}
			}
			array_push($nilai_target, $n_target);
		}

		
		for ($i=0; $i < count($nilai_target) ; $i++) { 
			$pnt = 0;
			for ($p=0; $p < $i+1; $p++) { 
				$pnt += $nilai_target[$p];
			}
			array_push($persentase_nilai_target, $pnt);
		}
		
		// perhitungan nilai maksimal
		$nilai_maksimal = [];
		$persentase_nilai_maksimal = [];

		foreach ($arr['semester'] as $key_0) {
			
			$n_m = 0;
			foreach ($rumus_cpl as $key_4) {
				if ($arr['simpanan_cpl'] == $key_4->id_cpl_langsung) {
					foreach ($rumus_deskriptor as $key_3) {
						if ($key_4->id_deskriptor == $key_3->id_deskriptor) {
							if ($key_0->id_semester == $key_3->id_semester) {

								$n_m += $key_4->persentasi*100*$key_3->persentasi;

							}
							
						}											
					}
				}
			}
			array_push($nilai_maksimal, $n_m);
		}

		
		for ($i=0; $i < count($nilai_maksimal) ; $i++) { 
			$pnt = 0;
			for ($p=0; $p < $i+1; $p++) { 
				$pnt += $nilai_maksimal[$p];
			}
			array_push($persentase_nilai_maksimal, $pnt);
		}


		// perhitungan nilai mahasiswa 

		$nilai_cpl_average = []; 
		$nilai_cpl_mahasiswa = [];
		$nilai_capaian_mahasiswa = [];

		foreach ($arr['semester'] as $key_0) {
			$dt = [];
			foreach ($mahasiswa as $key ) {
				$n = 0;
				foreach ($nilai_cpmk as $key_2) {
					if ($key["Nim"] == $key_2->nim) {
						$n_1 = 0;
							foreach ($rumus_cpl as $key_4) {
								if ($arr['simpanan_cpl'] == $key_4->id_cpl_langsung) {
									foreach ($rumus_deskriptor as $key_3) {
										if ($key_4->id_deskriptor == $key_3->id_deskriptor) {
											if ($key_0->id_semester == $key_3->id_semester) {
												if ($key_2->id_matakuliah_has_cpmk == $key_3->id_matakuliah_has_cpmk) {
												$n_1 += $key_4->persentasi*$key_2->nilai_langsung*$key_3->persentasi;
												//$n_1 += 100;
												}
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

			array_push($nilai_cpl_mahasiswa, $dt);
			array_push($nilai_cpl_average, $dt_avg);
		}

		for ($i=0; $i < count($nilai_cpl_average) ; $i++) { 
			$pnt = 0;
			for ($p=0; $p < $i+1; $p++) { 
				$pnt += $nilai_cpl_average[$p];
			}
			array_push($nilai_capaian_mahasiswa, $pnt);
		}

 
	
		$arr['capaian'] = $nilai_capaian_mahasiswa;
		$arr['target'] = $persentase_nilai_target;
		$arr['nilai_tertinggi'] = $persentase_nilai_maksimal;
		$arr['nama_semester'] = [];
		foreach ($arr['semester'] as $key_0) {
			array_push($arr['nama_semester'], "Semester ".$key_0->nama);
		}




		//echo '<pre>';  var_dump($arr['capaian']); echo '</pre>';
		//echo '<pre>';  var_dump($persentase_nilai_target); echo '</pre>';

		//echo '<pre>';  var_dump($nilai_maksimal); echo '</pre>';
		//echo '<pre>';  var_dump($persentase_nilai_maksimal); echo '</pre>';

		//echo '<pre>';  var_dump($nilai_cpl_average); echo '</pre>';
		//echo '<pre>';  var_dump($nilai_capaian_mahasiswa); echo '</pre>';
		$this->load->view('vw_template_guest', $arr);
	} 
}