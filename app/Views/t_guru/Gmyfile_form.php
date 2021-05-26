<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>

<div class="container-fluid">
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

    <div class="card m-b-30 o-hidden shadow-lg my-1">
        <div class="card-body">
            <br />
            <div class="card w-50 mx-auto o-hidden shadow-lg">
                <div class="card-body">
                    <div class="alert alert-primary text-center" role="alert">
                        <h8 class="card-title"><b>UPLOAD FILE ANDA</b></h8>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php echo base_url() ?>/modul/myfile/save" enctype="multipart/form-data">
                            <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                            <div class="form-group">
                                <label for="ex3">Judul File Anda</label>
                                <input name="judul" class="form-control" id="judul" id="ex3" type="text" placeholder="Judul File !">
                            </div>

                            <div class="form-group">
                                <label for="file">Upload File:</label><br />
                                <input type="file" id="file" name="file" />
                                <!-- Error -->
                                <div class='alert alert-danger mt-2 d-none' id="err_file">Maaf File Anda Tidak Bisa Di Upload !</div>
                            </div>
                            <br />

                            <button href="submit" class="btn btn-primary btn-user btn-block">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <br /><br /><br />
        </div>
    </div>
</div>

<?= $this->endSection(); ?>