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
                        <form action="<?php echo base_url().'bayar/cektotal'?>" method="post" class="form-horizontal form-label-left">

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NISN Siswa<span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-12">
                                    <input type="text" id="nisn_siswa" name="nisn_siswa" readonly class="form-control" value="<?= $data_siswa['nisn_siswa'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Siswa<span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-12">
                                    <input type="text" id="nama_siswa" name="nama_siswa" readonly class="form-control" value="<?= $data_siswa['nama_siswa'] ?>">
                                    <input type="hidden" id="id_siswa" name="id_siswa" readonly class="form-control" value="<?= $data_siswa['id_siswa'] ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kelas<span class="required">*</span>
                                </label>
                                <div class="col-md-7 col-sm-12">
                                    <input type="text" id="kelas_siswa" name="kelas_siswa" readonly class="form-control" value="<?= $data_siswa['nama_kelas'] ?>">
                                </div>
                            </div>

                            <div class="row item form-group" id="data_tagihan">
                                <div class="col-md-12 col-sm-12">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Pilih</th>
                                                <th>Tagihan</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                        
                                        <tbody>
                                        <?php
                                        $no=1; 
                                        foreach($data as $row){
                                        echo '
                                            <tr>
                                                <td>';
                                                    if($row->status_bayar == 'Lunas'){
                                                        echo '
                                                            <input type="checkbox" name="id_spp[]" value="'.$row->id_spp.'" class="flat" disabled="disabled">
                                                        ';
                                                    }else{
                                                        echo '
                                                            <input type="checkbox" name="id_spp[]" value="'.$row->id_spp.'" class="flat" >
                                                        ';
                                                    }
                                                    
                                                echo '	
                                                </td>
                                                <td>'.$row->bulan_spp.'</td>
                                                <td>Rp. '.rupiah($row->jumlah_bayar).'</td>
                                            </tr>';
                                        
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-sm btn-success" value="Input">Proses</button>
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