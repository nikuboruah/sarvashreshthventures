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
                                <li class="breadcrumb-item"><a href="#">Update Product Details</a></li>
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
                            <h4 class="card-title">Update Product Details</h4>
                            <p class="text-muted mb-0"><code class="highlighter-rouge">*</code> Fields are required
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <h3><?= $PRODUCTS[0]->product_name ?></h3>
                                    <?php $this->load->view('messages'); ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Product Name</th>
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-center">Status</th>
                                                            <th class="text-center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($COMBO as $data){ ?>
                                                        <tr>
                                                            <td><?= $data->product_name ?></td>
                                                            <td>
                                                                <select name="qty" id="qty<?= $data->id ?>"
                                                                    class="form-control my-2">
                                                                    <?php for($i=1; $i <=10; $i++){ ?>
                                                                    <option
                                                                        <?= $data->quantity == $i ? 'selected' : '' ?>
                                                                        value="<?= $i ?>">
                                                                        <?= $i ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <button type="button" id="<?= $data->id ?>"
                                                                    onclick="updateQty(this.id)"
                                                                    class="btn btn-success">Update</button>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php if($data->status == 1){ ?>
                                                                <span class="text-success">Active</span>
                                                                <?php } else { ?>
                                                                <span class="text-danger">Inactive</span>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php if($data->status == 1){ ?>
                                                                <button type="button" id="<?= $data->id.'~0' ?>"
                                                                    onclick="updateStatus(this.id)"
                                                                    class="btn btn-warning">Block</button>
                                                                <?php } else { ?>
                                                                <button type="button" id="<?= $data->id.'~1' ?>"
                                                                    onclick="updateStatus(this.id)"
                                                                    class="btn btn-danger">Unblock</button>
                                                                <?php } ?>

                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <h3>Add Product</h3>
                                            <form action="<?php echo base_url('product/add_product_combo') ?>"
                                                method="POST">
                                                <div class="row align-items-end">
                                                    <div class="col-lg-4">
                                                        <label for="">Choose Product</label>
                                                        <select name="add_product" id="add_product" class="form-control"
                                                            required>
                                                            <option value="" selected disabled>Select an option</option>
                                                            <?php foreach($products_list as $data){ ?>
                                                            <option value="<?= $data->product_id ?>">
                                                                <?= $data->product_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <input type="hidden" name="add_combo"
                                                            value="<?= $COMBO[0]->combo_id ?>">
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <label for="">Quantity</label>
                                                        <select name="add_qty" id="add_qty" class="form-control"
                                                            required>
                                                            <?php for($i=1; $i <=10; $i++){ ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <button type="submit" class="btn btn-success">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
        updateStatus = function(id) {
            let result = confirm('Are you sure you want to update status?');
            if (result) {
                var status = id.split('~');
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('product/update_status') ?>',
                    data: {
                        id: status[0],
                        status: status[1]
                    },
                    success: function(data) {
                        if (data == 1) {
                            alert('Status updated successfully');
                            location.reload();
                        } else {
                            alert('Failed to update status');
                        }
                    }
                });
            }
        }

        updateQty = function(x) {
            var result = confirm('Are you sure you want to update quantity?');
            if (result) {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('product/update_qty') ?>',
                    data: {
                        id: x,
                        qty: $('#qty' + x).val()
                    },
                    success: function(data) {
                        if (data == 1) {
                            alert('Quantity updated successfully');
                            location.reload();
                        } else {
                            alert('Failed to update quantity');
                        }
                    }
                });
            }

        }
        </script>