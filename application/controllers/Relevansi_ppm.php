<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Relevansi_ppm extends CI_Controller {

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
        $this->load->model('relevansi_ppm_model');
        $this->load->model('Matakuliah_model'); 
        $this->load->model('mahasiswa_model');
         
        if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');}
      
    }

 
    public function index() 
    { 
        $arr['breadcrumbs'] = 'relevansi_ppm';
        $arr['content'] = 'vw_relevansi_ppm';

        $arr['datas'] =  $this->relevansi_ppm_model->get_relevansi_ppm();

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
        $arr['datas_relevansi_ppm'] = [];
        $arr['datas_cpl'] = $this->relevansi_ppm_model->get_cpl();;

        //Menyimpan Data Persheet
        for ($p=0; $p < $highestSheet; $p++) { 
            
            $sheet = $objPHPExcel->getSheet($p);

            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            // Menyimpan Data Alumnus
            //$kode_mk = str_replace(":", "", $kode_mk_2 );
            for ($row = 2; $row <= $highestRow; $row++){  
            $row_relevansi_ppm = $sheet->rangeToArray('B' . $row  . ':' . 'J' . $row ,
                                                NULL,
                                                TRUE,
                                                FALSE);            
                if ($row_relevansi_ppm[0][0] !== NULL) {
                $save_data_ppm = array(
                                "id_relevansi_ppm"=>str_replace(" ","_",$row_relevansi_ppm[0][3]).'_'.str_replace(" ","_",$row_relevansi_ppm[0][0]),
                                "nama"=> $row_relevansi_ppm[0][0],
                                "posisi"=> $row_relevansi_ppm[0][1],
                                "jenis_kelamin"=> $row_relevansi_ppm[0][2],
                                "tahun_lulusan"=> $row_relevansi_ppm[0][3],
                                "nama_organisasi"=> $row_relevansi_ppm[0][5],
                                "alamat"=> $row_relevansi_ppm[0][6],
                                "hp"=> $row_relevansi_ppm[0][7],
                                "email"=> $row_relevansi_ppm[0][8]);

                array_push($arr['datas_relevansi_ppm'],$save_data_ppm);
                $insert = $this->relevansi_ppm_model->update_excel_relevansi_ppm($save_data_ppm);

                }
            }
            // Menyimpan Nilai PPM (CPL)
            $row_cpl = $sheet->rangeToArray('K' . 1 . ':' . 'R' . 1,
                                                NULL,
                                                TRUE,
                                                FALSE);
            $row_cpl_1 = array_reduce($row_cpl, 'array_merge', array());
            $row_cpl_2 = str_replace("CMPK", "CPMK", $row_cpl_1);
            $row_nilai_cpl = str_replace(" ", "_", $row_cpl_2);

            $i = 0;
             foreach ($row_nilai_cpl as $key) {
                 # code...
                 
                for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                    $rowData = $sheet->rangeToArray('B' . $row  . ':' . 'J' . $row,
                                                    NULL,
                                                    TRUE,
                                                    FALSE);
                    $rowNilai = $sheet->rangeToArray('K' . $row . ':' . 'R' . $row,
                                                    NULL,
                                                    TRUE,
                                                    FALSE);
                    //Sesuaikan sama nama kolom tabel di database 

                    $data_cek =  $this->relevansi_ppm_model->cek_cpl($key);

                    if (empty($data_cek)) {
                        $save_data = array(
                            "id"=>"Data_Relevansi_PPM_CPL_Kosong",
                            "id_relevansi_ppm"=> 0,
                            "id_cpl_langsung"=> 0,
                            "nilai_relevansi_ppm_cpl"=>  0
                        );
                        } 
                    elseif ($rowData[0][0] == NULL) {
                        $save_data = array(
                            "id"=>"Data_Kosong",
                            "id_relevansi_ppm"=> 0,
                            "id_cpl_langsung"=> 0,
                            "nilai_relevansi_ppm_cpl"=>  0

                        );
                        } 
                    else {                            
                         $save_data = array(                            
                            "id"=>str_replace(" ","_",$rowData[0][3]).'_'.str_replace(" ","_",$rowData[0][0]).'_'.$key,
                            "id_relevansi_ppm"=> str_replace(" ","_",$rowData[0][3]).'_'.str_replace(" ","_",$rowData[0][0]),
                            "id_cpl_langsung"=> $key,
                            "nilai_relevansi_ppm_cpl"=>  $rowNilai[0][0+$i]

                        );                         
                        }

                    $masukan = $save_data;
                    //sesuaikan nama dengan nama tabel
                     
                    array_push($arr['datas'],$masukan);
                    $insert = $this->relevansi_ppm_model->update_excel_nilai_relevansi_ppm_cpl($save_data);
                    //delete_files($media['file_path']);
                         
                    }

                    $i++;
                }
                
                // Menyimpan Nilai PPM

                $row_ppm = $sheet->rangeToArray('V' . 1 . ':' . 'Z' . 1,
                                                NULL,
                                                TRUE,
                                                FALSE);
                $row_ppm_1 = array_reduce($row_ppm, 'array_merge', array());
                $row_ppm_2 = str_replace("CMPK", "CPMK", $row_ppm_1);
                $row_nilai_ppm = str_replace(" ", "_", $row_ppm_2);
                
                $i = 0;
                 foreach ($row_nilai_ppm as $key) {
                     # code...
                     
                    for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('B' . $row  . ':' . 'J' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        $rowNilai = $sheet->rangeToArray('V' . $row . ':' . 'Z' . $row,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        //Sesuaikan sama nama kolom tabel di database 

                        $data_cek =  $this->relevansi_ppm_model->cek_ppm($key);

                        if (empty($data_cek)) {
                            $save_data = array(
                                "id"=>"Data_Relevansi_PPM_Kosong",
                                "id_relevansi_ppm"=> 0,
                                "id_ppm"=> 0,
                                "nilai_relevansi_ppm"=>  0
                            );
                            } 
                        elseif ($rowData[0][0] == NULL) {
                            $save_data = array(
                                "id"=>"Data_Kosong",
                                "id_relevansi_ppm"=> 0,
                                "id_ppm"=> 0,
                                "nilai_relevansi_ppm"=>  0

                            );
                            } 
                        else {                            
                             $save_data = array(                            
                                "id"=>str_replace(" ","_",$rowData[0][3]).'_'.str_replace(" ","_",$rowData[0][0]).'_'.$key,
                                "id_relevansi_ppm"=> str_replace(" ","_",$rowData[0][3]).'_'.str_replace(" ","_",$rowData[0][0]),
                                "id_ppm"=> $key,
                                "nilai_relevansi_ppm"=>  $rowNilai[0][0+$i]

                            );                         
                            }

                        $masukan = $save_data;
                        //sesuaikan nama dengan nama tabel
                         
                        array_push($arr['datas'],$masukan);
                        $insert = $this->relevansi_ppm_model->update_excel_nilai_relevansi_ppm($save_data);
                        //delete_files($media['file_path']);
                             
                        }

                        $i++;
                    }

        }


        //echo '<pre>';  var_dump($row_nilai_ppm); echo '</pre>'; 
       // echo '<pre>';  var_dump($cek_kode_mk); echo '</pre>'; 
        unlink($inputFileName);

        //redirect('Cpmklang','refresh');
        $arr['breadcrumbs'] = 'relevansi_ppm';
        $arr['content'] = 'vw_data_nilai_berhasil_disimpan3';
        $this->load->view('vw_template', $arr);
    
 
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
                $arr['datas_cpl'] = $this->relevansi_ppm_model->get_cpl();;

                //Menyimpan Data Persheet
                for ($p=0; $p < $highestSheet; $p++) { 
                    
                    $sheet = $objPHPExcel->getSheet($p);

                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();

                    // Menyimpan Data Alumnus
                    //$kode_mk = str_replace(":", "", $kode_mk_2 );
                    for ($row = 2; $row <= $highestRow; $row++){  
                    $row_relevansi_ppm = $sheet->rangeToArray('B' . $row  . ':' . 'J' . $row ,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);            
                        if ($row_relevansi_ppm[0][0] !== NULL) {
                        $save_data_ppm = array(
                                        "id_relevansi_ppm"=>str_replace(" ","_",$row_relevansi_ppm[0][3]).'_'.str_replace(" ","_",$row_relevansi_ppm[0][0]),
                                        "nama"=> $row_relevansi_ppm[0][0],
                                        "posisi"=> $row_relevansi_ppm[0][1],
                                        "jenis_kelamin"=> $row_relevansi_ppm[0][2],
                                        "tahun_lulusan"=> $row_relevansi_ppm[0][3],
                                        "nama_organisasi"=> $row_relevansi_ppm[0][5],
                                        "alamat"=> $row_relevansi_ppm[0][6],
                                        "hp"=> $row_relevansi_ppm[0][7],
                                        "email"=> $row_relevansi_ppm[0][8]);

                        array_push($arr['datas_relevansi_ppm'],$save_data_ppm);
                        $insert = $this->relevansi_ppm_model->update_excel_relevansi_ppm($save_data_ppm);

                        }
                    }
                    // Menyimpan Nilai PPM (CPL)
                    $row_cpl = $sheet->rangeToArray('K' . 1 . ':' . 'R' . 1,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                    $row_cpl_1 = array_reduce($row_cpl, 'array_merge', array());
                    $row_cpl_2 = str_replace("CMPK", "CPMK", $row_cpl_1);
                    $row_nilai_cpl = str_replace(" ", "_", $row_cpl_2);

                    $i = 0;
                     foreach ($row_nilai_cpl as $key) {
                         # code...
                         
                        for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                            $rowData = $sheet->rangeToArray('B' . $row  . ':' . 'J' . $row,
                                                            NULL,
                                                            TRUE,
                                                            FALSE);
                            $rowNilai = $sheet->rangeToArray('K' . $row . ':' . 'R' . $row,
                                                            NULL,
                                                            TRUE,
                                                            FALSE);
                            //Sesuaikan sama nama kolom tabel di database 

                            $data_cek =  $this->relevansi_ppm_model->cek_cpl($key);

                            if (empty($data_cek)) {
                                $save_data = array(
                                    "id"=>"Data_Relevansi_PPM_CPL_Kosong",
                                    "id_relevansi_ppm"=> 0,
                                    "id_cpl_langsung"=> 0,
                                    "nilai_relevansi_ppm_cpl"=>  0
                                );
                                } 
                            elseif ($rowData[0][0] == NULL) {
                                $save_data = array(
                                    "id"=>"Data_Kosong",
                                    "id_relevansi_ppm"=> 0,
                                    "id_cpl_langsung"=> 0,
                                    "nilai_relevansi_ppm_cpl"=>  0

                                );
                                } 
                            else {                            
                                 $save_data = array(                            
                                    "id"=>str_replace(" ","_",$rowData[0][3]).'_'.str_replace(" ","_",$rowData[0][0]).'_'.$key,
                                    "id_relevansi_ppm"=> str_replace(" ","_",$rowData[0][3]).'_'.str_replace(" ","_",$rowData[0][0]),
                                    "id_cpl_langsung"=> $key,
                                    "nilai_relevansi_ppm_cpl"=>  $rowNilai[0][0+$i]

                                );                         
                                }

                            $masukan = $save_data;
                            //sesuaikan nama dengan nama tabel
                             
                            array_push($arr['datas'],$masukan);
                            $insert = $this->relevansi_ppm_model->update_excel_nilai_relevansi_ppm_cpl($save_data);
                            //delete_files($media['file_path']);
                                 
                            }

                            $i++;
                        }
                        
                        // Menyimpan Nilai PPM

                        $row_ppm = $sheet->rangeToArray('V' . 1 . ':' . 'Z' . 1,
                                                        NULL,
                                                        TRUE,
                                                        FALSE);
                        $row_ppm_1 = array_reduce($row_ppm, 'array_merge', array());
                        $row_ppm_2 = str_replace("CMPK", "CPMK", $row_ppm_1);
                        $row_nilai_ppm = str_replace(" ", "_", $row_ppm_2);
                        
                        $i = 0;
                         foreach ($row_nilai_ppm as $key) {
                             # code...
                             
                            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                                $rowData = $sheet->rangeToArray('B' . $row  . ':' . 'J' . $row,
                                                                NULL,
                                                                TRUE,
                                                                FALSE);
                                $rowNilai = $sheet->rangeToArray('V' . $row . ':' . 'Z' . $row,
                                                                NULL,
                                                                TRUE,
                                                                FALSE);
                                //Sesuaikan sama nama kolom tabel di database 

                                $data_cek =  $this->relevansi_ppm_model->cek_ppm($key);

                                if (empty($data_cek)) {
                                    $save_data = array(
                                        "id"=>"Data_Relevansi_PPM_Kosong",
                                        "id_relevansi_ppm"=> 0,
                                        "id_ppm"=> 0,
                                        "nilai_relevansi_ppm"=>  0
                                    );
                                    } 
                                elseif ($rowData[0][0] == NULL) {
                                    $save_data = array(
                                        "id"=>"Data_Kosong",
                                        "id_relevansi_ppm"=> 0,
                                        "id_ppm"=> 0,
                                        "nilai_relevansi_ppm"=>  0

                                    );
                                    } 
                                else {                            
                                     $save_data = array(                            
                                        "id"=>str_replace(" ","_",$rowData[0][3]).'_'.str_replace(" ","_",$rowData[0][0]).'_'.$key,
                                        "id_relevansi_ppm"=> str_replace(" ","_",$rowData[0][3]).'_'.str_replace(" ","_",$rowData[0][0]),
                                        "id_ppm"=> $key,
                                        "nilai_relevansi_ppm"=>  $rowNilai[0][0+$i]

                                    );                         
                                    }

                                $masukan = $save_data;
                                //sesuaikan nama dengan nama tabel
                                 
                                array_push($arr['datas'],$masukan);
                                $insert = $this->relevansi_ppm_model->update_excel_nilai_relevansi_ppm($save_data);
                                //delete_files($media['file_path']);
                                     
                                }

                                $i++;
                            }

                }

            } else {
                //echo $_FILES['upload_file']['type'];
                echo '<pre>';  var_dump($_FILES['file']['type']); echo '</pre>';

            }
            //echo '<pre>';  var_dump($arr['datas']); echo '</pre>';
            $arr['breadcrumbs'] = 'relevansi_ppm';
            $arr['content'] = 'vw_data_nilai_berhasil_disimpan3';
            $this->load->view('vw_template', $arr);


    }

}