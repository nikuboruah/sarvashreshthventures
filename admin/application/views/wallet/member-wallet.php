<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Member Wallet</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <!-- <div class="row mb-3">
                <div class="col-lg-3">
                    <input type="date" name="" id="" class="form-control">
                </div>
                <div class="col-lg-3">
                    <input type="date" name="" id="" class="form-control">
                </div>
                <div class="col-lg-3">
                    <button class="btn btn-info">Submit</button>
                </div>
            </div> -->
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th nowrap>Member Details</th>
                            <th>Available Amount</th>
                            <th>Total Income</th>
                            <th>Total Sponsor Bonus</th>
                            <th>Total Matching Bonus</th>
                            <th>Total Repurchase Bonus</th>
                            <th>Total Self Repurchase Bonus</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=0;
                        foreach($wallet as $wl){
                            $m_id = $wl['customer_id'];
                            $bank_details = $this->Crud->ciCount("kyc_master", "`customer_id` = '$m_id'");
                        ?>
                        <tr class="text-center">
                            <td class="text-center"><?=++$i?></td>
                            <td class="text-left" nowrap style="font-size:12px;">
                                Member Id : <?=$wl['customer_id']?> ,<br />
                                Name : <?=$wl['name']?>
                            </td>
                            <td class="h5 text-success">&#8377;<?= $wl['main_wallet'] ?></td>
                            <td>&#8377;<?= $wl['wallet_income'] ?></td>
                            <td>&#8377;<?= $wl['sponsor_bonus'] ?></td>
                            <td>&#8377;<?= $wl['matching_bonus'] ?></td>
                            <td>&#8377;<?= $wl['repurchase_bonus'] ?></td>
                            <td>&#8377;<?= $wl['repurchase_self_bonus'] ?></td>
                            <td>
                                <button <?= $bank_details == 0 ? 'disabled' : '' ?> class="btn btn-info" id="<?= $wl['customer_id']."/".$wl['main_wallet']."/".$wl['pan'] ?>" onclick="payNow(this)">PAY
                                    NOW</button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Modal</h5>
                <button type="button" class="close" onclick="window.location.reload()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('wallet/pay_amount') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 mb-3">
                            <label for="">Available Amount</label>
                            <input type="text" name="a_amt" id="a_amt" value="" class="form-control" readonly>
                            <input type="text" name="c_id" id="c_id" hidden>
                            <input type="text" id="min_withdrawal_amt" value="<?= $SETTINGS[0]->min_withdrawal_amt ?>" hidden>
                            <input type="text" hidden id="tds" value="<?= $SETTINGS[0]->tds ?>">
                            <input type="text" hidden id="pan" value="<?= $SETTINGS[0]->pan ?>">
                            <input type="text" hidden id="admIn_charge" value="<?= $SETTINGS[0]->admIn_charge ?>">
                            <input type="text" hidden id="pan_status" >
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="">Payable Amount</label>
                            <input type="number" name="p_amt" id="p_amt"  value="" placeholder="Amount" class="form-control" min="<?= $SETTINGS[0]->min_withdrawal_amt ?>" max="" required>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="">TDS Amount (<?= $SETTINGS[0]->tds ?>%)</label>
                            <input type="text" name="tds_amt" id="tds_amt" value="TDS" placeholder="" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="">Admin Charge (<?= $SETTINGS[0]->admIn_charge ?>)</label>
                            <input type="text" name="ad_amt" id="ad_amt" value="Admin Charge" placeholder="" class="form-control"
                                readonly>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="">PAN Charge (<?= $SETTINGS[0]->pan ?>%)</label>
                            <input type="text" name="pan_amt" id="pan_amt" value="PAN Charge" placeholder="" class="form-control"
                                readonly>
                            <span style="font-size:10px;">If PAN Card not available</span>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <label for="">Net Amount</label>
                            <input type="text" name="net_amt" id="net_amt" value="Amount" placeholder="" class="form-control"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="window.location.reload()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Pay Now</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

function cal_all(){
    let amount = $('#p_amt').val();
    let pan_status = $('#pan_status').val();
    let tds = $('#tds').val()
    let adm = $('#admIn_charge').val()
    let pan = $('#pan').val()

    if(pan_status == ''){
        let tds_chrg = (tds/100)*amount;
        $('#tds_amt').val(Math.floor(tds_chrg))

        let adm_chrg = (adm/100)*amount;
        $('#ad_amt').val(Math.floor(adm_chrg))

        let pan_chrg = (pan/100)*amount;
        $('#pan_amt').val(Math.floor(pan_chrg))

        let final_chrg = amount - (tds_chrg + adm_chrg + pan_chrg);
        $('#net_amt').val(Math.floor(final_chrg))
    }else{
        let tds_chrg = (tds/100)*amount;
        $('#tds_amt').val(Math.floor(tds_chrg))

        let adm_chrg = (adm/100)*amount;
        $('#ad_amt').val(Math.floor(adm_chrg))

        let pan_chrg = 0;
        $('#pan_amt').val(Math.floor(pan_chrg))

        let final_chrg = amount - (tds_chrg + adm_chrg + pan_chrg);
        $('#net_amt').val(Math.floor(final_chrg))
    }
}

$(document).on('input', '#p_amt', function(){
    let amount = $(this).val();
    let pan_status = $('#pan_status').val();
    let tds = $('#tds').val()
    let adm = $('#admIn_charge').val()
    let pan = $('#pan').val()

    if(pan_status == ''){
        let tds_chrg = (tds/100)*amount;
        $('#tds_amt').val(Math.floor(tds_chrg))

        let adm_chrg = (adm/100)*amount;
        $('#ad_amt').val(Math.floor(adm_chrg))

        let pan_chrg = (pan/100)*amount;
        $('#pan_amt').val(Math.floor(pan_chrg))

        let final_chrg = amount - (tds_chrg + adm_chrg + pan_chrg);
        $('#net_amt').val(Math.floor(final_chrg))
    }else{
        let tds_chrg = (tds/100)*amount;
        $('#tds_amt').val(Math.floor(tds_chrg))

        let adm_chrg = (adm/100)*amount;
        $('#ad_amt').val(Math.floor(adm_chrg))

        let pan_chrg = 0;
        $('#pan_amt').val(Math.floor(pan_chrg))

        let final_chrg = amount - (tds_chrg + adm_chrg + pan_chrg);
        $('#net_amt').val(Math.floor(final_chrg))
    }
})
</script>