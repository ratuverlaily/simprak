<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>
<div class="container">
    <br />
    <div class="card my-1 shadow-lg">
        <div class="card-body">
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
            <div class="alert alert-primary shadow-lg" role="alert">
                <h6 align="center"><b>POSTING KEGIATAN PRAKTIKUM</b></h6>
            </div>

            <form method="post" action="<?php echo base_url() ?>/users/posting" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-6">
                        <div class="card o-hidden shadow-lg">
                            <div class="card-body text-secondary">
                                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <div class="form-group">
                                    <label for="ex3">Judul Posting</label>
                                    <input name="judul" class="form-control" id="judul" id="ex3" type="text" placeholder="Judul Postingan !">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Komentar Anda</label>
                                    <textarea name="komentar" class="form-control" id="komentar" id="exampleFormControlTextarea1" rows="3" placeholder="Komentar Anda !"></textarea>
                                    <small>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <p class="text-danger"><br />
                                                    Symbol ( / ) => Enter<br />
                                                    Symbol ( & ) => Nambah Space<br />
                                                    Symbol ( # kelimat #/ ) => bold
                                                </p>
                                            </div>
                                            <div class="col-sm-7">
                                                <p class="text-danger"><br />
                                                    Symbol ( * kelimat */ ) => underline<br />
                                                    Symbol ( ^ kelimat ^/ ) => italic<br />
                                                    Symbol ( [ kelimat ] ) => Rata Kanan Kiri
                                                </p>
                                            </div>
                                        </div>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card o-hidden shadow-lg">
                            <div class="card-body text-secondary">
                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Link Web</span>
                                        </div>
                                        <input name="link_web" class="form-control" id="link_web" id="ex3" type="text" placeholder="Input Link Jika Ada !">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Link Youtube</span>
                                        </div>
                                        <input name="link_youtube" class="form-control" id="link_youtube" id="ex3" type="text" placeholder="Input Link Jika Ada !">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="file">Upload File:</label><br />
                                    <input type="file" id="file" name="file" />
                                    <!-- Error -->
                                    <div class='alert alert-danger mt-2 d-none' id="err_file">Maaf File Anda Tidak Bisa Di Upload !</div>
                                </div>
                            </div>
                        </div>

                        <br />
                        <div class="card o-hidden shadow-lg">
                            <div class="card-body text-secondary">
                                <div class="d-flex justify-content-center bd-highlight">
                                    <!-- <div class="p-2 bd-highlight"><button class="btn btn-primary" onclick="add_photo()"><i class="fas fa-plus-square"></i> Upload Photo</button></div> -->
                                    <div class="p-1 bd-highlight">
                                        <button href="submit" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-save"></i> &nbsp;&nbsp; Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>