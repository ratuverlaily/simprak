<?= $this->extend('auth/templates_login/index'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">

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
                            <p class="text-gray-900 mb-4"><b>REGISTRASI</b><br />
                                <small>E-SIMPRAG (SIMULASI PRAKTIKUM DAN GAMES)</small><br />
                                <small>KOPETENSI BIDANG LISTRIK DASAR SMK</small>
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

                        <form method="post" action="<?php echo base_url() ?>/auth/register/save" id="form" enctype="multipart/form-data">

                            <input type="hidden" class="txt_csrfname_registrasi" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Username</span>
                                    </div>
                                    <input type="text" class="form-control" name="username" placeholder="" value="" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                                    </div>
                                    <input type="email" class="form-control" name="email" placeholder="" value="" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group-sm mb-3">
                                    <select class="custom-select" name="lavel_akses" id="inputGroupSelect03">
                                        <option selected>Level Akses...</option>
                                        <option value="1">Siswa</option>
                                        <option value="2">Guru</option>
                                    </select>
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

                            <button type="submit" class="btn btn-primary btn-user btn-block">Registrasi</button>
                        </form>
                        <!--</form>-->

                        <hr>
                        <!--<div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password ?</a>
                        </div>-->
                        <div class="text-center">
                            <a class="small" href="<?php echo base_url() ?>/auth/login">Kembali Ke Login ?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href=""></a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

<script>
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>

<?= $this->endSection(); ?>