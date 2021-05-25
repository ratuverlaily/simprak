<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">
    <div class="card o-hidden shadow-lg my-5">
        <div class="card-body">


            <?php
            $dt = json_encode($tampildata);
            $hsl = json_decode($dt, true);

            $waktu_batas = $hsl['tgl_batas'] . " " . $hsl['waktu_batas'];
            $wakru_sekarang = date('Y-m-d H:i:s');
            if ($waktu_batas >= $wakru_sekarang) { ?>
                <br />
                <div class="alert alert-primary" role="alert">
                    <h6 align="center"><b>PRAKTIKUM</b></h6>
                </div>
                <br />
            <?php } else { ?>
                <br />
                <div class="alert alert-danger" role="alert">
                    <h6 align="center"><b>PRAKTIKUM SUDAH SELESAI</b></h6>
                </div>
                <br />
            <?php } ?>
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
                <div class="col">
                    <?php

                    $a = array('/', '&', '#', '#/', '*', '*/', '^', '^/', '[', ']', '~', '/~');
                    $b = array('<br/>', '&nbsp;', '<b>', '</b>', '<u>', '</u>', '<i>', '</i>', '<p align="justify">', '</p>', '<h1 align="center">', '</h1>');
                    echo str_replace($a, $b, $hsl['komentar']);

                    ?>
                </div>
            </div>
            <br />
            <div class="row">

                <div class="col-2">
                    Modul Praktikum
                </div>
                <div class="col-4">
                    <a class="btn btn-primary" href="<?= base_url(); ?>/praktikum/modul/unduh/<?php echo $hsl['id_praktikum']; ?>"><i class="fas fa-download"></i></a>
                </div>
                <div class="col-2">
                    Aplikasi Praktikum <br />
                    ( Jika Belum Download )
                </div>
                <div class="col-4">
                    <a href="<?php echo base_url() ?>/games/SIMPRAG_JOB_1.exe"><i class="fas fa-download"></i> SIMPRAG.exe</a>
                </div>
            </div>
            <br />

            <div class="d-flex justify-content-between bd-highlight mb-3">
                <div class="p-2 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url('praktikum/siswa'); ?>'"><i class="fas fa-backward"></i> Kembali</button></div>
                <?php if ($waktu_batas >= $wakru_sekarang) { ?>
                    <div class="p-2 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url('praktikum/sentkode'); ?>/<?php echo $praktikum['id_praktikum'] ?>'"><i class="fas fa-forward"></i> Selanjutnya</button></div>
                <?php } else { ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>