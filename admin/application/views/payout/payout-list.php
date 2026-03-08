<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payout List</title>
    <style>
        .container{
            padding : 5px;
        }
        table{
            width : 100%;
            border-collapse: collapse;
            font-size:13px;
        }

        tr th,td{
            border: 1px solid #000;
        }

        .text-center{
            text-align:center;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if($isExist > 0){ ?>
        <table>
            <thead>
                <tr>
                    <th colspan="6">
                    <img src="<?php echo base_url('../portal_assets/images/logo.png') ?>" style="height:80px;" alt="">
                    <h4 style="margin-top:-4px; color:green;">MY HEALTH TO FIT</h4>
                    <h3>Payment List : <?= date('M d, Y', strtotime($DETAILS[0]->approve_request_date)) ?></h3>
                    </th>
                </tr>
                <tr>
                    <th>Sl No</th>
                    <th>Payee Name</th>
                    <th>Bank Name</th>
                    <th>A/C No</th>
                    <th>IFS Code</th>
                    <th>Amount(&#8377;)</th>
                </tr>
            </thead>
            <tbody>
                <?php $id=0; foreach($DETAILS as $data){
                    $_net += $data->final_amount;    
                ?>
                <tr>
                    <td class="text-center"><?= ++$id; ?></td>
                    <td><?= $data->payee_name ?></td>
                    <td><?= $data->bank_name ?></td>
                    <td><?= $data->ac_no ?></td>
                    <td><?= $data->ifsc_code ?></td>
                    <td style="text-align:right;"><?= number_format($data->final_amount, 2) ?></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align:right; color:red; font-size:20px;"><b>Grand Total : </b></td>
                    <td style="text-align:right; color:red; font-size:20px;">&#8377;<?= number_format($_net, 2) ?></td>
                </tr>
            </tfoot>
        </table>
        <?php } else { ?>
            <h4 class="text-center">NOT FOUND</h4>
        <?php } ?>
    </div>
</body>
</html>