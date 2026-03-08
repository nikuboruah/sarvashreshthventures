<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-portlet__body card p-5 shadow border-0">
    <div class="d-flex justify-content-between">
    <h5>Activation</h5>
    <h5><span class="text-info">TOPUP WALLET</span> : &#8377;<span id="topupAMT"><?= $CUSTOMER_DETAILS[0]->topup_wallet ?></span>.00</h5>
    </div>
    <hr>
    <?php $this->load->view('messages'); ?>

    <form action="<?php echo base_url('activation/activate_now') ?>" method="POST"
        enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Member ID</label>
                    <input type="text" class="form-control" placeholder="Enter member ID" name="cust_id" id="cust_id" required>
                    <small><span id="cust_msg"></span></small>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Choose Package</label>
                    <select name="package" id="package" class="form-control" required>
                        <option value="" selected disabled>Choose a package</option>
                        <?php
                        if($TOTAL_PACKAGES == 0){
                    ?>
                        <option value="" selected disabled>NO PACKAGES FOUND</option>
                        <?php
                    }else{
                        foreach($PACKAGES as $package){ ?>
                        <option value="<?= $package->package_id ?>">
                            <?= $package->package_name.' - &#8377;'.$package->package_amount ?></option>
                        <?php }} ?>
                    </select>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="">Package Amount</label>
                    <input type="text" class="form-control" name="pamount" id="pamount" placeholder="Amount" readonly>
                    <small><span id="topup_msg"></span></small>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="text" placeholder="Enter amount" name="tamount" id="tamount" class="form-control"
                        required>
                    <small><span id="amount_msg"></span></small>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="text-right">
                    <button type="submit" id="activationRequest" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<script>
$('#activationRequest').prop('disabled', true);
$('#tamount').prop('readonly', true);

$(document).on('input', '#cust_id', function(){
    let customer_id = $(this).val()

    $.ajax({
        url : '<?php echo base_url('activation/find_member_id') ?>',
        method : 'POST',
        data : 'c_id='+customer_id,

        success:function(data){
            if(data == 0){
                $('#cust_msg').html('Member ID not found.').addClass('text-danger').removeClass('text-success')
            }else{
                $('#cust_msg').html('Member name : '+data).addClass('text-success').removeClass('text-danger')
            }
        }
    })
})

$(document).on('change', "#package", function() {
    var package_id = $('#package').val();

    $.ajax({
        url: '<?php echo base_url('activation/find_package_amount') ?>',
        method: 'POST',
        data: 'package_id=' + package_id,

        success: function(data) {
            $('#pamount').val(data)
            check_topup_balance()
        }

    })
})

$(document).on('input', '#tamount', function() {
    let package_amt = $('#pamount').val()
    let member_amt = $('#tamount').val()
    if (package_amt == member_amt) {
        $('#activationRequest').prop('disabled', false);
        $('#amount_msg').html('Amount matched').addClass('text-success').removeClass('text-danger');
    } else {
        $('#activationRequest').prop('disabled', true);
        $('#amount_msg').html('Amount didn\'t matched.').addClass('text-danger').removeClass('text-success');
    }
})

function check_topup_balance(){
    let p_amount = parseInt($('#pamount').val())
    let topup_amt = parseInt($('#topupAMT').html())
    
    if(topup_amt < p_amount){
        $('#topup_msg').html('Topup wallet amount is below package amount').addClass('text-danger');
        $('#tamount').prop('readonly', true);
        $('#tamount').val('');
        $('#amount_msg').html('')
    }else{
        $('#tamount').prop('readonly', false);
        $('#topup_msg').html('').removeClass('text-danger');
    }
}
</script>