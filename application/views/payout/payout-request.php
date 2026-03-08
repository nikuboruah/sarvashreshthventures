<div class="page-wrapper">

    <!-- Page Content-->
    <div class="page-content-tab">

        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Income & Payouts</a></li>
                                <li class="breadcrumb-item"><a href="#">
                                      Payout Request  
                                </a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            Payout Request
                        </h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Payout Request
                            </h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <?php $this->load->view('messages'); ?>

                            <?php
                                $userid=$this->session->userdata('aiplUserId');
                                $check_pan = $this->Crud->ciRead("customer_master", "`customer_id` = '$userid'");
                                $pan = $check_pan[0]->pan;
                                if($BANK_DETAILS > 0){ 
                                $day = date('l');
                                $days_status = $this->Crud->ciRead("payout_days", "`days` = '$day'");
                                $available_days = $this->Crud->ciRead("payout_days", "`status` = '1'");
                                $display_status = $days_status[0]->status;
                                if($display_status == 1){
                            ?>
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="card p-3 text-center">
                                        <h5><b>Minimum request amount :</b>
                                            &#8377;<?= number_format($SETTINGS[0]->min_withdrawal_amt, 2) ?> ||
                                            <b>TDS :</b> <?= $SETTINGS[0]->tds ?>% || <b>Admin Charge :</b>
                                            <?= $SETTINGS[0]->admIn_charge ?>% || <b>Extra Charge (If PAN not available)
                                                : </b> <?= $SETTINGS[0]->pan ?>%
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-lg-2 mb-3">
                                    <div class="form-group">
                                        <label for="">Wallet Amount</label>
                                        <input type="text" placeholder="Amount" id="w_amount"
                                            value="<?= $WALLET[0]->main_wallet ?>" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-3">
                                    <div class="form-group">
                                        <label for="">Request Amount</label>
                                        <input type="hidden" class="from-control" id="min_amt"
                                            value="<?= $SETTINGS[0]->min_withdrawal_amt ?>">
                                        <input type="hidden" class="from-control" id="tds"
                                            value="<?= $SETTINGS[0]->tds ?>">
                                        <input type="hidden" class="from-control" id="admin_charge"
                                            value="<?= $SETTINGS[0]->admIn_charge ?>">
                                        <?php if($pan == ''){ ?>
                                        <input type="hidden" class="from-control" id="pan"
                                            value="<?= $SETTINGS[0]->pan ?>">
                                        <?php }else{ ?>
                                        <input type="hidden" class="from-control" id="pan" value="0">
                                        <?php } ?>
                                        <input type="number" placeholder="Enter amount" id="r_amount" min="0"
                                            class="form-control">
                                        <span id="amount_msg"></span>
                                    </div>
                                </div>

                                <div class="col-lg-2 mb-3">
                                    <div class="form-group">
                                        <label for="">Processing Amount</label>
                                        <input type="number" placeholder="Amount" id="p_amount" class="form-control"
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-lg-2 mb-3">
                                    <div class="form-group">
                                        <label for="">Final Amount</label>
                                        <input type="number" placeholder="Amount" id="f_amount" class="form-control"
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-3">
                                    <div class="form-group">
                                        <label for="">Transaction Password</label>
                                        <input type="password" placeholder="Enter password" id="t_password"
                                            class="form-control">
                                        <span id="password_message"></span>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success" id="request_submit"
                                            onclick="sendRequest()">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <?php }else{ ?>
                            <div class="text-center mt-4">
                                <h4>Payout requests are unavailable today. That can be made on
                                    <?php foreach($available_days as $data){echo $data->days.', ';} ?></h4>
                            </div>
                            <?php }} else { ?>
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="text-center mt-4">
                                        <h5>Bank details not found. Please add your bank details. <a
                                                href="<?php echo base_url('settings/bank_details') ?>">UPDATE NOW</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            let wallet_amt = $('#w_amount').val();
            $('#r_amount').prop('max', wallet_amt)
        })
        $('#request_submit').prop('disabled', true)
        $(document).on('change', '#r_amount', function() {
            let req_amt = parseInt($(this).val())
            let min_amt = parseInt($('#min_amt').val())
            let wallet_amt = parseInt($('#w_amount').val())
            let admin_tds = parseInt($('#tds').val())
            let admin_charge = parseInt($('#admin_charge').val())
            let pan_charge = parseInt($('#pan').val())

            if (wallet_amt < min_amt) {
                $('#amount_msg').html("Wallet balance is insufficient for withdrawal.").addClass(
                    'text-danger').css(
                    'font-size', '9px');
                $('#p_amount').val('');
                $('#f_amount').val('');
                return
            }

            if (req_amt < min_amt) {
                $('#amount_msg').html("Requested amount below minimum for withdrawal.").addClass(
                    'text-danger').css(
                    'font-size', '9px');
                $('#p_amount').val('');
                $('#f_amount').val('');
                return
            }

            $('#amount_msg').html("").removeClass('text-danger').css('font-size', '9px');

            let total_tax = parseInt(admin_tds + admin_charge + pan_charge)

            let calculate_processing_amt = parseInt(req_amt * (total_tax / 100))
            let final_amount = parseInt(req_amt - calculate_processing_amt);

            $('#p_amount').val(calculate_processing_amt);
            $('#f_amount').val(final_amount);

        })

        $(document).on('input', '#t_password', function() {
            let password = $('#t_password').val()
            $.ajax({
                url: '<?php echo base_url('payouts/check_transaction_password') ?>',
                data: 'password=' + password,
                method: 'POST',

                success: function(data) {
                    if (data == 1) {
                        $('#password_message').html('Password match').addClass(
                            'text-success').removeClass(
                            'text-danger')
                        $('#request_submit').prop('disabled', false)
                    } else {
                        $('#password_message').html('Password didn\'t match').addClass(
                                'text-danger')
                            .removeClass('text-success')
                        $('#request_submit').prop('disabled', true)
                    }
                }
            })
        })

        sendRequest = function() {
            let wallet_amt = $('#w_amount').val()
            let req_amt = $('#r_amount').val()
            let p_amount = $('#p_amount').val()
            let f_amount = $('#f_amount').val()

            if (req_amt == '') {
                $('#r_amount').addClass('border-danger')
                return
            }

            if ($('span#amount_msg').hasClass('text-danger')) {
                $('#r_amount').addClass('border-danger')
                return
            }

            if (parseInt(wallet_amt) < parseInt(req_amt)) {
                $('#r_amount').addClass('border-danger')
                return
            }

            $('#r_amount').removeClass('border-danger')
            $('#request_submit').prop('disabled', true);

            $.ajax({
                url: '<?php echo base_url('payouts/send_payout_request') ?>',
                data: {
                    req_amt: req_amt,
                    p_amount: p_amount,
                    f_amount: f_amount,
                },
                method: 'POST',

                success: function(data) {
                    if (data == 1) {
                        alert('Payment request send successfully.');
                        location.reload()
                    } else {
                        alert('Something went wrong. Try again.');
                    }
                }
            })
        }
        </script>