<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpltlang extends CI_Controller {

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
  		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    	$this->load->model('cpltlang_model');
    	$this->load->model('Matakuliah_model');
    	$this->load->model('mahasiswa_model');
        
        if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');}
      
    }

    public function index() 
    {
        $arr['breadcrumbs'] = 'cpltlang';
        $arr['content'] = 'vw_cpltlang';

        $arr['tahun_masuk'] =  $this->mahasiswa_model->get_tahun_masuk();
        $arr['cpl'] =  $this->cpltlang_model->get_cpl();
        $arr['simpanan_tahun'] = " - Pilih Tahun - ";
        $arr['t_simpanan_tahun'] = " ";

        $arr['datas'] =  $this->cpltlang_model->get_cpltlang_all();

        $data_tahun_masuk = ""; 
        $arr['data_mahasiswa'] =  $this->cpltlang_model->get_mahasiswa_all();
                                
        if (!empty($this->input->post('pilih', TRUE))) {
            $data_tahun_masuk = $this->input->post('tahun_masuk', TRUE); 

            $arr['datas'] =  $this->cpltlang_model->get_cpltlang($data_tahun_masuk);
            $arr['data_mahasiswa'] =  $this->cpltlang_model->get_mahasiswa($data_tahun_masuk);

            $data_tahun =$data_tahun_masuk+1; ;
            $arr['simpanan_tahun'] = $data_tahun_masuk;
            $arr['t_simpanan_tahun'] = "/".$data_tahun;
                //s
        }
        //echo '<pre>';  var_dump($data_tahun_masuk); echo '</pre>';
        //$this->load->view('vw_template', $arr);
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
        $arr['datas_cpl'] = $this->cpltlang_model->get_cpl();;

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

                    $data_cek =  $this->cpltlang_model->cek_cpl($key);

                    if (empty($data_cek)) {
                        $save_data = array(
                            "id_nilai_cpl_tak_langsung"=>"Data_cpltlang_Kosong",
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

                    $insert = $this->cpltlang_model->update_excel($save_data);
                    //delete_files($media['file_path']);
                         
                    }

                    $i++;
                }
                
                // Menyimpan Nilai PPM  
        }


        //echo '<pre>';  var_dump($row_nilai_ppm); echo '</pre>'; 
        //echo '<pre>';  var_dump($row_nilai_cpl); echo '</pre>'; 
        unlink($inputFileName);

        //redirect('Cpmklang','refresh');
        $arr['breadcrumbs'] = 'relevansi_ppm';
        $arr['content'] = 'vw_data_nilai_berhasil_disimpan5';
        $this->load->view('vw_template', $arr);
    
 
    }
}
 