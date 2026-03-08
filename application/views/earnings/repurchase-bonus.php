<div class="kt-portlet__body card p-5 shadow border-0">
    <h5><?= str_replace('Earnings >', '', $PAGE) ?></h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <div class="row mb-3">
                <form id="view" action="<?=base_url('earnings/repurchase_bonus')?>" method="POST">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">From</label>
                            <input type="date" class="form-control" id="dtf" name="dtf"
                                value="<?=($dtf!=''?$dtf:date("Y-m-d"))?>">
                        </div>
                        <div class="col-lg-5">
                            <label for="">To</label>
                            <input type="date" class="form-control" id="dtt" name="dtt"
                                value="<?=($dtt!=''?$dtt:date("Y-m-d"))?>">
                        </div>
                        <div class="col-lg-3 mt-2">
                            <button class="btn btn-success mt-4">Display</button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Repurchase Bonus</th>
                            <th>BV</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=0;
                        foreach($income as $inc) { ?>

                        <tr>
                            <td class="text-center"><?=++$i?></td>
                            <td class="text-center">&#8377;<?=$inc['credit']?></td>
                            <td><?=$inc['remarks']?></td>
                            <td><?= date('d M Y, h:i A', strtotime($inc['vc_date'])) ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>