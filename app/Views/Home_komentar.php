<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>
<div class="container">
    <br />
    <div class="alert alert-primary shadow-lg" role="alert">
        <h6 align="center"><b>DETAIL HOME</b></h6>
    </div>
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
            <br />

            <button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url('home'); ?>'"><i class="fas fa-backward"></i> Kembali</button>
            <br /><br />
            <div class="row bg-light p-2">
                <div class="col-sm-1 bg-light">
                    <div class="alert-secondary my-3">
                        <p align="center" class="p-2">
                            <?php if ($posting->status == "info") { ?>
                                <i class="fas fa-info-circle fa-2x"></i>
                            <?php } else { ?>
                                <i class="fas fa-plug fa-2x"></i>
                            <?php } ?>
                        </p>
                    </div>
                </div>
                <div class="col-sm-11">
                    <div class="row">
                        <div class="col-sm-11 bg-light p-2">
                            <b><small><?php echo $posting->username; ?>, <?php echo $posting->update_date; ?></small></b><br />
                            <b><?php echo $posting->judul; ?></b><br />
                            <hr />
                            <?php

                            $a = array('/', '&', '#', '#/', '*', '*/', '^', '^/', '[', ']', '~', '/~');
                            $b = array('<br/>', '&nbsp;', '<b>', '</b>', '<u>', '</u>', '<i>', '</i>', '<p align="justify">', '</p>', '<h1 align="center">', '</h1>');
                            echo str_replace($a, $b, $posting->posting);

                            ?><br />
                            <?php echo $posting->link_web; ?>
                            <?php if (!empty($posting->link_web)) { ?>
                                <p><a href="<?php echo $posting->link_web; ?>">Link Web Tutorial Praktikum</a></p>
                            <?php } ?>

                            <?php if (!empty($posting->link_youtube)) { ?>
                                <p><a href="<?php echo $posting->link_youtube; ?>">Link Youtube Tutorial Praktikum</a></p>
                            <?php } ?>
                        </div>
                        <div class="col-sm bg-light">
                            <?php if (session()->get('username') == $posting->username && empty($komentar)) { ?>
                                <div class="btn-group my-3">
                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" href="<?php echo base_url() ?>/users/posting/hapus/<?php echo $posting->id_posting; ?>">Hapus</a>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12 bg-light">
                            <?php if (!empty($posting->file)) { ?>
                                <div class="d-flex justify-content-left bd-highlight">
                                    <div class="p-2 bd-highlight"><button class="btn btn-primary" onclick="location.href='<?= base_url() ?>/users/komentar/pdf/<?= $posting->id_posting ?>'"><i class="fas fa-cloud-download-alt"></i> Lihat</button></div>
                                </div>
                            <?php } ?>
                            <br />
                        </div>
                    </div>
                </div>

                <div class='col-sm-12 bg-light'>

                    <form method="post" action="<?php echo base_url() ?>/users/komentar/<?php echo $posting->id_posting; ?>" id="form" enctype="multipart/form-data">
                        <input type="hidden" class="txt_csrfname_registrasi" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <div class="form-group">
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" name="komentar_<?php echo $posting->id_posting; ?>" placeholder="Komentar" value="" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary" onclick=""><i class="far fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php if ($jml_komentar->jumlah > 0) { ?>
                        <small><b>Komentar : <?= $jml_komentar->jumlah; ?> Orang</b></small>
                    <?php } ?>

                    <?php if (!empty($komentar)) { ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($komentar as $kmt) { ?>
                                        <div class="col-sm-1">
                                            <img class="img-profile rounded-circle" src="<?= base_url() ?>/uploads/<?php echo $kmt->user_image ?>" style="width:40px; height:40px;">
                                        </div>
                                        <div class="col-sm-11">
                                            <div class="d-flex bd-highlight">
                                                <div class="bd-highlight"><b><?php echo $kmt->username ?></b>, <small><?php echo $kmt->tanggal ?></small></div>
                                                <?php if ($kmt->username == session()->get('username')) { ?>
                                                    <div class="ml-auto p-2 bd-highlight"><small><a href="<?= base_url() ?>/users/komentar/orang/<?php echo $kmt->id_komentar ?>_<?php echo $posting->id_posting ?>">Hapus</a></small></div>
                                                <?php } else { ?>
                                                    <div class="ml-auto p-2 bd-highlight"><small><a href="#"></a></small></div>
                                                <?php } ?>
                                                <!-- exploade() -->
                                            </div>
                                            <?php echo $kmt->komentar ?>
                                            <hr />
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <br />
                </div>
            </div>
            <br />

        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
    var save_method; //for save method string
    var table;

    function add_posting() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function view_komentar(id) {
        <?php header('Content-type: application/json'); ?>
        //Ajax Load data from ajax
        $("#table_data").empty();
        $.ajax({
            url: "<?= base_url('users/komentar/view'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                //if success close modal and reload ajax table
                $('#modal_komentar_form').modal('show');
                location.reload(); // for reload a page
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    }

    function savePosting() {
        var url;
        // CSRF Hash
        var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash
        var judul = $('#judul').val();
        var komentar = $('#komentar').val();

        var files = $('#file')[0].files;
        //if (files.length > 0) {
        var fd = new FormData();
        // Append data 
        fd.append('file', files[0]);
        fd.append('judul', judul);
        fd.append('komentar', komentar);
        fd.append([csrfName], csrfHash);
        //}

        // ajax adding data to database
        $.ajax({
            url: "<?= base_url('users/posting'); ?>",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                //if success close modal and reload ajax table
                $('#modal_form').modal('hide');
                location.reload(); // for reload a page
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    }

    function add_komentar(id) {
        console.log(id);
    }
</script>

<?= $this->endSection(); ?>