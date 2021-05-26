<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>
<div class="container-fluid">
    <div class="alert alert-primary shadow-lg" role="alert">
        <h6 align="center"><b>HOME</b></h6>
    </div>
    <div class="card my-1 shadow-lg">
        <div class="card-body">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <a class="btn btn-primary" href="<?php echo base_url() ?>/home/form"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Posting</a>
                </div>
                <div class="ml-auto p-2">
                    <?= $pager->links('posting', 'posting_pagination'); ?>
                </div>
            </div>

            <!-- <a href="downloads/setup.exe">Download EXE file</a> -->

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

            <?php foreach ($posting as $pst) { ?>
                <div class="row bg-light">
                    <div class="col-sm-1 bg-light">
                        <div class="alert-secondary my-3">
                            <p align="center" class="p-2">
                                <?php if ($pst['status'] == "info") { ?>
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
                                <b><small><?php echo $pst['username']; ?>, <?php echo $pst['update_date']; ?></small></b><br />
                                <b><?php echo $pst['judul']; ?><br /></b>
                            </div>
                            <div class="col-sm bg-light">
                                <div class="btn-group my-3">
                                    <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <?php if ($pst['status'] == "info") { ?>
                                            <a class="dropdown-item" href="<?php echo base_url() ?>/users/komentar/detail/<?php echo $pst['id_posting']; ?>">Lihat Detail</a>
                                        <?php } else { ?>
                                            <?php if (session()->get('level') == 1) { ?>
                                                <a class="dropdown-item" href="<?php echo base_url() ?>/praktikum/detail/<?php echo $pst['id_praktikum']; ?>">Lihat Detail</a>
                                            <?php } else { ?>
                                                <a class="dropdown-item" href="<?php echo base_url() ?>/praktikum/guru/detail/<?php echo $pst['id_praktikum']; ?>">Lihat Detail</a>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
            <?php } ?>

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
        var link_web = $('#link_web').val();
        var link_youtube = $('#link_youtube').val();

        var files = $('#file')[0].files;
        var fd = new FormData();
        // Append data 
        fd.append('file', files[0]);
        fd.append('judul', judul);
        fd.append('komentar', komentar);
        fd.append('link_web', link_web);
        fd.append('link_youtube', link_youtube);
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


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class=" modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><b>POSTING</b></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body form">

                <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="savePosting()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<?= $this->endSection(); ?>