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
                        <form action="<?php echo base_url().'laporan/cetakpembayaran'?>" target="_blank" method="post" class="form-horizontal form-label-left">

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Bayar<span class="required">*</span>
                                </label>
                                <div class="col-md-4 col-sm-4 ">
                                    <input type="date" id="tgl_awal" name="tgl_awal" required="required" class="form-control ">
                                </div>

                                <div class="col-md-4 col-sm-4 ">
                                    <input type="date" id="tgl_akhir" name="tgl_akhir" required="required" class="form-control ">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kelas<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12 ">
                                    <select id="id_kelas" name="id_kelas" class="form-control ">
                                        <option value="">- Pilih -</option>
                                        <?php $no=1; foreach($list_kelas as $row_kelas){?>
                                        <option value="<?= $row_kelas->id_kelas ?>"><?= $row_kelas->nama_kelas ?></option>
                                        <?php } ?>
                                    </select>
                                    <span style="color: red">Kosongkan Kolom Jika Tidak Difilter</span>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Siswa<span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-12">
                                    <select id="id_siswa" name="id_siswa" class="form-control ">
                                        <option value="">- Pilih -</option>
                                    </select>
                                    <span style="color: red">Kosongkan Kolom Jika Tidak Difilter</span>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-12 col-sm-6 offset-md-0">

                                    <button type="submit" class="btn btn-sm btn-success pull-right"><i class="fa fa-fw fa-lg fa-print"></i> Cetak</button>
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
 
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4><?= $judul ?></h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                <li class="breadcrumb-item" style="float: left;">
                <a href="<?= base_url() ?>dashboard"> <i class="feather icon-home"></i> </a>
                </li>
                <li class="breadcrumb-item" style="float: left;"><a href="<?= base_url() ?>"><?= $judul ?></a>
                </li>
                </ul>
            </div>
        </div>
    </div>
</div>
