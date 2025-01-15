<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bayar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->cek();
		$this->load->model('Spp_model', 'spp');
		$this->load->model('Kelas_model', 'kelas');
		$this->load->model('Bayar_model', 'bayar');
		$this->load->model('User_model', 'user');
		$this->load->model('Siswa_model', 'siswa');
		$this->load->helper('tgl_indo');
		$this->load->helper('rupiah');
	}

	public function index()
	{
		if($this->session->userdata('level') == 'Wali Siswa'){
			$data = array(
				'title'			=> $this->session->userdata('level').' - Transaksi Pembayaran',
				'judul'			=> 'Transaksi Pembayaran',
				'data' 			=> $this->bayar->tabel()->result(),
				'content'		=> 'bayar/v_content',
				'ajax'	 		=> 'bayar/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}else{
			$data = array(
				'title'			=> $this->session->userdata('level').' - Transaksi Pembayaran',
				'judul'			=> 'Transaksi Pembayaran',
				'data' 			=> $this->bayar->tabel()->result(),
				'content'		=> 'bayar/v_content',
				'ajax'	 		=> 'bayar/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}
	}

	public function add()
	{
		if($this->session->userdata('level') == 'Wali Siswa'){
			$data = array(
				'title'			=> $this->session->userdata('level').' - Tambah Transaksi Pembayaran',
				'judul'			=> 'Tambah Data Transaksi Pembayaran',
				'data'			=> $this->spp->tabel('tbl_siswa.id_wali_siswa = '.$this->session->userdata('id').'')->result(),
				'data_siswa'	=> $this->siswa->tabel('tbl_siswa.id_wali_siswa = '.$this->session->userdata('id').'')->row_array(),
				'content'		=> 'bayar/v_add_wali',
				'ajax'	 		=> 'bayar/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}else{
			$data = array(
				'title'			=> $this->session->userdata('level').' - Tambah Transaksi Pembayaran',
				'judul'			=> 'Tambah Data Transaksi Pembayaran',
				'list_kelas' 	=> 	$this->kelas->tabel()->result(),
				'list_siswa' 	=> 	$this->siswa->tabel()->result(),
				'content'		=> 'bayar/v_add',
				'ajax'	 		=> 'bayar/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}
	}

	public function edit($id)
	{
		$cek = $this->spp->tabel('id_spp = "'.$id.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data tidak ditemukan');
			redirect(base_url('spp'),'refresh');
		}else{

			$data = array(
				'title'			=> $this->session->userdata('level').' - Edit Transaksi Pembayaran',
				'judul'			=> 'Edit Data Transaksi Pembayaran',
				'data' 			=> 	$this->spp->tabel('id_spp = "'.$id.'"')->row_array(),
				'user' 			=> 	$this->user->tabel()->result(),
				'siswa' 		=> 	$this->siswa->tabel()->result(),
				'content'		=> 'bayar/v_edit',
				'ajax'	 		=> 'bayar/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}
	}

	public function cektotal()
	{
		if($this->input->post('id_spp') == null){
			$this->session->set_flashdata('error', '<i class="fa fa-close"></i> Peringatan, pembayaran belum dipilih');
			redirect(base_url('bayar/add'),'refresh');
		}
		
		$id_spp = $this->input->post('id_spp');
		$rekapspp = '';
		$pembayaran = '';
		$totalbayar = 0;
		for ($i=0; $i < sizeof($id_spp); $i++) 
		{ 
			$rekapspp = $rekapspp.$id_spp[$i].',';
			$data_spp = $this->spp->detail($id_spp[$i])->row_array();
			$totalbayar = $totalbayar + $data_spp['jumlah_bayar'];

			$pembayaran = $pembayaran.$data_spp['bulan_spp'].', ';
		}

		if($this->session->userdata('level') == 'Wali Siswa'){
			$data = array(
				'title'			=> $this->session->userdata('level').' - Tambah Transaksi Pembayaran',
				'judul'			=> 'Tambah Data Transaksi Pembayaran',
				'nama_kelas' 	=> 	$data_spp['nama_kelas'],
				'nama_siswa' 	=> 	$data_spp['nama_siswa'],
				'id_siswa' 		=> 	$data_spp['id_siswa'],
				'nisn_siswa' 	=> 	$data_spp['nisn_siswa'],
				'pembayaran' 	=> 	$pembayaran,
				'id_spp' 		=> 	$rekapspp,
				'total' 		=> 	$totalbayar,
				'content'		=> 'bayar/v_bayar_wali',
				'ajax'	 		=> 'bayar/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}else{
			
			$data = array(
				'title'			=> $this->session->userdata('level').' - Tambah Transaksi Pembayaran',
				'judul'			=> 'Tambah Data Transaksi Pembayaran',
				'nama_kelas' 	=> 	$data_spp['nama_kelas'],
				'nama_siswa' 	=> 	$data_spp['nama_siswa'],
				'id_siswa' 		=> 	$data_spp['id_siswa'],
				'nisn_siswa' 	=> 	$data_spp['nisn_siswa'],
				'pembayaran' 	=> 	$pembayaran,
				'id_spp' 		=> 	$rekapspp,
				'total' 		=> 	$totalbayar,
				'content'		=> 'bayar/v_bayar',
				'ajax'	 		=> 'bayar/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}
	

		
	}

	public function insert()
	{
		$this->form_validation->set_rules('tgl_bayar', 'Tanggal', 'required',
		array( 'required'  => '%s harus diisi!'));
		if ($this->form_validation->run()) 
		{
			$no_bayar = $this->bayar->get_no_bayar();
			$jumlah_spp = substr_count($this->input->post('id_spp'), ',');

			if($jumlah_spp < 1){
				$this->session->set_flashdata('error', '<i class="fa fa-close"></i> Peringatan, pembayaran belum dipilih');
				redirect(base_url('bayar/add'),'refresh');
			}
			for ($i=0; $i < $jumlah_spp; $i++) 
			{
				$text = explode(",", $this->input->post('id_spp'));
				$id_spp = $text[$i];

				$data = array(
					'id_spp'					=> $id_spp,
					'tgl_bayar'					=> $this->input->post('tgl_bayar'),
					'no_bayar'					=> $no_bayar,
					'status_bayar'				=> 'Lunas',
				);
				$q = $this->spp->update($data);
			}
			$data = array(
				'tgl_bayar'					=> $this->input->post('tgl_bayar'),
				'id_siswa'					=> $this->input->post('id_siswa'),
				'no_bayar'					=> $no_bayar,
				'total_bayar'				=> $this->input->post('total'),
				'keterangan'				=> $this->input->post('keterangan'),
				'id_user'					=> $this->session->userdata('id'),
				'jenis_pembayaran'			=> 'Tunai',
				'bukti_bayar'				=> '',
				'status_bayar'				=> 'Lunas'
			);
			$q = $this->bayar->insert($data);

			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Sukses, Tambah data pembayaran berhasil');
			redirect(base_url('bayar'),'refresh');
		}else{
			$this->session->set_flashdata('error', '<i class="fa fa-close"></i> Peringatan, Data Tidak Lengkap');
			redirect(base_url('bayar/add'),'refresh');
		}
	}

	public function insertwali()
	{
		$this->form_validation->set_rules('tgl_bayar', 'Tanggal', 'required',
		array( 'required'  => '%s harus diisi!'));
		if ($this->form_validation->run()) 
		{
			$no_bayar = $this->bayar->get_no_bayar();
			$jumlah_spp = substr_count($this->input->post('id_spp'), ',');

			if($jumlah_spp < 1){
				$this->session->set_flashdata('error', '<i class="fa fa-close"></i> Peringatan, pembayaran belum dipilih');
				redirect(base_url('bayar/add'),'refresh');
			}
			for ($i=0; $i < $jumlah_spp; $i++) 
			{
				$text = explode(",", $this->input->post('id_spp'));
				$id_spp = $text[$i];

				$data = array(
					'id_spp'					=> $id_spp,
					'tgl_bayar'					=> $this->input->post('tgl_bayar'),
					'no_bayar'					=> $no_bayar,
					'status_bayar'				=> 'Menunggu Pembayaran',
				);
				$q = $this->spp->update($data);
			}
			$data = array(
				'tgl_bayar'					=> $this->input->post('tgl_bayar'),
				'id_siswa'					=> $this->input->post('id_siswa'),
				'no_bayar'					=> $no_bayar,
				'total_bayar'				=> $this->input->post('total'),
				'keterangan'				=> $this->input->post('keterangan'),
				'jenis_pembayaran'			=> 'Transfer',
				'bukti_bayar'				=> '',
				'status_bayar'				=> 'Menunggu Pembayaran'
			);
			$q = $this->bayar->insert($data);

			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Sukses, Tambah data pembayaran berhasil');
			redirect(base_url('bayar'),'refresh');
		}else{
			$this->session->set_flashdata('error', '<i class="fa fa-close"></i> Peringatan, Data Tidak Lengkap');
			redirect(base_url('bayar/add'),'refresh');
		}
	}

	public function uploadbukti()
	{
		$no_bayar = $this->input->post('no_bayar');

		$cek = $this->bayar->tabel('tbl_bayar.no_bayar = '.$no_bayar.'')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('bayar'),'refresh');
		}else{

			$this->form_validation->set_rules('id_Transaksi Pembayaran', 'ID Transaksi Pembayaran', 'required',
			array( 'required'  => '%s harus diisi!'));

			if($_FILES["bukti_bayar"]['name'] !== ""){ //jika tidak ada upload foto

				$nama1 = str_replace("_","",$_FILES["bukti_bayar"]['name']);
				$nama2 = str_replace(" ","",$nama1);
				$image 								= time().'-'.$nama2;
				$config['upload_path'] 				= './public/image/upload/';
				$config['allowed_types'] 			= 'gif|jpg|png|jpeg'; 
				$config['max_size']  				= '25000'; //maksimal 25Mb
				$config['file_name']  				= $image; //ubah nama file berdasarkan waktu

				$this->load->library('upload', $config); //panggil librarys upload
				$this->upload->do_upload('bukti_bayar'); //upload foto produk

				$data = array(
					'no_bayar'					=> $this->input->post('no_bayar'),
					'bukti_bayar'				=> $image,
					'status_bayar'				=> 'Menunggu Konfirmasi'
				);
				$q = $this->bayar->update_nobayar($data);

				$data = array(
					'status_bayar'				=> 'Menunggu Konfirmasi'
				);
				$q = $this->spp->update_nobayar($data, $this->input->post('no_bayar'));
			}
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Bukti Pembayaran Berhasil Disimpan');
			redirect(base_url('bayar'),'refresh');
		}
	}

	public function konfirmasi()
	{
		$no_bayar = $this->input->post('no_bayar');

		$cek = $this->bayar->tabel('tbl_bayar.no_bayar = '.$no_bayar.'')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('bayar'),'refresh');
		}else{

			$data = array(
				'no_bayar'					=> $this->input->post('no_bayar'),
				'status_bayar'				=> $this->input->post('verifikasi')
			);
			$q = $this->bayar->update_nobayar($data);

			$data = array(
				'status_bayar'				=> $this->input->post('verifikasi')
			);
			$q = $this->spp->update_nobayar($data, $this->input->post('no_bayar'));
			
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Konfirmasi Pembayaran Berhasil');
			redirect(base_url('bayar'),'refresh');
		}
	}

	public function delete($no_bayar)
	{
		$cek = $this->bayar->tabel('no_bayar = "'.$no_bayar.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('bayar'),'refresh');
		}else{

			$data = array(
				'no_bayar'		=> '',
				'status_bayar'	=> '',
				'tgl_bayar'		=> '0000-00-00'
			);
			$this->spp->update_nobayar($data, $no_bayar);

			$data = array(
				'no_bayar'	=> $no_bayar
			);
			$this->bayar->delete($data);
			
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dihapus');
			redirect(base_url('bayar'),'refresh');
		}
	}

	public function getmodal($no_bayar){
		$data_bayar = $this->bayar->tabel('tbl_bayar.no_bayar = '.$no_bayar.'')->row_array();
		echo '
			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">Kelas<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<input id="nama_kelas" name="nama_kelas" readonly class="form-control" value="'.$data_bayar['nama_kelas'].'">
				</div>
			</div>

			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">NISN<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<input id="nisn_siswa" name="nisn_siswa" readonly class="form-control" value="'.$data_bayar['nisn_siswa'].'">
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">Nama Siswa<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<input id="nama_siswa" name="nama_siswa" readonly class="form-control" value="'.$data_bayar['nama_kelas'].'">
					<input type="hidden" id="id_siswa" name="id_siswa" readonly class="form-control" value="'.$data_bayar['id_siswa'].'">
				</div>
			</div>

			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">No. Bayar<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<input id="no_bayar" name="no_bayar" readonly class="form-control" value="'.$data_bayar['no_bayar'].'">
				</div>
			</div>

			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">Pembayaran<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<textarea id="keterangan" name="keterangan" readonly class="form-control" rows="2">SPP '.$data_bayar['keterangan'].'</textarea>
				</div>
			</div>

			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">Total<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<input id="total_rp" name="total_rp" readonly class="form-control" value="Rp. '.rupiah($data_bayar['total_bayar']).'">
				</div>
			</div>

			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">Bukti Bayar<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<input type="file" id="bukti_bayar" name="bukti_bayar" required class="form-control">
				</div>
			</div>
		';
	}

	public function getkonfirmasi($no_bayar){
		$data_bayar = $this->bayar->tabel('tbl_bayar.no_bayar = '.$no_bayar.'')->row_array();
		echo '
			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">Kelas<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<input id="nama_kelas" name="nama_kelas" readonly class="form-control" value="'.$data_bayar['nama_kelas'].'">
				</div>
			</div>

			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">NISN<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<input id="nisn_siswa" name="nisn_siswa" readonly class="form-control" value="'.$data_bayar['nisn_siswa'].'">
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">Nama Siswa<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<input id="nama_siswa" name="nama_siswa" readonly class="form-control" value="'.$data_bayar['nama_kelas'].'">
					<input type="hidden" id="id_siswa" name="id_siswa" readonly class="form-control" value="'.$data_bayar['id_siswa'].'">
				</div>
			</div>

			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">No. Bayar<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<input id="no_bayar" name="no_bayar" readonly class="form-control" value="'.$data_bayar['no_bayar'].'">
				</div>
			</div>

			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">Pembayaran<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<textarea id="keterangan" name="keterangan" readonly class="form-control" rows="2">SPP '.$data_bayar['keterangan'].'</textarea>
				</div>
			</div>

			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">Total<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<input id="total_rp" name="total_rp" readonly class="form-control" value="Rp. '.rupiah($data_bayar['total_bayar']).'">
				</div>
			</div>

			<div class="item form-group">
				<label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name">Verifikasi<span class="required">*</span>
				</label>
				<div class="col-md-10 col-sm-12 ">
					<select class="form-control" id="verifikasi" name="verifikasi" required>
						<option value="">Pilih</option>
						<option value="Lunas">Lunas</option>
						<option value="Ditolak">Ditolak</option>
					</select>
				</div>
			</div>

		';
	}
}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */