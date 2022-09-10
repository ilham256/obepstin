<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Epbm extends CI_Controller {

    /**
     * Index Page for this controller. 
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -  
     *      http://example.com/index.php/welcome/index
     *  - or - 
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
        $this->load->model('epbm_model');
        $this->load->model('Matakuliah_model'); 
        $this->load->model('mahasiswa_model');
         
        if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');}
      
    }

 
    public function index()  
    { 
        $arr['breadcrumbs'] = 'epbm';
        $arr['content'] = 'vw_epbm';

        //$arr['datas'] =  $this->epbm_model->get_epbm();

        //echo '<pre>';  var_dump($data_mata_kuliah); echo '</pre>';
        //echo '<pre>';  var_dump($data_tahun_masuk); echo '</pre>';
        //echo '<pre>';  var_dump($arr['datas'] ); echo '</pre>';
        //echo '<pre>';  var_dump($arr['data_matakuliah_has_cpmk'] ); echo '</pre>';
        //echo '<pre>';  var_dump($arr['data_mahasiswa'] ); echo '</pre>';
        $this->load->view('vw_template', $arr);
    }



 

    public function upload(){
        $fileNames = time().$_FILES['file']['name']; 
        //echo '<pre>';  var_dump($_FILES['file']['name']); echo '</pre>';

        $fileName = str_replace(' ','_',$fileNames);
        $config['upload_path'] = './uploads/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = '10000';
 

        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('file')){
            $error = array('error' => $this->upload->display_errors());
        }
        else{
            $data = array('Upload File Excel' => $this->upload->data());
            
        }
        //redirect('mahasiswa','refresh');
        $media = $this->upload->data('file');
        //echo '<pre>';  var_dump($config); echo '</pre>';
        $inputFileName = './uploads/'.$config['file_name'];
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
        
        $highestSheet = $objPHPExcel->getSheetCount();

        $arr['datas'] = [];
        $arr['datas_epbm'] = [];
        $arr['datas_psd'] = $this->epbm_model->get_psd();;

        //Menyimpan Data Persheet
        //for ($p=0; $p < $highestSheet; $p++) { 
            
            $sheet = $objPHPExcel->getSheet(0);
 
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            // Menyimpan Data EPBM Matakuliah has Dosen
            //$kode_mk = str_replace(":", "", $kode_mk_2 );
            $row_tahun_semester = $sheet->rangeToArray('A' . 2 . ':' . 'C' . 2,
                                                NULL,
                                                TRUE,
                                                FALSE);
            //mencari data tahun

            $data_tahun_semester = $row_tahun_semester[0][0];
            $data_tahun1 = preg_replace("/[^0-9]/","",$data_tahun_semester);
            $data_tahun = substr($data_tahun1,0,4);
            
            // mencari data semester

            if (strpos($data_tahun_semester, 'Ganjil')) {
                $data_semester = 'Ganjil';
            }else {
                $data_semester = 'Genap'; // akan masuk kesini
            }

            // Menyimpan Data EPMB Matakuliah
            for ($row = 11; $row <= $highestRow; $row++)
            {
                $rowMk = $sheet->rangeToArray('B' . $row  . ':' . 'C' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);

                $data_cek = [];
                $data_cek =  $this->epbm_model->cek_epbm_mata_kuliah($rowMk[0][0]);
                $data_cek_kode_mk = substr($rowMk[0][0],0,-4);
                //echo '<pre>';  var_dump(substr($rowMk[0][0],0,-4)); echo '</pre>'; 
                if ($rowMk[0][0]  != NULL ) {
                    if (empty($data_cek)) {
                        $data_cek3 = [];
                        $data_cek3 =  $this->epbm_model->cek_mata_kuliah_kode_3($data_cek_kode_mk);

                        if (empty($data_cek3)) {
                        $data_cek2 = [];
                        $data_cek2 =  $this->epbm_model->cek_mata_kuliah_kode_2($data_cek_kode_mk);

                            if (empty($data_cek2)) {
                            $data_cek1 = [];
                            $data_cek1 =  $this->epbm_model->cek_mata_kuliah_kode_1($data_cek_kode_mk);

                                if (!empty($data_cek1)) {
                                
                                    $kode_mk = $data_cek1[0]->kode_mk;

                                    $save_data = array(
                                        "kode_epbm_mk"=> $rowMk[0][0],
                                        "no"=> substr($rowMk[0][0],-1),
                                        "kode_mk"=> $kode_mk
                                    );
                                    $insert = $this->epbm_model->update_excel_epbm_mata_kuliah($save_data);
                                
                                }
                            } else {

                            $kode_mk = $data_cek2[0]->kode_mk;

                            $save_data = array(
                                        "kode_epbm_mk"=> $rowMk[0][0],
                                        "no"=> substr($rowMk[0][0],-1),
                                        "kode_mk"=> $kode_mk
                                    );
                            $insert = $this->epbm_model->update_excel_epbm_mata_kuliah($save_data);
                            }
                        } else {

                        $kode_mk = $data_cek3[0]->kode_mk;

                        $save_data = array(
                            "kode_epbm_mk"=> $rowMk[0][0],
                            "no"=> substr($rowMk[0][0],-1),
                            "kode_mk"=> $kode_mk
                        );
                        $insert = $this->epbm_model->update_excel_epbm_mata_kuliah($save_data);

                        }
                    }
                }

            }

            // Menyimpan Data Dosen

            for ($row = 11; $row <= $highestRow; $row++)
            {
                $rowMk = $sheet->rangeToArray('B' . $row  . ':' . 'C' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);

                $data_cek = [];
                $data_cek =  $this->epbm_model->cek_epbm_mata_kuliah($rowMk[0][0]);
                //echo '<pre>';  var_dump(substr($rowMk[0][0],0,-4)); echo '</pre>'; 

                if ($rowMk[0][0]  != NULL ) {
                    if (empty($data_cek)) {
                        $data_cek3 = [];
                        $data_cek3 =  $this->epbm_model->cek_dosen($rowMk[0][0]);

                        if (empty($data_cek3)) {
                            $save_data = array(
                                "NIP"=> $rowMk[0][0],
                                "nama_dosen"=> $rowMk[0][1],
                                "password"=> "123456"
                            );
                            $insert = $this->epbm_model->update_excel_dosen($save_data);

                        } 

                    }
                }
            }

            // Menyimpan Data EPMB Matakuliah has dosen

            for ($row = 11; $row <= $highestRow; $row++)
            {
                $rowMk = $sheet->rangeToArray('B' . $row  . ':' . 'C' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);

                $data_cek = [];
                $data_cek =  $this->epbm_model->cek_epbm_mata_kuliah($rowMk[0][0]);
                //echo '<pre>';  var_dump(substr($rowMk[0][0],0,-4)); echo '</pre>'; 
                if (empty($data_cek)) {
                    $data_cek3 = [];
                    $data_cek3 =  $this->epbm_model->cek_epbm_mata_kuliah_has_dosen($d.'_'.$rowMk[0][0]);

                    if (empty($data_cek3)) {

                        $data_cek2 = [];
                        $data_cek2 =  $this->epbm_model->cek_dosen($rowMk[0][0]);

                        if (!empty($data_cek2)) {
                            $save_data = array(
                                "kode_epbm_mk_has_dosen"=> $d.'_'.$rowMk[0][0],
                                "kode_epbm_mk"=> $d,
                                "NIP"=> $rowMk[0][0]
                            );
                            $insert = $this->epbm_model->update_excel_epbm_mata_kuliah_has_dosen($save_data);
                        }
                        

                    } 

                } else {
                    $d = $rowMk[0][0];
                }

            }


            // Menyimpan Nilai Epbm
            $row_psd = $sheet->rangeToArray('D' . 10 . ':' . 'Q' . 10,
                                                NULL,
                                                TRUE,
                                                FALSE);
            $row_nilai_psd = array_reduce($row_psd, 'array_merge', array());

            echo '<pre>';  var_dump($row_nilai_psd); echo '</pre>'; 
            

            $i = 0;
             foreach ($row_nilai_psd as $key) {
                 # code...
                if ($key != NULL) {
                    for ($row = 11; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('B' . $row  . ':' . 'C' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        $rowNilai = $sheet->rangeToArray('D' . $row . ':' . 'Q' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);

                        // 
                        //

                        if ($rowData[0][0] != NULL) {

                            $data_cek1 = [];
                            $data_cek1 =  $this->epbm_model->cek_epbm_mata_kuliah($rowData[0][0]);

                            if (empty($data_cek1)) {
                                    $data_cek2 = []; 
                                    $data_cek2 =  $this->epbm_model->cek_epbm_mata_kuliah_has_dosen($d.'_'.$rowData[0][0]);
                                    if (empty($data_cek2)) {
                                        $save_data = array(
                                            "kode_nilai_epbm_mk_has_dosen"=>"Data_nilai_Kosong",
                                            "kode_epbm_mk_has_dosen"=> 0,
                                            "kode_psd"=> 0,
                                            "tahun"=> 0,
                                            "semester"=> 0,                                        
                                            "nilai"=>  0
                                        );
                                        }
                                    else {                            
                                         $save_data = array(                            
                                            "kode_nilai_epbm_mk_has_dosen"=>$data_tahun.'_'.$data_semester.'_'.$d.'_'.$rowData[0][0].'_'.$key,
                                            "kode_epbm_mk_has_dosen"=> $d.'_'.$rowData[0][0],
                                            "kode_psd"=> $key,
                                            "tahun"=> $data_tahun,
                                            "semester"=> $data_semester, 
                                            "nilai"=>  $rowNilai[0][0+$i]
                                            );                         
                                        }
                                        $insert = $this->epbm_model->update_excel_nilai_epbm_dosen($save_data);
                                } 
                            else {                            
                                 $save_data = array(                            
                                    "kode_nilai_epbm_mk"=>$data_tahun.'_'.$data_semester.'_'.$rowData[0][0].'_'.$key,
                                    "kode_epbm_mk"=> $rowData[0][0],
                                    "kode_psd"=> $key,
                                    "tahun"=> $data_tahun,
                                    "semester"=> $data_semester,  
                                    "nilai"=>  $rowNilai[0][0+$i]
                                    );
                                 $d = $rowData[0][0];
                                 $insert = $this->epbm_model->update_excel_nilai_epbm_mata_kuliah($save_data);
                                }
                        }                    
                

                        $masukan = $save_data;
                        //sesuaikan nama dengan nama tabel
                         
                        array_push($arr['datas'],$masukan);
                        
                        //delete_files($media['file_path']);
                             
                        }
                    }
                    $i++;
                }
                
                // Menyimpan Nilai PPM 
        //}


        //echo '<pre>';  var_dump($row_nilai_psd); echo '</pre>'; 
       // echo '<pre>';  var_dump($cek_kode_mk); echo '</pre>'; 
        unlink($inputFileName);

        //redirect('Cpmklang','refresh');
        $arr['breadcrumbs'] = 'epbm';
        $arr['content'] = 'vw_epbm';
        //redirect('Dashboard');
    
 
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
                } elseif ('xls' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
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
        $arr['datas_epbm'] = [];
        $arr['datas_psd'] = $this->epbm_model->get_psd();;

        //Menyimpan Data Persheet
        //for ($p=0; $p < $highestSheet; $p++) { 
            
            $sheet = $objPHPExcel->getSheet(0);
 
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            // Menyimpan Data EPBM Matakuliah has Dosen
            //$kode_mk = str_replace(":", "", $kode_mk_2 );
            $row_tahun_semester = $sheet->rangeToArray('A' . 2 . ':' . 'C' . 2,
                                                NULL,
                                                TRUE,
                                                FALSE);
            //mencari data tahun

            $data_tahun_semester = $row_tahun_semester[0][0];
            $data_tahun1 = preg_replace("/[^0-9]/","",$data_tahun_semester);
            $data_tahun = substr($data_tahun1,0,4);
            
            // mencari data semester

            if (strpos($data_tahun_semester, 'Ganjil')) {
                $data_semester = 'Ganjil';
            }else {
                $data_semester = 'Genap'; // akan masuk kesini
            }

            // Menyimpan Data EPMB Matakuliah
            for ($row = 11; $row <= $highestRow; $row++)
            {
                $rowMk = $sheet->rangeToArray('B' . $row  . ':' . 'C' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);

                $data_cek = [];
                $data_cek =  $this->epbm_model->cek_epbm_mata_kuliah($rowMk[0][0]);
                $data_cek_kode_mk = substr($rowMk[0][0],0,-4);
                //echo '<pre>';  var_dump(substr($rowMk[0][0],0,-4)); echo '</pre>'; 
                if ($rowMk[0][0]  != NULL ) {
                    if (empty($data_cek)) {
                        $data_cek3 = [];
                        $data_cek3 =  $this->epbm_model->cek_mata_kuliah_kode_3($data_cek_kode_mk);

                        if (empty($data_cek3)) {
                        $data_cek2 = [];
                        $data_cek2 =  $this->epbm_model->cek_mata_kuliah_kode_2($data_cek_kode_mk);

                            if (empty($data_cek2)) {
                            $data_cek1 = [];
                            $data_cek1 =  $this->epbm_model->cek_mata_kuliah_kode_1($data_cek_kode_mk);

                                if (!empty($data_cek1)) {
                                
                                    $kode_mk = $data_cek1[0]->kode_mk;

                                    $save_data = array(
                                        "kode_epbm_mk"=> $rowMk[0][0],
                                        "no"=> substr($rowMk[0][0],-1),
                                        "kode_mk"=> $kode_mk
                                    );
                                    $insert = $this->epbm_model->update_excel_epbm_mata_kuliah($save_data);
                                
                                }
                            } else {

                            $kode_mk = $data_cek2[0]->kode_mk;

                            $save_data = array(
                                        "kode_epbm_mk"=> $rowMk[0][0],
                                        "no"=> substr($rowMk[0][0],-1),
                                        "kode_mk"=> $kode_mk
                                    );
                            $insert = $this->epbm_model->update_excel_epbm_mata_kuliah($save_data);
                            }
                        } else {

                        $kode_mk = $data_cek3[0]->kode_mk;

                        $save_data = array(
                            "kode_epbm_mk"=> $rowMk[0][0],
                            "no"=> substr($rowMk[0][0],-1),
                            "kode_mk"=> $kode_mk
                        );
                        $insert = $this->epbm_model->update_excel_epbm_mata_kuliah($save_data);

                        }
                    }
                }

            }

            // Menyimpan Data Dosen

            for ($row = 11; $row <= $highestRow; $row++)
            {
                $rowMk = $sheet->rangeToArray('B' . $row  . ':' . 'C' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);

                $data_cek = [];
                $data_cek =  $this->epbm_model->cek_epbm_mata_kuliah($rowMk[0][0]);
                //echo '<pre>';  var_dump(substr($rowMk[0][0],0,-4)); echo '</pre>'; 

                if ($rowMk[0][0]  != NULL ) {
                    if (empty($data_cek)) {
                        $data_cek3 = [];
                        $data_cek3 =  $this->epbm_model->cek_dosen($rowMk[0][0]);

                        if (empty($data_cek3)) {
                            $save_data = array(
                                "NIP"=> $rowMk[0][0],
                                "nama_dosen"=> $rowMk[0][1],
                                "password"=> "123456"
                            );
                            $insert = $this->epbm_model->update_excel_dosen($save_data);

                        } 

                    }
                }
            }

            // Menyimpan Data EPMB Matakuliah has dosen

            for ($row = 11; $row <= $highestRow; $row++)
            {
                $rowMk = $sheet->rangeToArray('B' . $row  . ':' . 'C' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);

                $data_cek = [];
                $data_cek =  $this->epbm_model->cek_epbm_mata_kuliah($rowMk[0][0]);
                //echo '<pre>';  var_dump(substr($rowMk[0][0],0,-4)); echo '</pre>'; 
                if (empty($data_cek)) {
                    $data_cek3 = [];
                    $data_cek3 =  $this->epbm_model->cek_epbm_mata_kuliah_has_dosen($d.'_'.$rowMk[0][0]);

                    if (empty($data_cek3)) {

                        $data_cek2 = [];
                        $data_cek2 =  $this->epbm_model->cek_dosen($rowMk[0][0]);

                        if (!empty($data_cek2)) {
                            $save_data = array(
                                "kode_epbm_mk_has_dosen"=> $d.'_'.$rowMk[0][0],
                                "kode_epbm_mk"=> $d,
                                "NIP"=> $rowMk[0][0]
                            );
                            $insert = $this->epbm_model->update_excel_epbm_mata_kuliah_has_dosen($save_data);
                        }
                        

                    } 

                } else {
                    $d = $rowMk[0][0];
                }

            }


            // Menyimpan Nilai Epbm
            $row_psd = $sheet->rangeToArray('D' . 10 . ':' . 'Q' . 10,
                                                NULL,
                                                TRUE,
                                                FALSE);
            $row_nilai_psd = array_reduce($row_psd, 'array_merge', array());

            //echo '<pre>';  var_dump($row_nilai_psd); echo '</pre>'; 
            

            $i = 0;
             foreach ($row_nilai_psd as $key) {
                 # code...
                if ($key != NULL) {
                    for ($row = 11; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('B' . $row  . ':' . 'C' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        $rowNilai = $sheet->rangeToArray('D' . $row . ':' . 'Q' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);

                        // 
                        //

                        if ($rowData[0][0] != NULL) {

                            $data_cek1 = [];
                            $data_cek1 =  $this->epbm_model->cek_epbm_mata_kuliah($rowData[0][0]);

                            if (empty($data_cek1)) {
                                    $data_cek2 = []; 
                                    $data_cek2 =  $this->epbm_model->cek_epbm_mata_kuliah_has_dosen($d.'_'.$rowData[0][0]);
                                    if (empty($data_cek2)) {
                                        $save_data = array(
                                            "kode_nilai_epbm_mk_has_dosen"=>"Data_nilai_Kosong",
                                            "kode_epbm_mk_has_dosen"=> 0,
                                            "kode_psd"=> 0,
                                            "tahun"=> 0,
                                            "semester"=> 0,                                        
                                            "nilai"=>  0
                                        );
                                        }
                                    else {                            
                                         $save_data = array(                            
                                            "kode_nilai_epbm_mk_has_dosen"=>$data_tahun.'_'.$data_semester.'_'.$d.'_'.$rowData[0][0].'_'.$key,
                                            "kode_epbm_mk_has_dosen"=> $d.'_'.$rowData[0][0],
                                            "kode_psd"=> $key,
                                            "tahun"=> $data_tahun,
                                            "semester"=> $data_semester, 
                                            "nilai"=>  $rowNilai[0][0+$i]
                                            );                         
                                        }
                                        $insert = $this->epbm_model->update_excel_nilai_epbm_dosen($save_data);
                                } 
                            else {                            
                                 $save_data = array(                            
                                    "kode_nilai_epbm_mk"=>$data_tahun.'_'.$data_semester.'_'.$rowData[0][0].'_'.$key,
                                    "kode_epbm_mk"=> $rowData[0][0],
                                    "kode_psd"=> $key,
                                    "tahun"=> $data_tahun,
                                    "semester"=> $data_semester,  
                                    "nilai"=>  $rowNilai[0][0+$i]
                                    );
                                 $d = $rowData[0][0];
                                 $insert = $this->epbm_model->update_excel_nilai_epbm_mata_kuliah($save_data);
                                }
                        }                    
                

                        $masukan = $save_data;
                        //sesuaikan nama dengan nama tabel
                         
                        array_push($arr['datas'],$masukan);
                        
                        //delete_files($media['file_path']);
                             
                        }
                    }
                    $i++;
                }

        } else {
            //echo $_FILES['upload_file']['type'];
            echo '<pre>';  var_dump($_FILES['file']['type']); echo '</pre>';

        }
        //echo '<pre>';  var_dump($arr['datas']); echo '</pre>';
        $arr['breadcrumbs'] = 'epbm';
        $arr['content'] = 'vw_epbm';
        $this->load->view('vw_template', $arr);


    }

}