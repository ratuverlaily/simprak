<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">
    <div class="card o-hidden shadow-lg my-5">
        <div class="alert-primary p-3 text-center">
            <b>SEKOLAH</b>
        </div>
        <div class="card-body">

            <div class="card w-50 mx-auto">
                <div class="card-body">
                    <div class="alert alert-danger text-center" role="alert">
                        <h8 class="card-title"><b>IDENTITAS SEKOLAH</b></h8>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-3">
                                    Nama
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    <?= $nama; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    Alamat
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    <?= $alamat; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    Kode Pos
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    <?= $kode_pos; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    No Telpon
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    <?= $no_tlp; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    Nomor Fax
                                </div>
                                <div class="col-sm-1">
                                    :
                                </div>
                                <div class="col">
                                    <?= $no_fax; ?>
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

<?= $this->endSection(); ?>