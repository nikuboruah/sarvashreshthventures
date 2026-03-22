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
                        <!--end card-header-->
                        <form class="kt-form" id="ai" action="<?php echo base_url('product/updateProductBasic') ?>"
                            method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-body">
                                <?php $this->load->view('messages'); ?>
                                <!--begin::Portlet-->
                                <?php foreach($product as $pr) {
                                    $catid=$pr['category_id'];
                                    $countryorigin=$pr['country_of_origin'];
                                    $gst=$pr['gst'];
                                ?>
                                <div class="row">
                                    <input hidden readonly name="productid" value="<?=$pr['product_id']  ?>">
                                    <input hidden readonly name="pcode" value="<?=$pr['product_code']  ?>">
                                    
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label>Category <span class="text-danger">*</span></label>
                                            <select name="category" id="category" class="form-control" required>
                                                <option value="" disabled>Select a category</option>
                                                <?php foreach ($category as $cat) { ?>
                                                <option <?= $pr['category_id'] == $cat['category_id'] ? 'selected' : '' ?> value="<?= $cat['category_id']; ?>">
                                                    <?= $cat['category_name']; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label>Product Name</label>
                                            <input type="text" value="<?=$pr['product_name']; ?>" class="form-control"
                                                placeholder="Enter name" name="product" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label>HSN Code</label>
                                            <input type="number" class="form-control" value="<?=$pr['HSN_code']; ?>"
                                                placeholder="NSN Code" name="hsn" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label>Product Price</label>
                                            <input type="number" value="<?=$pr['mrp'];?>" class="form-control"
                                                placeholder="MRP" name="mrp" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label>Selling Price</label>
                                            <input type="number" value="<?=$pr['selling_price'];?>" class="form-control"
                                                placeholder="Price" name="sPrice" id="sPrice" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label>Discount Price (In &#8377;)</label>
                                            <input type="number" value="<?=$pr['discount'];?>" class="form-control"
                                                min="0" placeholder="Price" name="dist" required id="dist">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label>GST(%)</label>
                                            <select name="gst" id="gst" class="form-control" required>
                                                <option value="">Select an option</option>
                                                <option <?= $pr['gst'] == '0' ? 'selected' : '' ?> value="0">0%</option>
                                                <option <?= $pr['gst'] == '3' ? 'selected' : '' ?> value="3">3%</option>
                                                <option <?= $pr['gst'] == '5' ? 'selected' : '' ?> value="5">5%</option>
                                                <option <?= $pr['gst'] == '12' ? 'selected' : '' ?> value="12">12%
                                                </option>
                                                <option <?= $pr['gst'] == '18' ? 'selected' : '' ?> value="18">18%
                                                </option>
                                                <option <?= $pr['gst'] == '28' ? 'selected' : '' ?> value="28">28%
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label>Final Price</label>
                                            <input type="number" value="<?=$pr['final_price'];?>" class="form-control"
                                                placeholder="Price" name="fPrice" id="fPrice" readonly required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="productImage">Product Image (<small>Max. image
                                                6</small>)</label>
                                        <input type="file" id="productImage" name="productImage[]" class="form-control"
                                            accept="image/*" multiple="multiple">
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label>PV</label>
                                            <input type="number" value="<?=$pr['pv'];?>" class="form-control"
                                                placeholder="PV" name="pv" id="pv" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-right">
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <a href="<?= base_url('product/manageProducts/active') ?>" class="btn btn-warning">Cancel</a>
                                            <button type="submit" name="addproduct"
                                                class="btn btn-primary">Edit
                                                Product</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
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
        </script>