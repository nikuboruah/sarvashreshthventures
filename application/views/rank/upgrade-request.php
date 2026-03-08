<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-portlet__body card p-5 shadow border-0">
    <div class="d-flex justify-content-between">
        <h5>Upgrade</h5>
        <h5><span class="text-info">TOPUP WALLET</span> : &#8377; <?=($current_package[0]?$current_package[0]['topup_wallet']:0) ?></h5>
    </div>
    <hr>
    <?php $this->load->view('messages'); 
    foreach($current_package as $cp)
    {
    ?>
    
    <div class="row">
        <div class="col-lg-12 mb-3">
            <h5><strong>CURRENT PACKAGE : </strong> <strong><?=$cp['package_name'].' - '.$cp['package_amount']?></strong>  </h5>
        </div>
       <input type="text" hidden value="<?=$cp['package_amount']?>" id='camount'>
       <input type="text" hidden value="<?=$cp['package_id']?>" id='pre_packid'>
       <input type="text" hidden value="<?=$cp['topup_wallet']?>" id='wallet'>


    </div>
<?php } ?>

    <div class="row">
        <div class="col-lg-12 mb-3">
            <h5><strong>UPGRADE TO :</strong> </h5>
        </div>
        <!-- <div class="col-lg-4">
            <div class="form-group">
                <label for="">Member ID</label>
                <input type="text" class="form-control" placeholder="Enter member ID" name="cust_id" id="cust_id"
                    required>
                <small><span id="cust_msg"></span></small>
            </div>
        </div> -->
        <div class="col-lg-4">
            <div class="form-group">
                <label for="">Choose Package</label>
                <select name="package" id="package" class="form-control" required onchange="choose_package(this);">
                    <option value="" selected disabled>Choose a package</option>
                    <?php foreach($package as $pk) {
                    ?>
                    <option value="<?=$pk['package_id']."/".$pk['package_amount']."/".$pk['sponsor_income_prcentage']?>" ><?=$pk['package_name'].' - &#8377;'.$pk['package_amount']?></option>
                    <?php
                    }?>
                </select>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="form-group">
                <label for="">Package Amount &#8377;</label>
                <input type="text" class="form-control text-center" name="pamount" id="pamount" placeholder="Amount" readonly>
                <small><span id="topup_msg"></span></small>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="form-group">
                <label for="">Payable Amount &#8377;</label>
                <input readonly type="text" placeholder="Enter amount" name="tamount" id="tamount" class="form-control text-center" required>
                <small><span id="amount_msg"></span></small>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="text-right">
                <button type="button" id="activationRequest" class="btn btn-success" onclick="upgrade();">Upgrade</button>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    choose_package=function(x)
    {
        var p=$(x).val().split("/");
        $("#pamount").val(p[1]);
        $("#tamount").val(Number(p[1])-Number($("#camount").val()));
    }

    upgrade=function(){
        if(Number($("#wallet").val()<Number($("#tamount").val())))
        {
            alert("Can't process. Insufficient balance in wallet.");
            return;
        }
        if(!confirm("Upgrdation in progress.Press Ok to confirm.")) return;

        var p=$('#package').val().split("/");      
        $("#pamount").val(p[1]);
        var d={
            "pre_package_id":$("#pre_packid").val(),
            "up_package_id":p[0],
            "amount":Number($("#tamount").val()),
            "sp_income":p[2]
        }
        $.ajax(
            {
                url:"<?=base_url('rank/pack_upgrade')?>",
               
              type:"POST",
              dataType:"JSON",
                data:d,

                success:function(data){
                    // alert(data);
                    if(data=='d') alert("Can't process. Insufficient balance in wallet.");
                    else if(data==1) {
                        alert("Upgraded successfully.");
                        window.location.reload();
                    }
                    else alert("Something wend wrong");
                },
                error:function(data)
                {
                    alert(data);
                }
            }
        )
    }
</script>