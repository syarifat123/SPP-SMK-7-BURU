<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wali_siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Wali_siswa_model', 'wali_siswa');
		$this->load->helper('tgl_indo');
		// $this->auth->cek();
	}

	public function index()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - Wali Siswa',
			'judul'			=> 'Master Data Wali Siswa',
			'data' 			=> $this->wali_siswa->tabel()->result(),
			'content'		=> 'wali_siswa/v_content',
			'ajax'	 		=> 'wali_siswa/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function add()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - Tambah Wali Siswa',
			'judul'			=> 'Tambah Data Wali Siswa',
			'content'		=> 'wali_siswa/v_add',
			'ajax'	 		=> 'wali_siswa/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function edit($id)
	{
		$cek = $this->wali_siswa->tabel('id_wali_siswa = "'.$id.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data tidak ditemukan');
			redirect(base_url('wali_siswa'),'refresh');
		}else{

			$data = array(
				'title'			=> $this->session->userdata('level').' - Edit Wali Siswa',
				'judul'			=> 'Edit Data Wali Siswa',
				'data' 			=> 	$this->wali_siswa->tabel('id_wali_siswa = "'.$id.'"')->row_array(),
				'content'		=> 'wali_siswa/v_edit',
				'ajax'	 		=> 'wali_siswa/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}
	}

	public function insert()
	{
		$this->form_validation->set_rules('nik_wali_siswa', 'Nik Wali Siswa', 'required',
			array( 'required'  => '%s harus diisi!'));

		if ($this->form_validation->run()) 
		{

			$data = array(
				'nik_wali_siswa'			=> $this->input->post('nik_wali_siswa'),
				'nama_wali_siswa'			=> $this->input->post('nama_wali_siswa'),
				'alamat_wali_siswa'			=> $this->input->post('alamat_wali_siswa'),
				'nohp_wali_siswa'			=> $this->input->post('nohp_wali_siswa'),
				'email_wali_siswa'			=> $this->input->post('email_wali_siswa'),
				'password_wali_siswa'		=> $this->input->post('password_wali_siswa')
			);

			$q = $this->wali_siswa->insert($data);

			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat, Tambah data berhasil');
			redirect(base_url('wali_siswa'),'refresh');

		}else{
			
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Anda tidak mempunyai akses untuk ini');
			redirect(base_url('wali_siswa/add'),'refresh');
		}
	}

	public function update()
	{
		$id = $this->input->post('id_wali_siswa');

		$cek = $this->wali_siswa->tabel('id_wali_siswa = "'.$id.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('wali_siswa'),'refresh');
		}else{

			$data = array(
				'id_wali_siswa'				=> $this->input->post('id_wali_siswa'),
				'nik_wali_siswa'			=> $this->input->post('nik_wali_siswa'),
				'nama_wali_siswa'			=> $this->input->post('nama_wali_siswa'),
				'alamat_wali_siswa'			=> $this->input->post('alamat_wali_siswa'),
				'nohp_wali_siswa'			=> $this->input->post('nohp_wali_siswa'),
				'email_wali_siswa'			=> $this->input->post('email_wali_siswa'),
				'password_wali_siswa'		=> $this->input->post('password_wali_siswa')
			);
				
			$this->wali_siswa->update($data);
	
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dirubah');
			redirect(base_url('wali_siswa'),'refresh');
		}
	}

	public function delete($id)
	{
		$cek = $this->wali_siswa->tabel('id_wali_siswa = "'.$id.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('wali_siswa'),'refresh');
		}else{

			$data = array(
				'id_wali_siswa'	=> $id
			);
			
			$this->wali_siswa->delete($data);
			
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dihapus');
			redirect(base_url('wali_siswa'),'refresh');
		}
	}
}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */