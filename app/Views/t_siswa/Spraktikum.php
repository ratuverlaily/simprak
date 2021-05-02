<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>
<div class="container-fluid">
    <div class="card o-hidden shadow-lg my-5">
        <div class="card-body">
            <br />
            <div class="alert alert-primary" role="alert">
                <h6 align="center"><b>DAFTAR PRAKTIKUM</b></h6>
            </div>
            <br />

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
            foreach ($praktikums as $praktikum) { ?>
                <div class="list-group" style="background-color: #E9EFF1;">
                    <button type="button" class="list-group-item list-group-item-action" onclick="location.href='<?= base_url('praktikum/detail'); ?>/<?php echo $praktikum->id_praktikum ?>'">
                        <div class='row'>
                            <div class='col-sm-1'>
                                <img class="img-profile rounded-circle" src="<?= base_url() ?>/uploads/<?= $praktikum->user_image; ?>" style="width:50px;height:50px;">
                            </div>
                            <div class='col-sm'>
                                <div class="row">
                                    <div class='col-sm-3'><small> Posting : <?php echo $praktikum->tgl_publis; ?></small></div>
                                    <div class='col-sm-6'></div>
                                    <div class='col-sm-3'><small> Pengumpulan : <?php echo $praktikum->tgl_batas; ?></small></div>
                                </div>
                            </div>

                            <div class='col-sm-12'><br /><b><i class="fa fa-tasks"></i>&nbsp;&nbsp;<?php echo $praktikum->judul; ?></b><br />
                                <hr />
                                <?php echo $praktikum->komentar; ?>
                            </div>
                        </div>
                    </button>
                    <div class='col-sm-12 text-black'><br />
                        <div class="col-auto">
                            Komentar
                            <label class="sr-only" for="inlineFormInputGroup">Username</label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="komentar">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="far fa-paper-plane"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                </div><br />
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

    function add_modul() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }
</script>

<?= $this->endSection(); ?>