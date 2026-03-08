<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Sponsor Bonus</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <div class="row mb-3">
            <form id="view" action="<?=base_url('earnings/sponsor_bonus')?>" method="POST">
            <div class="row">
                <div class="col-lg-5">
                    <label for="">From</label>
                    <input type="date" class="form-control" id="dtf" name="dtf" value="<?=($dtf!=''?$dtf:date("Y-m-d"))?>">
                </div>
                <div class="col-lg-5">
                    <label for="">To</label>
                    <input type="date" class="form-control" id="dtt" name="dtt" value="<?=($dtt!=''?$dtt:date("Y-m-d"))?>">
                </div>
                <div class="col-lg-2 mt-2">
                    <button  class="btn btn-success mt-4">Display</button>
                </div>
            
                        </div>
            </form>
            </div>
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Member Details</th>
                            <th class="text-center">Sponsor Bonus</th>
                            <th>Remarks</th>
                            <th>Date & Time</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i=0;
                        foreach($income as $inc) { ?>
                        <tr>
                            <td><?=++$i?></td>
                            <td nowrap style="font-size:12px;">
                                Member Id : <?=$inc['cid']?>,<br />
                                Member Name : <?=$inc['cname']?>,<br />
                                Member Package : <?=$inc['cpackage']?>,<br />
                            </td>
                            <td class="text-center">&#8377;<?=$inc['credit']?></td>
                            <td><?=$inc['remarks']?></td>
                            <td><?=$inc['dt']?></td>
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