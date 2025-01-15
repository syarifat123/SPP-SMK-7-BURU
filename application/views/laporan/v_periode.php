        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Laporan Data <?= $kategori ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Laporan Data <?= $kategori ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box box-primary">
                <div class="box-header with-border">
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
                  <h3 class="box-title">Data <?= $kategori ?></h3>
                  <div style="padding-top: 10px;">
                  </div>
            
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <!-- form start -->
                <?php if($kategori == 'cuti'){ ?>
                  <form action="<?php echo base_url() ?>laporanperiode/cetakcuti/" target="_blank" method="post" enctype="multipart/form-data">

                  <div class="box-body">
                    <div class="row">
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="no_gaji">Tahun</label>
                          <div class="input-group col-md-8">
                              <select class="form-control" id="tahun" name="tahun" required>
                                <option value="">Pilih Tahun</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="no_gaji">Bulan</label>
                          <div class="input-group col-md-8">
                              <select class="form-control" id="bulan" name="bulan" required>
                                <option value="">Pilih Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                              </select>
                          </div>
                        </div>

                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3 control-label" for="name"></label>
                        <div class="input-group col-md-8">
                          <button type="submit" class="btn btn-primary" style="margin-right: 6px;">Cetak</button>
                        </div>
                      </div>
                    </div>

                  </div><!-- /.box-body -->

                  </form>

                <?php } ?>

                <?php if($kategori == 'lembur'){ ?>
                  <form action="<?php echo base_url() ?>laporanperiode/cetaklembur/" target="_blank" method="post" enctype="multipart/form-data">

                  <div class="box-body">
                    <div class="row">
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="no_gaji">Tahun</label>
                          <div class="input-group col-md-8">
                              <select class="form-control" id="tahun" name="tahun" required>
                                <option value="">Pilih Tahun</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="no_gaji">Bulan</label>
                          <div class="input-group col-md-8">
                              <select class="form-control" id="bulan" name="bulan" required>
                                <option value="">Pilih Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                              </select>
                          </div>
                        </div>

                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3 control-label" for="name"></label>
                        <div class="input-group col-md-8">
                          <button type="submit" class="btn btn-primary" style="margin-right: 6px;">Cetak</button>
                        </div>
                      </div>
                    </div>

                  </div><!-- /.box-body -->

                  </form>

                <?php } ?>

                <?php if($kategori == 'absensi'){ ?>
                  <form action="<?php echo base_url() ?>laporanperiode/cetakabsensi/" target="_blank" method="post" enctype="multipart/form-data">

                  <div class="box-body">
                    <div class="row">
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="no_gaji">Tahun</label>
                          <div class="input-group col-md-8">
                              <select class="form-control" id="tahun" name="tahun" required>
                                <option value="">Pilih Tahun</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="no_gaji">Bulan</label>
                          <div class="input-group col-md-8">
                              <select class="form-control" id="bulan" name="bulan" required>
                                <option value="">Pilih Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Nama karyawan</label>
                          <div class="input-group col-sm-8 col-md-8">
                              <select class="form-control" id="id_karyawan" name="id_karyawan" required>
                                  <option value="">Pilih karyawan</option>
                                  <?php foreach($list_karyawan as $row){ ?>
                                    <option value="<?= $row->id_karyawan ?>"><?= $row->nama_karyawan ?></option>
                                  <?php } ?>
                              </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3 control-label" for="name"></label>
                        <div class="input-group col-md-8">
                          <button type="submit" class="btn btn-primary" style="margin-right: 6px;">Cetak</button>
                        </div>
                      </div>
                    </div>

                  </div><!-- /.box-body -->

                  </form>

                <?php } ?>

                <?php if($kategori == 'rekapabsensi'){ ?>
                  <form action="<?php echo base_url() ?>laporanperiode/cetakrekapabsensi/" target="_blank" method="post" enctype="multipart/form-data">

                  <div class="box-body">
                    <div class="row">
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="no_gaji">Tahun</label>
                          <div class="input-group col-md-8">
                              <select class="form-control" id="tahun" name="tahun" required>
                                <option value="">Pilih Tahun</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="no_gaji">Bulan</label>
                          <div class="input-group col-md-8">
                              <select class="form-control" id="bulan" name="bulan" required>
                                <option value="">Pilih Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                              </select>
                          </div>
                        </div>

                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3 control-label" for="name"></label>
                        <div class="input-group col-md-8">
                          <button type="submit" class="btn btn-primary" style="margin-right: 6px;">Cetak</button>
                        </div>
                      </div>
                    </div>

                  </div><!-- /.box-body -->

                  </form>

                <?php } ?>
                  

                
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->