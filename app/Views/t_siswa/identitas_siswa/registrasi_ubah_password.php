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
                    <a class="nav-link" id="coba" href="<?= base_url() ?>/identitas/sekolah">Sekolah</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" id="coba" href="<?= base_url() ?>/identitas/password">Ubah Password</a>
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
                    <div class="alert alert-danger text-center" role="alert">
                        <h8 class="card-title"><b>UBAH PASSWORD</b></h8>
                    </div>
                    <form method="post" action="<?php echo base_url() ?>/identitas/password/update" id="form" enctype="multipart/form-data">

                        <input type="hidden" class="txt_csrfname_registrasi" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                        <div class="form-group">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                                </div>
                                <input type="email" class="form-control" name="email" placeholder="" value="<?php echo $users->email ?>" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Password Lama</span>
                                </div>
                                <input type="password" class="form-control" name="password_lama" placeholder="" value="<?php echo $users->password ?>" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Password</span>
                                </div>
                                <input type="password" class="form-control" name="password" placeholder="" value="" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Ulangi Password</span>
                                </div>
                                <input type="password" class="form-control" name="repassword" placeholder="" value="" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">Ubah Password</button>
                    </form>
                </div>
            </div>


            <div class="d-flex justify-content-between bd-highlight">
                <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url() ?>/identitas/sekolah'"><i class="fas fa-backward"></i> Sebelumnya</button></div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>