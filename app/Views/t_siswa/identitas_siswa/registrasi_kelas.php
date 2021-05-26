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
                    <a class="nav-link active" id="coba" href="<?= base_url() ?>/identitas/kelas">Kelas</a>
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

            <div class="p-2 bd-highlight"><button class="btn btn-primary" onclick="add_kelas()"><i class="fas fa-plus-square"></i> Daftar Kelas</button></div>

            <div class="card w-50 mx-auto">
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        <h8 class="card-title"><b>KELAS YANG DI AMBIL</b></h8>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">Kode Kelas</div>
                        <div class="col-sm-8">:&nbsp;&nbsp;<?php echo $kode; ?></div>
                        <div class="col-sm-4">Nama Kelas</div>
                        <div class="col-sm-8">:&nbsp;&nbsp;<?php echo $nama; ?></div>
                        <div class="col-sm-4">Mata Pelajaran</div>
                        <div class="col-sm-8">:&nbsp;&nbsp;<?php echo $jurusan; ?></div>
                        <div class="col-sm-4">Pengajar</div>
                        <div class="col-sm-8">:&nbsp;&nbsp;<b><?php echo $nama_guru; ?></b></div>
                        <div class="col-sm-4">Status</div>
                        <div class="col-sm-8">:&nbsp;&nbsp;<button type="button" class="btn btn-danger" disabled><?php echo $status; ?></button></div>
                        <div class="col-sm-10"></div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between bd-highlight">
                <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url() ?>/identitas/identitas'"><i class="fas fa-backward"></i> Sebelumnya</button></div>
                <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url() ?>/identitas/sekolah'"><i class="fas fa-forward"></i> Selanjutnya</button></div>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
    function add_kelas() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function save() {
        // CSRF Hash
        var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

        // ajax adding data to database
        $.ajax({
            url: "<?= base_url('identitas/kelas/add'); ?>",
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

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><b>Daftar Kelas</b></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

            </div>
            <div class="modal-body form">

                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Kode Kelas</label>
                            <div class="col-md-9">
                                <input name="kode_kelas" placeholder="Input Kode Kelas" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary"><i class="far fa-save"></i>&nbsp;&nbsp;Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i>&nbsp;&nbsp;Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<?= $this->endSection(); ?>