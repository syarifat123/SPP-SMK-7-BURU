<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?= base_url() ?>dashboard" class="site_title"> <span>E SPP</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?= base_url() ?>/public/image/admin.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <h2><?= $this->session->userdata('nama') ?></h2>
                <span><?= $this->session->userdata('level') ?></span>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="<?= base_url() ?>dashboard"><i class="fa fa-home"></i> Dashboard</a>
                    </li>

                    <?php if($this->session->userdata('level') == 'Staff TU'){?>

                    <li><a><i class="fa fa-briefcase"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url() ?>user">User</a></li>
                            <li><a href="<?= base_url() ?>siswa">Siswa</a></li>
                            <li><a href="<?= base_url() ?>wali_siswa">Wali Siswa</a></li>
                            <li><a href="<?= base_url() ?>kelas">Kelas</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-edit"></i> Transaksi<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url() ?>bayar">Pembayaran SPP</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-file-pdf-o"></i> Laporan<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url() ?>tagihan">Tagihan SPP</a></li>
                            <li><a href="<?= base_url() ?>laporan">Transaksi Pembayaran</a></li>
                        </ul>
                    </li>

                    <?php } ?>

                    <?php if($this->session->userdata('level') == 'Kepala Sekolah'){?>

                    <li><a><i class="fa fa-file-pdf-o"></i> Laporan<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= base_url() ?>tagihan">Tagihan SPP</a></li>
                            <li><a href="<?= base_url() ?>laporan">Transaksi Pembayaran</a></li>
                        </ul>
                    </li>

                    <?php } ?>

                    <?php if($this->session->userdata('level') == 'Wali Siswa'){?>

                        <li><a href="<?= base_url() ?>tagihan"><i class="fa fa-edit"></i> Tagihan SPP</a></li>
                        <li><a href="<?= base_url() ?>bayar"><i class="fa fa-money"></i> Transaksi Pembayaran</a></li>

                    <?php } ?>

                    <li><a href="<?= base_url() ?>profil"><i class="fa fa-user"></i> Profil</a>
                        </li>

                    <li><a href="<?= base_url() ?>login/logout"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                    
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->
    </div>
</div>