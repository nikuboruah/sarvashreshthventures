<link rel="stylesheet" href="<?php echo base_url('../') ?>assets/editor/css/style.css">
<div class="container mb-5 mt-3">
    <h4>About Company</h4>
    <hr>
    <div class="mt-1">
        <?php $this->load->view('messages') ?>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <form id="ai" action="" method="post">
                <div id="editor"><?php echo $content; ?></div>
                <textarea hidden name="content" id="blog" cols="30" rows="10"></textarea>
                <hr>
                <input type="submit" class="btn btn-info px-5" onclick="blogText()" name="submit" value="Save Changes">
            </form>
        </div>

        <div class="col-lg-12">
            <form action="<?php echo base_url('content/updateAboutImage') ?>" method="post" enctype="multipart/form-data">
                <h4>Update About Image</h4>
                <div class="row">
                    <div class="col-lg-4">
                        <input type="file" name="about" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-info">Update Image</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo base_url('../') ?>assets/editor/js/main.js"></script>
<script>
function blogText() {
    $('#blog').html($(".ql-editor").html());
    $("#ai").submit();
}
</script>