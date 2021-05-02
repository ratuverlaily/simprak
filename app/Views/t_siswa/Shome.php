<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <div class="col-sm-12">
        <div class="card m-b-30">
            <div class="card-body">
                <br />
                <div class="alert alert-primary" role="alert">
                    <h6 align="center"><b>HOME</b></h6>
                </div>
                <!-- CSRF token -->
                <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <div class="card">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Response message -->
                            <div class="alert displaynone" id="responseMsg"></div>

                            <!-- File upload form -->

                        </div>
                    </div>
                </div>
                <br />
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#submit').click(function() {

                // CSRF Hash
                var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                // Get the selected file
                var files = $('#file')[0].files;

                if (files.length > 0) {
                    var fd = new FormData();

                    // Append data 
                    fd.append('file', files[0]);
                    fd.append([csrfName], csrfHash);
                } else {
                    var fd = new FormData();

                    fd.append('komentar', $('textarea#komentar').val());
                    fd.append([csrfName], csrfHash);
                }

                // Hide alert 
                $('#responseMsg').hide();
                $('#filepreview a').hide();

                // AJAX request 
                $.ajax({
                    url: "<?= site_url('posting/fileupload') ?>",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {

                        console.log(response);

                        // Update CSRF hash
                        $('.txt_csrfname').val(response.token);

                        // Hide error container
                        $('#err_file').removeClass('d-block');
                        $('#err_file').addClass('d-none');

                        if (response.success == 1) { // Uploaded successfully

                            // Response message
                            $('#responseMsg').removeClass("alert-danger");
                            $('#responseMsg').addClass("alert-success");
                            $('#responseMsg').html(response.message);
                            $('#responseMsg').show();

                            // File preview
                            $('#filepreview').show();
                            $('#filepreview img,#filepreview a').hide();
                            if (response.extension == 'jpg' || response.extension == 'jpeg') {

                                $('#filepreview img').attr('src', response.filepath);
                                $('#filepreview img').show();
                            } else {
                                $('#filepreview a').attr('href', response.filepath).show();
                                $('#filepreview a').show();
                            }

                        } else if (response.success == 2) { // File not uploaded

                            // Response message
                            $('#responseMsg').removeClass("alert-success");
                            $('#responseMsg').addClass("alert-danger");
                            $('#responseMsg').html(response.message);
                            $('#responseMsg').show();
                        } else {
                            // Display Error
                            $('#err_file').text(response.error);
                            $('#err_file').removeClass('d-none');
                            $('#err_file').addClass('d-block');
                        }
                    },
                    error: function(response) {
                        console.log("error : " + JSON.stringify(response));
                    }
                });

            });
        });
    </script>


</div>
<?= $this->endSection(); ?>