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
                        <form action="<?php echo base_url().'bayar/insert'?>" method="post" class="form-horizontal form-label-left">

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal<span class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-12 ">
                                    <input type="date" id="tgl_bayar" name="tgl_bayar" readonly class="form-control" value="<?= date('Y-m-d') ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kelas<span class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-12 ">
                                    <input id="nama_kelas" name="nama_kelas" readonly class="form-control" value="<?= $nama_kelas ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NISN<span class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-12 ">
                                    <input id="nisn_siswa" name="nisn_siswa" readonly class="form-control" value="<?= $nisn_siswa ?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Siswa<span class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-12 ">
                                    <input id="nama_siswa" name="nama_siswa" readonly class="form-control" value="<?= $nama_siswa ?>">
                                    <input type="hidden" id="id_siswa" name="id_siswa" readonly class="form-control" value="<?= $id_siswa ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pembayaran<span class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-12 ">
                                    <textarea id="keterangan" name="keterangan" readonly class="form-control" rows="4">SPP <?= $pembayaran ?></textarea>
                                    <input type="hidden" id="id_spp" name="id_spp" readonly class="form-control" value="<?= $id_spp ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Total<span class="required">*</span>
                                </label>
                                <div class="col-md-10 col-sm-12 ">
                                    <input id="total_rp" name="total_rp" readonly class="form-control" value="<?= rupiah($total) ?>">
                                    <input type="hidden" id="total" name="total" readonly class="form-control" value="<?= $total ?>">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-12 col-sm-8 offset-md-0">
                                    <a type="button" href="<?= base_url();?>bayar/add" class="btn btn-sm btn-secondary"  style="color: white;"><i class="fa fa-fw fa-lg fa-times-circle"></i>Reset</a>

                                    <button type="submit" class="btn btn-sm btn-success pull-right"><i class="fa fa-fw fa-lg fa-save"></i> Submit</button>
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