<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kelas_model', 'kelas');
		$this->load->helper('tgl_indo');
		// $this->auth->cek();
	}

	public function index()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - Kelas',
			'judul'			=> 'Master Data Kelas',
			'data' 			=> $this->kelas->tabel()->result(),
			'content'		=> 'kelas/v_content',
			'ajax'	 		=> 'kelas/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function add()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - Tambah Kelas',
			'judul'			=> 'Tambah Data Kelas',
			'data' 			=> $this->kelas->tabel(),
			'content'		=> 'kelas/v_add',
			'ajax'	 		=> 'kelas/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function edit($id)
	{
		$cek = $this->kelas->tabel('id_kelas = "'.$id.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data tidak ditemukan');
			redirect(base_url('kelas'),'refresh');
		}else{

			$data = array(
				'title'			=> $this->session->userdata('level').' - Edit Kelas',
				'judul'			=> 'Edit Data Kelas',
				'data' 			=> 	$this->kelas->tabel('id_kelas = "'.$id.'"')->row_array(),
				'content'		=> 'kelas/v_edit',
				'ajax'	 		=> 'kelas/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}
	}

	public function insert()
	{
			$data = array(
				'nama_kelas'				=> $this->input->post('nama_kelas')
			);

			$q = $this->kelas->insert($data);

			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat, Tambah data berhasil');
			redirect(base_url('kelas'),'refresh');
	}

	public function update()
	{
		$id_kelas = $this->input->post('id_kelas');

		$cek = $this->kelas->tabel('id_kelas = "'.$id_kelas.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('kelas'),'refresh');
		}else{

				$data = array(
					'id_kelas'				=> $this->input->post('id_kelas'),
					'nama_kelas'			=> $this->input->post('nama_kelas')
				);
				
			$this->kelas->update($data);
	
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dirubah');
			redirect(base_url('kelas'),'refresh');
		}
	}

	public function delete($id)
	{
		$cek = $this->kelas->tabel('id_kelas = "'.$id.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('kelas'),'refresh');
		}else{

			$data = array(
				'id_kelas'	=> $id
			);
			
			$this->kelas->delete($data);
			
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dihapus');
			redirect(base_url('kelas'),'refresh');
		}
	}
}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */