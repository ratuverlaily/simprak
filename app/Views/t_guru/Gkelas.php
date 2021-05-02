<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<div class="container">
    <div class="card o-hidden shadow-lg my-5">
        <div class="alert-primary p-3 text-center">
            <b>KELAS</b>
        </div>
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

            <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Jumlah</th>
                        <th>Kode</th>
                        <th align="center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kelass as $kelas) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $kelas->nama; ?></td>
                            <td><?php echo $kelas->jurusan; ?></td>
                            <td><?php echo $kelas->jumlah; ?></td>
                            <td><b><?php echo $kelas->kode; ?></b></td>
                            <?php if ($kelas->kelas_aktif == 1) { ?>
                                <td>
                                    <button class="btn btn-warning" onclick="location.href='<?= base_url(); ?>/kelas/aktivasi/<?php echo $kelas->id_kelas ?>'">Aktif</button>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <button class="btn btn-primary" onclick="location.href='<?= base_url(); ?>/kelas/aktivasi/<?php echo $kelas->id_kelas ?>'">Non Aktif</button>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>

                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Jumlah</th>
                        <th>Kode</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>