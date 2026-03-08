<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Fund Transfer</h5>
    <hr>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-group">
                <label>Member ID</label>
                <input type="text" placeholder="Member ID" name="" id="customer_id" class="form-control" id="name">
                <small><span id="member_msg"></span></small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Amount (in &#8377;)</label>
                <input type="number" placeholder="Amount (in &#8377;)" name="" id="amount" class="form-control" id="name">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Wallet Type</label>
                <select name="wallet" id="wallet" class="form-control">
                    <option value="" selected >Select an option</option>
                    <?php foreach($wallet as $wl) 
                    {?>

                    <option value="<?=$wl['id']?>"><?=$wl['wallet']?></option>
                    <?php } ?>
                    
                </select>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <label for="">Remark</label>
                <textarea name="remarks" id="remarks" rows="2" class="form-control" placeholder="Remark"></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-12 text-right">
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="button" name="addstaff" class="btn btn-primary" onclick="transfer()">Transfer</button>
            </div>
        </div>
    </div>
</div>

<script>
    transfer=function()
    {
        if($("#wallet").val()=="" || $("#customer_id").val()=="" || Number($("#amount").val()==0))
        {
            alert("Invalid entry.Please check well and process.");
            return;
        }
        if(!confirm("Transfer in progress.Press Ok to continue.")) return;
        var d={
            "customer_id":$("#customer_id").val(),
            "amount":$("#amount").val(),
            "wallet":$("#wallet").val(),
            "remarks":$("#remarks").val()
        }

        $.ajax({
            url:"<?=base_url('fund/transfer')?>",
            type:"POST",
            dataType:"JSON",
            data:d,
            success:function(data)
            {
                // alert(data);
                if(data=='d')
                {
                    alert("Invalid member id");
                    return;
                }
                alert("Transfered successfully.");
                $("#customer_id").val(),
                $("#amount").val(),
                $("#wallet").val(),
                $("#remarks").val()
                location.reload()

            },
            error:function(data){
                alert(data);
            }
        })

    }

    $(document).on('input', '#customer_id', function(){
        let cust_id = $(this).val()

        $.ajax({
            url : '<?php echo base_url('fund/find_customer_id') ?>',
            method : 'POST',
            data : 'id='+cust_id,

            success:function(data){
                if(data == 0){
                    $('#member_msg').html('Member ID not found').addClass('text-danger').removeClass('text-success')
                }else{
                    $('#member_msg').html(data).addClass('text-success').removeClass('text-danger')
                }
            }
        })
    })
</script>