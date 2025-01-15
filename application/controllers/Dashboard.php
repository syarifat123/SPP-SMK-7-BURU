<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth->cek();
		$this->load->model('User_model', 'user');
		$this->load->model('Siswa_model', 'siswa');
		$this->load->model('Kelas_model', 'kelas');
		$this->load->model('Spp_model', 'spp');
		$this->load->model('Bayar_model', 'bayar');
		$this->load->model('Pengingat_model', 'pengingat');
		$this->load->helper('tgl_indo');
		$this->load->helper('rupiah');
	}

	public function index()
	{
		$tgl = date('Y-m-d');
		if($this->session->userdata('level') == 'Staff TU'){

			//cek pengingat
			$cek_pengingat = $this->pengingat->tabel('tbl_pengingat.tgl_pengingat = "'.$tgl.'"')->num_rows();
			if($cek_pengingat < 1){
				$query = $this->spp->tagihan('tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "" 
				or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Pembayaran" 
				or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Konfirmasi"
				or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Ditolak"')->result() ;
				foreach($query as $row){
					$this->load->library('mailer');
					$sendmaill = array(
						'email_pengirim' 	=> 'serverpesanku@gmail.com',
						'password_app' 		=> 'vzidebxbgnnayawg',
						'email_penerima' 	=> $row->email_wali_siswa,
						'subjek'			=> 'Pengingat Pembayaran SPP ',
						'content' 			=> $this->isihtml($row->id_siswa)
					);
				
					$send = $this->mailer->send($sendmaill); 
				}

				$data = array(
					'tgl_pengingat'					=> $tgl,
					'id_user'						=> $this->session->userdata('id')
				);
				$this->pengingat->insert($data);
			}
			$data = array(
				'title'					=> $this->session->userdata('level').' - Dashboard',
				'user'					=> $this->session->userdata('nama_user'),
				'jumlah_kelas'			=> $this->kelas->tabel()->num_rows(),
				'jumlah_siswa'			=> $this->siswa->tabel()->num_rows(),
				'tunggakan'				=> $this->spp->tunggakan('month(tbl_spp.jatuh_tempo) = '.date('m').' and year(tbl_spp.jatuh_tempo) = '.date('Y').' and tbl_spp.status_bayar = ""')->row_array(),
				'bayar'					=> $this->bayar->bayar('month(tbl_bayar.tgl_bayar) = '.date('m').' and year(tbl_bayar.tgl_bayar) = '.date('Y').' and tbl_bayar.status_bayar = "Lunas"')->row_array(),
				'content'	 			=> 'dashboard/v_content',
				'ajax'	 				=> 'dashboard/v_ajax'
			);

		}else{

			if($this->session->userdata('level') == 'Wali Siswa'){
				$data = array(
					'title'					=> $this->session->userdata('level').' - Dashboard',
					'user'					=> $this->session->userdata('nama_user'),
					'jumlah_kelas'			=> $this->kelas->tabel()->num_rows(),
					'jumlah_siswa'			=> $this->siswa->tabel()->num_rows(),
					'tunggakan'				=> $this->spp->tunggakan('month(tbl_spp.jatuh_tempo) = '.date('m').' and year(tbl_spp.jatuh_tempo) = '.date('Y').' and tbl_spp.status_bayar = "" and tbl_siswa.id_wali_siswa = '.$this->session->userdata('id').' ')->row_array(),
					'bayar'					=> $this->bayar->bayar('month(tbl_bayar.tgl_bayar) = '.date('m').' and year(tbl_bayar.tgl_bayar) = '.date('Y').' and tbl_bayar.status_bayar = "Lunas" and tbl_siswa.id_wali_siswa = '.$this->session->userdata('id').'')->row_array(),
					'content'	 			=> 'dashboard/v_content',
					'ajax'	 				=> 'dashboard/v_ajax'
				);
			}else{
				$data = array(
					'title'					=> $this->session->userdata('level').' - Dashboard',
					'user'					=> $this->session->userdata('nama_user'),
					'jumlah_kelas'			=> $this->kelas->tabel()->num_rows(),
					'jumlah_siswa'			=> $this->siswa->tabel()->num_rows(),
					'tunggakan'				=> $this->spp->tunggakan('month(tbl_spp.jatuh_tempo) = '.date('m').' and year(tbl_spp.jatuh_tempo) = '.date('Y').' and tbl_spp.status_bayar = ""')->row_array(),
					'bayar'					=> $this->bayar->bayar('month(tbl_bayar.tgl_bayar) = '.date('m').' and year(tbl_bayar.tgl_bayar) = '.date('Y').' and tbl_bayar.status_bayar = "Lunas"')->row_array(),
					'content'	 			=> 'dashboard/v_content',
					'ajax'	 				=> 'dashboard/v_ajax'
				);
			}
			
		}
		
		$this->load->view('layout/v_wrapper', $data, FALSE);
	}

	public function isihtml($id_siswa){
		$tgl = date('Y-m-d');

		$data_siswa = $this->siswa->tabel('tbl_siswa.id_siswa = '.$id_siswa.'')->row_array();

        $data_tagihan =	$this->spp->tabel('tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "" and tbl_spp.id_siswa = '.$id_siswa.'
		or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Pembayaran" and tbl_spp.id_siswa = '.$id_siswa.' 
		or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Menunggu Konfirmasi" and tbl_spp.id_siswa = '.$id_siswa.'
		or tbl_spp.jatuh_tempo < "'.$tgl.'" and tbl_spp.status_bayar = "Ditolak" and tbl_spp.id_siswa = '.$id_siswa.'')->result();
        
		$html_template = '
			<!doctype html>
			<html>
			<head>
				<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<title>Verifikasi Email</title>
				<style>
				/* -------------------------------------
					GLOBAL RESETS
				------------------------------------- */
				
				/*All the styling goes here*/
				
				img {
					border: none;
					-ms-interpolation-mode: bicubic;
					max-width: 100%; 
				}

				body {
					background-color: #f6f6f6;
					font-family: sans-serif;
					-webkit-font-smoothing: antialiased;
					font-size: 14px;
					line-height: 1.4;
					margin: 0;
					padding: 0;
					-ms-text-size-adjust: 100%;
					-webkit-text-size-adjust: 100%; 
				}

				table {
					border-collapse: separate;
					mso-table-lspace: 0pt;
					mso-table-rspace: 0pt;
					width: 100%; }
					table td {
					font-family: sans-serif;
					font-size: 14px;
					vertical-align: top; 
				}

				/* -------------------------------------
					BODY & CONTAINER
				------------------------------------- */

				.body {
					background-color: #f6f6f6;
					width: 100%; 
				}

				/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
				.container {
					display: block;
					margin: 0 auto !important;
					/* makes it centered */
					max-width: 580px;
					padding: 10px;
					width: 580px; 
				}

				/* This should also be a block element, so that it will fill 100% of the .container */
				.content {
					box-sizing: border-box;
					display: block;
					margin: 0 auto;
					max-width: 580px;
					padding: 10px; 
				}

				/* -------------------------------------
					HEADER, FOOTER, MAIN
				------------------------------------- */
				.main {
					background: #ffffff;
					border-radius: 3px;
					width: 100%; 
				}

				.wrapper {
					box-sizing: border-box;
					padding: 20px; 
				}

				.content-block {
					padding-bottom: 10px;
					padding-top: 10px;
				}

				.footer {
					clear: both;
					margin-top: 10px;
					text-align: center;
					width: 100%; 
				}
					.footer td,
					.footer p,
					.footer span,
					.footer a {
					color: #999999;
					font-size: 12px;
					text-align: center; 
				}

				/* -------------------------------------
					TYPOGRAPHY
				------------------------------------- */
				h1,
				h2,
				h3,
				h4 {
					color: #000000;
					font-family: sans-serif;
					font-weight: 400;
					line-height: 1.4;
					margin: 0;
					margin-bottom: 30px; 
				}

				h1 {
					font-size: 35px;
					font-weight: 300;
					text-align: center;
					text-transform: capitalize; 
				}

				p,
				ul,
				ol {
					font-family: sans-serif;
					font-size: 14px;
					font-weight: normal;
					margin: 0;
					margin-bottom: 15px; 
				}
					p li,
					ul li,
					ol li {
					list-style-position: inside;
					margin-left: 5px; 
				}

				a {
					color: #3498db;
					text-decoration: underline; 
				}

				/* -------------------------------------
					BUTTONS
				------------------------------------- */
				.btn {
					box-sizing: border-box;
					width: 100%; }
					.btn > tbody > tr > td {
					padding-bottom: 15px; }
					.btn table {
					width: auto; 
				}
					.btn table td {
					background-color: #ffffff;
					border-radius: 5px;
					text-align: center; 
				}
					.btn a {
					background-color: #ffffff;
					border: solid 1px #3498db;
					border-radius: 5px;
					box-sizing: border-box;
					color: #3498db;
					cursor: pointer;
					display: inline-block;
					font-size: 14px;
					font-weight: bold;
					margin: 0;
					padding: 12px 25px;
					text-decoration: none;
					text-transform: capitalize; 
				}

				.btn-primary table td {
					background-color: #3498db; 
				}

				.btn-primary a {
					background-color: #3498db;
					border-color: #3498db;
					color: #ffffff; 
				}

				/* -------------------------------------
					OTHER STYLES THAT MIGHT BE USEFUL
				------------------------------------- */
				.last {
					margin-bottom: 0; 
				}

				.first {
					margin-top: 0; 
				}

				.align-center {
					text-align: center; 
				}

				.align-right {
					text-align: right; 
				}

				.align-left {
					text-align: left; 
				}

				.clear {
					clear: both; 
				}

				.mt0 {
					margin-top: 0; 
				}

				.mb0 {
					margin-bottom: 0; 
				}

				.preheader {
					color: transparent;
					display: none;
					height: 0;
					max-height: 0;
					max-width: 0;
					opacity: 0;
					overflow: hidden;
					mso-hide: all;
					visibility: hidden;
					width: 0; 
				}

				.powered-by a {
					text-decoration: none; 
				}

				hr {
					border: 0;
					border-bottom: 1px solid #f6f6f6;
					margin: 20px 0; 
				}

				/* -------------------------------------
					RESPONSIVE AND MOBILE FRIENDLY STYLES
				------------------------------------- */
				@media only screen and (max-width: 620px) {
					table.body h1 {
					font-size: 28px !important;
					margin-bottom: 10px !important; 
					}
					table.body p,
					table.body ul,
					table.body ol,
					table.body td,
					table.body span,
					table.body a {
					font-size: 16px !important; 
					}
					table.body .wrapper,
					table.body .article {
					padding: 10px !important; 
					}
					table.body .content {
					padding: 0 !important; 
					}
					table.body .container {
					padding: 0 !important;
					width: 100% !important; 
					}
					table.body .main {
					border-left-width: 0 !important;
					border-radius: 0 !important;
					border-right-width: 0 !important; 
					}
					table.body .btn table {
					width: 100% !important; 
					}
					table.body .btn a {
					width: 100% !important; 
					}
					table.body .img-responsive {
					height: auto !important;
					max-width: 100% !important;
					width: auto !important; 
					}
				}

				/* -------------------------------------
					PRESERVE THESE STYLES IN THE HEAD
				------------------------------------- */
				@media all {
					.ExternalClass {
					width: 100%; 
					}
					.ExternalClass,
					.ExternalClass p,
					.ExternalClass span,
					.ExternalClass font,
					.ExternalClass td,
					.ExternalClass div {
					line-height: 100%; 
					}
					.apple-link a {
					color: inherit !important;
					font-family: inherit !important;
					font-size: inherit !important;
					font-weight: inherit !important;
					line-height: inherit !important;
					text-decoration: none !important; 
					}
					#MessageViewBody a {
					color: inherit;
					text-decoration: none;
					font-size: inherit;
					font-family: inherit;
					font-weight: inherit;
					line-height: inherit;
					}
					.btn-primary table td:hover {
					background-color: #34495e !important; 
					}
					.btn-primary a:hover {
					background-color: #34495e !important;
					border-color: #34495e !important; 
					} 
				}

				</style>
			</head>
			<body>
				<span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
				<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
				<tr>
					<td>&nbsp;</td>
					<td class="container">
					<div class="wrapper">

						
						
						<table role="presentation" class="main">

						<!-- START MAIN CONTENT AREA -->
						<tr>
							<td>
								<span>Kpd Yth <br> Bpk/Ibu/Wali Siswa Ananda '.$data_siswa['nama_siswa'].'</span>
							</td>
							
						</tr>
						<tr>
							<td>
								<span>Dengan ini kami beritahukan kepada Bapak/Ibu wali murid SMK NEGERI 7 BURU, bahwa berkaitan dengan Kelangsungan Belajar Mengajar (KBM). Berikut ini ada beberapa pembiayaan yang harus dipenuhi: </span>
							</td>
						</tr>
						<tr>
							<td class="wrapper">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%";>
									<tr>
										<td width="5%"><b>No</b></td>
										<td width="60%"><b>Uraian</b></td>
										<td width="30%"><b>Besar Biaya</b></td>
									</tr>';
									$no = 1;
									$total_tagihan = 0;
									foreach($data_tagihan as $row){
										$total_tagihan = $total_tagihan + $row->jumlah_bayar;
										$html_template .= '
											<tr>
												<td style="width: 5%; text-align: center;">'.$no++.'</td>
												<td style="width: 60%; text-align: left">SPP '.$row->bulan_spp.'</td>
												<td style="width: 30%; text-align: left">Rp '.rupiah($row->jumlah_bayar).'</td>
											</tr>
										';
									}
								$html_template .= '
									<tr>
										<td colspan="2" align="center"><b>Total</b></td>
										<td style="width: 30%;"><b>Rp '.rupiah($total_tagihan).'</b></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td>
								<span>Demikian Pemberitahuan ini kami sampaikan untuk diketahui. Atas perhatian dankerjasamanya kami ucapkan terima kasih. </span>
							</td>
						</tr>

						<!-- END MAIN CONTENT AREA -->
						</table>
						<!-- END CENTERED WHITE CONTAINER -->

						<!-- START FOOTER -->
						<div class="footer">
						<table role="presentation" border="0" cellpadding="0" cellspacing="0">
							<td class="content-block powered-by">
								Powered by <a>Mata Kreasi Nusantara</a>.
							</td>
							</tr>
						</table>
						</div>
						<!-- END FOOTER -->

					</div>
					</td>
					<td>&nbsp;</td>
				</tr>
				</table>
			</body>
			</html>
		'; 

		return $html_template;
	}

	

}

/* End of file Guru.php */
/* Location: ./application/controllers/user/Guru.php */