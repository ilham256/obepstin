<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
 
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
		$arr['content'] = 'vw_report';

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
		$arr['nim_3'] = 'F34180001';
		$arr['cpl'] =  $this->kincpl_model->get_cpl();
		$arr['simpanan_cpl'] = ($arr['cpl']["7"]->id_cpl_langsung);

		$rumus_cpl = $this->kinumum_model->get_cpl_rumus_deskriptor();
        $rumus_deskriptor = $this->kinumum_model->get_deskriptor_rumus_cpmk();
        $nilai_cpmk = $this->kinumum_model->get_nilai_cpmk();

        $target = $this->katkin_model->get_katkin();
		$target_cpl =  ($target["0"]->nilai_target_pencapaian_cpl);

		if (!empty($this->input->post('pilih_3', TRUE))) {
			
			
			$nim_3 = $this->input->post('nim_3', TRUE); 
			$arr['nim_3'] = $nim_3;
			
			$cpl_1 = $this->input->post('cpl', TRUE); 
			$arr['simpanan_cpl'] = $cpl_1;

			$arr['status_aktif'] = '';
			$arr['status_aktif_2'] = '';
			$arr['status_aktif_3'] = 'show active';


			$arr['naf'] = '';
			$arr['naf_2'] = '';
			$arr['naf_3'] = 'active';

		}
 
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

    	$arr['nim'] = 'F34180001';
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

    	if (!empty($this->input->post('pilih', TRUE))) {

			$nim = $this->input->post('nim', TRUE); 
			$arr['nim'] = $nim;
			$n_m = $this->report_model->get_nama_mahasiswa($nim);

			foreach ($dt_mahasiswa as $key) {
				if ($key["Nim"] == $nim) {
					$n_m = $key;
				}
			}

			$arr['nama'] = ($n_m["Nama"]); 
 
			$arr['ns'] = 'Nilai CPMK '.$arr['nama'].' ('.$arr['nim'].')';

		} else {

    	$arr['ns'] = 'Nilai CPMK F34180001';
		} 

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

		if (!empty($this->input->post('pilih_2', TRUE))) {
			
			$arr['status_aktif'] = '';
			$arr['status_aktif_2'] = 'show active';
			$arr['status_aktif_3'] = '';

			$arr['naf'] = '';
			$arr['naf_2'] = 'active';
			$arr['naf_3'] = '';

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




    //- Sub Menu Rapor Mata Kuliah -

		//echo '<pre>';  var_dump($arr['nilai_mk_raport']); echo '</pre>';
		//echo '<pre>';  var_dump($nilai_mahasiswa_tak_langsung); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nilai_mk_raport']); echo '</pre>';
		//echo '<pre>';  var_dump($mahasiswa); echo '</pre>';
		//echo '<pre>';  var_dump($mahasiswa[0]); echo '</pre>';
		$this->load->view('vw_template', $arr);
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
 
	public function mata_kuliah()
	{
		$arr['breadcrumbs'] = 'report';
		$arr['content'] = 'report/vw_report_mata_kuliah';

		$arr['mata_kuliah'] =  $this->Matakuliah_model->get_matakuliah();
		$arr['simpanan_mk'] = 'TIN211';
		$arr['tahun_mk'] = 2018;
		$target = $this->katkin_model->get_katkin();
		$arr['target_cpl'] =  $target;

		if (!empty($this->input->post('pilih_4', TRUE))) {		
				
			$th = $this->input->post('tahun', TRUE); 
			$arr['tahun_mk'] = $th;
			
			$mk_1 = $this->input->post('mk', TRUE); 
			$arr['simpanan_mk'] = $mk_1;

			$arr['status_aktif'] = '';
			$arr['status_aktif_2'] = '';
			$arr['status_aktif_4'] = 'show active';

			$arr['naf'] = '';
			$arr['naf_2'] = '';
			$arr['naf_4'] = 'active';

		}

		$arr['data_mk'] = $this->report_model->get_data_mk($arr['simpanan_mk']);

		
		//dari Database

		$mahasiswa_2 = $this->kinumum_model->get_mahasiswa_tahun($arr['tahun_mk']);
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

		$mk_raport = $this->report_model->get_mk_cpmk($arr['simpanan_mk']);
		$arr['mk_raport'] = [];
		$arr['nilai_mk_raport'] = [];  
		$arr['nilai_mk_raport_keseluruhan'] = [];
		$arr['nilai_mk_raport_tl'] = [];
		$arr['nilai_mk_raport_tak_langsung'] = [];
		$arr['jumlah'] = [];

		foreach ($mk_raport as $key_0) {
			array_push($arr['mk_raport'], $key_0->id_cpmk_langsung);
		}

		foreach ($mk_raport as $key) {
			$nilai_mk_raport_s = [];
			$nilai_mk_raport_s_tl = [];
			foreach ($mahasiswa as $key_2) {				
				$nilai_mahasiswa = $this->report_model->get_nilai_cpmk($key->id_matakuliah_has_cpmk,$key_2['Nim']);

				if (empty($nilai_mahasiswa)) { 
					  $nilai_mahasiswa = 0;
					}		

				if ($nilai_mahasiswa == 0) {
						array_push($nilai_mk_raport_s, $nilai_mahasiswa);
					} else {

						$nilai_sementara = [];
						$nilai_sementara_tl = [];
						foreach ($nilai_mahasiswa as $key_2) {
							array_push($nilai_sementara, $key_2->nilai_langsung);
							array_push($nilai_sementara_tl, $key_2->nilai_tak_langsung);
						}

						$average = array_sum($nilai_sementara)/count($nilai_sementara);
						$average_tl = array_sum($nilai_sementara_tl)/count($nilai_sementara_tl);
						array_push($nilai_mk_raport_s, $average);
						array_push($nilai_mk_raport_s_tl, $average_tl);
					}
			}

			$j = 0;
			foreach ($nilai_mk_raport_s as $k) {
				if ($k > 0.0) {
					$j += 1;
				}
			}

			if ($j == 0) {
				$j = 1;
			}

			$j_tl = 0;
			foreach ($nilai_mk_raport_s_tl as $k_tl) {
				if ($k_tl > 0.0) {
					$j_tl += 1;
				}
			}

			if ($j_tl == 0) {
				$j_tl = 1;
			}

			$dt_avg = array_sum($nilai_mk_raport_s)/$j;
			$dt_avg_tl = array_sum($nilai_mk_raport_s_tl)/$j_tl;

			array_push($arr['nilai_mk_raport'], $dt_avg);
			array_push($arr['nilai_mk_raport_keseluruhan'], $nilai_mk_raport_s);
			array_push($arr['jumlah'], $j);
		}

		foreach ($mk_raport as $key) {
			$nilai_mk_raport_tak_langsung_s = [];
			foreach ($mahasiswa as $key_2) {				
				$nilai_mahasiswa_tak_langsung = $this->report_model->get_nilai_cpmk_tl($key->id_matakuliah_has_cpmk,$key_2['Nim']);

				if (empty($nilai_mahasiswa_tak_langsung)) { 
					  $nilai_mahasiswa_tak_langsung = 0;
					}		

				if ($nilai_mahasiswa_tak_langsung == 0) {
						array_push($nilai_mk_raport_tak_langsung_s, $nilai_mahasiswa_tak_langsung);
					} else {


						$nilai_sementara_tl = [];
						foreach ($nilai_mahasiswa_tak_langsung as $key_2) {

							array_push($nilai_sementara_tl, $key_2->nilai_tak_langsung);
						}


						$average_tl = array_sum($nilai_sementara_tl)/count($nilai_sementara_tl);
						array_push($nilai_mk_raport_tak_langsung_s, $average_tl);

					}
			}
 			$j = 0;
			foreach ($nilai_mk_raport_tak_langsung_s as $k) {
				if ($k > 0.0) {
					$j += 1;
				}
			}
			if ($j == 0) {
				$j = 1;
			}
			$dt_avg = array_sum($nilai_mk_raport_tak_langsung_s)/$j;
			array_push($arr['nilai_mk_raport_tak_langsung'], $dt_avg);
	
		}
		//echo '<pre>';  var_dump($arr['cpl']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nilai_diagram_cpl']); echo '</pre>';
		//echo '<pre>';  var_dump($mahasiswa_2); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nilai_mk_raport_keseluruhan']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['tahun_mk']); echo '</pre>';
		//echo '<pre>';  var_dump($mahasiswa_2); echo '</pre>';
		$this->load->view('vw_template', $arr);

	}
 
 public function download_report_mata_kuliah()
	{
		$arr['breadcrumbs'] = 'report';
		$arr['content'] = 'report/vw_report_mata_kuliah_print';

		$arr['mata_kuliah'] =  $this->Matakuliah_model->get_matakuliah();
		$arr['simpanan_mk'] = 'TIN211';
		$arr['tahun_mk'] = 2018;
		$target = $this->katkin_model->get_katkin();
		$arr['target_cpl'] =  $target;

		if (!empty($this->input->post('download', TRUE))) {		
				
			$th = $this->input->post('tahun', TRUE); 
			$arr['tahun_mk'] = $th;
			
			$mk_1 = $this->input->post('mk', TRUE); 
			$arr['simpanan_mk'] = $mk_1;

			$arr['status_aktif'] = '';
			$arr['status_aktif_2'] = '';
			$arr['status_aktif_4'] = 'show active';

			$arr['naf'] = '';
			$arr['naf_2'] = '';
			$arr['naf_4'] = 'active';

		}

		$arr['data_mk'] = $this->report_model->get_data_mk($arr['simpanan_mk']);

		
		//dari Database

		$mahasiswa_2 = $this->kinumum_model->get_mahasiswa_tahun($arr['tahun_mk']);
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

		$mk_raport = $this->report_model->get_mk_cpmk($arr['simpanan_mk']);
		$arr['mk_raport'] = [];
		$arr['nilai_mk_raport'] = [];
		$arr['nilai_mk_raport_keseluruhan'] = [];
		$arr['nilai_mk_raport_tl'] = [];
		$arr['nilai_mk_raport_tak_langsung'] = [];
		$arr['jumlah'] = [];

		foreach ($mk_raport as $key_0) {
			array_push($arr['mk_raport'], $key_0->id_cpmk_langsung);
		}

		foreach ($mk_raport as $key) {
			$nilai_mk_raport_s = [];
			$nilai_mk_raport_s_tl = [];
			foreach ($mahasiswa as $key_2) {				
				$nilai_mahasiswa = $this->report_model->get_nilai_cpmk($key->id_matakuliah_has_cpmk,$key_2['Nim']);

				if (empty($nilai_mahasiswa)) { 
					  $nilai_mahasiswa = 0;
					}		

				if ($nilai_mahasiswa == 0) {
						array_push($nilai_mk_raport_s, $nilai_mahasiswa);
					} else {

						$nilai_sementara = [];
						$nilai_sementara_tl = [];
						foreach ($nilai_mahasiswa as $key_2) {
							array_push($nilai_sementara, $key_2->nilai_langsung);
							array_push($nilai_sementara_tl, $key_2->nilai_tak_langsung);
						}

						$average = array_sum($nilai_sementara)/count($nilai_sementara);
						$average_tl = array_sum($nilai_sementara_tl)/count($nilai_sementara_tl);
						array_push($nilai_mk_raport_s, $average);
						array_push($nilai_mk_raport_s_tl, $average_tl);
					}
			}

			$j = 0;
			foreach ($nilai_mk_raport_s as $k) {
				if ($k > 0.0) {
					$j += 1;
				}
			}

			if ($j == 0) {
				$j = 1;
			}

			$j_tl = 0;
			foreach ($nilai_mk_raport_s_tl as $k_tl) {
				if ($k_tl > 0.0) {
					$j_tl += 1;
				}
			}

			if ($j_tl == 0) {
				$j_tl = 1;
			}

			$dt_avg = array_sum($nilai_mk_raport_s)/$j;
			$dt_avg_tl = array_sum($nilai_mk_raport_s_tl)/$j_tl;

			array_push($arr['nilai_mk_raport'], $dt_avg);
			array_push($arr['nilai_mk_raport_keseluruhan'], $nilai_mk_raport_s);
			array_push($arr['jumlah'], $j);
		}




		foreach ($mk_raport as $key) {
			$nilai_mk_raport_tak_langsung_s = [];
			foreach ($mahasiswa as $key_2) {				
				$nilai_mahasiswa_tak_langsung = $this->report_model->get_nilai_cpmk_tl($key->id_matakuliah_has_cpmk,$key_2['Nim']);

				if (empty($nilai_mahasiswa_tak_langsung)) { 
					  $nilai_mahasiswa_tak_langsung = 0;
					}		

				if ($nilai_mahasiswa_tak_langsung == 0) {
						array_push($nilai_mk_raport_tak_langsung_s, $nilai_mahasiswa_tak_langsung);
					} else {


						$nilai_sementara_tl = [];
						foreach ($nilai_mahasiswa_tak_langsung as $key_2) {

							array_push($nilai_sementara_tl, $key_2->nilai_tak_langsung);
						}

 
						$average_tl = array_sum($nilai_sementara_tl)/count($nilai_sementara_tl);
						array_push($nilai_mk_raport_tak_langsung_s, $average_tl);

					}
			}
 
			$j = 0;
			foreach ($nilai_mk_raport_tak_langsung_s as $k) {
				if ($k > 0.0) {
					$j += 1;
				}
			}

			if ($j == 0) {
				$j = 1;
			}


			$dt_avg = array_sum($nilai_mk_raport_tak_langsung_s)/$j;
			array_push($arr['nilai_mk_raport_tak_langsung'], $dt_avg);
	
		}
		//echo '<pre>';  var_dump($arr['cpl']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nilai_diagram_cpl']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['target_cpl']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nilai_mk_raport_keseluruhan']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['jumlah']); echo '</pre>';
		$arr['title_print'] =  "Report MataKuliah ".$arr['data_mk']["0"]->nama_mata_kuliah." Angkatan ".$arr['tahun_mk'];
		$this->load->view('vw_template_print', $arr);

	}
	public function relevansi_ppm()
	{
		$arr['breadcrumbs'] = 'report';
		$arr['content'] = 'report/vw_report_relevansi_ppm';

		$arr['relevansi_ppm'] = $this->report_model->get_relevansi_ppm();
		$arr['ppm'] = $this->report_model->get_ppm();
		$arr['cpl'] = $this->report_model->get_cpl();
		$arr['nilai_ppm'] = [];
		$arr['nilai_cpl'] = [];
		$arr['nilai_diagram_ppm'] = [];
		$arr['nilai_diagram_cpl'] = [];
		$arr['nama_cpl'] = [];
		$arr['nama_ppm'] = [];
 
		foreach ($arr['cpl'] as $key ) {
			$nilai_ppm_cpl = [];
			foreach ($arr['relevansi_ppm'] as $key2) {
				$nilai = $this->report_model->get_nilai_ppm_cpl($key->id_cpl_langsung,$key2->id_relevansi_ppm);
				//echo '<pre>';  var_dump($nilai); echo '</pre>';
				$n = intval($nilai['0']->nilai_relevansi_ppm_cpl);
				array_push($nilai_ppm_cpl, $n);
			}
			$average_nilai_ppm_cpl = array_sum($nilai_ppm_cpl)/count($nilai_ppm_cpl);
			array_push($arr['nilai_cpl'], $nilai_ppm_cpl);
			array_push($arr['nama_cpl'], $key->nama);
		}

		foreach ($arr['ppm'] as $key ) {
			$nilai_ppm = [];
			foreach ($arr['relevansi_ppm'] as $key2) {
				$nilai = $this->report_model->get_nilai_ppm($key->id,$key2->id_relevansi_ppm);
				$n = intval($nilai['0']->nilai_relevansi_ppm);
				array_push($nilai_ppm, $n);
			}
			$average_nilai_ppm = array_sum($nilai_ppm)/count($nilai_ppm);
			array_push($arr['nilai_ppm'], $nilai_ppm);
			array_push($arr['nama_ppm'], $key->nama);
		}

		for ($i=1; $i < 6; $i++) { 
				$nilai_diagram = [];
				for ($j=0; $j < count($arr['cpl']); $j++) { 
					$n = 0;
					foreach ($arr['nilai_cpl'][$j] as $key) {						
						if ($key == $i) {
							$n += 1; 
						}
					}
					$m = round($n/count($arr['nilai_cpl'][$j])*100);
					array_push($nilai_diagram, $m);
				}
				array_push($arr['nilai_diagram_cpl'], $nilai_diagram);
			}

		for ($i=1; $i < 6; $i++) { 
				$nilai_diagram = [];
				for ($j=0; $j < count($arr['ppm']); $j++) { 
					$n = 0;
					foreach ($arr['nilai_ppm'][$j] as $key) {						
						if ($key == $i) {
							$n += 1; 
						}
					}
					$m = round($n/count($arr['nilai_ppm'][$j])*100);
					array_push($nilai_diagram, $m);
				}
				array_push($arr['nilai_diagram_ppm'], $nilai_diagram);
			}

		//echo '<pre>';  var_dump($arr['cpl']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nilai_diagram_cpl']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nilai_diagram_ppm']); echo '</pre>';
		$this->load->view('vw_template', $arr);

	}

	public function efektivitas_cpl()
	{
		$arr['breadcrumbs'] = 'report';
		$arr['content'] = 'report/vw_report_efektivitas_cpl';

		$arr['mahasiswa'] = $this->report_model->get_mahasiswa();
		$arr['cpl'] = $this->report_model->get_cpl();
		$arr['nilai_cpl'] = [];
		$arr['nilai_cpl_keseluruhan'] = [];
		$arr['jumlah'] = [];
		$arr['nilai_diagram'] = [];
		$arr['nama_cpl'] = [];
 
		foreach ($arr['cpl'] as $key ) {
			$nilai_efektivitas_cpl = [];
			foreach ($arr['mahasiswa'] as $key2) {
				$nilai = $this->report_model->get_nilai_efektivitas_cpl($key->id_cpl_langsung,$key2->nim);
				//echo '<pre>';  var_dump($nilai); echo '</pre>';
				if (empty($nilai)) {
					$n = 0;
				} else { 
				$n = intval($nilai['0']->nilai); }
				
				array_push($nilai_efektivitas_cpl, $n);
			}

			$j = 0;
			foreach ($nilai_efektivitas_cpl as $k) {
				if ($k > 0.0) {
					$j += 1;
				}
			}

			if ($j == 0) {
				$j = 1;
			}

			$average_nilai_cpl = array_sum($nilai_efektivitas_cpl)/$j;
			array_push($arr['nilai_cpl'], round($average_nilai_cpl));
			array_push($arr['jumlah'], $j);
			array_push($arr['nilai_cpl_keseluruhan'], $nilai_efektivitas_cpl);
			array_push($arr['nama_cpl'], $key->nama);

		}

			for ($i=1; $i < 8; $i++) { 
				$nilai_diagram = [];
				for ($j=0; $j < count($arr['cpl']); $j++) { 
					$n = 0;
					foreach ($arr['nilai_cpl_keseluruhan'][$j] as $key) {						
						if ($key == $i) {
							$n += 1; 
						}
					}
					$m = round($n/$arr['jumlah'][$j]*100);
					array_push($nilai_diagram, $m);
				}
				array_push($arr['nilai_diagram'], $nilai_diagram);
			}
		//echo '<pre>';  var_dump($arr['cpl']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nilai_cpl']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nilai_cpl']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['mata_kuliah']); echo '</pre>';
		$this->load->view('vw_template', $arr);

	}

	public function report_epbm_copy()
	{ 
		$arr['breadcrumbs'] = 'report';
		$arr['content'] = 'report/vw_report_epbm';

		
		$arr['data_epbm_dosen'] = $this->report_model->get_epbm_mata_kuliah_has_dosen();
		$arr['data_epbm_mk'] = $this->report_model->get_epbm_mata_kuliah();
		$arr['data_dosen'] = $this->report_model->get_dosen();
		$arr['data_psd'] = $this->report_model->get_psd();
		$arr['psd'] = [];

		$arr['tahun'] = '2015';
		$arr['semester'] = 'Ganjil';
		$arr['dosen'] = '196106301986032003';
		$arr['mk'] = 'TIN213 / 1';

		if (!empty($this->input->post('pilih', TRUE))) {		
				
			//$mk_1 = $this->input->post('mk', TRUE); 
			//$arr['simpanan_mk'] = $mk_1;

			$arr['tahun'] = $this->input->post('tahun', TRUE); 
			$arr['semester'] = $this->input->post('semester', TRUE); 
			$arr['dosen'] = $this->input->post('dosen', TRUE); 
			$arr['mk'] = $this->input->post('mk', TRUE); 

		}


		$arr['data_nilai_epbm_mk'] = $this->report_model->get_nilai_epbm_mk($arr['tahun'],$arr['semester'],$arr['mk']);
		$arr['data_nilai_epbm_dosen'] = $this->report_model->get_nilai_epbm_dosen($arr['tahun'],$arr['semester'],$arr['mk']."_".$arr['dosen']);

		$arr['data_diagram_epbm_mk'] = [];
		$arr['data_diagram_epbm_dosen'] = [];


		for ($i=1; $i < count($arr['data_nilai_epbm_mk']); $i++) { 
			array_push($arr['psd'], $arr['data_psd'][$i]->nama);
			array_push($arr['data_diagram_epbm_mk'], $arr['data_nilai_epbm_mk'][$i]->nilai);
			array_push($arr['data_diagram_epbm_dosen'], $arr['data_nilai_epbm_dosen'][$i]->nilai);
		}



		//echo '<pre>';  var_dump($arr['tahun']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['semester']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['dosen']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['mk']); echo '</pre>';
		$this->load->view('vw_template', $arr);
 
	}

	public function report_epbm()
	{ 
		$arr['breadcrumbs'] = 'report';
		$arr['content'] = 'report/vw_report_epbm_2';

		$arr['data_epbm_dosen'] = $this->report_model->get_epbm_mata_kuliah_has_dosen();
		$arr['data_epbm_mk'] = $this->report_model->get_epbm_mata_kuliah();
		$arr['data_dosen'] = $this->report_model->get_dosen();
		$arr['data_psd'] = $this->report_model->get_psd();
		$arr['psd'] = [];

		$arr['tahun'] = '2015';
		$arr['semester'] = 'Ganjil';
		$arr['dosen'] = '196106301986032003';

		if (!empty($this->input->post('pilih', TRUE))) {		
			//$mk_1 = $this->input->post('mk', TRUE); 
			//$arr['simpanan_mk'] = $mk_1;
			//$arr['tahun'] = $this->input->post('tahun', TRUE); 
			//$arr['semester'] = $this->input->post('semester', TRUE); 
			$arr['dosen'] = $this->input->post('dosen', TRUE); 
		}

		$arr['data_epbm_dosen_select'] = $this->report_model->get_epbm_mata_kuliah_has_dosen_select($arr['dosen']);
		$arr['data_tahun'] = $this->report_model->get_tahun();
		$arr['data_semester'] = ['Ganjil','Genap'];

		$arr['data_nilai_epbm_mk'] = [];
		$arr['data_nilai_epbm_dosen'] = [];
		$arr['data_diagram_epbm_mk'] = [];
		$arr['data_diagram_epbm_dosen'] = [];
		$arr['kode_epbm_dosen'] = [];
		$arr['nama_mata_kuliah'] = [];
		$arr['nama_tahun'] = [];
		$arr['nama_semester'] = [];

		foreach ($arr['data_tahun'] as $key1) {
			foreach ($arr['data_semester'] as $key2) {
				foreach ($arr['data_epbm_dosen_select'] as $key) {
					$data_nilai_epbm_mk = $this->report_model->get_nilai_epbm_mk($key1->tahun,$key2,$key->kode_epbm_mk);
					$data_nilai_epbm_dosen = $this->report_model->get_nilai_epbm_dosen($key1->tahun,$key2,$key->kode_epbm_mk."_".$arr['dosen']);

					$data_diagram_epbm_mk = [];
					$data_diagram_epbm_dosen = [];
					$psd = [];
					//echo '<pre>';  var_dump($data_nilai_epbm_mk); echo '</pre>';		

					if (!empty($data_nilai_epbm_dosen)) {
						for ($i=1; $i < count($data_nilai_epbm_mk); $i++) { 
							array_push($psd, $arr['data_psd'][$i]->nama);
							array_push($data_diagram_epbm_mk, $data_nilai_epbm_mk[$i]->nilai);
							array_push($data_diagram_epbm_dosen, $data_nilai_epbm_dosen[$i]->nilai);
						}

						array_push($arr['data_nilai_epbm_mk'], $data_nilai_epbm_mk);
						array_push($arr['data_nilai_epbm_dosen'], $data_nilai_epbm_dosen);
						array_push($arr['psd'], $psd);
						array_push($arr['data_diagram_epbm_mk'], $data_diagram_epbm_mk);
						array_push($arr['data_diagram_epbm_dosen'], $data_diagram_epbm_dosen);
						array_push($arr['kode_epbm_dosen'], $key->kode_epbm_mk);
						array_push($arr['nama_mata_kuliah'], $key->nama_mata_kuliah);
						array_push($arr['nama_tahun'], $key1->tahun);
						array_push($arr['nama_semester'], $key2);
					}
				}
			}
		}
		//echo '<pre>';  var_dump($arr['data_tahun']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['kode_epbm_dosen']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['nama_mata_kuliah']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['data_epbm_dosen_select']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['data_nilai_epbm_mk']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['data_nilai_epbm_dosen']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['data_diagram_epbm_mk']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['data_diagram_epbm_dosen']); echo '</pre>';
		$this->load->view('vw_template', $arr);
 
	}
} 
 