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
                                        <?php if($STATUS == 1){ ?>
                                        Payout Requests
                                        <?php }else if($STATUS == 2){ ?>
                                        Paid Payouts
                                        <?php }else if($STATUS == 3){ ?>
                                        Rejected Payouts
                                        <?php } ?>
                                    </a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <?php if($STATUS == 1){ ?>
                            Payout Requests
                            <?php }else if($STATUS == 2){ ?>
                            Paid Payouts
                            <?php }else if($STATUS == 3){ ?>
                            Rejected Payouts
                            <?php } ?>
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
                                <?php if($STATUS == 1){ ?>
                                Payout Requests
                                <?php }else if($STATUS == 2){ ?>
                                Paid Payouts
                                <?php }else if($STATUS == 3){ ?>
                                Rejected Payouts
                                <?php } ?>
                            </h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <?php $this->load->view('messages'); ?>

                            <div class="row">
                                <div class="col-sm">
                                    <form action="" method="POST">
                                        <p>Search by Requested Date</p>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <input type="date" name="from" value="<?= $FROM?$FROM:'' ?>" id=""
                                                    class="form-control" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="date" name="to" value="<?= $TO?$TO:'' ?>" id=""
                                                    class="form-control" required>
                                            </div>

                                            <div class="col-lg-3">
                                                <button type="submit" name="sendSubmit"
                                                    class="btn btn-info">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-wrap">
                                        <table class="table table-striped- table-bordered table-hover table-checkable"
                                            id="kt_table_1">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th nowrap>Member Details</th>
                                                    <th nowrap>Payment Details</th>
                                                    <th nowrap>Requested Amount</th>
                                                    <th>Processing Fees</th>
                                                    <th>Net Amount</th>
                                                    <th>Requested Date & Time</th>
                                                    <?php if($STATUS == 1){ ?>
                                                    <th>Actions</th>
                                                    <?php } if($STATUS == 2){ ?>
                                                    <th>Approved Date & Time</th>
                                                    <?php } else if($STATUS == 3){ ?>
                                                    <th>Rejected Date & Time</th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $id = 0; foreach($PAYOUTS as $data){ ?>
                                                <tr>
                                                    <td><?= ++$id ?></td>
                                                    <td nowrap style="font-size:12px;">
                                                        Member Id : <?= $data->customer_id ?>,<br />
                                                        Member Name : <?= $data->user_name ?>,<br />
                                                        Member Number : <?= $data->user_phone ?>,<br />
                                                        Member Package : <?= $data->package_name ?>
                                                    </td>
                                                    <td nowrap style="font-size:12px;">
                                                        A/C No : <?= $data->ac_no ?>,<br />
                                                        IFSC : <?= $data->ifsc_code ?>,<br />
                                                        Bank Name : <?= $data->bank_name ?>,<br />
                                                        A/C Holder : <?= $data->payee_name ?>
                                                    </td>
                                                    <td class="text-center">
                                                        &#8377;<?= number_format($data->req_amt, 2) ?></td>
                                                    <td class="text-center">
                                                        &#8377;<?= number_format($data->processing_amt, 2) ?></td>
                                                    <td class="text-center">
                                                        &#8377;<?= number_format($data->final_amount, 2) ?></td>
                                                    <td><?= date('d M Y, h:i A', strtotime($data->req_date)) ?></td>
                                                    <?php if($STATUS == 1){ ?>
                                                    <td>
                                                        <button class="btn btn-success btn-sm"
                                                            id="<?= $data->req_amt.'~'.$data->processing_amt.'~'.$data->final_amount.'~'.$data->customer_id.'~'.$data->id ?>"
                                                            onclick="approvePayout(this)">Approve</button>
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="rejectPayout('<?= $data->id ?>')">Reject</button>
                                                    </td>
                                                    <?php } if($STATUS == 2){ ?>
                                                    <td><?= date('d M Y, h:i A', strtotime($data->approve_request_date)) ?>
                                                    </td>
                                                    <?php } else if($STATUS == 3){ ?>
                                                    <td><?= date('d M Y, h:i A', strtotime($data->approve_request_date)) ?>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Modal -->
        <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordModalTitle">Transaction Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo base_url('payouts/approve_customer_wallet') ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Transaction Password</label>
                                <input type="password" name="tpassword" id="tpassword"
                                    placeholder="Enter transaction password" id="" class="form-control" required>
                                <span id="password_message"></span>
                                <input type="hidden" name="r_amount" id="r_amount">
                                <input type="hidden" name="p_amount" id="p_amount">
                                <input type="hidden" name="f_amount" id="f_amount">
                                <input type="hidden" name="cust_id" id="cust_id">
                                <input type="hidden" name="req_id" id="req_id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="approveNow" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
        $('#approveNow').prop('disabled', true)

        function approvePayout(x) {
            let d = x.id.split('~')

            $('#r_amount').val(d[0])
            $('#p_amount').val(d[1])
            $('#f_amount').val(d[2])
            $('#cust_id').val(d[3])
            $('#req_id').val(d[4])
            $('#passwordModal').modal('show')
        }

        $(document).on('input', '#tpassword', function() {
            let password = $(this).val();

            $.ajax({
                url: '<?php echo base_url('payouts/validate_transaction_password') ?>',
                method: 'POST',
                data: 'password=' + password,

                success: function(data) {
                    if (data == 1) {
                        $('#password_message').html('Password match').addClass(
                            'text-success').removeClass(
                            'text-danger')
                        $('#approveNow').prop('disabled', false)
                    } else {
                        $('#password_message').html('Password didn\'t match')
                            .addClass('text-danger')
                            .removeClass('text-success')
                        $('#approveNow').prop('disabled', true)
                    }
                }
            })
        })

        rejectPayout = function(x) {
            let result = confirm('Are you sure you want to reject')
            if (result) {
                $.ajax({
                    url: '<?php echo base_url('payouts/reject_payout') ?>',
                    method: 'POST',
                    data: 'id=' + x,

                    success: function(data) {
                        if (data == 1) {
                            alert('Payout request rejected');
                            location.reload()
                        } else {
                            alert('Something went wrong. Try again.');
                        }
                    }
                })
            }
        }
        </script>