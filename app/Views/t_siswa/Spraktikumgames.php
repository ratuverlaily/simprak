<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>
<div class="container-fluid">
    <div class="card o-hidden shadow-lg my-5">
        <div class="card-body">
            <br /><br /><br />
            <div class="card w-50 mx-auto">
                <div class="card-body">
                    <div class="alert alert-danger text-center" role="alert">
                        <h6 class="card-title"><b>AKUN LOGIN GAMES PRAKTIKUM</b><br />
                            <small>Silahkan login pada game praktikum melalui registrasi ini !</small>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4">
                                    Email
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    <?= session()->get('email'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    Password
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    ############ <br /><small class="text-danger">Password sama seperti login di Web !</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    Kode Praktikum
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    <?php echo $kode_praktikum; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br /><br /><br />


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