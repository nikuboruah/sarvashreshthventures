<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Weekly Payouts</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <!-- <div class="row mb-3">
            <form id="view" action="<?=base_url('earnings/rank_reward')?>" method="POST">
            <div class="row">
            <div class="col-lg-5">
                <label for="">From</label>
                <input type="date" class="form-control" id="dtf" name="dtf" value="<?=($dtf!=''?$dtf:date("Y-m-d"))?>">
            </div>
            <div class="col-lg-5">
                <label for="">To</label>
                <input type="date" class="form-control" id="dtt" name="dtt" value="<?=($dtt!=''?$dtt:date("Y-m-d"))?>">
            </div>
            <div class="col-lg-3 mt-2">
                <button  class="btn btn-success mt-4">Display</button>
            </div>
            
                        </div>
            </form>
            </div> -->
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Member Details</th>                           
                            <th>Sponsor Bonus</th>
                            <th>Matching Bonus</th>
                            <th>Repurchase Bonus</th>
                            <th>TDS(5%)</th>
                            <th>Admin Charge(5%)</th>
                            <th>PAN Charge(10%)</th>
                            <th>Total Payable Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 0; foreach($reward as $data){ ?>
                        <tr>
                            <td class="text-center"><?= ++$id ?></td>
                            <td>
                                <?=
                                    'Name : '.$data->name.'<br/> ID : '.$data->customer_id;
                                ?>
                            </td>
                            <td class="text-center">&#8377;<?= $data->matching_bonus ?></td>
                            <td><?= $data->rank ?></td>
                            <td><?= $data->gift_received ?></td>
                            <td><?= date('d M Y', strtotime($data->date)) ?></td>
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