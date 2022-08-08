<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpmklang extends CI_Controller {

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
    	$this->load->model('cpmklang_model');
    	$this->load->model('Matakuliah_model'); 
    	$this->load->model('mahasiswa_model'); 

        
        if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');}
      
    }

 

	public function index() 
	{ 
		$arr['breadcrumbs'] = 'cpmklang';
		$arr['content'] = 'vw_cpmklang';
		$arr['mata_kuliah'] =  $this->Matakuliah_model->get_matakuliah();
		$arr['tahun_masuk'] =  $this->mahasiswa_model->get_tahun_masuk();
        $arr['simpanan_tahun'] = " - Pilih Tahun - ";
        $arr['tahun'] = 2017;
        $arr['t_simpanan_tahun'] = " ";
        $arr['simpanan_mk'] = " - Pilih Mata Kuliah - ";
        $arr['simpanan_nama_mk'] = " - Pilih Mata Kuliah - ";
		
		if (!empty($this->input->post('pilih', TRUE))) {
			$data_tahun_masuk = $this->input->post('tahun_masuk', TRUE); 
			$data_mata_kuliah = $this->input->post('mata_kuliah', TRUE); 
			$arr['datas'] =  $this->cpmklang_model->get_cpmklang($data_mata_kuliah);
            $arr['data_matakuliah_has_cpmk'] =  $this->cpmklang_model->get_matakuliah_has_cpmk($data_mata_kuliah);
            $arr['data_mahasiswa'] =  $this->cpmklang_model->get_mahasiswa($data_tahun_masuk);
            $arr['tahun'] = $data_tahun_masuk;
            $data_tahun =$data_tahun_masuk+1; ;
            $arr['simpanan_tahun'] = $data_tahun_masuk;
            $arr['t_simpanan_tahun'] = "/".$data_tahun; 
            $arr['simpanan_mk'] = $data_mata_kuliah;
            $nama_mk = $this->Matakuliah_model->get_nama_mk($data_mata_kuliah);
            $arr['simpanan_nama_mk'] = ($nama_mk["0"]->nama_kode).' ('.($nama_mk["0"]->nama_mata_kuliah).')';
		} else {
			$arr['datas'] =  [];
            $data_mata_kuliah = "";
            $data_tahun_masuk = ""; 
            $arr['data_matakuliah_has_cpmk'] =  $this->cpmklang_model->get_matakuliah_has_cpmk($data_mata_kuliah);
            $arr['data_mahasiswa'] =  $this->cpmklang_model->get_mahasiswa($data_tahun_masuk);
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
        $arr['data_mahasiswa'] =  $mahasiswa;
		//echo '<pre>';  var_dump($data_mata_kuliah); echo '</pre>';
        //echo '<pre>';  var_dump($data_tahun_masuk); echo '</pre>';
        //echo '<pre>';  var_dump($arr['datas'] ); echo '</pre>';
        //echo '<pre>';  var_dump($arr['data_matakuliah_has_cpmk'] ); echo '</pre>';
        //echo '<pre>';  var_dump($arr['data_mahasiswa'] ); echo '</pre>';
		$this->load->view('vw_template', $arr);
	}

	public function upload(){
        $fileNames = $_FILES['file']['name']; 
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

        for ($p=0; $p < $highestSheet; $p++) { 
            
        $sheet = $objPHPExcel->getSheet($p);

        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $row_mk = $sheet->rangeToArray('A' . 13 . ':' . $highestColumn . 13,
                                            NULL,
                                            TRUE,
                                            FALSE); 
        $kode_mk_1 = $row_mk[0][2];
        $kode_mk_2 = str_replace(" ", "", $kode_mk_1 );
        $kode_mk = str_replace(":", "", $kode_mk_2 );

        $cek_kode_mk = $this->cpmklang_model->cek_matakuliah_kode_2($kode_mk);

        if (!empty($cek_kode_mk)) {
            $kode_mk = $cek_kode_mk["0"]->kode_mk;
        }else {
            $cek_kode_mk = $this->cpmklang_model->cek_matakuliah_kode_3($kode_mk);
        } 

        if (!empty($cek_kode_mk)) {
            $kode_mk = $cek_kode_mk["0"]->kode_mk;
        }

        $row_cpmk = $sheet->rangeToArray('F' . 19 . ':' . $highestColumn . 19,
                                            NULL,
                                            TRUE,
                                            FALSE);
        $row_cpmk_1 = array_reduce($row_cpmk, 'array_merge', array());
        $row_cpmk_2 = str_replace("CMPK", "CPMK", $row_cpmk_1);
        $row_nilai_cpmk = str_replace(" ", "_", $row_cpmk_2);

        


         $i = 0;
         foreach ($row_nilai_cpmk as $key) {
             # code...
             
            for ($row = 20; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                $rowNilai = $sheet->rangeToArray('F' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                //Sesuaikan sama nama kolom tabel di database 

                $data_cek =  $this->cpmklang_model->cek_matakuliah_has_cpmk($kode_mk.'_'.$key);

                if (empty($data_cek)) {
                    $save_data = array(
                        "id_nilai"=> "Data_CPMK_Kosong",
                        "nim"=> 0,
                        "id_matakuliah_has_cpmk"=> 0,
                        "nilai_langsung"=> 0

                    );
                    $masukan = array(
                        "id_nilai"=> "Data_CPMK_Kosong",
                        "nim"=> 0,
                        "id_matakuliah_has_cpmk"=> $kode_mk.'_'.$key,
                        "nilai_langsung"=> 0

                    );
                }
                elseif ($rowData[0][1] == NULL) {
                    $save_data = array(
                        "id_nilai"=> "Data_Kosong",
                        "nim"=> 0,
                        "id_matakuliah_has_cpmk"=> 0,
                        "nilai_langsung"=> 0

                ); 
                $masukan = $save_data;
                }else {                            
                     $save_data = array(
                        "id_nilai"=> $rowData[0][1].'_'.$kode_mk.'_'.$key,
                        "nim"=> $rowData[0][1],
                        "id_matakuliah_has_cpmk"=> $kode_mk.'_'.$key,
                        "nilai_langsung"=> $rowData[0][5+$i]

                );
                 $masukan = $save_data;
                }
                //sesuaikan nama dengan nama tabel
                 
                array_push($arr['datas'],$masukan);
                $insert = $this->cpmklang_model->update_excel($save_data);
                //delete_files($media['file_path']);
                     
            }
            $i++;
         }



        }


        //echo '<pre>';  var_dump($kode_mk); echo '</pre>'; 
       // echo '<pre>';  var_dump($cek_kode_mk); echo '</pre>'; 
        //unlink($inputFileName);

        //redirect('Cpmklang','refresh');
        $arr['breadcrumbs'] = 'cpmklang';
        $arr['content'] = 'vw_data_nilai_berhasil_disimpan';
        $this->load->view('vw_template', $arr);
        redirect('Cpmklang/data_tersimpan','refresh');
    
 
    }

    public function data_tersimpan(){
        $arr['breadcrumbs'] = 'cpmklang';
        $arr['content'] = 'vw_data_berhasil_disimpan'; 
        $this->load->view('vw_template', $arr);
    }
}
 