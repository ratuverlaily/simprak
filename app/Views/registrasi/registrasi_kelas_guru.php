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
                        <a class="nav-link active" id="coba" href="#">Kelas</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="coba" href="<?= base_url() ?>/users/kelas">Kelas</a>
                    </li>
                <?php } ?>

                <?php if ($kelas == 0) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sekolah</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" id="coba" href="<?= base_url() ?>/users/sekolah">Sekolah</a>
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

            <div class="p-2 bd-highlight"><button class="btn btn-primary" onclick="add_kelas()"><i class="fas fa-plus-square"></i> Daftar Kelas</button></div>
            <br /><br />
            <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Jumlah</th>
                        <th>Kode</th>
                        <th align="center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kelass as $kelas) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $kelas->nama; ?></td>
                            <td><?php echo $kelas->jurusan; ?></td>
                            <td><?php echo $kelas->jumlah; ?></td>
                            <td><b><?php echo $kelas->kode; ?></b></td>
                            <td>
                                <button class="btn btn-primary" onclick="edit_kelas(<?php echo $kelas->id_kelas; ?>)"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Jumlah</th>
                        <th>Kode</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>

            <div class="d-flex justify-content-between bd-highlight">
                <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url('logout'); ?>'"><i class="fas fa-backward"></i> Keluar</button></div>
                <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url() ?>/users/sekolah'"><i class="fas fa-forward"></i> Selanjutnya</button></div>
            </div>

        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function add_kelas() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form_kelas').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_kelas(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        <?php header('Content-type: application/json'); ?>
        //Ajax Load data from ajax
        $.ajax({
            url: "<?= base_url('users/kelas/guru/edit'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data);

                $('[name="id_kelas"]').val(data.id_kelas);
                $('[name="nama"]').val(data.nama);
                $('[name="jurusan"]').val(data.jurusan);
                $('[name="jumlah"]').val(data.jumlah);

                $('#modal_form_kelas').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit kelas'); // Set title to Bootstrap modal title

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
            url = "<?= base_url('users/kelas/guru/add'); ?>";
        } else {
            url = "<?= base_url('users/simpankelas'); ?>";
        }

        // CSRF Hash
        var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {
                //if success close modal and reload ajax table
                $('#modal_form_kelas').modal('hide');
                location.reload(); // for reload a page
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    }
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_kelas" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><b>Daftar Kelas</b></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

            </div>
            <div class="modal-body form">

                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" value="" name="id_kelas" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Kelas</label>
                            <div class="col-md-9">
                                <input name="nama" placeholder="Input Kode Kelas" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jurusan</label>
                            <div class="col-md-9">
                                <input name="jurusan" placeholder="Input Kode Kelas" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jumlah</label>
                            <div class="col-md-9">
                                <input name="jumlah" placeholder="Input Kode Kelas" class="form-control" type="text">
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