<?= $this->extend('auth/templates_login/index'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="card o-hidden shadow-lg my-5 text-center">
        <br /><br />
        <h4>APLIKASI PRAKTIKUM VIRTUAL ONLINE</h4>
        <h4>BERBASIS 3D GAME</h4><br /><br />

        <h2><b>SELAMAT DATANG</b></h2><br />
        <h5><b>Kepada : <?php echo session()->get('username'); ?> (Guru)</b></h5>
        <br />

        <h5>Aktifkan proritas kelas anda, yang lebih dahulu ingin melakukan praktikum ?..</h5>

        <div class="card w-50 mx-auto">
            <div class="card-body">
                <div class="alert alert-primary text-center" role="alert">
                    <h8 class="card-title"><b>AKTIFASI KELAS PRAKTIKUM</b></h8>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo base_url() ?>/users/aktivasi/kelas" id="form" enctype="multipart/form-data">

                        <input type="hidden" class="txt_csrfname_registrasi" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <div class="form-group">
                            <div class="input-group-sm mb-3">
                                <label>Pilih Kelas</label>
                                <select class="custom-select" name="aktifasi_kelas" id="inputGroupSelect03">
                                    <?php foreach ($kelass as $kelas) { ?>
                                        <option value="<?php echo $kelas->kode ?>"><?php echo $kelas->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">Mulai</button>
                    </form>
                </div>
            </div>
        </div>
        <br /><br />
    </div>
</div>


<!-- End Bootstrap modal -->
<?= $this->endSection(); ?>