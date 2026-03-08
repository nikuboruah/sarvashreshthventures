<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Page Controls</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <div class="row mt-3">
                <?php $id = 0; foreach($PAGE_CONTROL as $data){
                    $d = ++$id;    
                ?>
                <div class="col-md-4" <?= $data->page_name == 'Website' ? 'hidden' : '' ?>>
                    <div class="form-group">
                        <label><?= $data->page_name ?></label>
                        <select id="page-<?= $d ?>" onchange="updatePageStatus('<?= $d ?>')" class="form-control">
                            <option value="1" <?= $data->status == '1' ? 'selected' : '' ?>>Open</option>
                            <option value="0" <?= $data->status == '0' ? 'selected' : '' ?>>Block</option>
                        </select>
                        <input type="hidden" value="<?= $data->id ?>" id="p_status-<?= $d ?>" class="form-control">
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
function updatePageStatus(x) {
    let result = confirm("Are you sure you want to update status");
    if (result) {
        let status = $("#page-" + x).val()
        let id = $("#p_status-" + x).val()

        let d = {
            'status': status,
            'id': id,
        }

        $.ajax({
            url: '<?php echo base_url('settings/update_page_status') ?>',
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