<link rel="stylesheet" href="<?php echo base_url('../') ?>assets/editor/css/style.css">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid card" id="kt_content">
        <div class="col-xl-12 mb-3 m-0 p-0">
            <?php $this->load->view('messages') ?>
            <h4 class="mb-4">Company Documents</h4>
            <form action="<?php echo base_url('content/add_document') ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="text" name="name" id="" placeholder="Enter document name" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="file" name="document" id="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <button type="submit" id="addDocument" name="addDocument" class="btn btn-info">Add
                                Documents</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row mt-5">
                <?php
                    //Count local files 
                    $directory ="../assets/images/documents";
                    $count = 0;

                    $iterator = new DirectoryIterator($directory);
                    foreach ($iterator as $file) {
                      if ($file->isFile()) {
                ?>
                    <div class="col-lg-3 mb-2">
                        <div class="card p-2">
                            <img src="<?php echo base_url('../assets/images/documents/'.$file) ?>" alt="" style="height:150px;">
                            <hr>
                            <div class="text-center">
                                <p> <?= str_replace( array('_' , '-', '.png' ), ' ', $file) ?></p>
                                <a href="<?php echo base_url('content/remove_document/'.$file) ?>" class="btn btn-danger btn-sm p-2"><i class="fa fa-trash"></i> Trash</a>
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