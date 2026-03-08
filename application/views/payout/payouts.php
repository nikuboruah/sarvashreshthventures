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
                                    <div class="table-responsive">
                                        <table class="table" id="datatable_1">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th nowrap>Member Details</th>
                                                    <th nowrap>Payment Details</th>
                                                    <th nowrap>Requested Amount</th>
                                                    <th>Processing Fees</th>
                                                    <th>Net Amount</th>
                                                    <th>Requested Date & Time</th>
                                                    <?php if($STATUS == 2){ ?>
                                                    <th>Approved Date & Time</th>
                                                    <?php } else if($STATUS == 3){ ?>
                                                    <!-- <th>Company Remark</th>
                            <th>Member Remark</th> -->
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
                                                    <?php if($STATUS == 2){ ?>
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