<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>

<div class="container-fluid">
    <div class="alert alert-primary o-hidden shadow-lg" role="alert">
        <h6 align="center"><b>DAFTAR PRAKTIKUM</b></h6>
    </div>

    <div class="card o-hidden shadow-lg my-2">
        <div class="card-body">
            <?php if (session()->get('warning')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= session()->getFlashdata('warning') ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (session()->get('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= session()->getFlashdata('error') ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?= session()->getFlashdata('success') ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="d-flex bd-highlight mb-3">
                <div class="p-2 bd-highlight">
                    <?= $pager->links('praktikum', 'praktikum_pagination'); ?>
                </div>
            </div>

            <?php $no = 1;
            date_default_timezone_set('Asia/Jakarta');

            foreach ($praktikums as $praktikum) {
                $waktu = $praktikum['tgl_publis'] . " " . $praktikum['waktu_publis'];
                $waktu_sistem = $waktu;
                $wakru_sekarang = date('Y-m-d H:i:s');

                $waktu_batas = $praktikum['tgl_batas'] . " " . $praktikum['waktu_batas'];

                $getGames[$praktikum['id_games']] = $praktikum['id_games'];

                if ($waktu_batas >= $wakru_sekarang) {
                    $bgcolor = "";
                    $status = "";
                } else {
                    $bgcolor = "alert-danger";
                    $status = "EXPIRED";
                }

                if ($waktu_sistem <= $wakru_sekarang) {
            ?>
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="alert-secondary my-3">
                                <p align="center" class="p-2">
                                    <i class="fas fa-plug fa-2x"></i>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-11 ">
                            <button type="button" class="list-group-item list-group-item-action" onclick="location.href='<?= base_url('praktikum/detail'); ?>/<?php echo $praktikum['id_praktikum'] ?>'">
                                <div class="row <?php echo  $bgcolor; ?>">
                                    <div class="col-sm-10 p-2">
                                        <b><small><?php echo $praktikum['username'] ?>, <?php echo $praktikum['tgl_publis']; ?></small></b><br />
                                        <b><?php echo $praktikum['judul']; ?></b><br />
                                    </div>
                                    <div class="col-sm-2 p-3">
                                        <h5 class="text-center"> <i class="fas fa-engine-warning"></i>
                                            <?php echo $status ?></h5>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div><br />
            <?php
                }
            } ?>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>