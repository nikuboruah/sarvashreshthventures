<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Generate Epin</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <form action="<?php echo base_url('epin/generate_epins') ?>" method="POST">
                <div class="row mb-3">
                    <div class="col-lg-6 mb-3">
                        <label for="">Choose Package</label>
                        <select name="package" id="package" class="form-control">
                            <option value="" selected disabled>Select a package</option>
                            <?php foreach($PACKAGE as $package){ ?>
                            <option value="<?= $package->package_id ?>"><?= $package->package_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="">Total Epin</label>
                        <input type="number" name="epins" id="epins" min="0" max="100" placeholder="Epin no" class="form-control">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <button type="submit" class="btn btn-info">Generate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>