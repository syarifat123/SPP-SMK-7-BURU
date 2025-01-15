<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2><?= $judul ?></h2>
            <ul class="nav navbar-right panel_toolbox">
            <?php if($this->session->userdata('level') !== 'Kepala Sekolah'){?>
            <p><a href="<?= base_url(); ?>bayar/add" class="btn btn-sm btn-success icon-btn"><i class="fa fa-plus"></i>Tambah Pembayaran</a></p>
            <?php } ?>
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

                  <div class="card-box table-responsive">
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>No Pembayaran</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Total Bayar</th>
                        <th>Pembayaran</th>
                        <th>Jenis pembayaran</th>
                        <th>Bukti Bayar</th>
                        <th>Status Bayar</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>


                    <tbody>
                    <?php $no=1; foreach($data as $row){?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date_indo($row->tgl_bayar) ?></td>
                        <td><?= $row->no_bayar ?></td>
                        <td><?= $row->nama_siswa ?></td>
                        <td><?= $row->nama_kelas ?></td>
                        <td>Rp. <?= rupiah($row->total_bayar) ?></td>
                        <td><?= $row->keterangan ?></td>
                        <td><?= $row->jenis_pembayaran ?></td>
                        <td>
                          <?php if($row->jenis_pembayaran == 'Tunai'){ ?>
                            
                            <?php }else{ ?>
                              <?php if($row->bukti_bayar == ''){ ?>

                              <?php }else{ ?>
                                <a href="<?= base_url() ?>/public/image/upload/<?= $row->bukti_bayar ?>" target="_blank">
                                <img src="<?= base_url() ?>/public/image/upload/<?= $row->bukti_bayar ?>" style="width: 80px; height: 100px;"></a>
                              <?php } ?>
                              <?php } ?>
                          </td>
                          <td><?= $row->status_bayar ?></td>
                        <td>
                          <?php if($row->status_bayar == 'Lunas'){ ?>
                            <a href="<?= base_url(); ?>laporan/cetakbayar/<?= $row->no_bayar ?>" target="_blank" class="btn btn-sm btn-success" id="<?= $row->id_bayar ?>"><i class="fa fa-lg fa-print"></i> Cetak</a>
                          <?php } ?>

                          <?php if($this->session->userdata('level') == 'Wali Siswa'){?>
                            <?php if($row->status_bayar == 'Menunggu Pembayaran' || $row->status_bayar == 'Menunggu Konfirmasi' || $row->status_bayar == 'Ditolak'){ ?>
                              <a type="submit" class="btn btn-sm btn-info btnupload" data-id="<?= $row->no_bayar ?>"><i class="fa fa-lg fa-upload"></i> Upload Bukti Transfer</a>
                            <?php } ?>
                          <?php } ?>

                          <?php if($this->session->userdata('level') == 'Staff TU'){?>
                            <?php if($row->status_bayar == 'Menunggu Konfirmasi' || $row->status_bayar == 'Ditolak'){ ?>
                              <a type="submit" class="btn btn-sm btn-info btnkonfirmasi" data-id="<?= $row->no_bayar ?>"><i class="fa fa-lg fa-check"></i> Konfirmasi Pembayaran</a>
                            <?php } ?>

                            <a type="submit" class="btn btn-sm btn-danger btnhapus" data-id="<?= $row->no_bayar ?>"><i class="fa fa-lg fa-trash"></i> Hapus</a>
                          <?php }?>
                        </td>
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


  <div class="modal fade modalupload" id="modalupload" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form action="<?php echo base_url().'bayar/uploadbukti'?>" method="post" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Upload Bukti Transfer</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="data_tagihan">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade modalkonfirmasi" id="modalkonfirmasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form action="<?php echo base_url().'bayar/konfirmasi'?>" method="post" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Konfirmasi Pembayaran</h4>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="data_konfirmasi">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>