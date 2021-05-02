<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">
    <div class="card o-hidden shadow-lg my-5">
        <div class="alert-primary p-3 text-center">
            <b>KELAS</b>
        </div>
        <div class="card-body">

            <div class="card w-50 mx-auto">
                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        <h8 class="card-title"><b>KELAS YANG DI AMBIL</b></h8>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">Kode Kelas</div>
                        <div class="col-sm-8">:&nbsp;&nbsp;<?php echo $kode; ?></div>
                        <div class="col-sm-4">Nama Kelas</div>
                        <div class="col-sm-8">:&nbsp;&nbsp;<?php echo $nama; ?></div>
                        <div class="col-sm-4">Mata Pelajaran</div>
                        <div class="col-sm-8">:&nbsp;&nbsp;<?php echo $jurusan; ?></div>
                        <div class="col-sm-4">Pengajar</div>
                        <div class="col-sm-8">:&nbsp;&nbsp;<b><?php echo $nama_guru; ?></b></div>
                        <div class="col-sm-4">Status</div>
                        <div class="col-sm-8">:&nbsp;&nbsp;<button type="button" class="btn btn-danger" disabled><?php echo $status; ?></button></div>
                        <div class="col-sm-10"></div>
                    </div>
                </div>
            </div>
            <br /><br /><br />
        </div>
    </div>
</div>

<?= $this->endSection(); ?>