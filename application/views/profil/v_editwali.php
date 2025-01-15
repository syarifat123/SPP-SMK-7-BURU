<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-8 col-sm-12 ">
                <?php
                echo validation_errors('<div class="alert alert-danger alert-dismissible">','</div>');
                if ($this->session->flashdata('success'))
                {
                    echo '<div class="alert alert-success alert-dismissible " role="alert">';
                    echo $this->session->flashdata('success');
                    echo '</div>';
                }
                if ($this->session->flashdata('error'))
                {
                    echo '<div class="alert alert-danger alert-dismissible " role="alert">';
                    echo $this->session->flashdata('error');
                    echo '</div>';
                }

                ?>
             

                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $judul ?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form action="<?php echo base_url().'profil/updatewali'?>" method="post" class="form-horizontal form-label-left">

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NIK<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="text" id="nik_wali_siswa" name="nik_wali_siswa" required="required" class="form-control" value="<?= $data['nik_wali_siswa'] ?>">
                                    <input type="hidden" id="id_wali_siswa" name="id_wali_siswa" required="required" class="form-control " value="<?= $data['id_wali_siswa'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Wali Siswa<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="text" id="nama_wali_siswa" name="nama_wali_siswa" required="required" class="form-control " value="<?= $data['nama_wali_siswa'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alamat<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="text" id="alamat_wali_siswa" name="alamat_wali_siswa" required="required" class="form-control " value="<?= $data['alamat_wali_siswa'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No HP<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="number" id="nohp_wali_siswa" name="nohp_wali_siswa" required="required" class="form-control " value="<?= $data['nohp_wali_siswa'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Email<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="email" id="email_wali_siswa" name="email_wali_siswa" required="required" class="form-control " value="<?= $data['email_wali_siswa'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Password<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="password" id="password_wali_siswa" name="password_wali_siswa" required="required" class="form-control " value="<?= $data['password_wali_siswa'] ?>">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-12 col-sm-6 offset-md-0">
                                  <a type="button" href="<?= base_url();?>wali_siswa" class="btn btn-sm btn-secondary"  style="color: white;"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>

                                    <button type="submit" class="btn btn-sm btn-success pull-right"><i class="fa fa-fw fa-lg fa-save"></i> Simpan</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->