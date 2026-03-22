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
                                <li class="breadcrumb-item"><a href="#">Manage Products</a></li>
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
                            <h4 class="card-title">All Products</h4>
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
                                                    <th>Product Name</th>
                                                    <th>Category</th>
                                                    <th>HSN Code</th>
                                                    <th>Product Price</th>
                                                    <th>Discount Price</th>
                                                    <th>Selling Price</th>
                                                    <th>GST(%)</th>
                                                    <th>Final Price</th>
                                                    <th>PV</th>
                                                    <th>Images</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $id = 0;
                                                    function underCategory($categoryid)
                                                    {
                                                        $c = &get_instance();
                                                        $cat = "";
                                                        $sql = "SELECT * FROM `category_master` WHERE `category_id`='" . $categoryid . "'";
                                                        $query = $c->db->query($sql);
                                                        $result = $query->result_array();
                                                        foreach ($result as $rs) {
                                                            if ($rs['under_category_id'] != 1) {
                                                                $cat = underCategory($rs['under_category_id']) . "/" . $rs['category_name'];
                                                            } else  $cat = $rs['category_name'];
                                                        }
                                                        return $cat;
                                                    }
                                                    foreach ($PRODUCT as $product) {
                                                        $category = underCategory($product->category_id);
                                                ?>
                                                <tr class="<?= $product->status == 0 ? 'bg-warning' : '' ?>">
                                                    <td><?= ++$id ?></td>
                                                    <td><?= $product->product_name ?></td>
                                                    <td>
                                                        <?php if($product->category_id == 2){ ?>
                                                        <a
                                                            href="<?php echo base_url('product/product_combo/'.$product->product_id) ?>" class="text-info"><u><?= $category ?></u></a>
                                                        <?php } else { ?>
                                                        <?= $category ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?= $product->HSN_code ?></td>
                                                    <td>&#8377;<?= number_format($product->mrp,2) ?></td>
                                                    <td>&#8377;<?= number_format($product->discount,2) ?></td>
                                                    <td>&#8377;<?= number_format($product->selling_price,2) ?></td>
                                                    <td><span><?= $product->gst ?>%</span></td>
                                                    <td>&#8377;<?= number_format($product->final_price,2) ?></td>
                                                    <td><?= $product->pv ?></td>
                                                    <td>
                                                        <button id="<?= $product->product_id ?>"
                                                            class="btn btn-warning btn-sm"
                                                            onclick="viewImageModal(this)">View</button>
                                                    </td>
                                                    <td nowrap>
                                                        <button class="btn btn-info btn-sm"
                                                            id="<?php echo $product->product_code?>/<?php echo $product->product_name?>/<?php echo $product->category_id?>/<?php echo $product->product_id?>"
                                                            onclick="product_edit(this)">Edit</button>
                                                        <?php if($product->status == 1){ ?>
                                                        <button onclick="changeStatus(<?= $product->product_id ?>,0)"
                                                            class="btn btn-danger btn-sm">Block</button>
                                                        <?php }else{ ?>
                                                        <button onclick="changeStatus(<?= $product->product_id ?>,1)"
                                                            class="btn btn-success btn-sm">Unblock</button>
                                                        <?php } ?>
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
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Product Images</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="images">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
        product_details = function(x) {
            var p = x.id.split("/");
            $("#pcode").val(p[0]);

            $("#pd").submit();
        }
        </script>

        <script>
        product_edit = function(x) {
            var p = x.id.split("/");
            $("#editpcode").val(p[0]);
            $("#editpname").val(p[1]);
            $("#editcatid").val(p[2]);
            $("#editpid").val(p[3]);
            $("#editpd").submit();
        }
        </script>

        <script>
        function viewImageModal(x) {
            let id = x.id
            $.ajax({
                type: 'post',
                url: '<?php echo base_url('product/viewImages') ?>',
                data: {
                    id: id
                },

                success: function(data) {
                    $("#imageModal").modal('show');
                    $("#images").html(data);
                }
            })
        }
        </script>

        <script>
        set_remove_scratch_card = function(pid, status) {

            $.ajax({
                type: 'post',
                url: '<?php echo base_url('product/setscratch') ?>',
                data: {
                    "pid": pid,
                    "status": status
                },

                success: function(data) {
                    // alert(data);
                    if (data == 1) {
                        if (status == 1) alert("Added to scratch card.");
                        else alert("Removed from scratch card.")

                        location.reload();
                    } else {
                        alert("Something went wrong.")
                        location.reload();
                    }
                }
            })
        }

        function changeStatus(x, y) {
            $.ajax({
                type: 'post',
                url: '<?php echo base_url('product/changeProductStatus') ?>',
                data: {
                    id: x,
                    status: y
                },

                success: function(data) {
                    if (data == 1) {
                        alert("Status changed.")
                        location.reload();
                    } else {
                        alert("Something went wrong.")
                        location.reload();
                    }
                }
            })
        }
        </script>