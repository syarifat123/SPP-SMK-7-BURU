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
                        <form action="<?php echo base_url().'spp/insert'?>" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Staff<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <select id="id_user" name="id_user" required="required" class="form-control ">
                                        <option value="">- Pilih -</option>
                                        <?php $no=1; foreach($user as $row_user){?>
                                        <option value="<?= $row_user->id_user ?>"><?= $row_user->nama_user ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Siswa<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <select id="id_siswa" name="id_siswa" required="required" class="form-control ">
                                        <option value="">- Pilih -</option>
                                        <?php $no=1; foreach($siswa as $row_siswa){?>
                                        <option value="<?= $row_siswa->id_siswa ?>"><?= $row_siswa->nama_siswa ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jatuh Tempo<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="date" id="jatuh_tempo" name="jatuh_tempo" required="required" class="form-control ">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Bulan SPP<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="text" id="bulan_spp" name="bulan_spp" required="required" class="form-control ">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No Bayar<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="Number" id="no_bayar" name="no_bayar" required="required" class="form-control ">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Bayar<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="date" id="tgl_bayar" name="tgl_bayar" required="required" class="form-control ">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jumlah Bayar<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="number" id="jumlah_bayar" name="jumlah_bayar" required="required" class="form-control ">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Keterangan<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="text" id="keterangan" name="keterangan" required="required" class="form-control ">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Status Bayar<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <input type="text" id="status_bayar" name="status_bayar" required="required" class="form-control ">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Bukti Bayar</label>
                                <div class="input-group col-sm-12 col-md-8">
                                <input type="file" class="form-control" id="bukti_bayar" name="bukti_bayar" id="exampleInputUpload Foto1" placeholder="Upload Foto">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-12 col-sm-6 offset-md-0">
                                  <a type="button" href="<?= base_url();?>spp" class="btn btn-sm btn-secondary"  style="color: white;"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>

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