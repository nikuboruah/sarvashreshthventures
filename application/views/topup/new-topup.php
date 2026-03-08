<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>New Toup Request</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <form id="topup-form" action="<?php echo base_url('topup/send_topup_request') ?>" method="POST"
        enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="text" placeholder="Enter amount" name="tamount" id="tamount" class="form-control"
                        required>
                    <small><span id="amount_msg"></span></small>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Proof</label>
                    <input type="file" name="tproof" id="" required>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">UTR No</label>
                    <input type="text" placeholder="Enter UTR No" name="utr" class="form-control" required>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label for="">Remark</label>
                    <textarea id="" rows="2" name="remark" placeholder="Enter remark" class="form-control"
                        required></textarea>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).on('submit', '#topup-form', function(){
        $('#activationRequest').prop('disabled', true)
    })
</script>