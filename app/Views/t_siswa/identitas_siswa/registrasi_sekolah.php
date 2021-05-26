<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">
    <div class="card o-hidden shadow-lg my-5">

        <?= $this->include('reglayout/header'); ?>

        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>/identitas/photo">Photo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>/identitas/identitas">Identitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="coba" href="<?= base_url() ?>/identitas/kelas">Kelas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="coba" href="<?= base_url() ?>/identitas/sekolah">Sekolah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="coba" href="<?= base_url() ?>/identitas/password">Ubah Password</a>
                </li>
            </ul>
            <br />

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

            <div class="card w-50 mx-auto">
                <div class="card-body">
                    <div class="alert alert-primary text-center" role="alert">
                        <h8 class="card-title"><b>IDENTITAS SEKOLAH</b></h8>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    Nama
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    <?= $nama; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    Alamat
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    <?= $alamat; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    Kode Pos
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    <?= $kode_pos; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    No Telpon
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    <?= $no_tlp; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    Nomor Fax
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    <?= $no_fax; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between bd-highlight">
                <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url() ?>/identitas/kelas'"><i class="fas fa-backward"></i> Sebelumnya</button></div>
                <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url() ?>/identitas/password'"><i class="fas fa-forward"></i> Selanjutnya</button></div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>