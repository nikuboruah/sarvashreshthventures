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
                                <li class="breadcrumb-item"><a href="#">Categories</a></li>
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
                            <h4 class="card-title">Update Category</h4>
                            <p class="text-muted mb-0"><code class="highlighter-rouge">*</code> Fields are required
                            </p>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <!--begin::Portlet-->
                            <div class="kt-portlet">
                                <!--begin::Form-->
                                <form method="post" action="<?php echo site_url('product/updateCategory/'); ?>"
                                    enctype="multipart/form-data">
                                    <div class="kt-portlet__body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label>Category Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter category name" name="name"
                                                        value="<?= $CATEGORIES[0]->category_name ?>" required>
                                                    <input type="hidden" name="categoryid"
                                                        value="<?= $CATEGORIES[0]->category_id ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6" hidden>
                                                <div class="mb-3">
                                                    <label>Under Category</label>
                                                    <select name="category" id="" class="form-control" required>
                                                        <?php foreach ($CATEGORY as $category) {
                                    $underCategory = $CATEGORIES[0]->under_category_id;
                                ?>
                                                        <option value="<?= $category->category_id ?>"
                                                            <?= $category->category_id == $underCategory ? 'selected' : '' ?>>
                                                            <?= $category->category_name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-right">
                                            <div class="kt-portlet__foot">
                                                <div class="kt-form__actions">
                                                    <a href="<?= base_url('product/categories') ?>"
                                                        class="btn btn-warning text-light">Cancel</a>
                                                    <button type="submit" name="upadteCategory"
                                                        class="btn btn-primary">Update Category</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!--end::Portlet-->
                    </div>
                </div>
            </div>
        </div>