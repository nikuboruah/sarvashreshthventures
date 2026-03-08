<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Payout Days</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <div class="row mt-3">
                <?php $id = 0; foreach($DAYS as $data){
                    $d = ++$id;    
                ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><?= $data->days ?></label>
                        <select id="days-<?= $d ?>" onchange="updateDaysStatus('<?= $d ?>')" class="form-control">
                            <option value="1" <?= $data->status == '1' ? 'selected' : '' ?>>Open</option>
                            <option value="0" <?= $data->status == '0' ? 'selected' : '' ?>>Block</option>
                        </select>
                        <input type="hidden" value="<?= $data->id ?>" id="d_status-<?= $d ?>" class="form-control">
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
function updateDaysStatus(x) {
    let result = confirm("Are you sure you want to update status");
    if (result) {
        let status = $("#days-" + x).val()
        let id = $("#d_status-" + x).val()

        let d = {
            'status': status,
            'id': id,
        }

        $.ajax({
            url: '<?php echo base_url('payouts/update_days_status') ?>',
            data: d,
            method: 'POST',

            sucess: function(data) {
                if (data == 1) {
                    alert("Status Changed");
                } else {
                    alert("Something went wrong. Try agin.");
                }
            }
        })
    }
}
</script>