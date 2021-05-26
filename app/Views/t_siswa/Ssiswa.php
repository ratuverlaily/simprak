<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/css/jquery.dataTables.min.css">
<script src="<?= base_url() ?>/js/jquery.dataTables.min.js"></script>


<div class="container-fluid">
    <div class="card o-hidden shadow-lg my-5">
        <div class="alert-primary p-3 text-center">
            <b><?php echo $sekolah ?><br /><small> KELAS : <?php echo session()->get('kelas'); ?></small></b>
        </div>
        <div class="card-body">

            <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>username</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telpon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tampildata as $user) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $user->username; ?></td>
                            <td><?php echo $user->jenis_kelamin; ?></td>
                            <td><?php echo $user->no_telpon; ?></td>
                        </tr>
                    <?php } ?>

                </tbody>

                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>username</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telpon</th>
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