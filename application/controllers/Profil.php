<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->cek();
		$this->load->model('User_model', 'user');
		$this->load->model('Wali_siswa_model', 'wali_siswa');
		$this->load->helper('tgl_indo');
	}

	public function index()
	{
		if($this->session->userdata('level') == 'Wali Siswa'){
			$data = array(
				'title'			=> $this->session->userdata('level').' - Edit Profil',
				'judul'			=> 'Edit Data Profil',
				'data' 			=> 	$this->wali_siswa->tabel('id_wali_siswa = "'.$this->session->userdata('id').'"')->row_array(),
				'content'		=> 'profil/v_editwali',
				'ajax'	 		=> 'profil/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}else{
			$data = array(
				'title'			=> $this->session->userdata('level').' - Edit Profil',
				'judul'			=> 'Edit Data Profil',
				'data' 			=> 	$this->user->tabel('id_user = "'.$this->session->userdata('id').'"')->row_array(),
				'content'		=> 'profil/v_edituser',
				'ajax'	 		=> 'profil/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}
		
	}


	public function update()
	{
		$id_user = $this->input->post('id_user');

		$cek = $this->user->tabel('id_user = "'.$id_user.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('user'),'refresh');
		}else{

				$data = array(
					'id_user'				=> $this->input->post('id_user'),
					'nama_user'				=> $this->input->post('nama_user'),
					'alamat_user'			=> $this->input->post('alamat_user'),
					'nohp_user'				=> $this->input->post('nohp_user'),
					'jabatan_user'			=> $this->input->post('jabatan_user'),
					'email_user'			=> $this->input->post('email_user'),
					'password_user'			=> $this->input->post('password_user')
				);
				
			$this->user->update($data);
	
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dirubah');
			redirect(base_url('user'),'refresh');
		}
	}

	public function delete($id)
	{
		$cek = $this->user->tabel('id_user = "'.$id.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('user'),'refresh');
		}else{

			$data = array(
				'id_user'	=> $id
			);
			
			$this->user->delete($data);
			
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dihapus');
			redirect(base_url('user'),'refresh');
		}
	}
}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */