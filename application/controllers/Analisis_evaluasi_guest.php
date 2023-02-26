<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analisis_evaluasi_guest extends MY_Controller {

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
    	$this->load->model('evaluasi_l_model'); 
    	$this->load->model('katkin_model'); 
        $this->load->model('mahasiswa_model');
        $this->load->model('kinumum_model');
        $this->load->model('kincpl_model');
        $this->load->model('report_model');

        $this->load->model('evaluasi_tl_model'); 



        if ($this->session->userdata('loggedin') != true || $_SESSION['level'] != 4) {
      redirect('auth/login');
      }
    	

    }
     

    public function evaluasi_l() {


        $arr['breadcrumbs'] = 'evaluasi_l';
        $arr['content'] = 'login_guest/analisis_evaluasi_pengukuran_langsung/analisis_kinerja_cpl_vw';

        $arr['data_semester'] =  $this->Matakuliah_model->get_semester();
        $arr['tahun_masuk'] =  $this->mahasiswa_model->get_tahun_masuk();
        $arr['tahun_masuk_max'] =  $this->mahasiswa_model->get_tahun_masuk_max();
        $arr['katkin'] =  $this->katkin_model->get_katkin();
  
        $arr['data_cpl'] = $this->kinumum_model->get_cpl();
        $arr['nama_cpl'] = [];

        foreach ($arr['data_cpl'] as $key ) {
            array_push($arr['nama_cpl'], $key->nama);
        }



        $rumus_cpl = $this->kinumum_model->get_cpl_rumus_deskriptor();
        $rumus_deskriptor = $this->kinumum_model->get_deskriptor_rumus_cpmk();
        $nilai_cpmk = $this->kinumum_model->get_nilai_cpmk();

        $tahun_min = 2017;
        $tahun_max = 2019;
        //$tahun_max=date('Y');
        
        $target = $this->katkin_model->get_katkin();

        $arr['simpanan_tahun_min'] = $tahun_min;
        $arr['t_simpanan_tahun_min'] = ((int)$tahun_min)+1;
        $arr['simpanan_tahun_max'] = $tahun_max;
        $arr['t_simpanan_tahun_max'] = ((int)$tahun_max)+1;


        // Sub-Menu Analisis Kinerja CPL

        if (!empty($this->input->post('pilih', TRUE))) {

            $tahun_min = $this->input->post('tahun_masuk_min', TRUE);
            $arr['simpanan_tahun_min'] = $tahun_min;
            $arr['t_simpanan_tahun_min'] = ((int)$tahun_min)+1;

            $tahun_max = $this->input->post('tahun_masuk_max', TRUE);
            $arr['simpanan_tahun_max'] = $tahun_max;
            $arr['t_simpanan_tahun_max'] = ((int)$tahun_max)+1;

        }  

        $arr['tahun_masuk_select'] = [];

        for ($i=$tahun_min; $i < $tahun_max ; $i++) { 
            array_push($arr['tahun_masuk_select'] , $i);
        }


        $select_tahun = [];
        $simpan = [];
        $nilai_std_max = [];
        $nilai_std_min = [];
        $nilai_cpl_average = []; 
        $nilai_cpl_mahasiswa = [];
        $nilai_target = [];
        //$mahasiswa = $this->kinumum_model->get_mahasiswa_tahun($tahun);

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
   
        foreach ($arr['tahun_masuk_select'] as $tahun) {
            
            $nilai_std_max_1 = [];
            $nilai_std_min_1 = [];
            $nilai_cpl_average_1 = []; 
            $nilai_cpl_mahasiswa_1 = [];
            $target_1 = [];
        
            $send = $this->curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=".$tahun); 

            // mengubah JSON menjadi array
            $mahasiswa = json_decode($send, TRUE);

 
            // Menentukan Nilai yang dimasukan kedalam diagram

            foreach ($arr['data_cpl'] as $key_0) {

                $dt = [];
                foreach ($mahasiswa as $key) {

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
            
                array_push($nilai_cpl_mahasiswa_1, $dt);
                array_push($nilai_cpl_average_1, round($dt_avg));
                array_push($nilai_std_max_1, $dt_avg+5);
                array_push($nilai_std_min_1, $dt_avg-5);
                array_push($target_1, $target["0"]->nilai_target_pencapaian_cpl);
            }


            array_push($nilai_cpl_mahasiswa, $nilai_cpl_mahasiswa_1);
            array_push($nilai_cpl_average, $nilai_cpl_average_1);
            array_push($nilai_std_max, $nilai_std_max_1);
            array_push($nilai_std_min, $nilai_std_min_1);
            array_push($nilai_target, $target_1);
        }
 

        
        $arr['target'] =  $nilai_target;
        $arr['nilai_cpl'] = $nilai_cpl_average;
        $arr['nilai_std_max'] = $nilai_std_max;
        $arr['nilai_std_min'] = $nilai_std_min;

        //echo '<pre>';  var_dump($arr['target']); echo '</pre>';
        //echo '<pre>';  var_dump($arr['cpl_2']); echo '</pre>';
        //echo '<pre>';  var_dump($arr['tahun_masuk_select']); echo '</pre>';
        $this->load->view('vw_template_guest', $arr);
    }

     public function curl($url){
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

    public function evaluasi_kinerja_cpl()
    { 
        $arr['breadcrumbs'] = 'evaluasi_l';

        $arr['content'] = 'login_guest/analisis_evaluasi_pengukuran_langsung/evaluasi_kinerja_cpl_vw';

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

        $send = $this->get_curl("https://api.ipb.ac.id/v1/Mahasiswa/DaftarMahasiswa/PerDepartemen?departemenId=160&strata=S1&tahunMasuk=".$arr['tahun']);

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

    public function evaluasi_tl() 
    {
        $arr['breadcrumbs'] = 'evaluasi_tl';
        $arr['content'] = 'login_guest/vw_evaluasi_tl';

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
        $this->load->view('vw_template_guest', $arr);
    }
} 
