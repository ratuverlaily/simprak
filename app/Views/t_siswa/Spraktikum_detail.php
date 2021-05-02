<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="card o-hidden shadow-lg my-5">
        <div class="card-body">
            <br />
            <div class="alert alert-primary" role="alert">
                <h6 align="center"><b>PRAKTIKUM</b></h6>
            </div>
            <br />

            <?php
            $dt = json_encode($tampildata);
            $hsl = json_decode($dt, true);
            ?>
            <div class="row">
                <div class="col-2">
                    Tanggal Posting
                </div>
                <div class="col">
                    : &nbsp;<?php echo $hsl['tgl_publis']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    Batas Pengumpulan
                </div>
                <div class="col">
                    : &nbsp;<?php echo $hsl['tgl_batas']; ?>
                </div>
            </div><br />
            <div class="row">
                <div class="col-2">
                    Topik
                </div>
                <div class="col">
                    : &nbsp;<?php echo $hsl['judul']; ?>
                </div>
            </div><br />
            <div class="row">
                <div class="col-2">
                    Komentar
                </div>
                <div class="col-12">
                    <?php echo $hsl['komentar']; ?>
                </div>
            </div><br />
            <div class="row">
                <div class="col-2">
                    Modul Praktikum
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-primary"><i class="fas fa-download"></i>&nbsp;</button>
                    <button type="button" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp;</button>
                </div>
            </div><br />

            <div class="d-flex justify-content-between bd-highlight mb-3">
                <div class="p-2 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url('praktikum/siswa'); ?>?>'"><i class="fas fa-backward"></i></button></div>
                <div class="p-2 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url('praktikum/sentkode'); ?>/<?php echo $praktikum['id_praktikum'] ?>'"><i class="fas fa-forward"></i></button></div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>