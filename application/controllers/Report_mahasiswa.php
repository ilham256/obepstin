<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_mahasiswa extends CI_Controller {
 
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
  		if ($this->session->userdata('loggedin') != true || $_SESSION['level'] != 2) {
      redirect('auth/login');} 
    	$this->load->model('Matakuliah_model');
    	$this->load->model('mahasiswa_model'); 
    	$this->load->model('kincpmk_model'); 
    	$this->load->model('report_model'); 
    	$this->load->model('katkin_model'); 
    	$this->load->model('kinumum_model');
    	$this->load->model('kincpl_model');
    	$this->load->model('epbm_model');

    	}
 
	public function index()
	{
		$arr['breadcrumbs'] = 'report';
		$arr['content'] = 'login_mahasiswa/vw_report';

		$arr['status_aktif'] = 'show active';
		$arr['status_aktif_2'] = '';
		$arr['status_aktif_3'] = '';
		$arr['status_aktif_4'] = '';

		$arr['naf'] = 'active'; 
		$arr['naf_2'] = ''; 
		$arr['naf_3'] = '';
		$arr['naf_4'] = '';

		$arr['mata_kuliah'] =  $this->Matakuliah_model->get_matakuliah();
		$arr['katkin'] =  $this->katkin_model->get_katkin();
		$arr['data_cpl'] = $this->report_model->get_cpl();


		//- Sub Menu Kinerja CPL Mahasiswa - 

		$arr['semester'] =  $this->kincpl_model->get_semester();
		$arr['nim_3'] = $this->session->userdata('nama_user');
		$arr['cpl'] =  $this->kincpl_model->get_cpl();
		$arr['simpanan_cpl'] = ($arr['cpl']["7"]->id_cpl_langsung);

		$rumus_cpl = $this->kinumum_model->get_cpl_rumus_deskriptor();
        $rumus_deskriptor = $this->kinumum_model->get_deskriptor_rumus_cpmk();
        $nilai_cpmk = $this->kinumum_model->get_nilai_cpmk();

        $target = $this->katkin_model->get_katkin();
		$target_cpl =  ($target["0"]->nilai_target_pencapaian_cpl);

		if (!empty($this->input->post('pilih_3', TRUE))) {
			
			$cpl_1 = $this->input->post('cpl', TRUE); 
			$arr['simpanan_cpl'] = $cpl_1;

			$arr['status_aktif'] = '';
			$arr['status_aktif_2'] = '';
			$arr['status_aktif_3'] = 'show active';


			$arr['naf'] = '';
			$arr['naf_2'] = '';
			$arr['naf_3'] = 'active';

		}
		
 		$nim_3 = $arr['nim_3'];
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

		//echo '<pre>';  var_dump($persentase_nilai_target); echo '</pre>';
		// perhitungan nilai mahasiswa 

		$nilai_cpl_average = []; 
		$nilai_cpl_mahasiswa = [];
		$nilai_capaian_mahasiswa = [];

		foreach ($arr['semester'] as $key_0) {
			
				$n = 0;
				foreach ($nilai_cpmk as $key_2) {
					if ($arr['nim_3'] == $key_2->nim) {
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
				
			array_push($nilai_cpl_average, $n);
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
		//echo '<pre>';  var_dump($arr['target']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nilai_tertinggi']); echo '</pre>';

		//- Sub Menu Kinerja CPMK Mahasiswa -

		$kode_mk = [];
		foreach ($arr['mata_kuliah'] as $key) {
			      array_push($kode_mk, $key->kode_mk);
    				}

    	$arr['cpmklang_a'] = [];
    	$arr['cpmklang_b'] = [];
    	$arr['cpmklang_c'] = [];
    	$arr['mk_cpmk'] = [];
    	$arr['nilai_cpmk'] = []; 
    	$arr['nilai_cpl_mahasiswa'] = [];
    	$arr['status_nilai_cpl_mahasiswa'] = [];

    	$arr['nim'] = $this->session->userdata('nama_user');
    	$tgl=date('Y');

    	$th = 2017;
    	$tahun_report = [];
    	for ($i=$th; $i < $tgl ; $i++) { 
    		array_push($tahun_report, $i);
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

		$dt_mahasiswa_2 = [];
		foreach ($tahun_report as $key) {
			$send = curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=".$key);
			$dt_mahasisw = json_decode($send, TRUE);

			array_push($dt_mahasiswa_2, $dt_mahasisw);
		}

		$dt_mahasiswa = array_reduce($dt_mahasiswa_2, 'array_merge', array());

    	
		//echo '<pre>';  var_dump($dt_mahasiswa); echo '</pre>';
		// mengubah JSON menjadi array


		$n_m = $this->report_model->get_nama_mahasiswa($arr['nim']);

		foreach ($dt_mahasiswa as $key) {
				if ($key["Nim"] == $arr['nim']) {
					$n_m = $key;
				}
			}

		$arr['nama'] = ($n_m["Nama"]);

		$arr['ns'] = 'Nilai CPMK '.$arr['nama'].' ('.$arr['nim'].')';

		//mendefinisikan matakuliah dan nilai cpmk
		foreach ($kode_mk as $key) {

			$mk_cpmk = $this->report_model->get_mk_cpmk($key);

    		$t_mk_cpmk = [];
    		$t_n_cpmk = [];

	    	foreach ($mk_cpmk as $key) {
	    			array_push($t_mk_cpmk, $key->id_cpmk_langsung); 

	    			$n_cpmk = $this->report_model->get_nilai_cpmk($key->id_matakuliah_has_cpmk,$arr['nim']);
	    			if (empty($n_cpmk)) { 
					  $n_cpmk = 0;
					}		

					if ($n_cpmk == 0) {
						array_push($t_n_cpmk, $n_cpmk);
					} else {

						$nilai_sementara = [];
						foreach ($n_cpmk as $key_2) {
							array_push($nilai_sementara, $key_2->nilai_langsung);
						}

						$average = array_sum($nilai_sementara)/count($nilai_sementara);
						array_push($t_n_cpmk, $average);
					}
	    	}
    		//$t_mk_cpmk = $mk_cpmk["0"]->id_cpmk_langsung;
    		array_push($arr['mk_cpmk'],$t_mk_cpmk);
    		array_push($arr['nilai_cpmk'],$t_n_cpmk);
    	}
 




    	//- Sub Menu Rapor Mahasiswa- -


    	$rumus_cpl = $this->kinumum_model->get_cpl_rumus_deskriptor();
        $rumus_deskriptor = $this->kinumum_model->get_deskriptor_rumus_cpmk();
        $nilai_cpmk = $this->kinumum_model->get_nilai_cpmk();


			$nim_2 = $this->session->userdata('nama_user'); 
			$arr['nim_2'] = $nim_2;

			foreach ($dt_mahasiswa as $key) {
				if ($key["Nim"] == $nim_2) {
					$n_m = $key;
				}
			}

 			
 			$arr['nama_rapor_mahasiswa'] = ($n_m["Nama"]);
	    	$arr['nim_rapor_mahasiswa'] = ($n_m["Nim"]);

	    	$batas_cukup = ($arr['katkin']["0"]->batas_bawah_kategori_cukup_cpl);
	    	$batas_baik = ($arr['katkin']["0"]->batas_bawah_kategori_baik_cpl);
	    	$batas_sangat_baik = ($arr['katkin']["0"]->batas_bawah_kategori_sangat_baik_cpl);

	    	foreach ($arr['data_cpl'] as $key_0) {

					$n = 0;
					foreach ($nilai_cpmk as $key_2) {
						if ($arr['nim_rapor_mahasiswa'] == $key_2->nim) {
							$n_1 = 0;
								foreach ($rumus_cpl as $key_4) {
									if ($key_0->id_cpl_langsung == $key_4->id_cpl_langsung) {
										foreach ($rumus_deskriptor as $key_3) {
											if ($key_4->id_deskriptor == $key_3->id_deskriptor) {
												if ($key_2->id_matakuliah_has_cpmk == $key_3->id_matakuliah_has_cpmk) {
													$n_1 += $key_4->persentasi*$key_2->nilai_langsung*$key_3->persentasi;
												}
											}											
										}
									}
								}
							$n += $n_1;
						}
					}

				array_push($arr['nilai_cpl_mahasiswa'], $n);
			}
	    	
	    	foreach ($arr['nilai_cpl_mahasiswa'] as $key ) {

	    		if ($key > $batas_sangat_baik) {
		    		$status_cpl_mahasiswa = 'Sangat Baik';
		    	} elseif ($key > $batas_baik) {
		    		$status_cpl_mahasiswa = 'Baik';
		    	} elseif ($key > $batas_cukup) {
		    		$status_cpl_mahasiswa= 'Cukup';
		    	} else {
		    		$status_cpl_mahasiswa = 'Kurang';
		    	}

	    		array_push($arr['status_nilai_cpl_mahasiswa'], $status_cpl_mahasiswa);
	    	}
 
	    	//sistem_lama

	    	
	




    //- Sub Menu Rapor Mata Kuliah -

		//echo '<pre>';  var_dump($arr['nilai_mk_raport']); echo '</pre>';
		//echo '<pre>';  var_dump($nilai_mahasiswa_tak_langsung); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nilai_mk_raport']); echo '</pre>';
		//echo '<pre>';  var_dump($mahasiswa); echo '</pre>';
		//echo '<pre>';  var_dump($mahasiswa[0]); echo '</pre>';
		$this->load->view('vw_template_mahasiswa', $arr);
	}

	public function download_report_mahasiswa()
		{
			$arr['breadcrumbs'] = 'report';
			$arr['content'] = 'report/vw_report_mahasiswa_print';
	    	
	    	$rumus_cpl = $this->kinumum_model->get_cpl_rumus_deskriptor();
	        $rumus_deskriptor = $this->kinumum_model->get_deskriptor_rumus_cpmk();
	        $nilai_cpmk = $this->kinumum_model->get_nilai_cpmk();

	        $arr['mata_kuliah'] =  $this->Matakuliah_model->get_matakuliah();
			$arr['katkin'] =  $this->katkin_model->get_katkin();
			$arr['data_cpl'] = $this->report_model->get_cpl();
			$arr['nilai_cpl_mahasiswa'] = [];
			$arr['status_nilai_cpl_mahasiswa'] = [];
	        $tgl=date('Y');
	        $th = 2017;
	    	$tahun_report = [];
	    	for ($i=$th; $i < $tgl ; $i++) { 
	    		array_push($tahun_report, $i);
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

			$dt_mahasiswa_2 = [];
			foreach ($tahun_report as $key) {
				$send = curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=".$key);
				$dt_mahasisw = json_decode($send, TRUE);

				array_push($dt_mahasiswa_2, $dt_mahasisw);
			}

			$dt_mahasiswa = array_reduce($dt_mahasiswa_2, 'array_merge', array());


			if (!empty($this->input->post('download', TRUE))) {
				
				$nim_2 = $this->input->post('nim_2', TRUE); 
				$arr['nim_2'] = $nim_2;

				foreach ($dt_mahasiswa as $key) {
					if ($key["Nim"] == $nim_2) {
						$n_m = $key;
					}
				}

	 			$arr['nama_rapor_mahasiswa'] = ($n_m["Nama"]);
		    	$arr['nim_rapor_mahasiswa'] = ($n_m["Nim"]);

		    	$batas_cukup = ($arr['katkin']["0"]->batas_bawah_kategori_cukup_cpl);
		    	$batas_baik = ($arr['katkin']["0"]->batas_bawah_kategori_baik_cpl);
		    	$batas_sangat_baik = ($arr['katkin']["0"]->batas_bawah_kategori_sangat_baik_cpl);

		    	foreach ($arr['data_cpl'] as $key_0) {

						$n = 0;
						foreach ($nilai_cpmk as $key_2) {
							if ($arr['nim_rapor_mahasiswa'] == $key_2->nim) {
								$n_1 = 0;
									foreach ($rumus_cpl as $key_4) {
										if ($key_0->id_cpl_langsung == $key_4->id_cpl_langsung) {
											foreach ($rumus_deskriptor as $key_3) {
												if ($key_4->id_deskriptor == $key_3->id_deskriptor) {
													if ($key_2->id_matakuliah_has_cpmk == $key_3->id_matakuliah_has_cpmk) {
														$n_1 += $key_4->persentasi*$key_2->nilai_langsung*$key_3->persentasi;
													}
												}											
											}
										}
									}
								$n += $n_1;
							}
						}

					array_push($arr['nilai_cpl_mahasiswa'], $n);
				}
		    	
		    	foreach ($arr['nilai_cpl_mahasiswa'] as $key ) {

		    		if ($key > $batas_sangat_baik) {
			    		$status_cpl_mahasiswa = 'Sangat Baik';
			    	} elseif ($key > $batas_baik) {
			    		$status_cpl_mahasiswa = 'Baik';
			    	} elseif ($key > $batas_cukup) {
			    		$status_cpl_mahasiswa= 'Cukup';
			    	} else {
			    		$status_cpl_mahasiswa = 'Kurang';
			    	}

		    		array_push($arr['status_nilai_cpl_mahasiswa'], $status_cpl_mahasiswa);
		    	}
	 
		    	//sistem_lama 

		    	
			} else {
				foreach ($arr['data_cpl'] as $key) {
					array_push($arr['nilai_cpl_mahasiswa'], '-');
					array_push($arr['status_nilai_cpl_mahasiswa'], '-');

				}
				$arr['nama_rapor_mahasiswa'] = '-';
		    	$arr['nim_rapor_mahasiswa'] = '-';
		    	$arr['ttl_rapor_mahasiswa'] = '-';
		    	$arr['tahun_masuk_rapor_mahasiswa'] = '-';
			}

			$arr['title_print'] = "Report Mahasiswa ".$arr['nama_rapor_mahasiswa']."-".$arr['nim_rapor_mahasiswa'];
			$this->load->view('vw_template_print', $arr);

		}
 
		
} 
 