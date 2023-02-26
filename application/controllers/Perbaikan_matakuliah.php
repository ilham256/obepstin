<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Perbaikan_matakuliah extends CI_Controller {

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
    	$this->load->model('dosen_model');
    	$this->load->model('Matakuliah_model');
    	$this->load->model('perbaikan_model');
    	$this->load->model('mahasiswa_model'); 
    	$this->load->model('kincpmk_model'); 
    	$this->load->model('report_model'); 
    	$this->load->model('katkin_model'); 
    	$this->load->model('kinumum_model');
    	$this->load->model('kincpl_model');
    	$this->load->model('epbm_model');
    	
    	if ($this->session->userdata('loggedin') != true || $_SESSION['level'] != 0) {
      redirect('auth/login');
 		 }
    }

	public function index()
	{ 
		$arr['breadcrumbs'] = 'perbaikan'; 
		$arr['content'] = 'vw_perbaikan_matakuliah';
		$arr['datas'] =  $this->perbaikan_model->get_perbaikan_mata_kuliah();
		//	echo '<pre>';  var_dump($arr); echo '</pre>';

		//echo '<pre>';  var_dump($arr['datas']); echo '</pre>';
		//echo '<pre>';  var_dump($arr['data']); echo '</pre>';
		$this->load->view('vw_template', $arr); 
	}
  
 
		public function tambah()
	{
		$arr['breadcrumbs'] = 'dosen'; 
		$arr['content'] = 'perbaikan_matakuliah/tambah';

		$arr['dosen'] =  $this->dosen_model->get_dosen();
		$arr['mata_kuliah'] =  $this->Matakuliah_model->get_matakuliah();
		//	echo '<pre>';  var_dump($arr); echo '</pre>';
		$this->load->view('vw_template', $arr);
	}


	public function submit_tambah()
	{ 
	    if (($this->input->post('simpan', TRUE))) {
	        $save_data = [
	        	  'id' => $this->input->post('dosen', TRUE)."_".$this->input->post('mata_kuliah', TRUE)."_".$this->input->post('tahun', TRUE),
	        	  'NIP' => $this->input->post('dosen', TRUE),
	              'kode_mk' => $this->input->post('mata_kuliah', TRUE),
	              'tahun' => $this->input->post('tahun', TRUE),
	              'analisis' => $this->input->post('analisis', TRUE),
	              'perbaikan' => $this->input->post('perbaikan', TRUE),
	        ];
	      $query = $this->perbaikan_model->submit_tambah($save_data);
	      if ($query) {
	        redirect('perbaikan_matakuliah','refresh');
	      }
	    } 
	}

	public function submit_edit() 
		{
		if (($this->input->post('simpan', TRUE))) {
        $save_data = [
	              'analisis' => $this->input->post('analisis', TRUE),
	              'perbaikan' => $this->input->post('perbaikan', TRUE),
	        ];
	    $id_edit = $this->input->post('id', TRUE);

	    $query = $this->perbaikan_model->submit_edit($save_data,$id_edit);
	    
	    if ($query) {
          redirect('perbaikan_matakuliah','refresh');
      	}
	 }
	}

	public function edit($id)
	  {
	    $edit = $this->perbaikan_model->edit_perbaikan_mata_kuliah($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['breadcrumbs'] = 'perbaikan_matakuliah';
		$arr['content'] = 'perbaikan_matakuliah/edit';
	    $this->load->view('vw_template', $arr);

	  }


	public function download($id)
	  {
	    $edit = $this->perbaikan_model->edit_perbaikan_mata_kuliah($id);
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
	    $arr['breadcrumbs'] = 'perbaikan_matakuliah';
		$arr['content'] = 'perbaikan_matakuliah/vw_perbaikan_matakuliah_print';

		$arr['mata_kuliah'] =  $this->Matakuliah_model->get_matakuliah();
		$target = $this->katkin_model->get_katkin();
		$arr['target_cpl'] =  $target;
		$arr['simpanan_mk'] = $arr['data']->kode_mk;
		$arr['tahun_mk'] = $arr['data']->tahun;
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
		$arr['title_print'] =  "Perbaikan MataKuliah ".$arr['data_mk']["0"]->nama_mata_kuliah." Angkatan ".$arr['tahun_mk'];
	    $this->load->view('vw_template_print', $arr);
	   // echo '<pre>';  var_dump($arr['data']); echo '</pre>';

	  }





	 public function Hapus($id)
	  {
	    $delete = $this->perbaikan_model->hapus($id);
	    if ($delete) {
	      redirect('perbaikan_matakuliah','refresh');
	    }
	  }
 
 public function export_excel(){

 			
			// mengubah JSON menjadi array
			$data_dosen = $this->perbaikan_model->get_dosen();

           $data = array( 
           		'title' => 'Data dosen',
                'data' => $data_dosen); 
 
           $this->load->view('vw_excel_dosen',$data);
      } 
   
 
}

 


 