<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {

	protected $CI;

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->model('User_model','user');
		$this->CI->load->model('Wali_siswa_model','wali_siswa');
	}	

	public function login_user($username,$password)
	{
		$check = $this->CI->user->login($username,$password);
		if ($check)
		{

			$data = [
				'id'				=> $check->id_user,
				'nama'				=> $check->nama_user,
				'level'				=> $check->jabatan_user,
				'email'				=> $check->email_user,
				'login'				=> true
			];
			
			$this->CI->session->set_userdata($data);
			redirect(base_url('dashboard'),'refresh');
		}
		else{
			return;
		}
	}

	public function login_wali($username,$password)
	{
		$check = $this->CI->wali_siswa->login($username,$password);
		if ($check)
		{
			$data = [
				'id'				=> $check->id_wali_siswa,
				'nama'				=> $check->nama_wali_siswa,
				'level'				=> 'Wali Siswa',
				'email'				=> $check->email_wali_siswa,
				'login'				=> true
			];
			
			$this->CI->session->set_userdata($data);
			redirect(base_url('dashboard'),'refresh');
		}
		else{
			return;
		}
	}

	public function cek()
	{
		if ($this->CI->session->userdata('login') == '') {
			redirect(base_url('login'),'refresh');
		}
	}

	public function logout()
	{
		$data = array(
			'id_user',
			'nama_user',
			'jabatan_user',
			'username',
			'login'
		);
		$this->CI->session->unset_userdata($data);
		$this->CI->session->set_flashdata('sukses', '<i class="fa fa-info-circle"></i> Anda berhasil logout!');
		redirect(base_url('login'),'refresh');
	}

}