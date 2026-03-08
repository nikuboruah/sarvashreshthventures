<div class="kt-portlet__body card p-5 shadow border-0">
    <?php if($TOPUP == 0){ ?>
        <h5>Pending Topup Request</h5>
    <?php }else if($TOPUP == 1){ ?>
        <h5>Approved Topup Request</h5>
    <?php } else if($TOPUP == 2){ ?>
        <h5>Rejected Topup Request</h5>
    <?php } ?>
    <hr>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Amount</th>
                            <th>Proof</th>
                            <th>UTR No</th>
                            <th>Remark</th>
                            <th>Requested Date</th>
                            <th>Status</th>
                            <?php if($TOPUP == 0){ ?>
                            <th></th>
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
                            <td class="text-center">&#8377;<?= number_format($data->amount, 2) ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url('uploads/member/proof/'.$data->proof) ?>" target="_blank"><i class="fa fa-file-image"></i></a>
                            </td>
                            <td><?= $data->utr_no ?></td>
                            <td><?= $data->remark ?></td>
                            <td><?= $data->request_date ?></td>
                            <td class="text-center"><?= $data->status == '0' ? '<span class="badge badge-warning">Pending</span>' : ($data->status == '1' ? '<span class="badge badge-success">Approved</span>' : '<span class="badge badge-danger">Rejected</span>') ?></td>
                            <?php if($TOPUP == 0){ ?>
                            <td></td>
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