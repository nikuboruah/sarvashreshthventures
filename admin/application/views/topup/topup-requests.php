<div class="kt-portlet__body card p-5 shadow border-0">
    <?php if($TOPUP == 0){ ?>
    <h5>Pending Topup Request</h5>
    <?php }else if($TOPUP == 1){ ?>
    <h5>Approved Topup Request</h5>
    <?php } else if($TOPUP == 2){ ?>
    <h5>Rejected Topup Request</h5>
    <?php } ?>
    <?php $this->load->view('messages') ?>
    <hr>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Member ID</th>
                            <th>Amount</th>
                            <th>Proof</th>
                            <th>UTR No</th>
                            <th>Remark</th>
                            <th>Requested Date</th>
                            <th>Status</th>
                            <?php if($TOPUP == 0){ ?>
                            <th>Actions</th>
                            <?php }else if($TOPUP == 1){ ?>
                            <th>Approved On</th>
                            <?php } else if($TOPUP == 2){ ?>
                            <th>Rejected On</th>
                            <th>Rejected Reason</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 0; foreach($REQUEST as $data){ ?>
                        <tr>
                            <td class="text-center"><?= ++$id ?></td>
                            <td>
                                <?= $data->user_name ?><br />
                                <small><?= $data->customer_id ?></small>
                            </td>
                            <td class="text-center">&#8377;<?= number_format($data->amount, 2) ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url('../uploads/member/proof/'.$data->proof) ?>"
                                    target="_blank"><i class="fa fa-file-image"></i></a>
                            </td>
                            <td><?= $data->utr_no ?></td>
                            <td><?= $data->remark ?></td>
                            <td><?= date('d M Y h:i A', strtotime($data->request_date)) ?></td>
                            <td class="text-center">
                                <?= $data->status == '0' ? '<span class="badge badge-warning">Pending</span>' : ($data->status == '1' ? '<span class="badge badge-success">Approved</span>' : '<span class="badge badge-danger">Rejected</span>') ?>
                            </td>
                            <?php if($TOPUP == 0){ ?>
                            <td nowrap>
                                <button onclick="approveRequest(this)"
                                    id="<?= $data->id.'/'.$data->amount.'/'.$data->customer_id.'/1' ?>"
                                    class="btn btn-success">Approve</button>
                                <button onclick="rejectRequest(this)" id="<?= $data->id ?>"
                                    class="btn btn-warning">Reject</button>
                            </td>
                            <?php }else if($TOPUP == 1){ ?>
                            <td><?= date('d M Y h:i A', strtotime($data->approve_reject_date)) ?></td>
                            <?php } else if($TOPUP == 2){ ?>
                            <td><?= date('d M Y h:i A', strtotime($data->approve_reject_date)) ?></td>
                            <td><?= $data->reject_reason ?></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="rejectReasonModal" tabindex="-1" role="dialog" aria-labelledby="rejectReasonModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectReasonModalLabel">Topup Reject Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('topup/reject_topup_request') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="request_id" name="request_id">
                    <textarea name="request_reason" id="request_reason" placeholder="Enter reason" class="form-control" cols="3" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reject Now</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Approve request -->
<div class="modal fade" id="approveReasonModal" tabindex="-1" role="dialog" aria-labelledby="approveReasonModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveReasonModalLabel">Approve Topup Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('topup/changeTopupStatus') ?>" method="POST">
                <div class="modal-body">
                    <label for="">Enter Transaction Password</label>
                    <input type="text" id="t_password" placeholder="Enter password" class="form-control">
                    <span id="t_msg"></span>
                    <input type="hidden" id="rid" name="rid">
                    <input type="hidden" id="amount" name="amount">
                    <input type="hidden" id="c_id" name="c_id">
                    <input type="hidden" id="status" name="status">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="approveBtn" class="btn btn-primary">Approve Now</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$('#approveBtn').prop('disabled', true)
function approveRequest(x) {
    let result = confirm("Are you sure you want to approve topup request")

    if (result) {
        let d = x.id.split('/')
        $('#rid').val(d[0])
        $('#amount').val(d[1])
        $('#c_id').val(d[2])
        $('#status').val(d[3])
        $('#approveReasonModal').modal('show');
    }
}

$(document).on('input', '#t_password', function(){
    let password = $(this).val();

    $.ajax({
        url : '<?php echo base_url('topup/check_transaction_password') ?>',
        method : 'POST',
        data : 'password='+password,

        success:function(data){
            if(data == 1){
                $('#t_msg').html('Password Match.').addClass('text-success').removeClass('text-danger');
                $('#approveBtn').prop('disabled', false)
            }else{
                $('#t_msg').html('Password didn\'t Match.').addClass('text-danger').removeClass('text-success');
                $('#approveBtn').prop('disabled', true);
            }
        }
    })
})

function rejectRequest(x) {
    let result = confirm("Are you sure you want to reject topup request")

    if (result) {
        $('#request_id').val(x.id)
        $('#rejectReasonModal').modal('show')
    }
}
</script>