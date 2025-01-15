<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->cek();
		$this->load->model('Spp_model', 'spp');
		$this->load->model('User_model', 'user');
		$this->load->model('Siswa_model', 'siswa');
		$this->load->model('Kelas_model', 'kelas');
		$this->load->helper('tgl_indo');
		$this->load->helper('rupiah');
	}

	public function index()
	{
		if($this->session->userdata('level') == 'Wali Siswa'){
			$tgl = date('Y-m-d');
			$total_tagihan = 0;
			$query = $this->spp->tagihan('tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "" and tbl_siswa.id_wali_siswa = '.$this->session->userdata('id').' or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Pembayaran" and tbl_siswa.id_wali_siswa = '.$this->session->userdata('id').' or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Konfirmasi" and tbl_siswa.id_wali_siswa = '.$this->session->userdata('id').' or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Ditolak" and tbl_siswa.id_wali_siswa = '.$this->session->userdata('id').'')->result() ;
			foreach($query as $row){
				$total_tagihan = $total_tagihan + $row->jumlah_bayar;
			}
			$data = array(
				'title'			=> $this->session->userdata('level').' - Tagihan Pembayaran SPP',
				'judul'			=> 'Tagihan Pembayaran SPP',
				'id_kelas'		=> '',
				'total_tagihan'	=> rupiah($total_tagihan),
				'list_kelas' 	=> $this->kelas->tabel()->result(),
				'data' 			=> $this->spp->tagihan('tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "" and tbl_siswa.id_wali_siswa = '.$this->session->userdata('id').' or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Pembayaran" and tbl_siswa.id_wali_siswa = '.$this->session->userdata('id').' or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Konfirmasi" and tbl_siswa.id_wali_siswa = '.$this->session->userdata('id').' or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Ditolak" and tbl_siswa.id_wali_siswa = '.$this->session->userdata('id').'')->result(),
				'content'		=> 'tagihan/v_content_wali',
				'ajax'	 		=> 'tagihan/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);

		}else{
			$tgl = date('Y-m-d');
			$total_tagihan = 0;
			$query = $this->spp->tagihan('tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "" or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Pembayaran" or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Konfirmasi" or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Ditolak" ')->result() ;
			foreach($query as $row){
				$total_tagihan = $total_tagihan + $row->jumlah_bayar;
			}
			$data = array(
				'title'			=> $this->session->userdata('level').' - Tagihan Pembayaran SPP',
				'judul'			=> 'Tagihan Pembayaran SPP',
				'id_kelas'		=> '',
				'total_tagihan'	=> rupiah($total_tagihan),
				'list_kelas' 	=> $this->kelas->tabel()->result(),
				'data' 			=> $this->spp->tagihan('tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "" or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Pembayaran" or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Konfirmasi" or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Ditolak"')->result(),
				'content'		=> 'tagihan/v_content',
				'ajax'	 		=> 'tagihan/v_ajax'
			);
			$this->load->view('layout/v_wrapper', $data, FALSE);
		}

		
	}

	public function cari($id_kelas)
	{
		$tgl = date('Y-m-d');
		$total_tagihan = 0;
		$query = $this->spp->tagihan('tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "" and tbl_siswa.id_kelas = '.$id_kelas.' or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Pembayaran" and tbl_siswa.id_kelas = '.$id_kelas.' or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Konfirmasi" and tbl_siswa.id_kelas = '.$id_kelas.'')->result();
		foreach($query as $row){
			$total_tagihan = $total_tagihan + $row->jumlah_bayar;
		}
		$data = array(
			'title'			=> $this->session->userdata('level').' - Tagihan Pembayaran SPP',
			'judul'			=> 'Tagihan Pembayaran SPP',
			'id_kelas'		=> $id_kelas,
			'total_tagihan'	=> rupiah($total_tagihan),
			'list_kelas' 	=> $this->kelas->tabel()->result(),
			'data' 			=> $this->spp->tagihan('tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "" and tbl_siswa.id_kelas = '.$id_kelas.' or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Pembayaran" and tbl_siswa.id_kelas = '.$id_kelas.' or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Konfirmasi" and tbl_siswa.id_kelas = '.$id_kelas.'')->result(),
			'content'		=> 'tagihan/v_content',
			'ajax'	 		=> 'tagihan/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function gettagihan($id_siswa = null){
		if($id_siswa == '' || $id_siswa == null){
			echo '';
		}else{
			$data = $this->spp->tabel('tbl_spp.id_siswa = '.$id_siswa.'')->result();
			echo '
				<div class="col-md-12 col-sm-12">
					<table class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>Pilih</th>
								<th>Tagihan</th>
								<th>Jumlah</th>
							</tr>
						</thead>
		
						<tbody>';
						$no=1; 
						foreach($data as $row){
						echo '
							<tr>
								<td>';
									if($row->status_bayar == 'Lunas'){
										echo '
											<input type="checkbox" name="id_spp[]" value="'.$row->id_spp.'" class="flat" disabled="disabled">
										';
									}else{
										echo '
											<input type="checkbox" name="id_spp[]" value="'.$row->id_spp.'" class="flat" >
										';
									}
									
								echo '	
								</td>
								<td>'.$row->bulan_spp.'</td>
								<td>Rp. '.rupiah($row->jumlah_bayar).'</td>
							</tr>';
						}
						echo '
						</tbody>
					</table>
				</div>
				<div class="col-md-12 col-sm-12">
					<button type="submit" class="btn btn-sm btn-success" value="Input">Proses</button>
				</div>
			';
			
		}
	}

	

	public function insert()
	{
			$image 								= time().'-'.$_FILES["bukti_bayar"]['name']; //data post dari form
			$config['upload_path'] 				= './public/image/upload/tagihan/'; //lokasi folder foto produk
			$config['allowed_types'] 			= 'gif|jpg|png|jpeg'; //jenis file yang boleh diijinkan
			$config['max_size']  				= '25000'; //maksimal 25Mb
			$config['file_name']  				= $image; //ubah nama file berdasarkan waktu

			$this->load->library('upload', $config); //panggil librarys upload
			$this->upload->do_upload('bukti_bayar'); //upload foto produk

			$data = array(
				'jatuh_tempo'				=> $this->input->post('jatuh_tempo'),
				'bulan_spp'					=> $this->input->post('bulan_spp'),
				'no_bayar'					=> $this->input->post('no_bayar'),
				'tgl_bayar'					=> $this->input->post('tgl_bayar'),
				'jumlah_bayar'				=> $this->input->post('jumlah_bayar'),
				'keterangan'				=> $this->input->post('keterangan'),
				'bukti_bayar'				=> $image,
				'status_bayar'				=> $this->input->post('status_bayar'),
				'id_user'					=> $this->input->post('id_user'),
				'id_siswa'					=> $this->input->post('id_siswa')
			);

			$q = $this->spp->insert($data);

			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat, Tambah data berhasil');
			redirect(base_url('spp'),'refresh');
	}

	public function update()
	{
		$id = $this->input->post('id_spp');

		$cek = $this->spp->detail($id)->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('spp'),'refresh');
		}else{

			$this->form_validation->set_rules('id_spp', 'ID spp', 'required',
			array( 'required'  => '%s harus diisi!'));

			if($_FILES["bukti_bayar"]['name'] !== ""){ //jika tidak ada upload foto

				$image 								= time().'-'.$_FILES["bukti_bayar"]['name']; //data post dari form
				$config['upload_path'] 				= './public/image/upload/tagihan/'; //lokasi folder foto produk
				$config['allowed_types'] 			= 'gif|jpg|png|jpeg'; //jenis file yang boleh diijinkan
				$config['max_size']  				= '25000'; //maksimal 25Mb
				$config['file_name']  				= $image; //ubah nama file berdasarkan waktu

				$this->load->library('upload', $config); //panggil librarys upload
				$this->upload->do_upload('bukti_bayar'); //upload foto produk

					$data = array(
						'id_spp'					=> $this->input->post('id_spp'),
						'bukti_bayar'				=> $image
					);
					
					$q = $this->spp->update($data);
			}

			$data = array(
				'id_spp'					=> $this->input->post('id_spp'),
				'jatuh_tempo'				=> $this->input->post('jatuh_tempo'),
				'bulan_spp'					=> $this->input->post('bulan_spp'),
				'no_bayar'					=> $this->input->post('no_bayar'),
				'tgl_bayar'					=> $this->input->post('tgl_bayar'),
				'jumlah_bayar'				=> $this->input->post('jumlah_bayar'),
				'keterangan'				=> $this->input->post('keterangan'),
				'status_bayar'				=> $this->input->post('status_bayar'),
				'id_user'					=> $this->input->post('id_user'),
				'id_siswa'					=> $this->input->post('id_siswa')
			);

			$this->spp->update($data);
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dirubah');
			redirect(base_url('spp'),'refresh');
		}
	}

	public function delete($id)
	{
		$cek = $this->spp->tabel('id_spp = "'.$id.'"')->row_array();
		if($cek == null){
			$this->session->set_flashdata('error', '<i class="fa fa-warning"></i> Peringatan! Data Tidak Ditemukan');
			redirect(base_url('spp'),'refresh');
		}else{

			$data = array(
				'id_spp'	=> $id
			);
			
			$this->spp->delete($data);
			
			$this->session->set_flashdata('success', '<i class="fa fa-check"></i> Selamat! Data Berhasil Dihapus');
			redirect(base_url('spp'),'refresh');
		}
	}

}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */