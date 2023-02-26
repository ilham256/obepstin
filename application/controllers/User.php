<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
 
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
  		if ($this->session->userdata('loggedin') != true || $_SESSION['level'] != 3) {
      redirect('auth/login');} 
    	$this->load->model('user_model'); 
    	}
 
 	// User Admin

	public function admin() 
	{
		$arr['breadcrumbs'] = 'Dashboard';

		$arr['content'] = 'login_operator/vw_admin';

		$arr['datas'] =  $this->user_model->get_admin();

		//print_r($this->session->userdata());
		$this->load->view('vw_template_operator', $arr); 
	}


	public function tambah_admin()
	{
		$arr['breadcrumbs'] = 'Dashboard';

		$arr['content'] = 'login_operator/vw_tambah_admin';
		//print_r($this->session->userdata());
		$this->load->view('vw_template_operator', $arr); 
	}

	public function submit_tambah_admin()
	{ 
	    if (($this->input->post('simpan', TRUE))) {
	        $save_data = [
	        	  'id' => $this->input->post('username', TRUE),
	              'username' => $this->input->post('username', TRUE),
	              'email' => $this->input->post('email', TRUE),
	              'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
	              'level' => 0,
	        ];
	      $query = $this->user_model->submit_tambah_admin($save_data);
	      if ($query) {
	        redirect('User/admin','refresh');
	      }
	    } 
	}
 

	public function hapus_admin($id)
	  {
	    $hapus = $this->user_model->hapus_user($id);
	    //echo '<pre>';  var_dump($arr['data']); echo '</pre>';
	    redirect('User/admin','refresh');
	  }

 	// User dosen
 
	public function dosen() 
	{
		$arr['breadcrumbs'] = 'Dashboard';

		$arr['content'] = 'login_operator/vw_dosen';

		$arr['datas'] =  $this->user_model->get_dosen();

		//print_r($this->session->userdata());
		$this->load->view('vw_template_operator', $arr); 
	}


	public function tambah_dosen()
	{
		$arr['breadcrumbs'] = 'Dashboard';

		$arr['content'] = 'login_operator/vw_tambah_dosen';
		//print_r($this->session->userdata());
		$this->load->view('vw_template_operator', $arr); 
	}

	public function submit_tambah_dosen()
	{ 
	    if (($this->input->post('simpan', TRUE))) {
	        $save_data = [
	        	  'id' => $this->input->post('username', TRUE),
	              'username' => $this->input->post('username', TRUE),
	              'email' => $this->input->post('email', TRUE),
	              'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
	              'level' => 1,
	        ];
	      $query = $this->user_model->submit_tambah_dosen($save_data);
	      if ($query) {
	        redirect('User/dosen','refresh');
	      }
	    } 
	}
 

	public function hapus_dosen($id)
	  {
	    $hapus = $this->user_model->hapus_user($id);
	    //echo '<pre>';  var_dump($arr['data']); echo '</pre>';
	    redirect('User/dosen','refresh');
	  }

	   	// User mahasiswa

	public function mahasiswa() 
	{
		$arr['breadcrumbs'] = 'Dashboard';

		$arr['content'] = 'login_operator/vw_mahasiswa';

		$arr['datas'] =  $this->user_model->get_mahasiswa();

		//print_r($this->session->userdata());
		$this->load->view('vw_template_operator', $arr); 
	}


	public function tambah_mahasiswa()
	{
		$arr['breadcrumbs'] = 'Dashboard';

		$arr['content'] = 'login_operator/vw_tambah_mahasiswa';
		//print_r($this->session->userdata());
		$this->load->view('vw_template_operator', $arr); 
	}

	public function submit_tambah_mahasiswa()
	{ 
	    if (($this->input->post('simpan', TRUE))) {
	        $save_data = [
	        	  'id' => $this->input->post('username', TRUE),
	              'username' => $this->input->post('username', TRUE),
	              'email' => $this->input->post('email', TRUE),
	              'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
	              'level' => 2,
	        ];
	      $query = $this->user_model->submit_tambah_mahasiswa($save_data);
	      if ($query) {
	        redirect('User/mahasiswa','refresh');
	      }
	    } 
	}
 

	public function hapus_mahasiswa($id)
	  {
	    $hapus = $this->user_model->hapus_user($id);
	    //echo '<pre>';  var_dump($arr['data']); echo '</pre>';
	    redirect('User/mahasiswa','refresh');
	  }
}
 	