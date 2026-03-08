<div class="kt-portlet__body">
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card p-3 border-0">
                <div class="d-flex justify-content-between">
                    <h3>Our Products</h3>
                    <a href="<?php echo base_url('member/cart') ?>"><i class="fa fa-shopping-cart" style="font-size:25px;"></i> <span style="font-size: 20px; color: red;"><sup><?= $count_cart ?></sup></span></a>
                </div>

                <hr>
                <div class="row">
                    <?php foreach($PRODUCTS as $data){ ?>
                    <div class="col-lg-4 mb-3">
                        <div class="card p-2">
                            <img src="<?php echo $data->product_image_one == '' ? base_url('uploads/products/No_Image_Available.jpg') : base_url('uploads/products/'. $data->product_image_one) ?>"
                                alt="" style="height:250px; width : 100%;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $data->product_name ?></h5>
                                <h5>&#8377;<?= number_format($data->selling_price,2) ?> <span
                                        style="font-size:18px; color:#ccc;"><small><del>&#8377;<?= number_format($data->mrp,2) ?></del></small></span>
                                </h5>
                                <h6>PV : <?= number_format($data->pv,2) ?></h6>
                                <h6>Category : <?= $data->category_name?></h6>
                                <br />
                                <button id="<?= $data->product_id ?>" onclick="addToCart(this)"
                                    class="btn btn-success btn-sm"><i class="fa fa-shopping-cart"></i> Add To
                                    Cart</button>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
function addToCart(x) {
    var details = {
        "productid": x.id,
        "qty": 1
    };
    $.ajax({
        type: "POST",
        url: '<?php echo base_url('member/addToCart') ?>',
        data: details,
        success: function(response) {
            if (response == 0) {
                Swal.fire(
                    'Ooops. Something went wrong.',
                    'Try Again.',
                    'question'
                ).then((result) => {
                    location.reload()
                });
            } else if (response == 1) {
                $("#cart").html(Number($("#cart").html()) + 1);
                Swal.fire(
                    'Success',
                    'Item added to Cart.',
                    'success'
                ).then((result) => {
                    location.reload()
                });
            }
        }
    })
}
</script>