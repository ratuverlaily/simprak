<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>


<div class="container-fluid">
    <div class="card o-hidden shadow-lg my-5">
        <div class="alert-primary p-3 text-center">
            <b>PENILAIAN PRAKTIKUM SISWA KELAS <?= session()->get('kelas'); ?></b>
        </div>
        <div class="card-body">
            Halaman : <br /><br />
            <div class="row">
                <?php foreach ($tampildata as $nilaiprak) { ?>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title"><b><?= $nilaiprak->judul; ?></b></h6>
                                <p class="card-text">Link : <a href="">Lihat Detail</a> <br />Selesai : <?= $nilai[$nilaiprak->id_praktikum]; ?> orang<br />Belum Terkumpul : <?= $sisa[$nilaiprak->id_praktikum]; ?> orang<br /><br />
                                    <small> Posting : <?= $nilaiprak->tgl_publis; ?> <br />Batas Pengumpulan : <?= $nilaiprak->tgl_publis; ?></small>
                                </p>

                                <a href="<?= base_url() ?>/praktikum/penilaian/detail/<?php echo $nilaiprak->id_praktikum ?>" class="btn btn-primary">Rekap Nilai Siswa</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>

<?= $this->endSection(); ?>