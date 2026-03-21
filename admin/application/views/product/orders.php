<div class="page-wrapper">

    <!-- Page Content-->
    <div class="page-content-tab">

        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Products & Orders</a></li>
                                <li class="breadcrumb-item"><a href="#">Orders</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Products & Orders</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-lg-12">
                    <?php $this->load->view('messages'); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Orders</h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-responsive">
                                        <table class="table" id="datatable_1">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Order ID</th>
                                                    <th>Items</th>
                                                    <th>Customer ID</th>
                                                    <th>PV</th>
                                                    <th>Total Amount</th>
                                                    <th>Payment Mode</th>
                                                    <th>Transaction ID</th>
                                                    <th>Proof</th>
                                                    <th>Address</th>
                                                    <th>Order Type</th>
                                                    <th>Order Date</th>
                                                    <th>Payment Status</th>
                                                    <th>Delivery Status</th>
                                                    <th>Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                            $id = 0;
                            foreach ($orders as $order) {
                            ?>
                                                <tr>
                                                    <td class="<?= $order->payment_status == 0 ? 'bg-warning' : '' ?>">
                                                        <?= ++$id; ?></td>
                                                    <td><?= $order->order_id ?></td>
                                                    <td class="text-center"><button class="btn btn-info"
                                                            onclick="viewItems('<?= $order->order_id ?>')">View</button>
                                                    </td>
                                                    <td><?= $order->customer_id ?><br /><?= $order->name ?></td>
                                                    <td class="text-center"><?= number_format($order->bv) ?></td>
                                                    <td class="text-center">
                                                        &#8377;<?= number_format($order->grand_total, 2) ?></td>
                                                    <td class="text-center"><?= $order->payment_mode ?></td>
                                                    <td class="text-center">
                                                        <?= $order->transaction_no == '' ? '--' : $order->transaction_no ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $order->proof == '' ? '--' : '<a href="'.base_url('../uploads/member/proof/'.$order->proof).'" target="_blank"><i class="fa fa-image h2"></i></a>' ?>
                                                    </td>
                                                    <td><?= $order->address ?></td>
                                                    <td><?= $order->order_status == 0 ? 'Activation' : ($order->order_status == 1 ? 'Repurchase' : 'Upgrade') ?>
                                                    </td>
                                                    <td><?= date('d M Y, h:i A', strtotime($order->added_on)) ?></td>
                                                    <td>
                                                        <?php if($order->payment_status == 0 AND $order->order_status == 1){ ?>
                                                        <button
                                                            id="<?= $order->id.'~'.$order->customer_id.'~'.$order->bv.'~'.$order->order_status.'~'.$order->grand_total ?>"
                                                            onclick="takePayment(this)" class="btn btn-warning">Payment
                                                            Received</button>
                                                        <?php } else if($order->payment_status == 0 AND $order->order_status == 0){ ?>
                                                        <button
                                                            id="<?= $order->id.'~'.$order->customer_id.'~'.$order->bv.'~'.$order->order_status.'~'.$order->grand_total ?>"
                                                            onclick="takePaymentActivation(this)" class="btn btn-warning">Payment
                                                            Received</button>
                                                        <?php }else{ ?>
                                                        Received
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if($order->delivery_status == 0){ ?>
                                                        <button onclick="deliverNow('<?= $order->id.'~'.$order->payment_status ?>')"
                                                            class="btn btn-success">Delivered</button>
                                                        <?php }else{ ?>
                                                        Delivered
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url('product/print_invoice/'. $order->order_id) ?>"
                                                            class="btn btn-info">Print</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <form id='pd' action="<?php echo base_url('product/product_details'); ?>"
                                            method="post">
                                            <input hidden id="pcode" name="pcode" type="text">
                                        </form>

                                        <form id='editpd' action="<?php echo base_url('product/product_edit'); ?>"
                                            method="post">
                                            <input hidden id="editpid" name="editpid" type="text">
                                            <input hidden id="editpcode" name="editpcode" type="text">
                                            <input hidden id="editpname" name="editpname" type="text">
                                            <input hidden id="editcatid" name="editcatid" type="text">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="itemsModal" tabindex="-1" role="dialog" aria-labelledby="itemsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemsModalLabel">Products</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl No.</th>
                                        <th>Product Name</th>
                                        <th class="text-center">QTY</th>
                                    </tr>
                                </thead>
                                <tbody id="prdlist"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
        function viewItems(x) {
            $.ajax({
                url: '<?php echo base_url('product/show_product_list') ?>',
                method: 'POST',
                data: 'oid=' + x,

                success: function(data) {
                    $('#itemsModal').modal('show')
                    $('#prdlist').html(data)
                }
            })
        }

        function takePayment(x) {
            let d = x.id.split('~')
            let result = confirm("Are you sure you want to approve payment.");

            if (result) {
                $.ajax({
                    url: '<?php echo base_url('product/take_payment') ?>',
                    method: 'POST',
                    data: {
                        id: d[0],
                        cust_id: d[1],
                        tbv: d[2],
                        p_status: d[3],
                        amount: d[4],
                    },

                    success: function(data) {
                        if (data == 1) {
                            alert('Payment received.')
                            location.reload()
                        } else {
                            alert('Something went wrong. Try again.')
                        }
                    }
                })
            }
        }

        function takePaymentActivation(x){
            let d = x.id.split('~')
            let result = confirm("Are you sure you want to approve payment.");

            if (result) {
                $.ajax({
                    url: '<?php echo base_url('product/take_payment_activation') ?>',
                    method: 'POST',
                    data: {
                        id: d[0],
                        cust_id: d[1],
                        tbv: d[2],
                        p_status: d[3],
                        amount: d[4],
                    },

                    success: function(data) {
                        if (data == 1) {
                            alert('Payment received.')
                            location.reload()
                        } else {
                            alert('Something went wrong. Try again.')
                        }
                    }
                })
            }
        }

        function deliverNow(x) {
            let d = x.split('~');
            if(d[1] == 0){
                confirm("This order cannot be delivered until payment is completed.");
                return;  
            }

            let result = confirm("Are you sure you want to change delivery status.");

            if (result) {
                $.ajax({
                    url: '<?php echo base_url('product/deliver_now') ?>',
                    method: 'POST',
                    data: 'id=' + d[0],

                    success: function(data) {
                        if (data == 1) {
                            alert('Order Delivered.')
                            location.reload()
                        } else {
                            alert('Something went wrong. Try again.')
                        }
                    }
                })
            }
        }
        </script>