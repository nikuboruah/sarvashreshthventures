<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet"
    type="text/css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js">
</script>
<style>
.fr-wrapper {
    height: 300px;
}

.fr-second-toolbar #fr-logo {
    display: none;
}
</style>
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
                                <li class="breadcrumb-item"><a href="#">Add Product</a></li>
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
                            <h4 class="card-title">Add New Product</h4>
                            <p class="text-muted mb-0"><code class="highlighter-rouge">*</code> Fields are required
                            </p>
                        </div>
                        <!--end card-header-->
                        <form class="kt-form" id="addproduct" action="<?php echo base_url('product/addProduct') ?>"
                            method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Category <span class="text-danger">*</span></label>
                                            <select name="category" id="category" class="form-control" required>
                                                <option value="" selected disabled>Select a category</option>
                                                <?php foreach ($CATEGORY as $category) { ?>
                                                <option value="<?= $category->category_id; ?>">
                                                    <?= $category->category_name; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Product Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Enter name"
                                                name="product" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>HSN Code <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" placeholder="NSN Code" name="hsn"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Product Price <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" min="0" placeholder="Price"
                                                name="mrp" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Selling Price <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" min="0" placeholder="Price"
                                                name="sPrice" id="sPrice" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Discount Price (In &#8377;)</label>
                                            <input type="number" value="0" class="form-control" min="0"
                                                placeholder="Price" name="dist" required id="dist">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>GST(%) <span class="text-danger">*</span></label>
                                            <select name="gst" id="gst" class="form-control" required>
                                                <option value="" selected disabled>Select an option</option>
                                                <option value="0">0%</option>
                                                <option value="3">3%</option>
                                                <option value="5">5%</option>
                                                <option value="12">12%</option>
                                                <option value="18">18%</option>
                                                <option value="28">28%</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Final Price</label>
                                            <input type="number" class="form-control" placeholder="Price" name="fPrice"
                                                id="fPrice" readonly required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="productImage">Product Image (<small>Max. image 6</small>)</label>
                                        <input type="file" id="productImage" name="productImage[]" class="form-control"
                                            accept="image/*" multiple="multiple" required>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>BV <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" placeholder="BV" name="pv" id="pv"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-3" id="combo-list">
                                        <h4>Add Combo Products</h4>

                                        <div class="row mt-2 align-items-end">
                                            <div class="col-lg-4">
                                                <label for="">Choose Products <span class="text-danger">*</span></label>
                                                <select name="products" id="products" class="form-control">
                                                    <option value="" selected disabled>Select Product</option>
                                                    <?php foreach($PRODUCTS as $data) { ?>
                                                    <option value="<?= $data->product_id ?>"><?= $data->product_name ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-lg-2">
                                                <label for="">Quantity <span class="text-danger">*</span></label>
                                                <select name="qty" id="qty" class="form-control">
                                                    <?php for($i=1; $i <=10; $i++){ ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-lg-2">
                                                <button type="button" onclick="add_combo_product()"
                                                    class="btn btn-info">Add</button>
                                            </div>
                                        </div>

                                        <div class="table-responsive mt-3">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th class="text-center">Quantity</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="combo-list-products">
                                                    <?php foreach($COMBO_PRODUCTS as $data){ ?>
                                                    <tr>
                                                        <td><?= $data->product_name ?></td>
                                                        <td class="text-center"><?= $data->quantity ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="remove_product('<?= $data->id ?>')">Remove</button>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-right">
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <button type="reset" class="btn btn-warning text-light">Reset</button>
                                            <button type="submit" name="addproduct"
                                                class="btn btn-primary">Add
                                                Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript">
        $('#pBonus').prop('disabled', true)
        $('#rBonus').prop('disabled', true)
        $('#combo-list').hide()

        add_combo_product = function() {
            let productid = $('#products').val()
            let qty = $('#qty').val()

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('product/add_combo_product'); ?>',
                data: {
                    productid: productid,
                    qty: qty
                },
                success: function(data) {
                    if (data == 1) {
                        get_combo_products()
                    } else if (data == 2) {
                        alert('Product already added')
                    } else {
                        alert('Error')
                    }

                }
            })
        }

        remove_product = function(x) {
            let result = confirm('Are you sure you want to remove this product?')
            if (result) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('product/remove_product'); ?>',
                    data: {
                        id: x
                    },
                    success: function(data) {
                        if (data == 1) {
                            get_combo_products()
                        } else {
                            alert('Something went wrong. Please try again.')
                        }
                    }
                })
            }
        }

        function get_combo_products() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('product/get_combo_products'); ?>',
                success: function(data) {
                    $('#combo-list-products').html(data)
                }
            })
        }

        $(document).on('change', '#gst', function() {
            let s_price = $('#sPrice').val();
            let dist = $('#dist').val();
            let gst = $('#gst').val();

            if (s_price == '') {
                $('#sPrice').addClass('border-danger');
                $('#gst').val('');
                return
            } else if (dist == '') {
                $('#dist').addClass('border-danger');
                $('#gst').val('');
                return
            }

            $('#sPrice').removeClass('border-danger');
            $('#dist').removeClass('border-danger');


            let count_gst_price = (s_price / (1 + Number(gst) / 100)).toFixed(2);
            let dist_price = Number(s_price) - Number(dist);
            $('#fPrice').val(dist_price);
        })

        $(document).on('change', '#bv', function() {
            let bv = $(this).val()
            if (bv == '') {
                $('#pBonus').prop('disabled', true)
                $('#rBonus').prop('disabled', true)
                $('#pBonus').val('');
                $('#rBonus').val('');
                $('#puBonus').val('');
                $('#reBonus').val('');
            } else {
                $('#pBonus').prop('disabled', false)
                $('#rBonus').prop('disabled', false)
            }
        })

        $(document).on('change', '#pBonus', function() {
            let bv = $('#bv').val()
            let p_bonus = $(this).val()

            if (p_bonus == '') {
                $('#puBonus').val('')
            } else {
                let purchase_bonus = Number(bv) * (Number(p_bonus) / 100)
                $('#puBonus').val(purchase_bonus)
            }
        })

        $(document).on('change', '#rBonus', function() {
            let bv = $('#bv').val()
            let r_bonus = $(this).val()

            if (r_bonus == '') {
                $('#reBonus').val('')
            } else {
                let purchase_bonus = Number(bv) * (Number(r_bonus) / 100)
                $('#reBonus').val(purchase_bonus)
            }
        })

        $(document).on('change', '#sPrice', function() {
            $('#gst').val('')
            $('#fPrice').val('')
        })

        $(document).on('change', '#dist', function() {
            $('#gst').val('')
            $('#fPrice').val('')
        })

        $(document).on('change', '#category', function() {
            if ($(this).val() == '2') { // 2 = Combo Category ID
                $('#combo-list').show();
            } else {
                $('#combo-list').hide();
            }
        });
        </script>