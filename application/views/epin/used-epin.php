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
                            <th>Package Amount</th>
                            <th>Used By</th>
                            <th></th>
                            <!-- <th>Transfer Epin</th> -->
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 0; foreach($EPIN as $epin){ ?>
                        <tr>
                            <td><?= ++$id ?></td>
                            <td><?= $epin->epin ?></td>
                            <td><?= $epin->package_name ?></td>
                            <td class="text-center">&#8377;<?= number_format($epin->package_amount, 2) ?></td>
                            <td nowrap><?= $epin->name ?><br/><?= $epin->owner ?></td>
                            <td></td>
                            <!-- <td><button class="btn btn-info">TRANSFER</button></td> -->
                            <td></td>
                            <td></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <form action="<?php echo base_url('activation_with_epin') ?>" method="post" id="activation_form">
                    <input type="text" id="epin_new" name="epin_new" hidden>
                    <input type="text" id="mem_id" name="mem_id" hidden>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function registrationWithEPIN(x){
        let d = x.id.split('/')
        $('#epin_new').val(d[0])
        $('#mem_id').val(d[1])
        $('#activation_form').submit()
    }
</script>

