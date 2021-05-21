<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<script src="<?= base_url() ?>/js/pdfobject.min.js"></script>
<div class="container">
    <br />
    <div class="alert alert-primary shadow-lg" role="alert">
        <h6 align="center"><b>VIEW PDF</b></h6>
    </div>

    <div class="card my-1 shadow-lg mx-auto">
        <div class="card-body">
            <button type="button" class="btn btn-outline-info" onclick="location.href='<?= base_url(''); ?>/praktikum/detail/<?php echo $getdata->id_praktikum; ?>'"><i class="fas fa-backward"></i> Kembali</button>
            <br /><br />
            <div id="viewpdf" style="height: 700px;"></div>
        </div>
    </div>
</div>

<script>
    var viewer = $('#viewpdf');
    PDFObject.embed('/file/<?php echo $getdata->link ?>', viewer);
</script>

<?= $this->endSection(); ?>