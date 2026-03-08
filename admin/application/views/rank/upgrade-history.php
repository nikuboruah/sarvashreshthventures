<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-portlet__body card p-5 shadow border-0">
        <h5>Upgrade History</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
    <div class="col-sm-12">
            <div class="row mb-3">
            <form id="view" action="<?=base_url('rank/upgrade_history')?>" method="POST">
            <div class="row">
            <div class="col-sm-5">
                <label for="">From</label>
                <input type="date" class="form-control" id="dtf" name="dtf" value="<?=($dtf!=''?$dtf:date("Y-m-d"))?>">
            </div>
            <div class="col-sm-5">
                <label for="">To</label>
                <input type="date" class="form-control" id="dtt" name="dtt" value="<?=($dtt!=''?$dtt:date("Y-m-d"))?>">
            </div>
            <div class="col-sm-2 mt-2">
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
                            <th>Upgraded From</th>
                            <th>Upgraded To</th>
                            <th>Package Amount</th>
                            <th>Upgarde Amount</th>
                            <th>Upgrade Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=0;
                        foreach($history as $hs){ ?>
                        <tr>
                            <td><?=++$i?></td>                            
                            <td nowrap style="font-size:12px;">
                                Member Id : <?=$hs['customer_id']?>,<br />
                                Epin :  <?=$hs['epin']?>,<br />
                                Member Name :  <?=$hs['name']?>
                            </td>
                            <td> <?=$hs['pack_from']?></td>
                            <td> <?=$hs['pack_to']?></td>
                            <td class="text-right"> &#8377;<?=$hs['pt_amount']?></td>
                            <td class="text-right"> &#8377;<?=$hs['amount_paid']?></td>
                            <td><?=$hs['dt']?></td>
                            <td></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>