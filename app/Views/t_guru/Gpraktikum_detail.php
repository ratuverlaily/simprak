<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<script type="text/javascript" src="<?= base_url() ?>/datepacker/bootstrap-datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/datepacker/bootstrap-datepicker.css">

<div class="container-fluid">
    <?php
    $dt = json_encode($tampildata);
    $hsl = json_decode($dt, true);
    ?>

    <?php
    date_default_timezone_set('Asia/Jakarta');

    $waktu_posting = $hsl['tgl_publis'] . " " . $hsl['waktu_publis'];
    $waktu_batas = $hsl['tgl_batas'] . " " . $hsl['waktu_batas'];
    $wakru_sekarang = date('Y-m-d H:i:s');

    if ($waktu_batas >= $wakru_sekarang) { ?>
        <br />
        <div class="alert alert-primary" role="alert">
            <h6 align="center"><b>PRAKTIKUM</b></h6>
        </div>
    <?php } else { ?>
        <br />
        <div class="alert alert-danger" role="alert">
            <h6 align="center"><b>PRAKTIKUM SUDAH SELESAI</b></h6>
        </div>
    <?php } ?>

    <div class="card shadow-lg my-1">
        <div class="card-body">
            <?php if ($waktu_batas >= $wakru_sekarang) { ?>
                <div class="d-flex flex-row-reverse">
                    <div class="p-2">
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo base_url() ?>/praktikum/hapus/<?php echo $hsl['id_praktikum']; ?>">Hapus</a>
                                <a class="dropdown-item" onclick="edit_praktikum(<?php echo $hsl['id_praktikum']; ?>)">Update Praktikum</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-2">
                    Tanggal Posting
                </div>
                <div class="col">
                    : &nbsp;<?php echo $waktu_posting; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    Batas Pengumpulan
                </div>
                <div class="col">
                    : &nbsp;<?php echo $waktu_batas; ?>
                </div>
            </div><br />
            <div class="row">
                <div class="col-2">
                    Topik
                </div>
                <div class="col">
                    : &nbsp;<?php echo $hsl['judul']; ?>
                </div>
            </div><br />
            <div class="row">
                <div class="col-2">
                    Komentar
                </div>
                <div class="col">
                    <?php

                    $a = array('/', '&', '#', '#/', '*', '*/', '^', '^/', '[', ']', '~', '/~');
                    $b = array('<br/>', '&nbsp;', '<b>', '</b>', '<u>', '</u>', '<i>', '</i>', '<p align="justify">', '</p>', '<h1 align="center">', '</h1>');
                    echo str_replace($a, $b, $hsl['komentar']);

                    ?>
                </div>
            </div>
            <br />
            <div class="row">

                <div class="col-2">
                    Modul Praktikum
                </div>
                <div class="col-4">
                    <a class="btn btn-primary" href="<?= base_url(); ?>/praktikum/modul/unduh/<?php echo $hsl['id_praktikum']; ?>"><i class="fas fa-download"></i></a>
                </div>
                <div class="col-2">
                    Aplikasi Praktikum <br />
                    ( Jika Belum Download )
                </div>
                <div class="col-4">
                    <a href="downloads/setup.exe"><i class="fas fa-download"></i> SIMPRAG.exe</a>
                </div>
            </div>
        </div><br />


        <div class="card mx-auto  alert-danger" style="width: 15rem;">
            <div class="card-body">
                <h6 class="card-title text-center">KODE PRAKTIKUM</h6>
                <hr />
                <p class="card-text text-center"><b><?php echo $hsl['kode_praktikum']; ?></b></p>
            </div>
        </div>

        <div class="d-flex justify-content-between bd-highlight mx-3">
            <div class="p-2 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url('praktikum/guru/list'); ?>'"><i class="fas fa-backward"></i> Kembali</button></div>
        </div>
        <br />
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
                                </div>
                            </div>
                        </div>

                        <!-- input kelas -->
                        <div class="col-md-5">
                            <div class="card o-hidden shadow-lg ">
                                <div class="card-body text-secondary">
                                    <div class="alert alert-primary" role="alert">
                                        <h6 class="card-title text-center"><b>INPUT KELAS</b></h6>
                                    </div>
                                    <div class="row">
                                        <?php $no = 0;
                                        foreach ($kelass as $kelas) { ?>
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input name="kelas[]" class="form-check-input" type="checkbox" value="<?php echo $kelas->kode ?>" id="flexCheckDefault">
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
                                        foreach ($games as $game) { ?>
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input name="games" class="form-check-input" type="radio" name="exampleRadios" id="games_<?php echo $no ?>" value="<?php echo $game->id_games ?>">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        <b><?php echo $game->judul; ?></b><br />
                                                        <small><?php echo $game->modul; ?></small><br />
                                                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
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


    function add_praktikum() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_praktikum(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        <?php header('Content-type: application/json'); ?>
        //Ajax Load data from ajax
        $.ajax({
            url: "<?= base_url('praktikum/guru/ubahview'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                var chk_arr = document.getElementsByName("kelas[]");
                var chklength = chk_arr.length;
                //console.log(chklength);
                for (k = 0; k < chklength; k++) {
                    if (chk_arr[k].value == data.kode_kelas) {
                        chk_arr[k].checked = true;
                    } else {
                        console.log(chk_arr[k]);
                        chk_arr[k].disabled = true;
                        //chk_arr[k].prop('disabled', true);
                    }
                }

                $('[name="judul"]').val(data.judul);
                $('[name="id_praktikum"]').val(data.id_praktikum);
                $('[name="komentar"]').val(data.komentar);
                $('[name="tanggal_batas"]').val(data.tgl_batas);
                $('[name="waktu_batas"]').val(data.waktu_batas);
                $('[name="tanggal_posting"]').val(data.tgl_publis);
                $('[name="waktu_posting"]').val(data.waktu_publis);
                $("input[value='" + data.id_games + "']").attr('checked', true);

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