<link rel="stylesheet" href="<?php echo base_url('../') ?>assets/editor/css/style.css">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid card" id="kt_content">
        <div class="col-xl-12 mb-3 m-0 p-0">
            <?php $this->load->view('messages') ?>
            <h4>Add Slider</h4>
            <p><small><span class="text-info">Note :</span> Max. Slider upload limit 5</small></p>
            <form action="<?php echo base_url('content/addSlider') ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="no" id="" class="form-control" required>
                                <option value="" selected disabled>Select slide no</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="file" name="slider" id="" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <button type="submit" id="addSlider" name="addSlider" class="btn btn-info">Add
                                Slider</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-12">
            <div class="row">
                <?php
                    for($i = 1; $i < 6 ; $i++){
                        $filename = $i.'.png';
                        $file_path = FCPATH . "../assets/images/slider/" . $filename;
                        if (file_exists($file_path)) {
                ?>

                <div class="col-lg-4 mb-5">
                    <img src="<?php echo base_url('../assets/images/slider/'.$i.'.png') ?>"
                        style="height:160px; width : 100%;" class="rounded" alt="">
                    <a href="<?php echo base_url('content/remove_image/'.$i) ?>">
                        <span
                            style="position:absolute; right : 2px; background-color : #fff; color: teal; padding:10px; text-align:center; height:35px; width:35px; line-height:20px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 50%; top:-8px; cursor : pointer;"><i
                                class="fa fa-trash"></i></span>
                    </a>
                    <span><small>Slider <?= $i ?></small></span>
                </div>
                <?php }} ?>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(function).on('click', '#addSlider', function() {
    $('#addSlider').prop('disabled', true);
})
</script>