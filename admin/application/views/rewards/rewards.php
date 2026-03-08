<div class="kt-portlet__body card p-5 shadow border-0">
    <?php if($STATUS == 1){ ?>
    <h5>Reward Requests</h5>
    <?php }else if($STATUS == 2){ ?>
    <h5>Approved Rewards</h5>
    <?php } ?>
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
                            <th nowrap>Member Details</th>
                            <th>Rank</th>
                            <th>SV</th>
                            <th>Reward Type</th>
                            <th>Reward</th>
                            <th>Requested Date & Time</th>
                            <?php if($STATUS == 1){ ?>
                                <td nowrap>Actions</td>
                            <?php } if($STATUS == 2){ ?>
                                <th>Approved Date & Time</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 0; foreach($REWARD as $data){ ?>
                        <tr>
                            <td><?= ++$id ?></td>
                            <td nowrap style="font-size:12px;">
                                Member Id : <?= $data->customer_id ?>,<br />
                                Member Name : <?= $data->name ?>,<br />
                                Member Package : <?= $data->package_name ?>
                            </td>
                            <td><?= $data->rank ?></td>
                            <td><?= $data->sv_matching ?></td>
                            <td><?= $data->request_type == '' ? '--' : ($data->request_type == 1 ? 'Reward' : 'Amount')  ?></td>
                            <td><?= $data->request_type == 1 ? $data->reward : $data->reward_amount ?></td>
                            <td><?= $data->requested_date ? date('d M Y, h:i A', strtotime($data->requested_date)) : '--' ?></td>
                            <?php if($STATUS == 1){ ?>
                            <td nowrap>
                                <button class="btn btn-success btn-sm" id="<?= $data->rank_history_id.'/'.$data->request_type ?>" onclick="approveReward(this)">Approve</button>
                            </td>
                            <?php } if($STATUS == 2){ ?>
                            <td><?= $data->approve_reject_date ? date('d M Y, h:i A', strtotime($data->approve_reject_date)) : '--' ?></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function approveReward(x){
        let dt = x.id.split('/');
        let d = {
            'id' : dt[0],
            'r_type' : dt[1]
        }
        $.ajax({
            url : '<?php echo base_url('rewards/approve_reward') ?>',
            method : 'POST',
            data : d,

            success:function(data){
                if(data == 1){
                    alert('Request approved.')
                    location.reload()
                }else{
                    alert('Something went wrong. Try again.')
                }
            }
        })
    }
</script>