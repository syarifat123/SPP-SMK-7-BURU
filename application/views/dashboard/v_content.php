<?php if($this->session->userdata('level') == 'Staff TU' || $this->session->userdata('level') == 'Kepala Sekolah'){?>
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-users"></i></div>
                        <div class="count"><?= $jumlah_siswa ?></div>
                        <h3>Jumlah <br> Siswa</h3>
                        <p></p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa fa-building"></i></div>
                        <div class="count"><?= $jumlah_kelas ?></div>
                        <h3>Jumlah <br> Kelas</h3>
                        <p></p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                    <div class="tile-stats">
                        <div class="count">Rp. <?= rupiah($tunggakan['jumlah_bayar']) ?></div>
                        <h3>Tunggakan SPP <br> Bulan Ini</h3>
                        <p></p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                    <div class="tile-stats">
                    <div class="count">Rp. <?= rupiah($bayar['total_bayar']) ?></div>
                        <h3>Pembayaran SPP <br> Bulan Ini</h3>
                        <p></p>
                    </div>
                </div>

                <div class="animated flipInY col-lg-3 col-md-3 col-sm-12 ">
                    <div class="tile-stats text-center" style="padding: 20px;">
                        <img style="width:100px" src="<?php echo base_url();?>public/image/smkn7.png">
                    </div>
                </div>
                <div class="animated flipInY col-lg-9 col-md-9 col-sm-12 ">
                    <div class="tile-stats" style="padding: 20px;">
                        <div class="icon" style="padding: 20px;"><i class="fa fa-university"></i></div>
                        <div class="count">SMK NEGERI 7 BURU</div>
                        <h3>Kepala Sekolah : Nasir Hadi</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if($this->session->userdata('level') == 'Wali Siswa'){?>
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 ">
                    <div class="tile-stats">
                        <div class="count">Rp. <?= rupiah($tunggakan['jumlah_bayar']) ?></div>
                        <h3>Tunggakan SPP Bulan Ini</h3>
                        <p></p>
                    </div>
                </div>
                <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 ">
                    <div class="tile-stats">
                    <div class="count">Rp. <?= rupiah($bayar['total_bayar']) ?></div>
                        <h3>Pembayaran SPP Bulan Ini</h3>
                        <p></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php } ?>