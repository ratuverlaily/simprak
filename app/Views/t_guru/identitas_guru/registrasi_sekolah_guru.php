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

            <?php if ($status == 1) { ?>
                <div class="p-2 bd-highlight"><button class="btn btn-primary" onclick="edit_sekolah()"><i class="fas fa-edit"></i> Update Sekolah</button></div>
            <?php } else { ?>
                <div class="p-2 bd-highlight"><button class="btn btn-primary" onclick="add_sekolah()"><i class="fas fa-plus-square"></i> Input Sekolah</button></div>
            <?php } ?>

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
                <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url() ?>/identitas/guru'"><i class="fas fa-forward"></i> Selanjutnya</button></div>
            </div>

        </div>
    </div>
</div>

<script>
    function add_sekolah() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function save() {
        var url;
        if (save_method == 'add') {
            url = "<?= base_url('G_sekolah/sekolah_add'); ?>";
        } else {
            url = "<?= base_url('G_sekolah/sekolah_update'); ?>";
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
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

    function edit_sekolah(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        <?php header('Content-type: application/json'); ?>
        //Ajax Load data from ajax
        $.ajax({
            url: "<?= base_url('identitas/sekolah/edit'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data);

                $('[name="id_sekolah"]').val(data.id_sekolah);
                $('[name="nama"]').val(data.nama);
                $('[name="alamat"]').val(data.alamat);
                $('[name="no_tlp"]').val(data.no_tlp);
                $('[name="no_fax"]').val(data.no_fax);
                $('[name="kode_pos"]').val(data.kode_pos);

                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Sekolah'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        var url;
        if (save_method == 'add') {
            url = "<?= base_url('identitas/sekolah/add'); ?>";
        } else {
            url = "<?= base_url('identitas/sekolah/update'); ?>";
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
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
</script>
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Sekolah Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body form">

                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" value="" name="id_sekolah" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input name="nama" placeholder="Nama" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <input name="alamat" placeholder="Alamat" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kode Pos</label>
                            <div class="col-md-9">
                                <input name="kode_pos" placeholder="Kode Pos" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No Telpon</label>
                            <div class="col-md-9">
                                <input name="no_tlp" placeholder="Nomor Telpon" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No Fax</label>
                            <div class="col-md-9">
                                <input name="no_fax" placeholder="No Fax" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<?= $this->endSection(); ?>