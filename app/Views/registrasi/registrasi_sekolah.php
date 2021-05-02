<?= $this->extend('auth/templates_login/index'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="card o-hidden shadow-lg my-5">

        <?= $this->include('reglayout/header'); ?>

        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url() ?>/users/photo">Photo</a>
                </li>

                <?php if ($photo == 0) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Identitas</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>/users/identitas">Identitas</a>
                    </li>
                <?php } ?>

                <?php if ($identitas == 0) { ?>
                    <li class="nav-item">
                        <a class="nav-link" id="coba" href="#">Kelas</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" id="coba" href="<?= base_url() ?>/users/kelas">Kelas</a>
                    </li>
                <?php } ?>

                <?php if ($kelas == 0) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sekolah</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="coba" href="<?= base_url() ?>/users/sekolah">Sekolah</a>
                    </li>
                <?php } ?>
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
                    <div class="alert alert-danger text-center" role="alert">
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
                <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url('logout'); ?>'"><i class="fas fa-backward"></i> Keluar</button></div>
                <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url() ?>/home'"><i class="fas fa-forward"></i> Selanjutnya</button></div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>