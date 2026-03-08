<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Transfer Report</h5>
    <hr>
    <div class="row">
        <div class="col-sm">
            <div class="row mb-3">
            <form id="view" action="<?=base_url('fund/transfer_report')?>" method="POST">
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
                            <th nowrap>Member Details</th>
                            <th>Amount</th>
                            <th>Wallet Type</th>
                            <th>Company Remark</th>
                            <th>Transferred Date & Time</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i=0;
                        foreach($transfer as $dc) {?>
                            <tr>
                            <td><?=++$i?></td>
                            <td nowrap style="font-size:12px;">
                            Member Id : <?=$dc['customer_id']?> ,<br/>
                            Epin : <?=$dc['epin']?> ,<br/>
                            Member Name :  <?=$dc['name']?> <br/>
                          
                            </td>
                            <td class="text-right"> &#8377; <?=$dc['amount']?> </td>
                            <td ><?=$dc['wl']?> </td>

                            <td> <?=$dc['remarks']?> </td>
                            <td class="text-center"> <?=$dc['dt']?> </td>
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