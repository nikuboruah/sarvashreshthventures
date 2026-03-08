<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Invoice</title>
    <style>
    * {
        font-size: 12px;
    }

    table {
        border: 1px solid #ccc;
        width: 100%;
        border-collapse: collapse;
        margin-top: 2px;
    }

    table tr th,
    td {
        border: 1px solid #ccc;
    }
    </style>
</head>

<body>
    <div style="padding:10px;">
        <div style="text-align:center;">
            <img src="<?php echo base_url('../portal_assets/images/logo.png') ?>" style="height:80px;" alt="">
            <h4>MY HEALTH TO FIT</h4>
            <h3>SALE INVOICE</h3>
        </div>
        <div style="border:1px solid #ccc; padding-left:5px;">
            <h3>SHIPPING DETAILS:</h3>
            <table style="border:none; margin-top:-15px;">
                <tr>
                    <td style="border:none;">
                        <p>
                            <b>Name : </b> <?= $DETAILS[0]->user_name ?><br />
                            <b>Phone No : </b> <?= $DETAILS[0]->user_phone ?><br />
                            <b>Address : <?= $DETAILS[0]->address ?></b>
                        </p>
                    </td>
                    <td style="border:none; text-align:right; vertical-align:top;">
                        <h3>Invoice No : SALE-INV-<?= $DETAILS[0]->id ?>&nbsp;<br/>
                        Invoice Date : <?= date('M d, Y h:i A', strtotime($DETAILS[0]->added_on)) ?>&nbsp;</h3>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <table>
                <colgroup>
                    <col style="width:5%;">
                    <col style="width:35%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                </colgroup>
                <thead>
                    <tr>
                        <th>Sl No.</th>
                        <th>Product Name</th>
                        <th>HSN Code</th>
                        <th>GST(%)</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>GST(&#8377;)</th>
                        <th>Net Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $id = 0;
                        foreach($ITEMS as $data){
                        $gst_per = $data->gst;
                        $qty = $data->qty;
                        $price = $data->price;
                        $net_price = $qty * $price;
                        $gst_amt = ($gst_per/100)*$net_price;

                        // Total
                        $_net += $net_price;
                        $_net_gst += $gst_amt
                    ?>
                    <tr>
                        <td style="text-align:center;"><?= ++$id ?></td>
                        <td><?= $data->product_name ?></td>
                        <td style="text-align:center;"><?= $data->HSN_code ?></td>
                        <td style="text-align:center;"><?= $gst_per ?></td>
                        <td style="text-align:right;"><?= number_format($price, 2) ?></td>
                        <td style="text-align:center;"><?= $qty ?></td>
                        <td style="text-align:center;"><?= number_format($gst_amt,2) ?></td>
                        <td style="text-align:right;"><?= number_format($net_price,2) ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <table>
                <colgroup>
                    <col style="width:50%;">
                    <col style="width:25%;">
                    <col style="width:25%;">
                </colgroup>
                <tbody>
                    <tr>
                        <th rowspan="7" style="text-align:left; vertical-align:top;">
                            <?php                            
                            $obj=new IndianCurrency($_net);
                        ?>
                            <b><u>Amount in words : </u></b><br />
                            <?=$obj->get_words()?>
                        </th>
                        <th style="text-align:right;">Total Amount : </th>
                        <th style="text-align:right;">&#8377;<?= number_format($_net,2) ?></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;">Total CGST (incl.) : </th>
                        <th style="text-align:right;">&#8377;<?= number_format($_net_gst/2, 2) ?></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;">Total SGST (incl.) : </th>
                        <th style="text-align:right;">&#8377;<?= number_format($_net_gst/2, 2) ?></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;">Total IGST (incl.) : </th>
                        <th style="text-align:right;">&#8377;<?= number_format($_net_gst, 2) ?></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;">Net amount to Pay : </th>
                        <th style="text-align:right;">&#8377;<?= number_format($_net,2) ?></th>
                    </tr>
                    <tr>
                        <th style="text-align:right;">Mode of Payment : </th>
                        <th style="text-align:right;">
                            <?= $DETAILS[0]->payment_mode == 'UPI' ? 'UPI/Debit Card/Credit Card/Cheque/Transfer' : $DETAILS[0]->payment_mode ?>
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align:right;">Transaction No. : </th>
                        <th style="text-align:right;">
                            <?= $DETAILS[0]->transaction_no == '' ? '--' : $DETAILS[0]->transaction_no ?></th>
                    </tr>
                </tbody>
            </table>

            <table style="border:none;">
                <tr>
                    <td style="border:none;">
                        <p><b>MY HEALTH TO FIT</b><br />
                            
                        </p>

                        <h3 style="font-size:16px;">Bank Details</h3>
                        <p style="margin-top:-15px;"><b><?= $BANK_DETAILS[0]->payee_name ?></b><br />
                            A/C No. : <?= $BANK_DETAILS[0]->ac_no ?><br />
                            IFSC Code : <?= $BANK_DETAILS[0]->ifsc_code ?><br />
                            Bank Name : <?= $BANK_DETAILS[0]->bank_name ?><br />
                        </p>
                    </td>
                    <td style="border:none; text-align:center;">
                        <h3>Authorized Signature</h3>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>