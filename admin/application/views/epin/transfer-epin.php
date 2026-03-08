<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Transfer Epin</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <form action="<?php echo base_url('epin/transfer_epin_to_member') ?>" method="POST">
                <div class="row mb-3">
                    <div class="col-lg-3 mb-3">
                        <label for="">Choose Package</label>
                        <select name="package" id="package" class="form-control">
                            <option value="" selected disabled>Select a package</option>
                            <?php foreach($PACKAGE as $data){ ?>
                            <option value="<?= $data->package_id ?>"><?= $data->package_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label for="">Available Epin</label>
                        <input type="number" name="epin" id="epin" min="0" placeholder="Available Epin"
                            class="form-control" readonly>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label for="">Customer ID</label>
                        <input type="text" name="custid" id="custid" placeholder="Customer ID" class="form-control">
                        <span id="msg"></span>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label for="">Transfer Epin No</label>
                        <input type="number" name="tepin" id="tepin" min="1" placeholder="Epin no" class="form-control">
                        <span id="msg_amt"></span>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <button class="btn btn-info" type="submit" id="submitBtn">Transfer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$('#submitBtn').prop('disabled', true)
$(document).on('change', '#package', function() {
    let package = $(this).val()

    $.ajax({
        url: '<?php echo base_url('epin/count_epin') ?>',
        method: 'POST',
        data: 'pkg=' + package,

        success: function(data) {
            $('#epin').val(data)
            $('#tepin').prop('max', data)
        }
    })
})

$(document).on('input', '#custid', function(){
    let customer = $(this).val()

    $.ajax({
        url: '<?php echo base_url('epin/find_custid') ?>',
        method: 'POST',
        data: 'customer=' + customer,

        success: function(data) {
            if(data == 0){
                $('#msg').html("Not Founnd").addClass('text-danger').removeClass('text-success')
                $('#submitBtn').prop('disabled', true)
            }else{
                $('#msg').html(data).addClass('text-success').removeClass('text-danger')
                $('#submitBtn').prop('disabled', false)
            }
            
        }
    })
})

$(document).on('input', '#tepin', function(){
    let enpin_count = $(this).val()
    let packid = $('#package').val()

    $.ajax({
        url: '<?php echo base_url('epin/find_epin_amount') ?>',
        method: 'POST',
        data: {
            enpin_count : enpin_count,
            packid : packid
        },

        success: function(data) {
            $('#msg_amt').html(data).addClass('text-success').removeClass('text-danger')   
        }
    })
})
</script>