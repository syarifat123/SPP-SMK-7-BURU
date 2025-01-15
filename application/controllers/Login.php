<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
		ob_start();
	}

	public function index()
	{

		$data = array(
			'title'	=> 'Login | SPP'
		);
		$this->load->view('login', $data, FALSE);
	}

	public function login()
	{

		$this->form_validation->set_rules('username', 'Username', 'required',
			array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('password', 'Password', 'required',
			array( 'required'  => '%s harus diisi!'));

		if ($this->form_validation->run()) 
		{
			$username    = $this->input->post('username');
			$password    = $this->input->post('password');

				$cek_u = $this->user->tabel('email_user = "'.$username.'"')->num_rows();

				$cek_w = $this->wali_siswa->tabel('email_wali_siswa = "'.$username.'"')->num_rows();
				
    			if ($cek_u==1){
					$test = $this->auth->login_user($username,$password);

				}elseif($cek_w==1){
					$test = $this->auth->login_wali($username,$password);
					
				}else{
					$this->session->set_flashdata('danger', '<i class="fa fa-warning"></i>
					Maaf, username dan password tidak sesuai.');
						redirect(base_url('login'),'refresh');
				}
		}

		$this->session->set_flashdata('danger', '<i class="fa fa-warning"></i>Maaf, username dan password Tidak Sesuai.');
		redirect(base_url('login'),'refresh');
	}

	public function register()
	{

		$data = array(
			'title'	=> 'Register | SPP'
		);
		$this->load->view('register', $data, FALSE);
	}

	public function insertregister()
	{

		$this->form_validation->set_rules('nik_wali_siswa', 'NIK KTP Wali Siswa', 'required',
			array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('nama_wali_siswa', 'Password', 'required',
			array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('alamat_wali_siswa', 'Password', 'required',
			array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('email_wali_siswa', 'Username', 'required',
			array( 'required'  => '%s harus diisi!'));
		$this->form_validation->set_rules('password_wali_siswa', 'Password', 'required',
			array( 'required'  => '%s harus diisi!'));

		if ($this->form_validation->run() == FALSE)
		{
				$this->load->view('register');
		}
		else
		{
				$this->load->view('login');
		}


		// $this->session->set_flashdata('danger', '<i class="fa fa-warning"></i>Maaf, username dan password Tidak Sesuai.');
		// redirect(base_url('login'),'refresh');
	}
	

	public function logout()
	{
		$this->auth->logout();
	}
	

}

/* End of file Login.php */
/* Location: ./application/controllers/user/Login.php */