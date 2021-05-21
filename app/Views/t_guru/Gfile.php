<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>

<div class="container-fluid">
    <div class="alert alert-primary o-hidden shadow-lg" role="alert">
        <h6 align="center"><b>DAFTAR MODUL</b></h6>
    </div>

    <div class="card m-b-30 o-hidden shadow-lg my-1">
        <div class="card-body">
            <?php if (session()->get('level') == 1) { ?>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo base_url('modul/siswa'); ?>">Modul Praktikum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url('modul/file/siswa'); ?>">Files</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('modul/myfile/siswa'); ?>">My File</a>
                    </li>
                </ul>
            <?php } else { ?>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('modul/guru'); ?>">Modul Praktikum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url('modul/file/guru'); ?>">Files</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('modul/myfile/guru'); ?>">Files Saya</a>
                    </li>
                </ul>
            <?php } ?>
            <br /><br />
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
                                <a class="btn btn-primary" href="<?= base_url(); ?>/modul/file/unduh/<?php echo $file->id_posting; ?>"><i class="fas fa-download"></i></a>
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

    function add_modul() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
</script>

<?= $this->endSection(); ?>