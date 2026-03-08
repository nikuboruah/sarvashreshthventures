<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-portlet__body card p-5 shadow border-0">
    <?php if($STATUS == 1){ ?>
        <h5>Pending Rank</h5>
    <?php }else if($STATUS == 2){ ?>
        <h5>Approved Rank</h5>
    <?php }else if($STATUS == 3){ ?>
        <h5>Rejected Rank</h5>
    <?php } ?>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <div class="row mb-3">
                <div class="col-lg-3">
                    <input type="date" name="" id="" class="form-control">
                </div>
                <div class="col-lg-3">
                    <input type="date" name="" id="" class="form-control">
                </div>
                <div class="col-lg-3">
                    <button class="btn btn-info">Submit</button>
                </div>
            </div>
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Present Rank</th>
                            <th nowrap>Member Details</th>
                            <th>Rank Requested For</th>
                            <th>Package Amount</th>
                            <?php if($STATUS == 3){ ?>
                            <th>Rejected Date &amp; Time</th>
                            <th>Company Remark</th>
                            <th>Member Remark</th>
                            <?php } ?>
                            <?php if($STATUS == 1 || $STATUS == 2){ ?>
                            <th>Payment Details</th>
                            <th></th>
                            <th></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td nowrap style="font-size:12px;">
                                Member Id : ,<br />
                                Epin : ,<br />
                                Member Name : ,<br />
                                Member Number :
                            </td>
                            <td></td>
                            <td></td>
                            <?php if($STATUS == 3){ ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php } ?>
                            <?php if($STATUS == 1 || $STATUS == 2){ ?>
                            <td>
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#paymentHistory">Payment History</button>
                            </td>
                            <td></td>
                            <td></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="paymentHistory" tabindex="-1" role="dialog" aria-labelledby="paymentHistoryTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentHistoryTitle">Payment History</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Proof</th>
                        <th>UTR No's</th>
                        <th>Company Remark</th>
                        <th>Member Remark</th>
                        <th>Payment Date & Time</th>
                        <th>Approved Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>