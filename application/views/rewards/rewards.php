<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Approved Rewards</h5>
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
                        <tr>
                            <th>#</th>
                            <th>Rank</th>
                            <th>SV</th>
                            <th>Reward Type</th>
                            <th>Reward</th>
                            <th>Requested Date & Time</th>
                            <th>Approved Date & Time</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 0; foreach($REWARD as $data){ ?>
                        <tr>
                            <td><?= ++$id ?></td>
                            <td><?= $data->rank ?></td>
                            <td><?= $data->sv_matching ?></td>
                            <td><?= $data->request_type == '' ? '--' : ($data->request_type == 1 ? 'Reward' : 'Amount')  ?></td>
                            <td><?= $data->request_type == 1 ? $data->reward : $data->reward_amount ?></td>
                            <td><?= $data->requested_date ? date('d M Y, h:i A', strtotime($data->requested_date)) : '--' ?></td>
                            <td><?= $data->approve_reject_date ? date('d M Y, h:i A', strtotime($data->approve_reject_date)) : '--' ?></td>
                            <th></th>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>