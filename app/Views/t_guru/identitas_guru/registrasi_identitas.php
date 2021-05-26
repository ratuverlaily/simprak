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
                    <a class="nav-link active" href="<?= base_url() ?>/identitas/identitas">Identitas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="coba" href="<?= base_url() ?>/identitas/kelas">Kelas</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" id="coba" href="<?= base_url() ?>/identitas/sekolah">Sekolah</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="coba" href="<?= base_url() ?>/identitas/password">Ubah Password</a>
                </li>
            </ul>
            <br />

            <h6 align="center"><u><b>Data Identitas User</b></u></h6>

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


            <div class="p-2 bd-highlight"><button class="btn btn-primary" onclick="edit_identitas()"><i class="fas fa-edit"></i> Update Data Diri</button></div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card border-secondary" style="max-width: 35rem;">
                        <div class="card-body text-secondary">
                            <div class="alert alert-primary" role="alert">
                                <h6 align="center"><b>Data Diri</b></h6>
                            </div>
                            <br />
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-8">
                                    <input type="text" name="fullname" class="form-control" value="<?= $fullname; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-8">
                                    <input type="text" name="jenis_kelamin" class="form-control" value="<?= $jenis_kelamin; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4 col-form-label">Nomor Telpon</label>
                                <div class="col-sm-8">
                                    <input type="text" name="no_tlp" class="form-control" value="<?= $no_telpon; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="alamat" id="alamat" rows="3" readonly><?= $alamat; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-secondary" style="max-width: 35rem;">
                        <div class="card-body text-secondary">
                            <div class="alert alert-primary" role="alert">
                                <h6 align="center"><b>Daftar Kelas</b></h6>
                            </div><br />
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4">Email</label>
                                <div class="col-sm-8">
                                    <i class="fab fa fa-envelope"></i>&nbsp; <?= $email; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4">Facebook</label>
                                <div class="col-sm-8">
                                    <i class="fab fa-facebook-square"></i>&nbsp; <?= $facebook; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4">Instagram</label>
                                <div class="col-sm-8">
                                    <i class="fab fa-instagram-square"></i>&nbsp; <?= $instagram; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-4">Twitter</label>
                                <div class="col-sm-8">
                                    <i class="fab fa-twitter-square"></i>&nbsp; <?= $twetter; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4">LinkedIn</label>
                                <div class="col-sm-8">
                                    <i class="fab fa-linkedin"></i>&nbsp; <?= $linkedIn; ?>
                                </div>
                            </div><br />
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between bd-highlight">
                <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url() ?>/identitas/photo'"><i class="fas fa-backward"></i> Sebelumnya</button></div>
                <div class="p-5 bd-highlight"><button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url() ?>/identitas/kelas'"><i class="fas fa-forward"></i> Selanjutnya</button></div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function add_identitas() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_identitas_form').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_identitas() {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        <?php header('Content-type: application/json'); ?>
        //Ajax Load data from ajax
        $.ajax({
            url: "<?= base_url('identitas/identitas/view'); ?>",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="email"]').val(data.email);
                $('[name="password"]').val(data.password);
                $('[name="fullname"]').val(data.fullname);
                $("input[name=jenis_kelamin][value='" + data.jenis_kelamin + "']").prop("checked", true);
                $('[name="no_telpon"]').val(data.no_telpon);
                $('[name="alamat"]').val(data.alamat);
                $('[name="facebook"]').val(data.facebook);
                $('[name="instagram"]').val(data.instagram);
                $('[name="tweter"]').val(data.tweter);
                $('[name="linkedIn"]').val(data.linkedIn);
                $('[name="tanggal"]').val(data.tanggal);

                $('#modal_identitas_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data Diri'); // Set title to Bootstrap modal title*/

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                alert('Error get data from ajax');
            }
        });
    }

    function saveidentitas() {
        var url;
        if (save_method == 'add') {
            url = "<?= base_url('identitas/identitas/add'); ?>";
        } else {
            url = "<?= base_url('identitas/identitas/add'); ?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {
                //if success close modal and reload ajax table
                $('#modal_identitas_form').modal('hide');
                location.reload(); // for reload a page
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
            }
        });
    }
</script>

<!-- Bootstrap modal IDENTITAS DIRI -->
<div class="modal fade" id="modal_identitas_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h6 class="modal-title"><b>Daftar Identitas</b></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body form">
                <form method="post" action="#" id="form" enctype="multipart/form-data">
                    <input type="hidden" class="txt_csrfname_identitas" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <div class="form-body">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" name="email" class="form-control" id="email" placeholder="Nama Lengkap" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" class="form-control" id="email" placeholder="password" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" name="fullname" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 ">Jenis Kelamin</label>
                            <div class="col-sm-7">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-Laki">
                                    <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan">
                                    <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Nomor Telpon</label>
                            <div class="col-sm-8">
                                <input type="text" name="no_telpon" class="form-control" id="nomor_telpon" placeholder="Nomor Telpon">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Alamat"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Media Sosial</label>
                            <div class="col-sm-8">

                                <div class="row">
                                    <div class="col-sm-6 dates">
                                        <label>Facebook</label>
                                        <input name="facebook" type="text" class="form-control" id="facebook" placeholder="@nama_akun">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Instagram</label>
                                        <input name="instagram" type="text" class="form-control" id="instagram" placeholder="@nama_akun" />
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-sm-6 dates">
                                        <label>Twitter</label>
                                        <input name="tweter" type="text" class="form-control" id="tweter" placeholder="@nama_akun">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>LinkedIn</label>
                                        <input name="linkedIn" type="text" class="form-control" id="linkedIn" placeholder="@nama_akun" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="saveidentitas()" class="btn btn-primary"><i class="far fa-save"></i>&nbsp;&nbsp;Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i>&nbsp;&nbsp;Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->



<?= $this->endSection(); ?>