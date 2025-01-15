<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2><?= $judul ?></h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
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

                  <form class="form-group row" action="<?php echo base_url().'laporan/cetaktagihan'?>" method="post" target="_blank">
                      <label class="col-sm-1 col-form-label"></label>
                      <div class="input-group col-sm-3 col-md-3">
                          
                      </div>

                      <label class="col-sm-2">
                      </label>

                      <label class="col-sm-2 col-form-label">TOTAL TAGIHAN</label>
                      <div class="input-group col-sm-4 col-md-4">
                          <h1>Rp. <?= $total_tagihan ?></h1>
                      </div>
                    </form>

                  <div class="card-box table-responsive">
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <th style="width: 10%;">No.</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Nama Wali Siswa</th>
                        <th>Email</th>
                        <th>Jumlah Tagihan</th>
                        <th>Aksi</th>
                      </thead>
                    <tbody>
                    <?php $no=1; foreach($data as $row){?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama_siswa ?></td>
                        <td><?= $row->nama_kelas ?></td>
                        <td><?= $row->nama_wali_siswa ?></td>
                        <td><?= $row->email_wali_siswa ?></td>
                        <td>Rp. <?= rupiah($row->jumlah_bayar) ?></td>
                        <td><a href="<?= base_url(); ?>laporan/cetakdetailtagihan/<?= $row->id_siswa ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-lg fa-print"></i> Cetak Tagihan</a></td>
                      </tr>
                      <?php } ?> 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>