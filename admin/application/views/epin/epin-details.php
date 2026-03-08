<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-portlet__body card p-5 shadow border-0">
    <?php if($STATUS == 1){ ?>
    <h5>Epin Transfer Request</h5>
    <?php }else if($STATUS == 2){ ?>
    <h5>Epin Approved</h5>
    <?php }else if($STATUS == 3){ ?>
    <h5>Epin Rejected</h5>
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
                            <th nowrap>Member Details</th>
                            <th>E-Pin Count</th>
                            <th>Amount</th>
                            <th>Proof</th>
                            <th>UTR No’s</th>
                            <th>Member Remark</th>
                            <th>Requested Date & Time</th>
                            <?php if($STATUS == 2){ ?>
                            <th>Approved Date & Time</th>
                            <th>E-Pin Count</th>
                            <th>Company Remark</th>
                            <?php } else if($STATUS == 3) { ?>
                            <th>Rejected Date & Time</th>
                            <th>Rejected Remark</th>
                            <?php } ?>
                            <?php if($STATUS == 1){ ?>
                            <th>Actions</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td nowrap style="font-size:12px;">
                                Member Id : ,<br />
                                Epin : ,<br />
                                Member Name : ,<br />
                                Member Number :
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php if($STATUS == 2){ ?>
                            <td></td>
                            <td>
                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#epinModal">Epin</button>
                            </td>
                            <td></td>
                            <?php } else if($STATUS == 3) { ?>
                            <td></td>
                            <td></td>
                            <?php } ?>
                            
                            <?php if($STATUS == 1){ ?>
                            <td nowrap>
                                <button class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to confirm')">Approve</button>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to reject')">Reject</button>
                            </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="epinModal" tabindex="-1" role="dialog" aria-labelledby="epinModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="epinModalLabel">Epin</h5>
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
                                <th class="text-center">E-pin</th>
                                <th>Rank</th>
                                <th>Package</th>
                                <th>Generated Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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