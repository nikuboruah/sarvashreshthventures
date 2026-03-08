<style>
/* Increment button css */
.quantity {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.quantity__minus,
.quantity__plus {
    display: block;
    /* width: 42px;
  height: 43px; */
    margin: 0;
    background: #dee0ee;
    text-decoration: none;
    text-align: center;
    line-height: 23px;
}

.quantity__minus:hover,
.quantity__plus:hover {
    background: #575b71;
    color: #fff;
}

.quantity__minus {
    border-radius: 3px 0 0 3px;
    font-size: 25px;
    padding: 5px 15px;
}

.quantity__plus {
    border-radius: 0 3px 3px 0;
    font-size: 25px;
    padding: 5px 15px;
}

.quantity__input {
    width: 42px;
    height: 33px;
    margin: 0;
    padding: 0;
    text-align: center;
    border-top: 2px solid #dee0ee;
    border-bottom: 2px solid #dee0ee;
    border-left: 1px solid #dee0ee;
    border-right: 2px solid #dee0ee;
    background: #fff;
    color: #8184a1;
}

.quantity__minus:link,
.quantity__plus:link {
    color: #8184a1;
}

.quantity__minus:visited,
.quantity__plus:visited {
    color: #fff;
}
</style>
<div class="kt-portlet__body">
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card p-3 border-0">
                <div class="d-flex justify-content-between">
                    <h3>Cart Items</h3>
                </div>

                <hr>
                <div class="row">
                    <?php if($cartItems == 0){ ?>
                    <div class="text-center">
                        <h2 style="color:#ccc;">NO PRODUCT FOUND</h2>
                    </div>
                    <?php }else{ ?>
                    <div class="col-lg-12">
                        <?php $this->load->view('messages') ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th style="text-align:center;">ID</th>
                                        <th style="text-align:center;">Products</th>
                                        <th style="text-align:center;">Qty</th>
                                        <th style="text-align:center;">PV</th>
                                        <th style="text-align:center;">Price</th>
                                        <th style="text-align:center;">Total Price</th>
                                        <th style="text-align:center;">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $id = 0; foreach($cart as $cart){
                                 $price = $cart->qty * $cart->selling_price;
                                 $totalPrice += $price;

                                 $totalPV += $cart->qty * $cart->pv;
                            ?>
                                    <tr class="text-center">
                                        <td style="vertical-align:middle;"><?= ++$id ?></td>
                                        <td style="vertical-align:middle;" class="text-center">
                                            <img src="<?php echo base_url('admin/uploads/products/'.$cart->product_image_one) ?>"
                                                alt="" style="height:40px; width: 60px; border-radius: 5px;">
                                            <p class="text-capitalize"><b><?= $cart->product_name ?></b></p>
                                        </td>
                                        <td style="vertical-align:middle;">
                                            <div class="quantity">
                                                <span class="quantity__minus" style="cursor : pointer;"
                                                    onclick="minus_cart_(<?= $cart->cart_id ?>)"><span>-</span></span>
                                                <input name="quantity" type="text" id="qty<?= $cart->cart_id ?>"
                                                    class="quantity__input"
                                                    onchange="updateQty('<?= $cart->cart_id ?>')"
                                                    value="<?= $cart->qty ?>">
                                                <span class="quantity__plus" style="cursor : pointer;"
                                                    onclick="plus_cart_(<?= $cart->cart_id ?>)"><span>+</span></span>
                                            </div>
                                        </td>
                                        <td style="vertical-align:middle;"><?= $cart->qty * $cart->pv ?></td>
                                        <td style="vertical-align:middle;" class="text-right">
                                            &#8377;<?= number_format($cart->selling_price,2) ?></td>
                                        <td style="vertical-align:middle;" class="text-right">
                                            &#8377;<span><?= number_format($price,2) ?></span></td>
                                        <td style="vertical-align:middle;">
                                            <span onclick="removeFromCart(<?= $cart->cart_id ?>)"
                                                style="cursor:pointer;color : red;"><i class="fa fa-trash"></i></span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Total PV = </th>
                                        <th class="text-right"><?= $totalPV ?></th>
                                        <th class="text-center" rowspan="2"><span
                                                style="cursor:pointer; color:red; vertical-align:middle;"
                                                onclick="removeAll()">Clear all</span></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Grand Total = </th>
                                        <th class="text-right">&#8377;<?= number_format($totalPrice, 2) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <?php 
                    $member_status = $USERSTATUS[0]->status;
                    if($cartItems > 0 && $member_status == 0){
                ?>
                        <div class="text-right">
                            <a href="<?php echo base_url('checkout_for_activation') ?>" class="btn btn-info"
                                style="padding:15px 25px;">Checkout</a>
                        </div>
                        <?php
                    }else if($cartItems > 0 && $member_status > 0){
                ?>
                        <div class="text-right">
                            <a href="<?php echo base_url('member/checkout') ?>" class="btn btn-info px-5"
                                style="padding:15px 25px;">Checkout</a>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<link href="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet"
    type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo base_url(''); ?>portal_assets/vendors/general/sweetalert2/dist/sweetalert2.min.js"
    type="text/javascript"></script>

<script>
function minus_cart_(x) {
    var value = $("#qty" + x).val();
    if (value > 1) {
        value--;
        decrease_qty(x);
    }
    $("#qty" + x).val(value);
}

function decrease_qty(x) {
    $.ajax({
        type: 'POST',
        url: '<?= base_url('member/decreaseCartQty') ?>',

        data: {
            id: x
        },

        success: function(response) {
            location.reload();
        }
    })
}

function plus_cart_(x) {
    var value = $("#qty" + x).val();
    value++;
    $("#qty" + x).val(value);
    increase_qty(x);
}

function increase_qty(x) {
    $.ajax({
        type: 'POST',
        url: '<?= base_url('member/increaseCartQty') ?>',

        data: {
            id: x
        },

        success: function(response) {
            location.reload();
        }
    })
}

function updateQty(x){
    let qty = $('#qty'+x).val()
    $.ajax({
        type: 'POST',
        url: '<?= base_url('member/update_cart_qty') ?>',

        data: {
            id : x,
            qty : qty
        },

        success: function(response) {
            location.reload();
        }
    })
}

function removeFromCart(x) {
    $.ajax({
        type: 'POST',
        url: '<?= base_url('member/removeFromCart') ?>',
        data: {
            id: x
        },

        success: function(response) {
            if (response == 0) {
                Swal.fire(
                    'Ooops. Something went wrong.',
                    'Try Again.',
                    'question'
                ).then((result) => {
                    window.location.assign("<?php echo base_url('member/cart') ?>")
                });
            } else if (response == 1) {
                Swal.fire(
                    'Success',
                    'Item removed from Cart.',
                    'success'
                ).then((result) => {
                    window.location.assign("<?php echo base_url('member/cart') ?>")
                });
            }
        }
    })
}

function removeAll() {
    $.ajax({
        type: 'POST',
        url: '<?= base_url('member/removeAll') ?>',

        success: function(response) {
            if (response == 0) {
                Swal.fire(
                    'Ooops. Something went wrong.',
                    'Try Again.',
                    'question'
                ).then((result) => {
                    window.location.assign("<?php echo base_url('cart') ?>")
                });
            } else if (response == 1) {
                Swal.fire(
                    'Success',
                    'Items removed from Cart.',
                    'success'
                ).then((result) => {
                    window.location.assign("<?php echo base_url('cart') ?>")
                });
            }
        }
    })
}
</script>