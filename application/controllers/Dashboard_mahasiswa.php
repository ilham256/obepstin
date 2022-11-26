<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_mahasiswa extends CI_Controller {

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
      redirect('auth/login'); }
     $this->load->model('user_model'); 
      
  }
  
	public function index()
	{
		$arr['breadcrumbs'] = 'Dashboard';

		$arr['content'] = 'vw_Beranda';

		//print_r($this->session->userdata('nama_user'));
		//$nama = $this->session->userdata('nama_user');
		//echo '<pre>';  var_dump($nama); echo '</pre>';

		$this->load->view('vw_template_mahasiswa', $arr); 
	}

	public function akun()
	{
		$arr['breadcrumbs'] = 'Dashboard';

		$arr['content'] = 'akun/vw_akun';
		$arr['id'] = $this->session->userdata('nama_user');
		$arr['data'] = $this->user_model->get_user_select($arr['id']);
		//print_r($this->session->userdata('nama_user'));
		//$nama = $this->session->userdata('nama_user');
		//echo '<pre>';  var_dump($arr['data_user']); echo '</pre>';

		$this->load->view('vw_template_mahasiswa', $arr); 
	}

	public function edit_password()
	{
		$arr['breadcrumbs'] = 'Dashboard';

		$arr['content'] = 'akun/vw_edit_password';
		$arr['id'] = $this->session->userdata('nama_user');
		$arr['data'] = $this->user_model->get_user_select($arr['id']);

		$arr['keterangan'] = Null;

		if (($this->input->post('simpan', TRUE))) {


			$password_baru = $this->input->post('password_baru', TRUE);
			$password_baru_verifikasi = $this->input->post('password_baru_verifikasi', TRUE);
			
			if (password_verify($this->input->post('password_lama', TRUE), $arr['data'][0]->password)) {
				if ($password_baru == $password_baru_verifikasi) {
					$save_data = [
			              'password' => password_hash($password_baru, PASSWORD_DEFAULT),
			        ];
			      $query = $this->user_model->update_password($save_data , $arr['id']);

			      $arr['keterangan'] = "Password Baru Berhasil Disimpan";
				}
				else {
					$arr['keterangan'] = "Password Baru Tidak Sama";
				}
			} else {
					$arr['keterangan'] = "Password Lama Salah";
				}
		}
		//print_r($this->session->userdata('nama_user'));
		//$nama = $this->session->userdata('nama_user');
		


		$this->load->view('vw_template_mahasiswa', $arr); 
	}
} 