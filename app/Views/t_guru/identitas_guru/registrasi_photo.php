<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">

    <div class="card o-hidden shadow-lg my-5">

        <?= $this->include('reglayout/header'); ?>

        <div class="card-body">

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url() ?>/identitas/photo">Photo</a>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="card o-hidden">
                        <div class="card-body text-secondary">
                            <div class="alert alert-primary" role="alert">
                                <h6 class="card-title text-center"><b>UNGGAH PHOTO</b></h6>
                            </div>
                            <br />
                            <form method="post" action="<?php echo base_url() ?>/identitas/photo/add" enctype="multipart/form-data">
                                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                                <div class="form-group">
                                    <label for="file"><b>Upload File:</b></label><br />
                                    <input type="file" id="file" name="file" />
                                    <!-- Error -->
                                    <div class='alert alert-danger mt-2 d-none' id="err_file">Maaf File Anda Tidak Bisa Di Upload !</div>
                                </div>
                                <br />
                                <div class="d-flex justify-content-center bd-highlight">
                                    <!-- <div class="p-2 bd-highlight"><button class="btn btn-primary" onclick="add_photo()"><i class="fas fa-plus-square"></i> Upload Photo</button></div> -->
                                    <div class="p-1 bd-highlight">
                                        <button href="submit" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-save"></i> &nbsp;&nbsp; Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card o-hidden">
                        <div class="card-body">
                            <div class="alert alert-primary" role="alert">
                                <h6 class="card-title text-center"><b>HASIL PHOTO</b></h6>
                            </div>

                            <!-- <p align="center"><small>Upload Photo Profil Anda</small><br /><small>Ukuran ( 3 x 4 )</small></p> -->
                            <div id="filepreview" class="displaynone">
                                <img src="<?= base_url() ?>/uploads/<?= session()->get('user_image') ?>" class="rounded mx-auto d-block" width="300px" height="300px"><br><br>
                            </div>
                            <div class="d-flex justify-content-center bd-highlight">
                                <!-- <div class="p-2 bd-highlight"><button class="btn btn-primary" onclick="add_photo()"><i class="fas fa-plus-square"></i> Upload Photo</button></div> -->
                                <div class="p-1 bd-highlight"><button class="btn btn-primary" onclick="location.href='<?= base_url() ?>/uploads/<?= session()->get('user_image') ?>'"><i class="fa fa-eye" aria-hidden="true"></i> Lihat Detail</button></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-between bd-highlight">
                <div class="p-5 bd-highlight"></div>
                <?php if ($photo == 1) { ?>
                    <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url() ?>/identitas/identitas'"><i class="fas fa-forward"></i> Selanjutnya</button></div>
                <?php } else { ?>
                    <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='#'"></i> Selanjutnya</button></div>
                <?php } ?>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    function add_photo() {
        save_method = 'add';
        $('#modal_photo_form').modal('show'); // show bootstrap modal
        $('#viewPhoto').hide();
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function savePhoto() {
        var url;
        // CSRF Hash
        var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        var files = $('#file')[0].files;
        if (files.length > 0) {
            var fd = new FormData();
            // Append data 
            fd.append('file', files[0]);
            fd.append([csrfName], csrfHash);
        }

        // ajax adding data to database
        $.ajax({
            url: "<?= base_url('identitas/photo/add'); ?>",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                //if success close modal and reload ajax table
                $('#modal_identitas_form').modal('hide');
                location.reload(); // for reload a page
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    }
</script>

<div class="modal fade" id="modal_photo_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- input photo -->
            <div class="modal-header bg-primary text-white">
                <h6 class="modal-title"><b>Photo Profile</b></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
            </div>
            <div class="modal-body form">
                <form method="post" action="#" id="form" enctype="multipart/form-data">
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="form-group">
                        <label for="file">Upload File:</label><br />
                        <input type="file" id="file" name="file" />
                        <!-- Error -->
                        <div class='alert alert-danger mt-2 d-none' id="err_file">Maaf File Anda Tidak Bisa Di Upload !</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="savePhoto()" class="btn btn-primary"><i class="far fa-save"></i>&nbsp;&nbsp;Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i>&nbsp;&nbsp;Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<?= $this->endSection(); ?>