        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?= $judul ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?= $judul ?></li>
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
                  <h3 class="box-title">Data Gaji</h3>
                  <div style="padding-top: 10px;">
                  </div>
            
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <!-- form start -->
                <form action="<?php echo base_url() ?>laporan/cetak/" target="_blank" method="post" enctype="multipart/form-data">
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
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->