<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
		$this->load->library('Pdf');
	}

	public function index()
	{
		$data = array(
			'title'			=> $this->session->userdata('level').' - Cetak Laporan',
			'judul'			=> 'Cetak Laporan',
			'list_kelas' 	=> 	$this->kelas->tabel()->result(),
			'list_siswa' 	=> 	$this->siswa->tabel()->result(),
			'content'		=> 'laporan/v_content',
			'ajax'	 		=> 'laporan/v_ajax'
		);
		$this->load->view('layout/v_wrapper', $data, FALSE);
		
	}
	

	public function cetaktagihan()
	{
		$tgl = date('Y-m-d');
		$total_tagihan = 0;
		$logo = '<img src="public/image/smkn7.png" width="100" height="100">';

		$id_kelas = $this->input->post('id_kelas');

		if($id_kelas == ''){
			$judul = '';

			$data_tagihan =	$this->spp->tagihan('tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "" or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Pembayaran" or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Konfirmasi" or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Ditolak"')->result();
		}else{
			$data_kelas = $this->kelas->tabel('id_kelas = '.$id_kelas.'')->row_array();
			$judul = 'Kelas '.$data_kelas['nama_kelas'];

			$data_tagihan =	$this->spp->tagihan('tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "" or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Pembayaran" or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Konfirmasi" and tbl_siswa.id_kelas = '.$id_kelas.' or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Ditolak" and tbl_siswa.id_kelas = '.$id_kelas.'')->result();
		}
		
		$isi_tagihan = '
		
			<style>
				h5{
					text-align: center;
					text-font: 11px;
					padding: 0px;
					font-weight: reguler;
				}
			</style> ';

			$isi_tagihan .= '
			<table border="0" style="font-size: 12px; padding:1; width: 105%;">
				<thead>
					<tr align="center">
						<th style="width: 20%; border-bottom-style: solid; border-bottom-color: black;" rowspan="4" align="right">'.$logo.'</th>
						<th style="width: 60%; font-size: 20px; "><b>SMK NEGERI 7 BURU</b></th>
						<th style="width: 20%; border-bottom-style: solid; border-bottom-color: black;" rowspan="4" align="right"></th>
					</tr>
					<tr align="center">
						<th style="width: 60%; solid; font-size: 14px;">NO IZIN OPERASIONAL 421.5/400/2015</th>
					</tr>
					<tr align="center">
						<th style="width: 60%; solid; font-size: 14px;">SK PENDIRIAN SEKOLAH : 421.5/399/2015</th>
					</tr>
					<tr align="center">
						<th style="width: 60%; border-bottom-style: solid; font-size: 10px; border-bottom-color: black;">JL. SMK7, SIMPANG 4 AL-BURUUJ, Namlea, Kec. Namlea, Kab. Buru Prov. Maluku</th>
					</tr>
				</thead>
			</table>';

			$isi_tagihan .= '
			<table border="0" style="font-size: 14px; padding:5; width: 105%;">
				<thead>
					<tr align="center">
						<th style="width: 105%;"></th>
					</tr>
					<tr align="center">
						<th style="width: 105%;"><b>Laporan Tagihan Pembayaran SPP Siswa '.$judul.'</b></th>
					</tr>
				</thead>
			</table>';

			
			$isi_tagihan .= '
			<table border="1" style="font-size: 12px; padding:5; width: 105%;">
				<thead>
					<tr align="center">
						<th width="5%"><b>No</b></th>
                        <th width="10%"><b>NISN</b></th>
						<th width="20%"><b>Nama Siswa</b></th>
                        <th width="10%"><b>Kelas</b></th>
                        <th width="20%"><b>Nama Wali Siswa</b></th>
                        <th width="20%"><b>Email</b></th>
                        <th width="15%"><b>Jumlah Tagihan</b></th>
					</tr>
				</thead>
				<tbody>';
				$no = 1;
				foreach($data_tagihan as $row){
					$total_tagihan = $total_tagihan + $row->jumlah_bayar;
					$isi_tagihan .= '
						<tr>
							<td style="width: 5%;text-align: center;">'.$no++.'</td>
							<td style="width: 10%;">'.$row->nisn_siswa.'</td>
							<td style="width: 20%;">'.$row->nama_siswa.'</td>
							<td style="width: 10%;">'.$row->nama_kelas.'</td>
							<td style="width: 20%;">'.$row->nama_wali_siswa.'</td>
							<td style="width: 20%;">'.$row->email_wali_siswa.'</td>
							<td style="width: 15%;">Rp '.rupiah($row->jumlah_bayar).'</td>
						</tr>
					';
				}
				
		$isi_tagihan .=	'
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6"><b>Total</b></td>
						<td style="width: 15%;"><b>Rp '.rupiah($total_tagihan).'</b></td>
					</tr>
				</tfoot>
			</table>

			<table align="center" style="width: 80%; align: text-center; font-size: 13px;">
				<tbody>
					<tr>
						<th width="80%"></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th>Buru, '.date_indo(date('Y-m-d')).'</th>
					</tr>

					<tr>
						<th></th>
						<th>Kepala Sekolah</th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>

					<tr>
						<th></th>
						<th>( Nasir Hadi )</th>
					</tr>
				</tbody>
			</table>
		';

		$data = array(
			'isi'			=> $isi_tagihan,
			'judul_file'	=> 'Laporan Tagihan Pembayaran SPP'
		);
		
		
		$this->load->view('laporan/cetak_potrait', $data, FALSE);

	}

	public function cetakdetailtagihan($id_siswa)
	{
		$tgl = date('Y-m-d');
		$total_tagihan = 0;
		$logo = '<img src="public/image/smkn7.png" width="100" height="100">';

		$data_siswa = $this->siswa->tabel('id_siswa = '.$id_siswa.'')->row_array();

		$data_tagihan =	$this->spp->tabel('tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "" and tbl_spp.id_siswa = '.$id_siswa.'
		or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Pembayaran" and tbl_spp.id_siswa = '.$id_siswa.' 
		or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Konfirmasi" and tbl_spp.id_siswa = '.$id_siswa.'
		or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Ditolak" and tbl_spp.id_siswa = '.$id_siswa.'')->result();
	
		
		$isi_tagihan = '
		
			<style>
				h5{
					text-align: center;
					text-font: 11px;
					padding: 0px;
					font-weight: reguler;
				}
			</style> ';

			$isi_tagihan .= '
			<table border="0" style="font-size: 12px; padding:1; width: 105%;">
				<thead>
					<tr align="center">
						<th style="width: 20%; border-bottom-style: solid; border-bottom-color: black;" rowspan="4" align="right">'.$logo.'</th>
						<th style="width: 60%; font-size: 20px; "><b>SMK NEGERI 7 BURU</b></th>
						<th style="width: 20%; border-bottom-style: solid; border-bottom-color: black;" rowspan="4" align="right"></th>
					</tr>
					<tr align="center">
						<th style="width: 60%; solid; font-size: 14px;">NO IZIN OPERASIONAL 421.5/400/2015</th>
					</tr>
					<tr align="center">
						<th style="width: 60%; solid; font-size: 14px;">SK PENDIRIAN SEKOLAH : 421.5/399/2015</th>
					</tr>
					<tr align="center">
						<th style="width: 60%; border-bottom-style: solid; font-size: 10px; border-bottom-color: black;">JL. SMK7, SIMPANG 4 AL-BURUUJ, Namlea, Kec. Namlea, Kab. Buru Prov. Maluku</th>
					</tr>
				</thead>
			</table>';

			$isi_tagihan .= '
			<table border="0" style="font-size: 14px; padding:2; width: 105%;">
				<thead>
					<tr align="left">
						<td style="width: 5%;"></td>
						<th style="width: 10%;">Perihal</th>
						<th style="width: 35%;"> : Pemberitahuan Pembiayaan</th>
						<th style="width: 20%;"></th>
						<th style="width: 25%;">Buru, '.date_indo(date('Y-m-d')).'</th>
					</tr>
					<tr align="left">
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>Kepada</th>
					</tr>
					<tr align="left">
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>Yth. Bapak/Ibu/Wali Murid</th>
					</tr>
					<tr align="left">
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>Di Tempat</th>
					</tr>
				</thead>
			</table>';

			$isi_tagihan .= '
			<table border="0" style="font-size: 14px; padding:2; width: 105%;">
				<thead>
					<tr align="left">
						<td style="width: 5%;"></td>
						<td style="width: 100%;">Assalamualaikum Wr. Wb</td>
					</tr>
					<tr align="left">
						<td style="width: 5%;"></td>
						<td style="width: 5%;"></td>
						<td style="width: 95%;">Puji syukur marilah kita panjatkan kehadirat Allah SWT. Sholawat dan salam semoga tercurah keharibaan</td>
					</tr>
					<tr align="left">
						<td style="width: 5%;"></td>
						<td style="width: 100%;">baginda rosulullah SAW. Kepada keluarganya, sahabatnya dan kepada kita semua selaku umatnya dari awal </td>
					</tr>
					<tr align="left">
						<td style="width: 5%;"></td>
						<td style="width: 100%;">sampai akhir. Amin</td>
					</tr>
					<tr align="left">
						<td style="width: 5%;"></td>
						<td style="width: 5%;"></td>
						<td style="width: 95%;">Dengan ini kami beritahukan kepada Bapak/Ibu wali murid SMK NEGERI 7 BURU, bahwa berkaitan dengan</td>
					</tr>
					<tr align="left">
						<td style="width: 5%;"></td>
						<td style="width: 105%;">Kelangsungan Belajar Mengajar (KBM). Berikut ini ada beberapa pembiayaan yang harus dipenuhi: </td>
					</tr>
					<tr align="left">
						<td style="width: 5%;"></td>
						<td style="width: 100%;"></td>
					</tr>
				</thead>
			</table>

			<table align="center" style="width: 100%; align: text-center; font-size: 13px;">
				<tbody>
					<tr>
						<th width="5%"></th>
						<th width="95%">
							<table border="1" style="font-size: 12px; padding:5; width: 105%;">
								<thead>
									<tr align="center">
										<th width="5%"><b>No</b></th>
										<th width="60%"><b>Uraian</b></th>
										<th width="30%"><b>Besar Biaya</b></th>
									</tr>
								</thead>
								<tbody>';
								$no = 1;
								$total_tagihan = 0;
								foreach($data_tagihan as $row){
									$total_tagihan = $total_tagihan + $row->jumlah_bayar;
									$isi_tagihan .= '
										<tr>
											<td style="width: 5%; text-align: center;">'.$no++.'</td>
											<td style="width: 60%; text-align: left">SPP '.$row->bulan_spp.'</td>
											<td style="width: 30%; text-align: left">Rp '.rupiah($row->jumlah_bayar).'</td>
										</tr>
									';
								}
								
							$isi_tagihan .=	'
								</tbody>
								<tfoot>
									<tr>
										<td colspan="2" align="center"><b>Total</b></td>
										<td style="width: 30%;"><b>Rp '.rupiah($total_tagihan).'</b></td>
									</tr>
								</tfoot>
							</table>
						</th>
					</tr>
				</tbody>
			</table>';

			$isi_tagihan .= '
			<table border="0" style="font-size: 14px; padding:2; width: 105%;">
				<thead>
					<tr align="left">
						<td style="width: 5%;"></td>
					</tr>
					<tr align="left">
						<td style="width: 5%;"></td>
						<td style="width: 5%;"></td>
						<td style="width: 100%;">Demikian Pemberitahuan ini kami sampaikan untuk diketahui. Atas perhatian dankerjasamanya kami</td>
					</tr>
					<tr align="left">
						<td style="width: 5%;"></td>
						<td style="width: 100%;">ucapkan terima kasih.</td>
					</tr>
				</thead>
			</table>';

			$isi_tagihan .= '
			<table align="center" style="width: 80%; align: text-center; font-size: 13px;">
				<tbody>
					<tr>
						<th width="80%"></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th>Buru, '.date_indo(date('Y-m-d')).'</th>
					</tr>

					<tr>
						<th></th>
						<th>Kepala Sekolah</th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>

					<tr>
						<th></th>
						<th>( Nasir Hadi )</th>
					</tr>
				</tbody>
			</table>
		';

		$data = array(
			'isi'			=> $isi_tagihan,
			'judul_file'	=> 'Tagihan Pembayaran SPP'
		);
		
		
		$this->load->view('laporan/cetak_potrait', $data, FALSE);

	}

	public function cetakbayar($no_bayar)
	{
		$tgl = date('Y-m-d');
		$total_tagihan = 0;
		$logo = '<img src="public/image/smkn7.png" width="100" height="100">';

		$data_bayar = $this->bayar->tabel('tbl_bayar.no_bayar = '.$no_bayar.'')->row_array();

		$data_spp =	$this->spp->tabel('tbl_spp.no_bayar = '.$no_bayar.'')->result();

		$isi_tagihan = '
		
			<style>
				h5{
					text-align: center;
					text-font: 11px;
					padding: 0px;
					font-weight: reguler;
				}
			</style> ';

			$isi_tagihan .= '
			<table border="0" style="font-size: 12px; padding:1; width: 105%;">
				<thead>
					<tr align="center">
						<th style="width: 20%; border-bottom-style: solid; border-bottom-color: black;" rowspan="4" align="right">'.$logo.'</th>
						<th style="width: 60%; font-size: 20px; "><b>SMK NEGERI 7 BURU</b></th>
						<th style="width: 20%; border-bottom-style: solid; border-bottom-color: black;" rowspan="4" align="right"></th>
					</tr>
					<tr align="center">
						<th style="width: 60%; solid; font-size: 14px;">NO IZIN OPERASIONAL 421.5/400/2015</th>
					</tr>
					<tr align="center">
						<th style="width: 60%; solid; font-size: 14px;">SK PENDIRIAN SEKOLAH : 421.5/399/2015</th>
					</tr>
					<tr align="center">
						<th style="width: 60%; border-bottom-style: solid; font-size: 10px; border-bottom-color: black;">JL. SMK7, SIMPANG 4 AL-BURUUJ, Namlea, Kec. Namlea, Kab. Buru Prov. Maluku</th>
					</tr>
				</thead>
			</table>';

			$isi_tagihan .= '
			<table border="0" style="font-size: 14px; padding:2; width: 105%;">
				<thead>
					<tr align="center">
						<td style="width: 105%;"><b>BUKTI PEMBAYARAN SISWA</b></td>
					</tr>
				</thead>
			</table>
			
			<table border="0" style="font-size: 14px; padding:2; width: 105%;">
				<thead>
					<tr align="left">
						<td style="width: 5%;"></td>
						<th style="width: 10%;">No Bayar</th>
						<th style="width: 40%;">: '.$no_bayar.'</th>
						<th style="width: 15%;">NIS</th>
						<th style="width: 35%;">: '.$data_bayar['nisn_siswa'].'</th>
					</tr>
					<tr align="left">
						<th></th>
						<th>Tanggal</th>
						<th>: '.$data_bayar['tgl_bayar'].'</th>
						<th>Nama Siswa</th>
						<th>: '.$data_bayar['nama_siswa'].'</th>
					</tr>
					<tr align="left">
						<th></th>
						<th></th>
						<th></th>
						<th>Kelas</th>
						<th>: '.$data_bayar['nama_kelas'].'</th>
					</tr>
				</thead>
			</table>';

			$isi_tagihan .= '
			<table align="center" style="width: 100%; align: text-center; font-size: 13px;">
				<tbody>
					<tr>
						<th width="5%"></th>
						<th width="95%">
							<table border="1" style="font-size: 12px; padding:5; width: 105%;">
								<thead>
									<tr align="center">
										<th width="5%"><b>No</b></th>
										<th width="60%"><b>Keterangan</b></th>
										<th width="30%"><b>Jumlah</b></th>
									</tr>
								</thead>
								<tbody>';
								$no = 1;
								$total_tagihan = 0;
								foreach($data_spp as $row){
									$total_tagihan = $total_tagihan + $row->jumlah_bayar;
									$isi_tagihan .= '
										<tr>
											<td style="width: 5%; text-align: center;">'.$no++.'</td>
											<td style="width: 60%; text-align: left">SPP '.$row->bulan_spp.'</td>
											<td style="width: 30%; text-align: left">Rp '.rupiah($row->jumlah_bayar).'</td>
										</tr>
									';
								}
								
							$isi_tagihan .=	'
								</tbody>
								<tfoot>
									<tr>
										<td colspan="2"><b>Total</b></td>
										<td style="width: 30%;"><b>Rp '.rupiah($total_tagihan).'</b></td>
									</tr>
								</tfoot>
							</table>
						</th>
					</tr>
				</tbody>
			</table>';


			$isi_tagihan .= '
			<table align="center" style="width: 80%; align: text-center; font-size: 13px;">
				<tbody>
					<tr>
						<th width="80%"></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th>Buru, '.date_indo(date('Y-m-d')).'</th>
					</tr>

					<tr>
						<th></th>
						<th>Yang Menerima,</th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>

					<tr>
						<th></th>
						<th>( '.$data_bayar['nama_user'].' )</th>
					</tr>
				</tbody>
			</table>
		';

		$data = array(
			'isi'			=> $isi_tagihan,
			'judul_file'	=> 'Bukti Pembayaran SPP'
		);
		
		
		$this->load->view('laporan/cetak_potrait', $data, FALSE);

	}

	public function cetakpembayaran()
	{
		$tgl = date('Y-m-d');
		$total_pembayaran = 0;
		$logo = '<img src="public/image/smkn7.png" width="100" height="100">';

		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir = $this->input->post('tgl_akhir');

		$id_kelas = $this->input->post('id_kelas');
		$id_siswa = $this->input->post('id_siswa');

		if($id_kelas == ''){
			$q_kelas =	'';
		}else{
			$q_kelas =	'and tbl_siswa.id_kelas = '.$id_kelas.'';
		}

		if($id_siswa == ''){
			$q_siswa =	'';
		}else{
			$q_siswa =	'and tbl_bayar.id_siswa = '.$id_siswa.'';
		}
		
		$isi_tagihan = '
		
			<style>
				h5{
					text-align: center;
					text-font: 11px;
					padding: 0px;
					font-weight: reguler;
				}
			</style> ';

			$isi_pembayaran = '
			<table border="0" style="font-size: 12px; padding:1; width: 105%;">
				<thead>
					<tr align="center">
						<th style="width: 20%; border-bottom-style: solid; border-bottom-color: black;" rowspan="4" align="right">'.$logo.'</th>
						<th style="width: 60%; font-size: 20px; "><b>SMK NEGERI 7 BURU</b></th>
						<th style="width: 20%; border-bottom-style: solid; border-bottom-color: black;" rowspan="4" align="right"></th>
					</tr>
					<tr align="center">
						<th style="width: 60%; solid; font-size: 14px;">NO IZIN OPERASIONAL 421.5/400/2015</th>
					</tr>
					<tr align="center">
						<th style="width: 60%; solid; font-size: 14px;">SK PENDIRIAN SEKOLAH : 421.5/399/2015</th>
					</tr>
					<tr align="center">
						<th style="width: 60%; border-bottom-style: solid; font-size: 10px; border-bottom-color: black;">JL. SMK7, SIMPANG 4 AL-BURUUJ, Namlea, Kec. Namlea, Kab. Buru Prov. Maluku</th>
					</tr>
				</thead>
			</table>';

			$isi_pembayaran .= '
			<table border="0" style="font-size: 14px; padding:5; width: 105%;">
				<thead>
					<tr align="center">
						<th style="width: 105%;"></th>
					</tr>
					<tr align="center">
						<th style="width: 105%;"><b>Laporan Pembayaran SPP Siswa</b></th>
					</tr>
				</thead>
			</table>';

			
			$isi_pembayaran .= '
			<table border="1" style="font-size: 12px; padding:5; width: 105%;">
				<thead>
					<tr align="center">
						<th width="5%"><b>No</b></th>
						<th width="15%"><b>Tanggal Bayar</b></th>
						<th width="15%"><b>No Pembayaran</b></th>
                        <th width="10%"><b>NISN</b></th>
						<th width="30%"><b>Nama Siswa</b></th>
                        <th width="10%"><b>Kelas</b></th>
                        <th width="15%"><b>Jumlah Bayar</b></th>
					</tr>
				</thead>
				<tbody>';
				$no = 1;
				$data_bayar =	$this->bayar->tabel('tbl_bayar.tgl_bayar between "'.$tgl_awal.'" and "'.$tgl_akhir.'" and tbl_bayar.status_bayar = "Lunas" '.$q_kelas.' '.$q_siswa.'')->result();
				foreach($data_bayar as $row){
					$total_pembayaran = $total_pembayaran + $row->total_bayar;
					$isi_pembayaran .= '
						<tr>
							<td style="width: 5%;text-align: center;">'.$no++.'</td>
							<td style="width: 15%;">'.date_indo($row->tgl_bayar).'</td>
							<td style="width: 15%;">'.$row->no_bayar.'</td>
							<td style="width: 10%;">'.$row->nisn_siswa.'</td>
							<td style="width: 30%;">'.$row->nama_siswa.'</td>
							<td style="width: 10%;">'.$row->nama_kelas.'</td>
							<td style="width: 15%;">Rp '.rupiah($row->total_bayar).'</td>
						</tr>
					';
				}
				
		$isi_pembayaran .=	'
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6"><b>Total</b></td>
						<td style="width: 15%;"><b>Rp '.rupiah($total_pembayaran).'</b></td>
					</tr>
				</tfoot>
			</table>

			<table align="center" style="width: 80%; align: text-center; font-size: 13px;">
				<tbody>
					<tr>
						<th width="80%"></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th>Buru, '.date_indo(date('Y-m-d')).'</th>
					</tr>

					<tr>
						<th></th>
						<th>Kepala Sekolah</th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<th></th>
						<th></th>
					</tr>

					<tr>
						<th></th>
						<th>( Nasir Hadi )</th>
					</tr>
				</tbody>
			</table>
		';

		$data = array(
			'isi'			=> $isi_pembayaran,
			'judul_file'	=> 'Laporan Pembayaran SPP'
		);
		
		
		$this->load->view('laporan/cetak_potrait', $data, FALSE);

	}


}

/* End of file Guru.php */
/* Location: ./application/controllers/admin/Guru.php */