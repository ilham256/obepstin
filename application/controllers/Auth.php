<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
		show_404();
	} 
 
	public function login()
	{ 
		if (isset($_SESSION['loggedin']) ) {
			redirect('Dashboard'); 
		} else { 
			$this->load->model('auth_model');
			$this->load->library('form_validation');

			$rules = $this->auth_model->rules();
			$this->form_validation->set_rules($rules);

			if($this->form_validation->run() == FALSE){
				return $this->load->view('login_form');
			}

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if($this->auth_model->login($username, $password)){
				$this->session->set_userdata( 'loggedin', true );


				if ($_SESSION['level'] == 1) {
					redirect('Dashboard_dosen');
				} elseif ($_SESSION['level'] == 2) {
					redirect('Dashboard_mahasiswa');
				} elseif ($_SESSION['level'] == 3) {
					redirect('Dashboard_operator');
				} elseif ($_SESSION['level'] == 4) {
					redirect('Dashboard_guest');
				} else {
					redirect('Dashboard');	 				
				}			
				 
			} else {
				$this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan username dan password benar!');
			}

			$this->load->view('login_form');	
		}
		
	}

	public function logout()
	{
		$this->load->model('auth_model');
		session_destroy();
		$this->auth_model->logout();
		redirect('Auth/login');
	}
}