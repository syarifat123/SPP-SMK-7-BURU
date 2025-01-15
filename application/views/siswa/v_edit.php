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
                        <form action="<?php echo base_url().'siswa/update'?>" method="post" class="form-horizontal form-label-left">

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NISN<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="number" id="nisn_siswa" name="nisn_siswa" required="required" class="form-control " value="<?= $data['nisn_siswa'] ?>">
                                    <input type="hidden" id="id_siswa" name="id_siswa" required="required" class="form-control " value="<?= $data['id_siswa'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="text" id="nama_siswa" name="nama_siswa" required="required" class="form-control " value="<?= $data['nama_siswa'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="exampleInputEmail1">Jenis Kelamin</label>
                                <div class="input-group col-sm-8 col-md-8">
                                    <select class="form-control" id="jk_siswa" name="jk_siswa">
                                        <option value="">Pilih</option>
                                        <option value="Laki-Laki" <?php if($data['jk_siswa'] == 'Laki-Laki') echo"selected"; ?>>Laki-Laki</option>
                                        <option value="Perempuan" <?php if($data['jk_siswa'] == 'Perempuan') echo"selected"; ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Biaya SPP<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="number" id="biaya_spp" name="biaya_spp" required="required" class="form-control " value="<?= $data['biaya_spp'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Wali Siswa<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <select id="id_wali_siswa" name="id_wali_siswa" required="required" class="form-control ">
                                    <option value="<?= $data['id_wali_siswa'] ?>"><?= $data['nama_wali_siswa'] ?></option>
                                        <option value="">- Pilih -</option>
                                        <?php $no=1; foreach($wali_siswa as $row_wali_siswa){?>
                                        <option value="<?= $row_wali_siswa->id_wali_siswa ?>"><?= $row_wali_siswa->nama_wali_siswa ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-12 col-sm-6 offset-md-0">
                                  <a type="button" href="<?= base_url();?>siswa" class="btn btn-sm btn-secondary"  style="color: white;"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>

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