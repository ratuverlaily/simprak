<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>

<div class="container-fluid">
    <div class="alert alert-primary o-hidden shadow-lg" role="alert">
        <h6 align="center"><b>DAFTAR MODUL</b></h6>
    </div>

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
            <?php if (session()->get('level') == 1) { ?>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('modul/siswa'); ?>">Modul Praktikum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('modul/file/siswa'); ?>">Files</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url('modul/myfile/siswa'); ?>">My File</a>
                    </li>
                </ul>
            <?php } else { ?>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('modul/guru'); ?>">Modul Praktikum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('modul/file/guru'); ?>">Files</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url('modul/myfile/guru'); ?>">Files Saya</a>
                    </li>
                </ul>
            <?php } ?>
            <br />
            <div class="p-2 bd-highlight"><button class="btn btn-primary" onclick="add_file()"><i class="fas fa-plus-square"></i> Daftar Kelas</button></div>
            <br />
            <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:100px;">No</th>
                        <th>Judul</th>
                        <th>Action
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($files as $file) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $file->judul; ?></td>
                            <td align="center">
                                <a class="btn btn-primary" href="<?= base_url(); ?>/modul/myfile/unduh/<?php echo $file->id_posting; ?>"><i class="fas fa-download"></i></a>
                                <a class="btn btn-primary" href="<?= base_url(); ?>/modul/myfile/hapus/<?php echo $file->id_posting; ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
    var save_method; //for save method string
    var table;

    function add_file() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function saveFile() {
        var url;
        // CSRF Hash
        var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
        var csrfHash = $('.txt_csrfname').val(); // CSRF hash
        var judul = $('#judul').val();

        var files = $('#file')[0].files;
        var fd = new FormData();
        // Append data 
        fd.append('file', files[0]);
        fd.append('judul', judul);
        fd.append([csrfName], csrfHash);

        // ajax adding data to database
        $.ajax({
            url: "<?= base_url('modul/myfile/simpan'); ?>",
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
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><b>Upload File Pribadi</b></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body form">

                <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="saveFile()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<?= $this->endSection(); ?>