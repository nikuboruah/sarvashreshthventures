<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Reward Requests</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Rank</th>
                            <th>SV</th>
                            <th class="text-center">Reward (In &#8377;)</th>
                            <th class="text-center">Reward (In Item)</th>
                            <th>Achieving Date & Time</th>
                            <th>Request Date</th>
                            <th>Request Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id=0; foreach($REWARD as $data){ ?>
                        <tr>
                            <td class="text-center"><?= ++$id ?></td>
                            <td class="text-center"><?= $data->rank ?></td>
                            <td class="text-center"><?= $data->sv_matching ?></td>
                            <td class="text-center">
                                <?= $data->reward ?><br/>
                                <button class="btn btn-success btn-sm" id="<?= $data->rank_history_id.'/1' ?>" onclick="send_request(this)" <?= $data->request_status == 0 ? '' : 'disabled' ?>>Request</button>
                            </td>
                            <td class="text-center">
                                <?php if($data->reward_amount == ''){
                                    echo '--';
                                }else{ ?>
                                &#8377;<?= $data->reward_amount ?><br/>
                                <button class="btn btn-info" id="<?= $data->rank_history_id.'/2' ?>" onclick="send_request(this)" <?= $data->request_status == 0 ? '' : 'disabled' ?>>Request</button>
                                <?php } ?>
                            </td>
                            <td class="text-center"><?= date('d M Y, h:i A', strtotime($data->date)) ?></td>
                            <td><?= $data->requested_date ? date('d M Y, h:i A', strtotime($data->requested_date)) : '--' ?></td>
                            <td class="text-center"><?= $data->request_type == '' ? '--' : ($data->request_type == 1 ? 'Reward' : 'Amount') ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>


<script>
    function send_request(x){
        let dt = x.id.split('/')

        let d = {
            'r_id' : dt[0],
            'r_type' : dt[1]
        }

        $.ajax({
            url : '<?php echo base_url('rewards/send_request') ?>',
            method : 'POST',
            data : d,

            success:function(data){
                if(data == 1){
                    alert('Request sent.')
                    location.reload()
                }else{
                    alert('Something went wrong. Try again.')
                }
            }
        })
    }
</script>