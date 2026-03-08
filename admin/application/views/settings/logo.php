<div class="container mb-5">
    <div class="mt-3">
        <?php $this->load->view('messages') ?>
    </div>
    <div class="row my-5">
        <div class="col-lg-6 mb-3">
            <div class="card p-5" style="height:370px;">
                <?php $id = 'abc' ?>
                <form action="<?php echo site_url('settings/changeFavicon/'); ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="col-lg-12" style="height:150px;">
                        <div class="text-center">
                            <img src="<?php echo base_url('../portal_assets/images/favicon.ico') ?>" id="showImage"
                                alt="" style="height:100px; width : 100px;">

                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group my-3">
                            <label>Upload Favicon</label>
                            <input type="file" class="form-control" id="favicon" aria-describedby="favicon"
                                name="favicon" required>
                            <small>Size : 50px(w) x 50px(H)</small>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" name="addFavicon" class="btn btn-success px-5">Change Favicon</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card p-5" style="height:370px;">
                <form action="<?php echo site_url('settings/changeLogo'); ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12" style="height:150px;">
                            <div class="text-center">
                                <img src="<?php echo base_url('../portal_assets/images/logo.png') ?>" id="showImage"
                                    alt="" style="height:100px; width : 100px;">

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group my-3">
                                <label>Upload Logo</label>
                                <input type="file" class="form-control" id="logo" aria-describedby="logo" name="logo"
                                    required>
                                <small>Size : 50px(w) x 50px(H)</small>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" name="change" class="btn btn-primary px-5">Change Logo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>