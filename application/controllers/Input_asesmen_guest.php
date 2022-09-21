<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_asesmen_guest extends CI_Controller {

	public function __construct() {
        parent::__construct();
    	$this->load->model('matakuliah_model');
    	$this->load->model('semester_model');
    	$this->load->model('Cpmk_cpl_model');
    	$this->load->model('Matakuliah_model');
    	$this->load->model('katkin_model');
    	$this->load->model('formula_model');
    	$this->load->model('formula_deskriptor_model');
    	$this->load->model('cpmklang_model');
    	$this->load->model('cpmktlang_model');
    	$this->load->model('cpltlang_model');
    	$this->load->model('efektivitas_cpl_model');
    	$this->load->model('relevansi_ppm_model');
    	$this->load->model('epbm_model');
    	$this->load->model('mahasiswa_model');

    	if ($this->session->userdata('loggedin') != true) {
      redirect('auth/login');}
	}

	public function kurikulum()
	{
		$arr['breadcrumbs'] = 'kurikulum';
		$arr['content'] = 'login_guest/vw_kurikulum';

		$semesters = $this->semester_model->get_semesters("asc"); 
		$dictionary = Array();

		foreach($semesters as $semester) {
			$mata_kuliah = $this->matakuliah_model->get_select_matakuliah($semester->id_semester);
			$dictionary[$semester->id_semester] = $mata_kuliah;
		}

		$arr['dictionary'] = $dictionary; 
		$arr['semesters'] = $semesters;

		$this->load->view('vw_template_guest', $arr);
	}

	public function cpmk_cpl()
	{ 
		$arr['breadcrumbs'] = 'cpmk_cpl';
		$arr['content'] = 'login_guest/vw_cpmk_cpl';

		$arr['data_cpl'] =  $this->Cpmk_cpl_model->get_cpl();
		$arr['data_cpmk'] =  $this->Cpmk_cpl_model->get_cpmk();
		$arr['rumus_deskriptor'] =  $this->Cpmk_cpl_model->get_cpl_rumus_deskriptor();
		//echo '<pre>';  var_dump($id_semester); echo '</pre>';

		$arr['status_aktif'] = 'show active';
		$arr['naf'] = 'active';

		$this->load->view('vw_template_guest', $arr);
	}

	public function matakuliah()
	{
		$arr['breadcrumbs'] = 'matakuliah';
		$arr['content'] = 'login_guest/vw_matakuliah';
		$arr['data_semester'] =  $this->Matakuliah_model->get_semester();
		
		if (!empty($this->input->post('pilih', TRUE))) {
			$semester = $this->input->post('semester', TRUE);
			$arr['datas'] =  $this->Matakuliah_model->get_select_matakuliah($semester);
		} else {
			$arr['datas'] =  $this->Matakuliah_model->get_matakuliah();
		}
		//echo '<pre>';  var_dump($id_semester); echo '</pre>';
		$this->load->view('vw_template_guest', $arr);
	}

	public function profil_matakuliah()
	{
		$arr['breadcrumbs'] = 'profil_matakuliah';
		$arr['content'] = 'login_guest/vw_profil_matakuliah';
		$arr['data_semester'] =  $this->Matakuliah_model->get_semester();

		$arr['rumus'] =  $this->Matakuliah_model->get_mk_matakuliah_has_cpmk_all();
		
		if (!empty($this->input->post('pilih', TRUE))) {
			$semester = $this->input->post('semester', TRUE);
			$arr['datas'] =  $this->Matakuliah_model->get_select_matakuliah($semester);
		} else {
			$arr['datas'] =  $this->Matakuliah_model->get_matakuliah();
		}
		//echo '<pre>';  var_dump($id_semester); echo '</pre>';
		$this->load->view('vw_template_guest', $arr);
	}
	public function katkin()
	{
	    $edit = $this->katkin_model->get_katkin();
	    foreach ($edit as $row) {
	     $arr = [
	        'data' => $row
	      ];
	    }
		$arr['breadcrumbs'] = 'katkin';
		$arr['content'] = 'login_guest/vw_kategori_kinerja_info';

		$this->load->view('vw_template_guest', $arr);
	}

	public function formula()
	{
		$arr['breadcrumbs'] = 'formula';
		$arr['content'] = 'login_guest/vw_formula';
 
		$arr['datas'] =  $this->formula_model->get_formula_cpl();
		$arr['rumus_deskriptor'] =  $this->formula_model->get_cpl_rumus_deskriptor();
		$arr['data_deskriptor'] =  $this->formula_deskriptor_model->get_deskriptor();
		$arr['rumus'] =  $this->formula_deskriptor_model->get_deskriptor_rumus_cpmk();
		
		$this->load->view('vw_template_guest', $arr);
	}

	public function cpmklang() 
	{ 
		$arr['breadcrumbs'] = 'cpmklang';
		$arr['content'] = 'login_guest/vw_cpmklang';
        $arr['error'] = '';
        $arr['message'] = '';
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
		$this->load->view('vw_template_guest', $arr);
	}

	 public function cpmktlang() 
    { 
        $arr['breadcrumbs'] = 'cpmktlang';
        $arr['content'] = 'login_guest/vw_cpmktlang';
        $arr['mata_kuliah'] =  $this->Matakuliah_model->get_matakuliah();
        $arr['tahun_masuk'] =  $this->mahasiswa_model->get_tahun_masuk();
        $arr['simpanan_tahun'] = " - Pilih Tahun - ";
        $arr['tahun'] = 2019;
        $arr['t_simpanan_tahun'] = " ";
        $arr['simpanan_mk'] = " - Pilih Mata Kuliah - ";
        $arr['simpanan_nama_mk'] = " - Pilih Mata Kuliah - ";
        
        if (!empty($this->input->post('pilih', TRUE))) {
            $data_tahun_masuk = $this->input->post('tahun_masuk', TRUE); 
            $data_mata_kuliah = $this->input->post('mata_kuliah', TRUE); 
            $arr['datas'] =  $this->cpmktlang_model->get_cpmktlang($data_mata_kuliah);
            $arr['data_matakuliah_has_cpmk'] =  $this->cpmktlang_model->get_matakuliah_has_cpmk($data_mata_kuliah);
            $arr['data_mahasiswa'] =  $this->cpmktlang_model->get_mahasiswa($data_tahun_masuk);
            $arr['tahun'] = $data_tahun_masuk;
            $data_tahun =$data_tahun_masuk+1; ;
            $arr['simpanan_tahun'] = $data_tahun_masuk;
            $arr['t_simpanan_tahun'] = "/".$data_tahun; 
            $arr['simpanan_mk'] = $data_mata_kuliah;
            $nama_mk = $this->Matakuliah_model->get_nama_mk($data_mata_kuliah);
            $arr['simpanan_nama_mk'] = ($nama_mk["0"]->nama_kode).' ('.($nama_mk["0"]->nama_mata_kuliah).')';
            $arr['th'] = $data_tahun_masuk;
            $arr['mk'] = $data_mata_kuliah;
        } else {
            $arr['datas'] =  [];
            $data_mata_kuliah = 'TIN211';
            $data_tahun_masuk = 2019; 
            $arr['data_matakuliah_has_cpmk'] =  $this->cpmktlang_model->get_matakuliah_has_cpmk($data_mata_kuliah);
            $arr['data_mahasiswa'] =  $this->cpmktlang_model->get_mahasiswa($data_tahun_masuk);
            $arr['datas'] =  $this->cpmktlang_model->get_cpmktlang($data_mata_kuliah);
            $arr['th'] = $data_tahun_masuk;
            $arr['mk'] = $data_mata_kuliah;
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
        $this->load->view('vw_template_guest', $arr);
    }

	public function cpltlang() 
    {
        $arr['breadcrumbs'] = 'cpltlang';
        $arr['content'] = 'login_guest/vw_cpltlang';

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
        //$this->load->view('vw_template_guest', $arr);
        $this->load->view('vw_template_guest', $arr);
    }

    public function efektivitas_cpl() 
    { 
        $arr['breadcrumbs'] = 'efektivitas_cpl';
        $arr['content'] = 'login_guest/vw_efektivitas_cpl';

        $arr['datas'] =  $this->efektivitas_cpl_model->get_relevansi_ppm();

        //echo '<pre>';  var_dump($data_mata_kuliah); echo '</pre>';
        //echo '<pre>';  var_dump($data_tahun_masuk); echo '</pre>';
        //echo '<pre>';  var_dump($arr['datas'] ); echo '</pre>';
        //echo '<pre>';  var_dump($arr['data_matakuliah_has_cpmk'] ); echo '</pre>';
        //echo '<pre>';  var_dump($arr['data_mahasiswa'] ); echo '</pre>';
        $this->load->view('vw_template_guest', $arr);
    }

    public function relevansi_ppm() 
    { 
        $arr['breadcrumbs'] = 'relevansi_ppm';
        $arr['content'] = 'login_guest/vw_relevansi_ppm';

        $arr['datas'] =  $this->relevansi_ppm_model->get_relevansi_ppm();

        //echo '<pre>';  var_dump($data_mata_kuliah); echo '</pre>';
        //echo '<pre>';  var_dump($data_tahun_masuk); echo '</pre>';
        //echo '<pre>';  var_dump($arr['datas'] ); echo '</pre>';
        //echo '<pre>';  var_dump($arr['data_matakuliah_has_cpmk'] ); echo '</pre>';
        //echo '<pre>';  var_dump($arr['data_mahasiswa'] ); echo '</pre>';
        $this->load->view('vw_template_guest', $arr);
    }
    public function epbm()  
    { 
        $arr['breadcrumbs'] = 'epbm';
        $arr['content'] = 'login_guest/vw_epbm';

        //$arr['datas'] =  $this->epbm_model->get_epbm();

        //echo '<pre>';  var_dump($data_mata_kuliah); echo '</pre>';
        //echo '<pre>';  var_dump($data_tahun_masuk); echo '</pre>';
        //echo '<pre>';  var_dump($arr['datas'] ); echo '</pre>';
        //echo '<pre>';  var_dump($arr['data_matakuliah_has_cpmk'] ); echo '</pre>';
        //echo '<pre>';  var_dump($arr['data_mahasiswa'] ); echo '</pre>';
        $this->load->view('vw_template_guest', $arr);
    }
}
   