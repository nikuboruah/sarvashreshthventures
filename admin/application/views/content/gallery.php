<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid card" id="kt_content">
        <div class="col-xl-12 m-0 p-0">
            <?php $this->load->view('messages') ?>
            <h4>Add Category</h4>
            <hr>
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="categoryName" placeholder="Enter category">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <button type="submit" id="addCategory" name="addCategory" class="btn btn-info">Add
                                Category</button>
                        </div>
                    </div>
                </div>
            </form>

            <p style="margin-top:-30px;"><small>All categories</small></p>
            <?php foreach($category as $data){ ?>
            <span class="border border-info rounded px-3 py-1"><?= $data->gallery_category ?> | <span type="button"
                    onclick="removeCategory(<?= $data->id ?>)"><i
                        class="fa fa-times text-danger pointer"></i></span></span>
            <?php } ?>

            <hr>
            <h4>Add Gallery</h4>
            <form action="<?php echo base_url('content/add_gallery') ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <select name="category" id="" class="form-control">
                                <option value="" selected disabled>Select a category</option>
                                <?php foreach($category as $key){ ?>
                                <option value="<?= $key->id ?>"><?= $key->gallery_category ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="file" name="image" id="" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <button type="submit" name="addGallery" class="btn btn-info">Add Gallery</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="mt-3">
                <div class="row">
                    <?php foreach($gallery as $gallery){ ?>
                        <div class="col-lg-2 mb-2">
                            <div class="card p-3">
                                <img src="<?php echo base_url('uploads/gallery/'.$gallery->file_name) ?>" style="height:70px; width : 100%;" alt="">
                                <hr>
                                <div class="text-right mt-1">
                                    <a href="<?php echo base_url('content/delete_image/'.$gallery->id) ?>"><span><i class="fa fa-trash text-danger"></i></span></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
function removeCategory(x) {
    $.ajax({
        type: 'post',
        url: "<?php echo base_url('content/removeCategory') ?>",
        data: {
            id: x
        },
        success: function(data) {
            location.reload();
        }
    })
}
</script>