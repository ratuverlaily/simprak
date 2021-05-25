<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>


<div class="container-fluid">
    <div class="card o-hidden shadow-lg my-5">
        <div class="alert-primary p-3 text-center">
            <b>PENILAIAN PRAKTIKUM SISWA</b>
        </div>
        <div class="card-body">

            <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">Praktikum</th>
                        <th colspan="3">Pre Games</th>
                        <th colspan="2">Experiment Games</th>
                        <th colspan="3">Post Games</th>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <th>Jml Kesalahan</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Jml Kesalahan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tampildata as $prak) {
                        $date = date_create($prak->update_date);
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo  date_format($date, "d-m-Y H:i:s"); ?></td>
                            <td><?php echo $prak->judul; ?></td>
                            <td><?php echo $prak->pre_waktu_games; ?></td>
                            <td><?php echo $prak->pre_fault_counter; ?></td>
                            <td><?php if ($prak->pre_status == 1) {
                                    echo "Berhasil";
                                } else {
                                    echo "Gagal";
                                } ?></td>
                            <td><?php echo $prak->expe_waktu_pengerjaan; ?></td>
                            <td><?php if ($prak->expe_status == 1) {
                                    echo "Berhasil";
                                } else {
                                    echo "Gagal";
                                } ?></td>
                            <td><?php echo $prak->post_waktu_pengerjaan; ?></td>
                            <td><?php echo $prak->post_fault_counter; ?></td>
                            <td><?php if ($prak->post_status == 1) {
                                    echo "Berhasil";
                                } else {
                                    echo "Gagal";
                                } ?></td>
                        </tr>
                    <?php } ?>
                </tbody>

                <tfoot>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">Praktikum</th>
                        <th>Waktu</th>
                        <th>Jml Kesalahan</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Jml Kesalahan</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <th colspan="3">Pre Games</th>
                        <th colspan="2">Experiment Games</th>
                        <th colspan="3">Post Games</th>
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