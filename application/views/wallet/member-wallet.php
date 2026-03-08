<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>My Wallet</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th class="text-center">Sponsor Income</th>
                            <th class="text-center">Matching Income</th>
                            <th class="text-center">Repurchase Income</th>
                            <th class="text-center">Total Wallet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($wallet as $wl){ ?>
                        <tr class="text-center">
                            <td class="h3">&#8377;<?= $wl['sponsor_bonus'] ?></td>
                            <td class="h3">&#8377;<?= $wl['matching_bonus'] ?></td>
                            <td class="h3">&#8377;<?= $wl['repurchase_bonus'] ?></td>
                            <td class="h3">&#8377;<?= $wl['sponsor_bonus'] + $wl['matching_bonus'] + $wl['repurchase_bonus'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>