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
                            <h4 class="card-title">Add New Category</h4>
                            <p class="text-muted mb-0"><code class="highlighter-rouge">*</code> Fields are required
                            </p>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <!--begin::Form-->
                            <form method="post" action="<?php echo site_url('product/addNewCategory/'); ?>"
                                enctype="multipart/form-data">
                                <div class="kt-portlet__body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label>Category Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter category name" name="name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-right">
                                        <div class="kt-portlet__foot">
                                            <div class="kt-form__actions">
                                                <button type="reset" class="btn btn-warning text-light">Reset</button>
                                                <button type="submit" name="addCategory" class="btn btn-primary">Add
                                                    Category</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Manage Product Categories</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable_1">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Category Name</th>
                                            <th>Under Category</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $id = 0;
                                                foreach ($CATEGORIES as $category) {
                                                    $categoryId = $category->under_category_id;
                                                    $underCategory = '';
                                                    if ($categoryId == 0) {
                                                        $underCategory = 'Main';
                                                    } else {
                                                        $underCategory = $this->Crud->ciRead("category_master", "`category_id` = '$categoryId'")[0]->category_name;
                                                    }
                                                ?>
                                        <tr>
                                            <td class="text-center"><?= ++$id ?></td>
                                            <td><?= $category->category_name ?></td>
                                            <td><?= $underCategory ?></td>
                                            <td>
                                                <?php if ($category->status == '1') { ?>
                                                <span class="badge bg-success rounded-pill">Active</span>
                                                <?php } else { ?>
                                                <span class="badge bg-warning rounded-pill">Inactive</span>
                                                <?php } ?>
                                            </td>

                                            <td nowrap>

                                                <?php
                                                                if ($category->under_category_id == 0) {
                                                                    echo '--';
                                                                } else {
                                                            ?>

                                                <button class="btn mb-2 btn-info"
                                                    onclick="editCategory(<?= $category->category_id ?>)">Edit</button>

                                                <form id="editCategory<?= $category->category_id ?>" method="post"
                                                    action="<?php echo base_url('product/editCategories') ?>">
                                                    <input type="hidden" name="categoryid"
                                                        id="categoryid<?= $category->category_id ?>">
                                                </form>
                                                <?php } ?>

                                                <?php
                                                                if ($category->under_category_id == 0) {
                                                                    echo '--';
                                                                } else {
                                                                    if ($category->status == '1') { ?>
                                                <a href="<?php echo base_url('product/changeStatus/0/' . $category->category_id) ?>"
                                                    class="btn mb-2 btn-danger">Block</a>
                                                <?php } else { ?>
                                                <a href="<?php echo base_url('product/changeStatus/1/' . $category->category_id) ?>"
                                                    class="btn mb-2 btn-success">Unblock</a>
                                                <?php }
                                                                } ?>

                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
        function editCategory(x) {
            $("#categoryid" + x).val(x);
            $("#editCategory" + x).submit();
        }
        </script>