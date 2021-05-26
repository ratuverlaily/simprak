<?= $this->extend('auth/templates_login/index'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <!-- Outer Row justify-content-center-->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-8 d-none d-lg-block bg-light">
                            <img src="<?= base_url() ?>/img/Header_Web.png" class="img-fluid" alt="...">
                        </div>
                        <div class="col-lg-4 bg-light">
                            <div class="p-5">
                                <div class="text-center">
                                    <p class="text-gray-900 mb-4">
                                        <b>
                                            <h5>LOGIN</h5>
                                        </b>
                                        <small>E-SIMPRAG (SIMULASI PRAKTIKUM GAME)</small><br />
                                        <small>KOMPETENSI BIDANG LISTRIK DASAR SMK</small>
                                    </p>
                                </div>
                                <!-- Success validasi -->
                                <?php if (session()->getFlashdata('success')) {  ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?= session()->getFlashdata('success') ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?>

                                <!-- error -->
                                <?php if (session()->getFlashdata('pesan')) {  ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= session()->getFlashdata('pesan') ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?>

                                <!-- Error Validasi -->
                                <?php $errors = session()->getFlashdata('errors'); ?>
                                <?php if ($errors) {  ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
                                            <?php foreach ($errors as $err) { ?>
                                                <li><?= esc($err) ?></li>
                                            <?php } ?>
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?>

                                <form method="post" action="<?php echo base_url() ?>/auth/cek" id="form" enctype="multipart/form-data">

                                    <input type="hidden" class="txt_csrfname_registrasi" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" placeholder="email">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="password">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <br />
                                    <button href="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <p><a href="<?= base_url('auth/register') ?>" class="small">Buat akun baru ?</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>