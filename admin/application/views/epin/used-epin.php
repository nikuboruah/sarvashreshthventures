<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Unused Epin</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th nowrap>Epin</th>
                            <th>Package Name</th>
                            <th class="text-center">Package Amount</th>
                            <th>Generated Date</th>
                            <th class="text-center">Epin Status</th>
                            <th>Used By</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 0; foreach($UNUSED as $data){ ?>
                        <tr>
                            <td><?= ++$id ?></td>
                            <td><?= $data->epin ?></td>
                            <td><?= $data->package_name ?></td>
                            <td class="text-center">&#8377;<?= $data->package_amount ?></td>
                            <td nowrap><?= date('d M Y, h:i A', strtotime($data->generated_date)) ?></td>
                            <td class="text-center">
                                <?php if($data->owner != ''){ ?>
                                <button class="btn btn-success" id="<?= $data->epin ?>"
                                    onclick="checkTransferHistory(this)">Epin Status</button>
                                <?php }else{ ?>
                                <p>New</p>
                                <?php } ?>
                            </td>
                            <td nowrap>
                            <?= $data->name ?><br/><?= $data->owner ?>
                            </td>
                            <td></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="epinModal" tabindex="-1" role="dialog" aria-labelledby="epinModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="epinModalLabel">Epin Transfer Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive" style="height:500px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">E-pin</th>
                                <th>Package Name</th>
                                <th>Package Amount</th>
                                <th>Transferred From</th>
                                <th>Transferred To</th>
                                <th>Transfer Date</th>
                            </tr>
                        </thead>
                        <tbody id="transferHistory">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
checkTransferHistory = function(x) {
    let epin = x.id;

    $.ajax({
        url: '<?php echo base_url('epin/transfer_history') ?>',
        method: 'POST',
        data: 'epin=' + epin,

        success: function(data) {
            $('#transferHistory').html(data)
            $('#epinModal').modal('show')
        }
    })
}
</script>