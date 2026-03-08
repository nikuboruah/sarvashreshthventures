<link rel="stylesheet" href="<?php echo base_url('../') ?>assets/editor/css/style.css">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid card" id="kt_content">
        <div class="col-xl-12 mb-3 m-0 p-0">
            <?php $this->load->view('messages') ?>
            <h4 class="mb-4">Company Offer</h4>
            <form action="<?php echo base_url('content/add_offer') ?>" method="post" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="file" name="document" accept="image/png, image/jpg, image/jpeg" id="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <button type="submit" id="addOffer" name="addOffer" class="btn btn-info">Add
                                Offer</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row mt-5">
                <?php
                    //Count local files 
                    $directory ="../assets/images/offer";
                    $count = 0;

                    $iterator = new DirectoryIterator($directory);
                    foreach ($iterator as $file) {
                      if ($file->isFile()) {
                ?>
                    <div class="col-lg-3 mb-2">
                        <div class="card p-2">
                            <img src="<?php echo base_url('../assets/images/offer/'.$file) ?>" alt="" style="height:150px;">
                            <hr>
                            <div class="text-center">
                                <a href="<?php echo base_url('content/remove_offer/'.$file) ?>" class="btn btn-danger btn-sm p-2"><i class="fa fa-trash"></i> Trash</a>
                            </div>
                        </div>
                    </div>
                <?php
                      }
                    }
                ?>
                
            </div>
        </div>
    </div>
</div>