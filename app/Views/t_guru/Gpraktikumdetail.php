<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>


<div class="container-fluid">
    <div class="card o-hidden shadow-lg my-5">
        <div class="alert-primary p-3 text-center">
            <b><?php echo $praktikum->judul; ?></b>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="mr-auto p-1">
                    <button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url('praktikum/guru/nilai'); ?>'"><i class="fas fa-backward"></i> Kembali</button>
                </div>
                <div class="ml-auto p-2 text-right">
                    <?php
                    $date_posting = date_create($praktikum->tgl_publis . " " . $praktikum->waktu_publis);
                    $date_batas = date_create($praktikum->tgl_batas . " " . $praktikum->waktu_publis);
                    ?>
                    Tanggal Posting : <?= date_format($date_posting, "d-m-Y H:i:s"); ?><br />
                    Tanggal Batas : <?= date_format($date_batas, "d-m-Y H:i:s"); ?><br />
                </div>
            </div>
            <br /><br />
            <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Waktu Pengerjaan</th>
                        <th rowspan="2">Nama</th>
                        <th colspan="3">Pre Games</th>
                        <th colspan="3">Post Games</th>
                        <th colspan="2">Experiment Games</th>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <th>Jml Kesalahan</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Jml Kesalahan</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($tampildata as $detail) {
                        $date = date_create($detail->waktu_pengerjaan);
                    ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= date_format($date, "d-m-Y H:i:s"); ?></td>
                            <td><?= $detail->fullname; ?></td>
                            <td><?= $detail->waktu_pretest; ?></td>
                            <td><?= $detail->pre_fault_counter; ?></td>
                            <td><?php if ($detail->pre_status == 1) {
                                    echo "<b>Berhasil</b>";
                                } else {
                                    echo "<b>Gagal</b>";
                                } ?></td>
                            <td><?= $detail->post_waktu_pengerjaan; ?></td>
                            <td><?= $detail->post_fault_counter; ?></td>
                            <td><?php if ($detail->post_status == 1) {
                                    echo "<b>Berhasil</b>";
                                } else {
                                    echo "<b>Gagal</b>";
                                } ?></td>
                            <td><?= $detail->expe_waktu_pengerjaan; ?></td>
                            <td><?php if ($detail->expe_status == 1) {
                                    echo "<b>Berhasil</b>";
                                } else {
                                    echo "<b>Gagal</b>";
                                } ?></td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Waktu Pengerjaan</th>
                        <th rowspan="2">Nama</th>
                        <th>Waktu</th>
                        <th>Jml Kesalahan</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Jml Kesalahan</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Status</th>

                    </tr>
                    <tr>
                        <th colspan="3">Pre Test</th>
                        <th colspan="3">Post Test</th>
                        <th colspan="2">Experiment</th>
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
</script>

<?= $this->endSection(); ?>