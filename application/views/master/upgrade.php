<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-portlet__body card p-5 shadow border-0">
    <h5><?= $page ?></h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th nowrap>Package Name</th>
                            <th nowrap>Package Price</th>
                            <th class="text-center" nowrap>PV</th>
                            <th class="text-center" nowrap>Transaction No</th>
                            <th class="text-center" nowrap>Requested On</th>
                            <th class="text-center" nowrap>Approved/Rejected On</th>
                            <th class="text-center" nowrap>Status</th>
                            <th>Rejected Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 0; foreach($pack as $data){ ?>
                        <tr>
                            <td><?= ++$id ?></td>
                            <td><?= $data->package_name ?></td>
                            <td class="text-right">&#8377;<?= number_format($data->package_price,2) ?></td>
                            <td><?= $data->pv ?></td>
                            <td><?= $data->transaction_no == '' ? '--' : $data->transaction_no ?><br/><?= $data->proof=='' ? '' : '<a target="_blank" href="../uploads/member/proof/'.$data->proof.'">View Proof</a>' ?></td>
                            <td><?= date('d-m-Y', strtotime($data->request_on)) ?></td>
                            <td><?= date('d-m-Y', strtotime($data->approved_on)) ?></td>
                            <td><?= $data->status == '0' ? '<span class="text-warning">Pending</span>' : ($data->status == 1 ? '<span class="text-success">Approved</span>' : '<span class="text-danger">Rejected</span>') ?></td>
                            <td><?= $data->rejected_reason ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>