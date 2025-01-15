<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->cek();
		$this->load->model('Siswa_model', 'siswa');
		$this->load->model('Bayar_model', 'bayar');
		$this->load->model('Spp_model', 'spp');
		$this->load->model('Kelas_model', 'kelas');
		$this->load->model('Wali_siswa_model', 'wali_siswa');
		$this->load->helper('tgl_indo');
		$this->load->helper('rupiah');
	}

	public function index()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - Siswa',
			'judul'			=> 'Master Data Siswa',
			'data' 			=> $this->siswa->tabel()->result(),
			'content'		=> 'siswa/v_content',
			'ajax'	 		=> 'siswa/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function add()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - Tambah Siswa',
			'judul'			=> 'Tambah Data Siswa',
			'data' 			=> $this->siswa->tabel(),
			'wali_siswa' 	=> 	$this->wali_siswa->tabel()->result(),
			'kelas' 		=> 	$this->kelas->tabel()->result(),
			'content'		=> 'siswa/v_add',
			'ajax'	 		=> 'siswa/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function edit($id)
	{
		$cek = $this->siswa->tabel('id_siswa = "'.$id.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data tidak ditemukan');
			redirect(base_url('siswa'),'refresh');
		}else{

			$data = array(
				'title'			=> $this->session->userdata('level_user').' - Edit Siswa',
				'judul'			=> 'Edit Data Siswa',
				'data' 			=> 	$this->siswa->tabel('id_siswa = '.$id.'')->row_array(),
				'wali_siswa' 	=> 	$this->wali_siswa->tabel()->result(),
				'kelas' 		=> 	$this->kelas->tabel()->result(),
				'content'		=> 'siswa/v_edit',
				'ajax'	 		=> 'siswa/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}
	}

	public function insert()
	{
		$data = array(
			'nisn_siswa'					=> $this->input->post('nisn_siswa'),
			'nama_siswa'					=> $this->input->post('nama_siswa'),
			'id_kelas'						=> $this->input->post('id_kelas'),
			'jk_siswa'						=> $this->input->post('jk_siswa'),
			'biaya_spp'						=> $this->input->post('biaya_spp'),
			'id_wali_siswa'					=> $this->input->post('id_wali_siswa')
		);
		$q = $this->siswa->insert($data);

		$AwalJatuhTempo = '2024-07-01';

		$bulanIndo = [
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
		];

		$qsiswa = $this->siswa->akhir()->row_array();
		$idSiswa = $qsiswa['id_siswa'];
		$iduser = $this->session->userdata('id');

		for ($i = 0; $i < 12; $i++) {
			// membuat tgl jatuh tempo nya setiap tanggal 10
			$jatuhTempo = date('Y-m-d', strtotime("+$i month", strtotime($AwalJatuhTempo)));
			$bulan = $bulanIndo[date('m', strtotime($jatuhTempo))] . " " . date('Y', strtotime($jatuhTempo));

			$data = [
				'id_siswa' => $idSiswa,
				'jatuh_tempo' => $jatuhTempo,
				'bulan_spp' => $bulan,
				'jumlah_bayar' => $this->input->post('biaya_spp'),
				'id_user' => $iduser
			];
			$q = $this->spp->insert($data);
		}

		$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat, Tambah data berhasil');
		redirect(base_url('siswa'),'refresh');
	}

	public function update()
	{
		$id = $this->input->post('id_siswa');

		$cek = $this->siswa->tabel('id_siswa = '.$id.'')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('siswa'),'refresh');
		}else{

			$data = array(
				'id_siswa'						=> $this->input->post('id_siswa'),
				'id_kelas'						=> $this->input->post('id_kelas'),
				'nisn_siswa'					=> $this->input->post('nisn_siswa'),
				'nama_siswa'					=> $this->input->post('nama_siswa'),
				'jk_siswa'						=> $this->input->post('jk_siswa'),
				'biaya_spp'						=> $this->input->post('biaya_spp'),
				'id_wali_siswa'					=> $this->input->post('id_wali_siswa')
			);
			$this->siswa->update($data);

			$data = array(
				'id_siswa' => $this->input->post('id_siswa'),
				'jumlah_bayar' => $this->input->post('biaya_spp')
			);
			$q = $this->spp->update_harga($data);
	
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dirubah');
			redirect(base_url('siswa'),'refresh');
		}
	}

	public function getsiswa($id_kelas)
	{
		if($id_kelas == ''){
			echo '';
		}else{
			$query = $this->siswa->tabel('tbl_siswa.id_kelas = '.$id_kelas.'')->result();
			echo '<option value="">Pilih Siswa</option>';
			foreach($query as $row){
				echo '<option value="'.$row->id_siswa.'">'.$row->nisn_siswa.' - '.$row->nama_siswa.'</option>';
			}
		}
	}

	public function delete($id)
	{
		$cek = $this->siswa->tabel('id_siswa = "'.$id.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('siswa'),'refresh');
		}else{

			$data = array(
				'id_siswa'	=> $id
			);
			
			$this->siswa->delete($data);
			$this->spp->delete_siswa($data);
			$this->bayar->delete_siswa($data);
			
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dihapus');
			redirect(base_url('siswa'),'refresh');
		}
	}
}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */