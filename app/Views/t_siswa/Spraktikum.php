<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>
<div class="container">
    <br />
    <div class="alert alert-primary shadow-lg" role="alert">
        <h6 align="center"><b>DAFTAR PRAKTIKUM</b></h6>
    </div>
    <div class="card shadow-lg my-1">
        <div class="card-body">


            <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Halaman 1
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item" type="button">Action</button>
                    <button class="dropdown-item" type="button">Another action</button>
                    <button class="dropdown-item" type="button">Something else here</button>
                </div>
            </div><br /><br />

            <?php $no = 1;
            date_default_timezone_set('Asia/Jakarta');

            foreach ($praktikums as $praktikum) {
                $waktu = $praktikum->tgl_publis . " " . $praktikum->waktu_publis;
                $waktu_sistem = $waktu;
                $wakru_sekarang = date('Y-m-d H:i:s');
                if ($waktu_sistem <= $wakru_sekarang) {
            ?>
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="alert-secondary my-3">
                                <p align="center" class="p-2">
                                    <i class="fas fa-plug fa-2x"></i>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-11">
                            <button type="button" class="list-group-item list-group-item-action" onclick="location.href='<?= base_url('praktikum/detail'); ?>/<?php echo $praktikum->id_praktikum ?>'">
                                <div class="row">
                                    <div class="col-sm-11 p-2">
                                        <b><small><?php echo $praktikum->username ?>, <?php echo $praktikum->tgl_publis; ?></small></b><br />
                                        <b><?php echo $praktikum->judul; ?></b><br />
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div><br />
            <?php
                }
            } ?>

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