<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Cpl_tersimpan extends CI_Controller {
 
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
  		//$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    	$this->load->model('cpl_tersimpan_model');
    	$this->load->model('Matakuliah_model');
    	$this->load->model('mahasiswa_model');
        $this->load->model('katkin_model');
        $this->load->model('kinumum_model');
        
        if ($this->session->userdata('loggedin') != true || $_SESSION['level'] != 0) {
      redirect('auth/login');}
      
    }

    public function index() 
    {
        $arr['breadcrumbs'] = 'cpl_tersimpan';
        $arr['content'] = 'vw_cpl_tersimpan';

        $arr['tahun_masuk'] =  $this->mahasiswa_model->get_tahun_masuk();
        $arr['cpl'] =  $this->cpl_tersimpan_model->get_cpl();
        $arr['simpanan_tahun'] = " - Pilih Tahun - ";
        $arr['t_simpanan_tahun'] = " ";

        $arr['datas'] =  $this->cpl_tersimpan_model->get_cpl_tersimpan_all();

        $data_tahun_masuk = ""; 
        $arr['data_mahasiswa'] =  $this->cpl_tersimpan_model->get_mahasiswa_all();
                                
        if (!empty($this->input->post('pilih', TRUE))) {
            $data_tahun_masuk = $this->input->post('tahun_masuk', TRUE); 

            $arr['datas'] =  $this->cpl_tersimpan_model->get_cpl_tersimpan($data_tahun_masuk);
            $arr['data_mahasiswa'] =  $this->cpl_tersimpan_model->get_mahasiswa($data_tahun_masuk);

            $data_tahun =$data_tahun_masuk+1; ;
            $arr['simpanan_tahun'] = $data_tahun_masuk;
            $arr['t_simpanan_tahun'] = "/".$data_tahun;                //s
        }
        //echo '<pre>';  var_dump($data_tahun_masuk); echo '</pre>';
        //$this->load->view('vw_template', $arr);
        $this->load->view('vw_template', $arr);
    }

    public function tambah() 
    {
        $arr['breadcrumbs'] = 'cpl_tersimpan';
        $arr['content'] = 'cpl_tersimpan/tambah';

        $arr['tahun_masuk'] =  $this->mahasiswa_model->get_tahun_masuk();

        $simpan_tahun = $this->mahasiswa_model->get_tahun_masuk_min();

        $arr['data_cpl'] = $this->kinumum_model->get_cpl();

        $rumus_cpl = $this->kinumum_model->get_cpl_rumus_deskriptor();
        $rumus_deskriptor = $this->kinumum_model->get_deskriptor_rumus_cpmk();
        $nilai_cpmk = $this->kinumum_model->get_nilai_cpmk();

        if (!empty($this->input->post('proses', TRUE))) {
            $tahun= $this->input->post('tahun', TRUE); 
            $arr['simpanan_tahun'] = $tahun;
            $arr['t_simpanan_tahun'] = ((int)$tahun)+1;
        }

        

        $nilai_std_max = [];
        $nilai_std_min = [];
        $nilai_cpl_average = []; 
        $nilai_cpl_mahasiswa = [];

        $simpan = [];
        //$mahasiswa = $this->kinumum_model->get_mahasiswa_tahun($tahun);

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
        $arr['data_mahasiswa'] =  $mahasiswa;

 
        // Menentukan Nilai yang dimasukan kedalam diagram
        $data_nilai_cpl = [];
        foreach ($arr['data_cpl'] as $key_0) {
            $dt = [];
            
            foreach ($arr['data_mahasiswa'] as $key ) {
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


                $save_data = [
                              'nim' => $key["Nim"],
                              'nama_mahasiswa' => $key["Nama"],
                              'id_cpl_langsung' => $key_0->id_cpl_langsung,  
                              'nilai_cpl' => $n,         
                        ];
                array_push($data_nilai_cpl, $save_data);

            }           
        }
 
 

        $target = $this->katkin_model->get_katkin();
        $arr['target'] =  ($target["0"]->nilai_target_pencapaian_cpl);
        $arr['datas'] = $data_nilai_cpl;
        
        $this->load->view('vw_template', $arr);

        //echo '<pre>';  var_dump($arr['datas']); echo '</pre>';
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

    public function simpan() 
    {
        $arr['breadcrumbs'] = 'cpl_tersimpan';
        $arr['content'] = 'vw_data_berhasil_disimpan';

        $arr['tahun_masuk'] =  $this->mahasiswa_model->get_tahun_masuk();

        $simpan_tahun = $this->mahasiswa_model->get_tahun_masuk_min();

        $arr['data_cpl'] = $this->kinumum_model->get_cpl();

        $rumus_cpl = $this->kinumum_model->get_cpl_rumus_deskriptor();
        $rumus_deskriptor = $this->kinumum_model->get_deskriptor_rumus_cpmk();
        $nilai_cpmk = $this->kinumum_model->get_nilai_cpmk();

        if (!empty($this->input->post('simpan', TRUE))) {
            $tahun= $this->input->post('tahun', TRUE); 
            $arr['simpanan_tahun'] = $tahun;
            $arr['t_simpanan_tahun'] = ((int)$tahun)+1;
        }

        

        $nilai_std_max = [];
        $nilai_std_min = [];
        $nilai_cpl_average = []; 
        $nilai_cpl_mahasiswa = [];

        $simpan = [];
        //$mahasiswa = $this->kinumum_model->get_mahasiswa_tahun($tahun);

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
        $arr['data_mahasiswa'] =  $mahasiswa;

 
        // Menentukan Nilai yang dimasukan kedalam diagram
        $data_nilai_cpl = [];
        foreach ($arr['data_cpl'] as $key_0) {
            $dt = [];
            
            foreach ($arr['data_mahasiswa'] as $key ) {
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


                $save_data = [
                              'nim' => $key["Nim"],
                              'nama_mahasiswa' => $key["Nama"],
                              'id_cpl_langsung' => $key_0->id_cpl_langsung,  
                              'nilai_cpl' => $n,         
                        ];
                $save = array(                            
                                "id_nilai_cpl_tersimpan"=> $key["Nim"].'_'.$key_0->id_cpl_langsung,
                                "nim"=> $key["Nim"],
                                "id_cpl_langsung"=> $key_0->id_cpl_langsung,
                                "nilai"=>  $n

                            );
                $insert = $this->cpl_tersimpan_model->update_excel($save);
                array_push($data_nilai_cpl, $save_data);

            }           
        }
 
 

        $target = $this->katkin_model->get_katkin();
        $arr['target'] =  ($target["0"]->nilai_target_pencapaian_cpl);
        $arr['datas'] = $data_nilai_cpl;
        
        $this->load->view('vw_template', $arr);

        //echo '<pre>';  var_dump($arr['datas']); echo '</pre>';
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


    public function import(){
    //echo "dkf";
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
   // echo '<pre>';  var_dump($_FILES); echo '</pre>'; 
        if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
 
            $arr_file = explode('.', $_FILES['file']['name']);
            //echo '<pre>';  var_dump($arr_file); echo '</pre>'; 
            $extension = end($arr_file);
            if('csv' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } else { 
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
            $objPHPExcel = $reader->load($_FILES['file']['tmp_name']);
            //$sheetData = $spreadsheet->getActiveSheet()->toArray();
            //$sheetData2 = $spreadsheet->getSheet(2)->toArray();
            $highestSheet = $objPHPExcel->getSheetCount();
            //echo "<pre>";
            //print_r($sheetData2);
            //echo '<pre>';  var_dump($highestSheet); echo '</pre>';

            //konfersi dari funsion uploads
            $arr['datas'] = [];
            $arr['datas_relevansi_ppm'] = [];
            $arr['datas_cpl'] = $this->cpl_tersimpan_model->get_cpl();

            //Menyimpan Data Persheet
            for ($p=0; $p < $highestSheet; $p++) { 
                
                $sheet = $objPHPExcel->getSheet($p);

                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // Menyimpan Data Alumnus
                //$kode_mk = str_replace(":", "", $kode_mk_2 );
                // Menyimpan Nilai PPM (CPL)
                $row_cpl = $sheet->rangeToArray('D' . 3 . ':' . $highestColumn . 3,
                                                    NULL,
                                                    TRUE,
                                                    FALSE);
                $row_cpl_1 = array_reduce($row_cpl, 'array_merge', array());
                $row_cpl_2 = str_replace("CMPK", "CPMK", $row_cpl_1);
                $row_nilai_cpl = str_replace(" ", "_", $row_cpl_2);

                $i = 0;
                 foreach ($row_nilai_cpl as $key) {
                     # code...
                     
                    for ($row = 4; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('B' . $row  . ':' . 'C' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        $rowNilai = $sheet->rangeToArray('D' . $row . ':' . $highestColumn . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        //Sesuaikan sama nama kolom tabel di database  

                        $data_cek =  $this->cpl_tersimpan_model->cek_cpl($key);

                        if (empty($data_cek)) {
                            $save_data = array(
                                "id_nilai_cpl_tak_langsung"=>"Data_cpl_tersimpan_Kosong",
                                "nim"=> 0,
                                "id_cpl_langsung"=> 0,
                                "nilai"=>  0
                            );
                            } 
                        elseif ($rowData[0][1] == NULL) {
                            $save_data = array(
                                "id_nilai_cpl_tak_langsung"=>"Data_Kosong",
                                "nim"=> 0,
                                "id_cpl_langsung"=> 0,
                                "nilai"=>  0

                            ); 
                            } 
                        else {                            
                             $save_data = array(                            
                                "id_nilai_cpl_tak_langsung"=> str_replace(" ","_",$rowData[0][1]).'_'.$key,
                                "nim"=> $rowData[0][1],
                                "id_cpl_langsung"=> $key,
                                "nilai"=>  $rowNilai[0][0+$i]

                            );                         
                            }

                        $masukan = $save_data; 
                        //sesuaikan nama dengan nama tabel
                         
                        array_push($arr['datas'],$masukan);

                        $insert = $this->cpl_tersimpan_model->update_excel($save_data);
                        //delete_files($media['file_path']);
                             
                        }

                        $i++;
                    }
                    
                    // Menyimpan Nilai PPM  
                }

        } else {
            //echo $_FILES['upload_file']['type'];
            echo '<pre>';  var_dump($_FILES['file']['type']); echo '</pre>';

        }
        //echo '<pre>';  var_dump($arr['datas']); echo '</pre>';
        $arr['breadcrumbs'] = 'cpl_tersimpan';
        $arr['content'] = 'vw_data_nilai_berhasil_disimpan5';
        $this->load->view('vw_template', $arr);


    }


}
 