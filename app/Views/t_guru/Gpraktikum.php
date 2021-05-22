<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/datepacker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/datepacker/bootstrap-datepicker.css">

<div class="container-fluid">
    <div class="alert alert-primary o-hidden shadow-lg" role="alert">
        <h6 align="center"><b>DAFTAR PRAKTIKUM</b></h6>
    </div>

    <div class="card o-hidden shadow-lg my-2">
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

            <div class="d-flex bd-highlight mb-3">
                <div class="p-2 bd-highlight">
                    <button class="btn btn-primary" onclick="add_praktikum()"><i class="fas fa-plus-square"></i> Tambah Praktikum</button>
                </div>
                <div class="ml-auto p-2 bd-highlight">
                    <?= $pager->links('praktikum', 'praktikum_pagination'); ?>
                </div>
            </div>

            <?php $no = 1;
            date_default_timezone_set('Asia/Jakarta');

            foreach ($praktikums as $praktikum) {
                $waktu = $praktikum['tgl_publis'] . " " . $praktikum['waktu_publis'];
                $waktu_sistem = $waktu;
                $wakru_sekarang = date('Y-m-d H:i:s');

                $waktu_batas = $praktikum['tgl_batas'] . " " . $praktikum['waktu_batas'];

                $getGames[$praktikum['id_games']] = $praktikum['id_games'];

                if ($waktu_batas >= $wakru_sekarang) {
                    $bgcolor = "";
                    $status = "";
                } else {
                    $bgcolor = "alert-danger";
                    $status = "EXPIRED";
                }

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
                        <div class="col-sm-11 ">
                            <button type="button" class="list-group-item list-group-item-action" onclick="location.href='<?= base_url('praktikum/guru/detail'); ?>/<?php echo $praktikum['id_praktikum'] ?>'">
                                <div class="row <?php echo  $bgcolor; ?>">
                                    <div class="col-sm-10 p-2">
                                        <b><small><?php echo $praktikum['username'] ?>, <?php echo $praktikum['tgl_publis']; ?></small></b><br />
                                        <b><?php echo $praktikum['judul']; ?></b><br />
                                    </div>
                                    <div class="col-sm-2 p-3">
                                        <h5 class="text-center"> <i class="fas fa-engine-warning"></i>
                                            <?php echo $status ?></h5>
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


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog mw-100 w-75">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><b>PRAKTIKUM</b></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body form">

                <form action="<?= base_url('G_modul/modul_add'); ?>" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" value="" name="id_praktikum" />
                    <div class="row">
                        <!--input data-->

                        <div class="col-md-7">
                            <div class="card o-hidden shadow-lg ">
                                <div class="card-body text-secondary">
                                    <div class="alert alert-primary" role="alert">
                                        <h6 class="card-title text-center"><b>INPUT DATA</b></h6>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label col-md-3 text-align: right">Judul</label>
                                            <input name="judul" placeholder="Judul" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label col-md-3">Komentar</label>
                                            <textarea name="komentar" class="form-control" id="exampleFormControlTextarea1" placeholder="Komentar" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <small>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p class="text-danger">&nbsp;&nbsp;&nbsp;Keterangan :<br />
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Symbol ( / ) => Enter<br />
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Symbol ( & ) => Nambah Space<br />
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Symbol ( # kelimat #/ ) => bold<br />
                                                </p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="text-danger"><br />
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Symbol ( * kelimat */ ) => underline<br />
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Symbol ( ^ kelimat ^/ ) => italic<br />
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Symbol ( [ kelimat ] ) => Rata Kanan Kiri<br />
                                                </p>
                                            </div>
                                        </div>
                                    </small>
                                </div>
                            </div>
                            <br />
                        </div>

                        <!-- input kelas -->
                        <div class="col-md-5">
                            <div class="card o-hidden shadow-lg ">
                                <div class="card-body text-secondary">
                                    <div class="alert alert-primary" role="alert">
                                        <h6 class="card-title text-center"><b>INPUT KELAS</b></h6>
                                    </div>
                                    <div class="row">
                                        <?php $no = 1;
                                        foreach ($kelass as $kelas) {
                                            if ($kelas->kode == session()->get('kode_kelas')) {
                                                $ceked = "checked";
                                            } else {
                                                $ceked = "";
                                            }
                                        ?>
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input name="kelas[]" class="form-check-input" type="checkbox" value="<?php echo $kelas->kode ?>" id="flexCheckDefault" <?php echo $ceked; ?>>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        <?php echo $kelas->nama; ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php $no++;
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <br />

                            <!-- tanggal posting -->
                            <div class="card o-hidden shadow-lg ">
                                <div class="card-body text-secondary">
                                    <div class="alert alert-primary" role="alert">
                                        <h6 class="card-title text-center"><b>POSTING</b></h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 dates">
                                            <label>Tanggal</label>
                                            <input name="tanggal_posting" type="text" class="form-control" id="usr1" name="event_date" placeholder="YYYY-MM-DD" autocomplete="off">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Waktu</label>
                                            <input name="waktu_posting" type="time" class="form-control" placeholder="8.30" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br />

                            <!-- input tanggal batas -->
                            <div class="card o-hidden shadow-lg ">
                                <div class="card-body text-secondary">
                                    <div class="alert alert-primary" role="alert">
                                        <h6 class="card-title text-center"><b>BATAS PENGUMPULAN</b></h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 dates">
                                            <label>Tanggal</label>
                                            <input name="tanggal_batas" type="text" class="form-control" id="usr1" name="event_date" placeholder="YYYY-MM-DD" autocomplete="off">
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Waktu</label>
                                            <input name="waktu_batas" type="time" class="form-control" placeholder="8.30" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br />
                        </div>

                        <!-- input praktikum -->
                        <div class="col-md-12">
                            <div class="card o-hidden shadow-lg ">
                                <div class="card-body text-secondary">
                                    <div class="alert alert-primary" role="alert">
                                        <h6 class="card-title text-center"><b>JENIS PRAKTIKUM</b></h6>
                                    </div>
                                    <div class="row">

                                        <?php $no = 1;
                                        foreach ($games as $game) {
                                            if (!empty($getGames[$game->id_games])) {

                                                $disable = "disabled";
                                            } else {
                                                $disable = "";
                                            }

                                        ?>
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input name="games" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="<?php echo $game->id_games ?>" <?php echo $disable; ?>>
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        <b><?php echo $game->judul; ?></b><br />
                                                        <small><?php echo $game->modul; ?></small><br />
                                                        <a href="<?php echo base_url() . "/file/" . $game->link ?>" target="_blank">View Modul</a>
                                                        <hr />
                                                    </label>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
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

<script type="text/javascript">
    $(function() {
        $('.dates #usr1').datepicker({
            'format': 'yyyy-mm-dd',
            'autoclose': true
        });
    });

    $(document).ready(function() {
        $('#table_id').DataTable();
    });
    var save_method; //for save method string
    var table;

    function add_praktikum() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_modul(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        <?php header('Content-type: application/json'); ?>
        //Ajax Load data from ajax
        $.ajax({
            url: "<?= base_url('G_modul/ajax_edit'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data);

                $('[name="id_modul"]').val(data.id_modul);
                $('[name="judul"]').val(data.judul);
                $('[name="keterangan"]').val(data.keterangan);

                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit modul'); // Set title to Bootstrap modal title

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
            url = "<?= base_url('praktikum/tambah'); ?>";
        } else {
            url = "<?= base_url('praktikum/ubah'); ?>";
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

    function view_pdf_praktikum() {
        $('#form')[0].reset(); // reset form on modals
        $('#modal_praktikum_form').modal('show');
    }

    function delete_modul(id) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data from database
            $.ajax({
                url: "<?= base_url('G_modul/modul_delete'); ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {

                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });

        }
    }

    $('#sandbox-container input').datepicker({});
</script>

<?= $this->endSection(); ?>