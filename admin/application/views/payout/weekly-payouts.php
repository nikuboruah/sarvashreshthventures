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
                                                        <li class="breadcrumb-item"><a href="#">Income & Payouts</a>
                                                        </li>
                                                        <li class="breadcrumb-item"><a href="#">
                                                                Member Wallet
                                                            </a></li>
                                                    </ol>
                                                </div>
                                                <h4 class="page-title">
                                                    Member Wallet
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
                                                        Member Wallet
                                                    </h4>
                                                </div>
                                                <!--end card-header-->
                                                <div class="card-body">
                                                    <?php
                                                        $day_name = date('l');
                                                        $check_day = $this->Crud->ciCount("payout_days", "`days` = '$day_name' AND `status` = '1'");
                                                        if($check_day == 1){
                                                    ?>
                                                    <?php $this->load->view('messages'); ?>
                                                    <div class="row">
                                                        <div class="col-sm">
                                                            <div class="table-wrap">
                                                                <table
                                                                    class="table table-striped- table-bordered table-hover table-checkable"
                                                                    id="kt_table_1" style="font-size:12px;">
                                                                    <thead>
                                                                        <tr class="text-center">
                                                                            <th>#</th>
                                                                            <th nowrap>Member Details</th>
                                                                            <th>Amount</th>
                                                                            <th>TDS(<?= $SETTINGS[0]->tds ?>%)</th>
                                                                            <th>Admin
                                                                                Charge(<?= $SETTINGS[0]->admIn_charge ?>%)
                                                                            </th>
                                                                            <th>PAN Charge(<?= $SETTINGS[0]->pan ?>%)
                                                                            </th>
                                                                            <th>Net Amount</th>
                                                                            <th>Payment</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                            $i=0;
                                                                            foreach($wallet as $wl){
                                                                                $m_id = $wl['customer_id'];
                                                                                $pan_card = $wl['pan'];
                                                                                $m_wallet = $wl['main_wallet'];
                                                                                $m_tds = ($SETTINGS[0]->tds/100)*$m_wallet;
                                                                                $m_admin_charge = ($SETTINGS[0]->admIn_charge/100)*$m_wallet;
                                                                                $m_pan_charge = 0;
                                                                                if($pan_card == ''){
                                                                                    $m_pan_charge = ($SETTINGS[0]->pan/100)*$m_wallet;
                                                                                }
                                                                                $m_net_amount = $m_wallet - ($m_tds + $m_admin_charge + $m_pan_charge);
                                                                                
                                                                                // All total
                                                                                $_total_amount += $m_wallet;
                                                                                $_total_tds += $m_tds;
                                                                                $_total_admin_charge += $m_admin_charge;
                                                                                $_total_pan += $m_pan_charge;
                                                                                $_total_net += $m_net_amount;
                                                                            ?>
                                                                        <tr class="text-center">
                                                                            <td class="text-center"><?=++$i?></td>
                                                                            <td class="text-left" nowrap
                                                                                style="font-size:12px;">
                                                                                Member Id : <?=$wl['customer_id']?>
                                                                                ,<br />
                                                                                Name : <?=$wl['name']?>
                                                                            </td>
                                                                            <td>&#8377;<?= $m_wallet ?></td>
                                                                            <td>&#8377;<?= $m_tds ?></td>
                                                                            <td>&#8377;<?= $m_admin_charge ?></td>
                                                                            <td>&#8377;<?= $m_pan_charge ?></td>
                                                                            <td>&#8377;<?= $m_net_amount ?></td>
                                                                            <td>
                                                                                <button class="btn btn-info btn-sm"
                                                                                    id="<?= $wl['customer_id']."/".$wl['main_wallet']."/".$wl['pan'] ?>"
                                                                                    onclick="payNow(this)">PAY
                                                                                    NOW</button>
                                                                            </td>
                                                                        </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr class="text-right">
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td>Total : <br /><span
                                                                                    class="text-warning h5">&#8377;<?= $_total_amount ?? 0 ?></span>
                                                                            </td>
                                                                            <td>Total : <br /><span
                                                                                    class="text-danger h5">&#8377;<?= $_total_tds ?? 0 ?></span>
                                                                            </td>
                                                                            <td>Total : <br /><span
                                                                                    class="text-danger h5">&#8377;<?= $_total_admin_charge ?? 0 ?></span>
                                                                            </td>
                                                                            <td>Total : <br /><span
                                                                                    class="text-danger h5">&#8377;<?= $_total_pan ?? 0 ?></span>
                                                                            </td>
                                                                            <td>Grand Total : <br /><span
                                                                                    class="text-success h5">&#8377;<?= $_total_net ?? 0 ?></span>
                                                                            </td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php }else{ ?>
                                                    <div class="text-center">
                                                        <h4>Weekly payout details are currently unavailable for today.
                                                        </h4>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="row mt-5">
                                                        <div class="col-lg-12">
                                                            <h4>Payout Details:</h4>
                                                            <hr>
                                                            <form
                                                                action="<?php echo base_url('payouts/find_payout_list') ?>"
                                                                method="POST">
                                                                <p>Enter Payout Date</p>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <input type="date" name="pdate"
                                                                            class="form-control" required>
                                                                    </div>

                                                                    <div class="col-lg-4">
                                                                        <button type="submit"
                                                                            class="btn btn-info">Submit</button>
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

                                <!-- Modal -->
                                <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog"
                                    aria-labelledby="paymentModalLabel" aria-hidden="true" data-backdrop="static">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="paymentModalLabel">Payment
                                                    Modal</h5>
                                                <button type="button" class="close" onclick="window.location.reload()"
                                                    data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo base_url('payouts/pay_amount') ?>" method="POST">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="">Available Amount</label>
                                                            <input type="text" name="a_amt" id="a_amt" value=""
                                                                class="form-control" readonly>
                                                            <input type="text" name="c_id" id="c_id" hidden>
                                                            <input type="text" id="min_withdrawal_amt"
                                                                value="<?= $SETTINGS[0]->min_withdrawal_amt ?>" hidden>
                                                            <input type="text" hidden id="tds"
                                                                value="<?= $SETTINGS[0]->tds ?>">
                                                            <input type="text" hidden id="pan"
                                                                value="<?= $SETTINGS[0]->pan ?>">
                                                            <input type="text" hidden id="admIn_charge"
                                                                value="<?= $SETTINGS[0]->admIn_charge ?>">
                                                            <input type="text" hidden id="pan_status">
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="">Payable Amount</label>
                                                            <input type="number" name="p_amt" id="p_amt" value=""
                                                                placeholder="Amount" class="form-control"
                                                                min="<?= $SETTINGS[0]->min_withdrawal_amt ?>" max=""
                                                                required>
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="">TDS Amount
                                                                (<?= $SETTINGS[0]->tds ?>%)</label>
                                                            <input type="text" name="tds_amt" id="tds_amt" value="TDS"
                                                                placeholder="" class="form-control" readonly>
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="">Admin Charge
                                                                (<?= $SETTINGS[0]->admIn_charge ?>)</label>
                                                            <input type="text" name="ad_amt" id="ad_amt"
                                                                value="Admin Charge" placeholder="" class="form-control"
                                                                readonly>
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="">PAN Charge
                                                                (<?= $SETTINGS[0]->pan ?>%)</label>
                                                            <input type="text" name="pan_amt" id="pan_amt"
                                                                value="PAN Charge" placeholder="" class="form-control"
                                                                readonly>
                                                            <span style="font-size:10px;">If PAN Card
                                                                not available</span>
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="">Net Amount</label>
                                                            <input type="text" name="net_amt" id="net_amt"
                                                                value="Amount" placeholder="" class="form-control"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="window.location.reload()"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Pay
                                                        Now</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
                                </script>
                                <script>
                                function payNow(x) {
                                    let custid = x.id.split('/')
                                    $('#paymentModal').modal('show')
                                    $('#c_id').val(custid[0])
                                    $('#a_amt').val(custid[1])
                                    $('#p_amt').val(Math.floor(custid[1]))
                                    $('#pan_status').val(custid[2])
                                    $('#p_amt').prop("max", custid[1])
                                    cal_all()
                                }

                                function cal_all() {
                                    let amount = $('#p_amt').val();
                                    let pan_status = $('#pan_status').val();
                                    let tds = $('#tds').val()
                                    let adm = $('#admIn_charge').val()
                                    let pan = $('#pan').val()

                                    if (pan_status == '') {
                                        let tds_chrg = (tds / 100) * amount;
                                        $('#tds_amt').val(Math.floor(tds_chrg))

                                        let adm_chrg = (adm / 100) * amount;
                                        $('#ad_amt').val(Math.floor(adm_chrg))

                                        let pan_chrg = (pan / 100) * amount;
                                        $('#pan_amt').val(Math.floor(pan_chrg))

                                        let final_chrg = amount - (tds_chrg + adm_chrg + pan_chrg);
                                        $('#net_amt').val(Math.floor(final_chrg))
                                    } else {
                                        let tds_chrg = (tds / 100) * amount;
                                        $('#tds_amt').val(Math.floor(tds_chrg))

                                        let adm_chrg = (adm / 100) * amount;
                                        $('#ad_amt').val(Math.floor(adm_chrg))

                                        let pan_chrg = 0;
                                        $('#pan_amt').val(Math.floor(pan_chrg))

                                        let final_chrg = amount - (tds_chrg + adm_chrg + pan_chrg);
                                        $('#net_amt').val(Math.floor(final_chrg))
                                    }
                                }

                                $(document).on('input', '#p_amt', function() {
                                    let amount = $(this).val();
                                    let pan_status = $('#pan_status').val();
                                    let tds = $('#tds').val()
                                    let adm = $('#admIn_charge').val()
                                    let pan = $('#pan').val()

                                    if (pan_status == '') {
                                        let tds_chrg = (tds / 100) * amount;
                                        $('#tds_amt').val(Math.floor(tds_chrg))

                                        let adm_chrg = (adm / 100) * amount;
                                        $('#ad_amt').val(Math.floor(adm_chrg))

                                        let pan_chrg = (pan / 100) * amount;
                                        $('#pan_amt').val(Math.floor(pan_chrg))

                                        let final_chrg = amount - (tds_chrg + adm_chrg +
                                            pan_chrg);
                                        $('#net_amt').val(Math.floor(final_chrg))
                                    } else {
                                        let tds_chrg = (tds / 100) * amount;
                                        $('#tds_amt').val(Math.floor(tds_chrg))

                                        let adm_chrg = (adm / 100) * amount;
                                        $('#ad_amt').val(Math.floor(adm_chrg))

                                        let pan_chrg = 0;
                                        $('#pan_amt').val(Math.floor(pan_chrg))

                                        let final_chrg = amount - (tds_chrg + adm_chrg +
                                            pan_chrg);
                                        $('#net_amt').val(Math.floor(final_chrg))
                                    }
                                })
                                </script>