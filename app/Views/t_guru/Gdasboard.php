<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>

<div class="container-fluid">
    <!-- Content Row -->
    <div class="card">
        <div class="card-header">
            <b>DAFTAR SISWA</b>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                $i = 0;
                foreach ($kelass as $kelas) { ?>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Kelas : <?php echo $kelas->nama ?></div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $kelas->jumlah_siswa ?> Orang</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-school fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                    $i++;
                }

                $jml_siswa_belum_terdaftar = $jml_kelas - $i;
                ?>

                <?php if ($jml_siswa_belum_terdaftar > 0) { ?>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-danger">
                                            KELAS MASIH KOSONG</div>
                                        <div class="h5 mb-0 font-weight-bold text-danger"><?php echo $jml_siswa_belum_terdaftar ?> Kelas</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <div class="card my-4">
        <div class="card-header">
            <b>GRAFIK MONITORING KELAS <?php echo session()->get('kelas') ?></b>
        </div>
        <div class="card-body">
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-4 mb-4">
                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">SISWA PRAKTIKUM</h6>
                        </div>
                        <div class="card-body">

                            <?php foreach ($tampildata as $nilaiprak) { ?>
                                <h4 class="small font-weight-bold"><?php echo  $nilaiprak['judul'] ?> <span class="float-right"><?php echo $presen[$nilaiprak['id_praktikum']] ?>%</span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar" role="progressbar" style="background-color:<?php echo $warna[$nilaiprak['id_praktikum']] ?>; width: <?php echo $presen[$nilaiprak['id_praktikum']] ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" max="20%"></div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="col-lg-8 mb-4">
                    <!-- Project Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">[ PENJELASAN ] [ JUMLAH SISWA (<?php echo $jml_siswa; ?>) ] </h6>
                        </div>
                        <div class="card-body">

                            <?php foreach ($tampildata as $nilaiprak) { ?>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <div class="card" style="width: 2.5rem; height:2.5rem; background-color:<?php echo $warna[$nilaiprak['id_praktikum']] ?>;">
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-11 p-2">
                                        <small>[ Peserta Praktikum : <?php echo $nilai[$nilaiprak['id_praktikum']] ?> Orang ]
                                            [ Belum Praktikum : <?php echo $sisa[$nilaiprak['id_praktikum']] ?> Orang ]
                                            [ Presentase : <?php echo $presen[$nilaiprak['id_praktikum']] ?> % ]

                                        </small>
                                    </div>
                                </div><br />

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card my-4">
        <div class="card-header">
            <b>GRAFIK PENILAIAN STATUS BERHASIL PRAKTIKUM KELAS <?php echo session()->get('kelas') ?></b>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Content Column -->
                <?php foreach ($getdatapraktikum as $getprak) {
                    if ($jml_siswa == 0) {
                        echo "<p class='text-danger p-2' align='center'>Mohon Maaf Grafik Tidak Dapat Di Tampilkan Karena Siswa Belum Ada Yang Daftar Praktikum !</p>";
                    } else {
                        $status_post = round(($getprak->post_status / $jml_siswa) * 100);
                        $status_pre = round(($getprak->pre_status / $jml_siswa) * 100);
                        $status_expe = round(($getprak->expe_status / $jml_siswa) * 100);
                ?>

                        <div class="col-lg-3 mb-4">
                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <small><b><?php echo  $getprak->judul ?></b></small>
                                </div>

                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Games Experiment<span class="float-right"><?php echo  $status_expe ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="background-color:<?php echo $warna_expe ?>; width: <?php echo $status_expe ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" max="20%"></div>
                                    </div>

                                    <h4 class="small font-weight-bold">Games Pre Test<span class="float-right"><?php echo $status_pre ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="background-color:<?php echo $warna_pre ?>; width: <?php echo $status_pre ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" max="20%"></div>
                                    </div>

                                    <h4 class="small font-weight-bold">Games Pos Test<span class="float-right"><?php echo $status_post ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="background-color:<?php echo $warna_post ?>; width: <?php echo $status_post ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" max="20%"></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                <?php
                    }
                } ?>

            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>