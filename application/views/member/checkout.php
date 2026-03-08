<div class="kt-portlet__body">
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card p-3 border-0">
                <div class="d-flex justify-content-between">
                    <h3>Checkout Items</h3>
                </div>

                <hr>
                <div class="row">
                    <div class="col-lg-6" style="margin-bottom:30px;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="bg-info">
                                        <th colspan="4" class="text-light"><b>All Products</b></th>
                                    </tr>
                                    <tr>
                                        <th>Product Name</th>
                                        <th class="text-center">PV</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $id = 0; foreach($cart as $cart){
                                 $price = $cart->qty * $cart->selling_price;
                                 $totalPrice += $price;

                                 $totalBV += $cart->qty * $cart->pv;
                            ?>
                                    <tr>
                                        <td style="vertical-align:middle;">
                                            <?= ++$id ?>. <b><?= $cart->product_name ?></b>
                                        </td>
                                        <td class="text-center">
                                            <?= $cart->qty * $cart->pv ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $cart->qty ?> x
                                            &#8377;<?= number_format($cart->selling_price,2) ?>
                                        </td>
                                        <td class="text-right">
                                            &#8377;<span><?= number_format($price,2) ?></span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right">Total BV = </th>
                                        <th class="text-right"><?= $totalBV ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-right">Grand Total =</th>
                                        <th class="text-right">&#8377;<?= number_format($totalPrice, 2) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form action="<?php echo base_url('member/upgrade_now') ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="col-lg-12" style="margin-bottom:30px;">
                                <div class="card"
                                    style="border:1px solid #ccc; padding:5px 15px 15px 10px; border-radius:10px;">
                                    <h5>Delivery Address:</h5>
                                    <hr>
                                    <textarea name="address" id="address" placeholder="Enter full address" rows="5"
                                        class="form-control" required></textarea>
                                    <input type="text" name="tbv" value="<?= $totalBV ?>" id="tbv" hidden>
                                    <input type="text" name="packid" id="packid" hidden>
                                    <input type="text" value="<?= $member_details[0]->package_id ?>" name="prev_pkg_id" id="prev_pkg_id" hidden>
                                    <input type="text" name="gtotal" value="<?= $totalPrice ?>" id="gtotal" hidden>
                                </div>

                                <div class="card"
                                    style="border:1px solid #ccc; padding:5px 15px 15px 10px; border-radius:10px; margin-top:20px;">
                                    <h5>Payment Details:</h5>
                                    <hr>
                                    <div class="form-group">
                                        <label for="">Payment Mode</label>
                                        <select style="margin-top:10px;" name="mode" id="mode" class="form-control">
                                            <option value="Cash">Cash</option>
                                            <option value="UPI">UPI/Debit Card/Credit Card/Cheque/Transfer</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="no-need-1">
                                        <label for="">Transaction No</label>
                                        <input type="text" style="margin-top:10px;" placeholder="Transaction no"
                                            name="tranno" id="tranno" class="form-control">
                                    </div>

                                    <div class="form-group" id="no-need-2">
                                        <label for="">Payment Mode</label>
                                        <input type="file" style="margin-top:10px;" name="proof" id="proof"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="text-right">
                                    <span id="msg"></span>
                                    <button type="submit" id="activate" class="btn btn-info"
                                        style="padding:15px 25px;">Order Now</button><br />
                                    
                                </div>
                            </div>
                        </form>
                    </div>
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
$('#no-need-1').hide()
$('#no-need-2').hide()
$(document).on('change', "#mode", function() {
    let mode = $(this).val()

    if (mode == 'UPI') {
        $('#no-need-1').show()
        $('#no-need-2').show()
        $('#tranno').prop('required', true)
        $('#proof').prop('required', true)
    } else {
        $('#no-need-1').hide()
        $('#no-need-2').hide()
        $('#tranno').prop('required', false)
        $('#proof').prop('required', false)
    }
})

$(document).ready(function() {
    let bv_amt = $('#tbv').val()
    let prev_pkg = $('#prev_pkg_id').val()

    $.ajax({
        url: '<?php echo base_url('member/find_package_for_activation') ?>',
        method: 'POST',
        data: 'bv=' + bv_amt,

        success: function(data) {
            if (data <= prev_pkg) {
                $('#activate').prop('disabled', true);
                $('#msg').html(
                    'Product value alone isn\'t adequate to upgrade you. Add more Product Value (PV)'
                    ).addClass('text-danger').css('font-size', '12px')
            } else {
                $('#activate').prop('disabled', false);
                $('#msg').html('')

                $('#packid').val(data)
            }
        }
    })
})
</script>