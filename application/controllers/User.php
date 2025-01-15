<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
		$this->load->helper('tgl_indo');
		// $this->auth->cek();
	}

	public function index()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - User',
			'judul'			=> 'Master Data User',
			'data' 			=> $this->user->tabel()->result(),
			'content'		=> 'user/v_content',
			'ajax'	 		=> 'user/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function add()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - Tambah User',
			'judul'			=> 'Tambah Data User',
			'data' 			=> $this->user->tabel(),
			'content'		=> 'user/v_add',
			'ajax'	 		=> 'user/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function edit($id)
	{
		$cek = $this->user->tabel('id_user = "'.$id.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data tidak ditemukan');
			redirect(base_url('user'),'refresh');
		}else{

			$data = array(
				'title'			=> $this->session->userdata('level').' - Edit User',
				'judul'			=> 'Edit Data User',
				'data' 			=> 	$this->user->tabel('id_user = "'.$id.'"')->row_array(),
				'content'		=> 'user/v_edit',
				'ajax'	 		=> 'user/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}
	}

	public function insert()
	{
			$data = array(
				'nama_user'				=> $this->input->post('nama_user'),
				'alamat_user'			=> $this->input->post('alamat_user'),
				'nohp_user'				=> $this->input->post('nohp_user'),
				'jabatan_user'			=> $this->input->post('jabatan_user'),
				'email_user'			=> $this->input->post('email_user'),
				'password_user'			=> $this->input->post('password_user')
			);

			$q = $this->user->insert($data);

			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat, Tambah data berhasil');
			redirect(base_url('user'),'refresh');
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