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
                                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profile</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Profile</h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <div class="col-lg-12">
                                <form action="<?php echo base_url('content/update_bank_details') ?>" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label for="">Account Number</label>
                                                <input type="text" name="account_no" placeholder="Enter account number"
                                                    class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label for="">IFSC</label>
                                                <input type="text" name="ifsc" placeholder="Enter IFSC"
                                                    class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label for="">Bank Name</label>
                                                <input type="text" name="bankname" placeholder="Enter bank name"
                                                    class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group">
                                                <label for="">Account Holder Name</label>
                                                <input type="text" name="account_holder"
                                                    placeholder="Enter account holder name" class="form-control"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="text-right">
                                                <button class="btn btn-info">Update Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <h3>Bank Details</h3>
                                <div class="table-responsive">
                                    <table class="table" id="datatable_1">
                                        <thead>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Account Number</th>
                                                    <th>IFSC</th>
                                                    <th>Bank Name</th>
                                                    <th>Account Holder’s Name</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                            <?php foreach($KYC as $data){ ?>
                                            <tr>
                                                <td><?= $data->ac_no ?></td>
                                                <td><?= $data->bank_name ?></td>
                                                <td><?= $data->ifsc_code ?></td>
                                                <td><?= $data->payee_name ?></td>
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
        </div>