<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SPP</title>

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>public/lte/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>public/lte/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>public/lte/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>public/lte/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>public/lte/iCheck/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>

  <body class="login" style="background-image: url(<?= base_url() ?>public/image/background.jpg);">
	<div class="login-box">
	  <div class="login-logo">
	  </div>
	  <!-- /.login-logo -->
	  <div class="login-box-body">
	  <?php  
					echo validation_errors('<div class="alert alert-danger alert-slide-up">','</div>');
					if ($this->session->flashdata('danger'))
					{
						echo '<div class="alert alert-danger alert-slide-up">';
						echo $this->session->flashdata('danger');
						echo '</div>';
					}

					if ($this->session->flashdata('sukses'))
					{
						echo '<div class="alert alert-success alert-slide-up">';
						echo $this->session->flashdata('sukses');
						echo '</div>';
					}
					?>
		


		<div class="login-logo">
			<img style="width:100px" src="<?php echo base_url();?>public/image/logo.jpg">
			<h3>DAFTAR AKUN WALI SISWA</h3>
		  </div>

		<form action="<?= base_url()?>insertregister" method="post">
		  <div class="form-group has-feedback">
			<input type="text" class="form-control" placeholder="NIK KTP" id="nik_wali_siswa" name="nik_wali_siswa" <?php echo set_value('nik_wali_siswa'); ?>>
			<span class="fa fa-address-book form-control-feedback"></span>
		  </div>
		  <div class="form-group has-feedback">
			<input type="text" class="form-control" placeholder="NAMA LENGKAP" id="nama_wali_siswa" name="nama_wali_siswa">
			<span class="fa fa-address-book form-control-feedback"></span>
		  </div>
		  <div class="form-group has-feedback">
			<input type="text" class="form-control" placeholder="ALAMAT LENGKAP" id="alamat_wali_siswa" name="alamat_wali_siswa">
			<span class="fa fa-address-book form-control-feedback"></span>
		  </div>
		  <div class="form-group has-feedback">
			<input type="number" class="form-control" placeholder="NO HP" id="nohp_wali_siswa" name="nohp_wali_siswa">
			<span class="fa fa-address-book form-control-feedback"></span>
		  </div>
		  <div class="form-group has-feedback">
			<input type="email" class="form-control" placeholder="EMAIL" id="email_wali_siswa" name="email_wali_siswa">
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		  </div>
		  <div class="form-group has-feedback">
			<input type="password" class="form-control" placeholder="PASSWORD" id="password_wali_siswa" name="password_wali_siswa">
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		  </div>
		  <div class="form-group has-feedback">
			<input type="number" class="form-control" placeholder="NISN SISWA" id="nisn_siswa" name="nisn_siswa">
			<span class="fa fa-credit-card-alt form-control-feedback"></span>
		  </div>
		  <div class="row">
			<div class="col-md-12">
			</div>
			<!-- /.col -->
			<div class="col-xs-12">
			  <button type="submit" class="btn btn-success btn-block btn-flat">Submit</button>
			  <span> Sudah Punya Akun? <a href="<?= base_url() ?>login">Login</a></span>
			</div>
			<!-- /.col -->
		  </div>
		</form>


	  </div>
	  <!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 3 -->
	<script src="<?= base_url() ?>public/lte/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?= base_url() ?>public/lte/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- iCheck -->
	<script src="<?= base_url() ?>public/lte/iCheck/icheck.min.js"></script>
	<!-- Page specific javascripts-->
    <script type="text/javascript" src="<?php echo base_url() ?>public/gentelella/vendors/alert/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>public/gentelella/vendors/alert/sweetalert.min.js"></script>

	<script type="text/javascript">
		$(".alert-slide-up").alert().delay(3000).slideUp('slow');
	</script>

    <script>
	
	const flashData = $('#alert').data('flashdata');
	console.log(flashData);
	if(flashData == 'Insert Berhasil'){
			var content = {};
			content.message = 'data berhasil ditambahkan';
			content.title = 'Sukses,';
			content.icon = 'fa fa-bell';

			$.notify(content,{
				type: 'success',
				placement: {
					from: 'top',
					align: 'right'
				},
				time: 1000,
				delay: 1000,
			});
	}

	if(flashData == 'Update Berhasil'){
			var content = {};
			content.message = 'data berhasil dirubah';
			content.title = 'Sukses,';
			content.icon = 'fa fa-bell';

			$.notify(content,{
				type: 'success',
				placement: {
					from: 'top',
					align: 'right'
				},
				time: 1000,
				delay: 1000,
			});
	}

	if(flashData == 'Hapus Berhasil'){
			var content = {};
			content.message = 'data, berhasil dihapus';
			content.title = 'Sukses';
			content.icon = 'fa fa-bell';

			$.notify(content,{
				type: 'success',
				placement: {
					from: 'top',
					align: 'right'
				},
				time: 1000,
				delay: 1000,
			});
	}
	if(flashData == 'login gagal'){
			var content = {};
			content.message = 'Eror, Tidak dapat diproses';
			content.title = 'Peringatan';
			content.icon = 'fa fa-times-circle';

			$.notify(content,{
				type: 'danger',
				placement: {
					from: 'top',
					align: 'center'
				},
				time: 1000,
				delay: 1000,
			});
	}

	if(flashData == 'Tidak Ada Perubahan'){
			var content = {};
			content.message = 'Tidak ada perubahan data';
			content.title = 'Peringatan,';
			content.icon = 'fa fa-times-circle';

			$.notify(content,{
				type: 'info',
				placement: {
					from: 'top',
					align: 'center'
				},
				time: 1000,
				delay: 1000,
			});
	}
	</script>
	
  </body>
</html>

 

