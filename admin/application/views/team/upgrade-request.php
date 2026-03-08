<div class="kt-portlet__body card p-5 shadow border-0">
    <h5><?= $PAGE ?></h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th nowrap>Member ID</th>
                            <th>Member Name</th>
                            <th>Upgrade Package</th>
                            <th>Status</th>
                            <th>Requested Date & Time</th>
                            <th>Approved/Rejected Date & Time</th>
                            <th nowrap>Transaction No</th>
                            <th nowrap>Rejected Reason</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 0; foreach($UPGRADE as $data){ ?>
                        <tr>
                            <td><?= ++$id ?></td>
                            <td><?= $data->customer_id ?></td>
                            <td><?= $data->name ?></td>
                            <td><?= $data->package_name ?></td>
                            <td>
                                <?php if($data->status == 0){ ?>
                                <span class="badge badge-warning">Pending</span>
                                <?php }else if($data->status == 1){ ?>
                                <span class="badge badge-success">Approved</span>
                                <?php }else if($data->status == 2){ ?>
                                <span class="badge badge-danger">Rejected</span>
                                <?php } ?>
                            </td>
                            <td><?= date('d/m/Y', strtotime($data->request_on)) ?></td>
                            <td><?= $data->approved_on == '' ? '' : date('d/m/Y', strtotime($data->approved_on)) ?></td>
                            <td><?= $data->transaction_no == '' ? '--' : $data->transaction_no ?><br/><?= $data->proof=='' ? '' : '<a target="_blank" href="../../uploads/member/proof/'.$data->proof.'">View Proof</a>' ?></td>
                            <td><p><?= $data->rejected_reason ?></p></td>
                            <td nowrap>
                                <?php if($data->status == 0){ ?>
                                <button id="<?= $data->id.'/'.$data->request_package.'/'.$data->customer_id ?>"
                                    onclick="upgradeNow(this.id)" class="btn btn-success mr-2">Upgrade Now</span>
                                    <button id="<?= $data->id ?>" onclick="rejectUpgrade(this.id)"
                                        class="btn btn-danger mr-2">Reject Now</span>
                                        <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Rejected modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Reject Reason</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('team/reject_upgradation') ?>" method="POST">
                <div class="modal-body">
                    <textarea name="reject_reason" id="reject_reason" rows="5" placeholder="Reason" class="form-control" required></textarea>
                    <input type="hidden" id="upgradeId" name="upgradeId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
upgradeNow = function(x) {
    let result = confirm('Are you sure you want to upgrade customer package?')

    if (result) {
        let d = x.split('/');
        $.ajax({
            url: '<?php echo base_url('team/upgrade__') ?>',
            method: 'POST',
            data: {
                id: d[0],
                request_package: d[1],
                customer: d[2]
            },

            success: function(data) {
                if (data == 1) {
                    alert('Customer package updated successfully.')
                    location.reload();
                } else {
                    alert('Something went wrong. Please try again.')
                }
            }
        })
    }
}

rejectUpgrade = function(x) {
    $('#upgradeId').val(x)
    $('#rejectModal').modal('show')
}
</script>