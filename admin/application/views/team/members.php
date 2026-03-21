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
                                <li class="breadcrumb-item"><a href="#">Members</a></li>
                                <li class="breadcrumb-item"><a href="#">Orders</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Members</h4>
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
                            <h4 class="card-title">
                                <?php if($STATUS == 1){ ?>
                                <h5>All Members</h5>
                                <?php }else if($STATUS == 2){ ?>
                                <h5>Pending Members</h5>
                                <?php }else if($STATUS == 3){ ?>
                                <h5>Active Members</h5>
                                <?php }else if($STATUS == 4){ ?>
                                <h5>Blocked Members</h5>
                                <?php } ?>
                            </h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <?php $this->load->view('messages'); ?>

                            <div class="row">
                                <div class="col-sm">
                                    <form action="" method="POST">
                                        <div class="row mb-3 align-items-center">
                                            <div class="col-lg-3">
                                                <label for="">Form</label>
                                                <input type="date" value="<?= $FROM?$FROM:'' ?>" name="from" id=""
                                                    class="form-control">
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="">To</label>
                                                <input type="date" value="<?= $TO?$TO:'' ?>" name="to" id=""
                                                    class="form-control">
                                            </div>
                                            <?php if($STATUS == 1){ ?>
                                            <div class="col-lg-3">
                                                <label for="">Status</label>
                                                <select name="status" id="" class="form-control">
                                                    <option value="4" <?= $STATUSS == '4'?'active':'' ?>>All Members
                                                    </option>
                                                    <option value="0" <?= $STATUSS == '0'?'active':'' ?>>Pending Members
                                                    </option>
                                                    <option value="1" <?= $STATUSS == '1'?'active':'' ?>>Active Members
                                                    </option>
                                                    <option value="2" <?= $STATUSS == '2'?'active':'' ?>>Blocked Members
                                                    </option>
                                                </select>
                                            </div>
                                            <?php } ?>
                                            <div class="col-lg-3">
                                                <button name="submit" class="btn btn-info mt-2">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table" id="datatable_1">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th nowrap>Member Details</th>
                                                    <th nowrap>Sponsor Details</th>
                                                    <th nowrap>Downline Details</th>
                                                    <th nowrap>Activated Using</th>
                                                    <th>Status</th>
                                                    <th>Activation Date & Time</th>
                                                    <th>Registration Date & Time</th>
                                                    <th>Details</th>
                                                    <th>Password</th>
                                                    <th>Actions</th>
                                                    <th>Activation</th>
                                                    <th>Direct Sponsors</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $id = 0;
                                                    foreach($TEAM as $data){
                                                    // Member package details
                                                    $package_id = $data->package_id;
                                                    if($package_id != ''){
                                                        $package = $this->Crud->ciRead("package_master", "`package_id` = '$package_id'")[0]->package_name;
                                                    }

                                                    // Sponsor details
                                                    $sponsor_id = $data->sponsor_id;
                                                    $s_name = $this->Crud->ciRead("user_master", "`customer_id` = '$sponsor_id'")[0]->user_name;

                                                    $sponsor_package = $this->Crud->ciRead("customer_master", "`customer_id` = '$sponsor_id'")[0]->package_id;
                                                    if($sponsor_package != ''){
                                                    $sponsor_package_name = $this->Crud->ciRead("package_master", "`package_id` = '$sponsor_package'")[0]->package_name;
                                                    }

                                                    // downline details
                                                    $downline_id = $data->dowline_id;
                                                    $d_name = $this->Crud->ciRead("user_master", "`customer_id` = '$downline_id'")[0]->user_name;

                                                    $downline_package = $this->Crud->ciRead("customer_master", "`customer_id` = '$downline_id'")[0]->package_id;
                                                    if($downline_package != ''){
                                                    $downline_package_name = $this->Crud->ciRead("package_master", "`package_id` = '$downline_package'")[0]->package_name;
                                                    }

                                                    // Activated By
                                                    $activateBy = $data->activated_by;
                                                    $a_name = $this->Crud->ciRead("user_master", "`customer_id` = '$activateBy'")[0]->user_name;
                                                ?>
                                                <tr <?= $data->activation_status == '0' ? 'class="bg-warning"' : '' ?>>
                                                    <td><?= ++$id ?></td>
                                                    <td nowrap>
                                                        <b>Member Id :</b> <?= $data->customer_id ?>,<br />
                                                        <b>Member Name :</b> <?= $data->user_name ?>,<br />
                                                        <b>Member Number :</b> <?= $data->user_phone ?>,<br />
                                                        <b>Member Package :</b>
                                                        <?= $package_id == '' ? '' : $package ?>,<br />
                                                        <b>PAN :</b> <?= $data->pan ?>
                                                    </td>
                                                    <td nowrap>
                                                        <b>Sponsor Id :</b> <?= $data->sponsor_id ?>,<br />
                                                        <b>Sponsor Name :</b> <?= $s_name ?>,<br />
                                                        <b>Sponsor Package :</b>
                                                        <?= $sponsor_package == '' ? '' : $sponsor_package_name ?>
                                                    </td>
                                                    <td nowrap>
                                                        <b>Downline Id :</b> <?= $data->dowline_id ?>,<br />
                                                        <b>Downline Name :</b> <?= $d_name ?>,<br />
                                                        <b>Downline Package :</b> <?= $downline_package_name ?>
                                                    </td>
                                                    <td nowrap>
                                                        <?= $list->epin != '' ? $list->epin : ($data->status == 0 ? '--' : 'Product Purchase')   ?>
                                                    </td>
                                                    <td>
                                                        <?php if($data->status == 0){ ?>
                                                        <span class="badge bg-warning">Pending</span>
                                                        <?php }else if($data->status == 1){ ?>
                                                        <span class="badge bg-success">Active</span>
                                                        <?php }else if($data->status == 2){ ?>
                                                        <span class="badge bg-danger">Blocked</span>
                                                        <?php }else if($data->status == 3){ ?>
                                                        <span class="badge bg-info">Upgrade</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?= $data->activation_date == '' ? '' : date('d M Y, h:i A', strtotime($data->activation_date)) ?>
                                                    </td>
                                                    <td><?= date('d M Y, h:i A', strtotime($data->registration_date)) ?>
                                                    </td>
                                                    <td>
                                                        <button onclick="editMemberDetails('<?= $data->customer_id ?>')"
                                                            class="btn btn-info btn-sm">Details</button>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm"
                                                            id="<?= $data->password.'~'.$data->transaction_password ?>"
                                                            onclick="showPassword(this)">Password</button>
                                                    </td>
                                                    <?php if($data->package_id != ''){if($STATUS == 3){ ?>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm"
                                                            id="<?= $data->customer_id.'/2' ?>"
                                                            onclick="changeStatus(this)">Blocked</button>
                                                    </td>
                                                    <?php } else if($STATUS == 4){ ?>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm"
                                                            id="<?= $data->customer_id.'/1' ?>"
                                                            onclick="changeStatus(this)">Unblocked</button>
                                                    </td>
                                                    <?php } else if($STATUS == 1){ ?>
                                                    <td>
                                                        <?php if($data->status == 1 ){ ?>
                                                        <button class="btn btn-warning btn-sm"
                                                            onclick="changeStatus(this)"
                                                            id="<?= $data->customer_id.'/2' ?>">Blocked</button>
                                                        <?php }else{ ?>
                                                        <button class="btn btn-primary btn-sm"
                                                            onclick="changeStatus(this)"
                                                            id="<?= $data->customer_id.'/1' ?>">Unblocked</button>
                                                        <?php } ?>
                                                    </td>
                                                    <?php }else{ ?>
                                                    <td>--</td>
                                                    <?php }} else if($STATUS == 2){ ?>
                                                    <td>
                                                        <button class="btn btn-danger" id="<?= $data->customer_id ?>"
                                                            onclick="removeUser(this.id)">Remove</button>
                                                    </td>
                                                    <?php }else{ ?>
                                                    <td>--</td>
                                                    <?php } ?>
                                                    <td>
                                                        Payment Mode :
                                                        <?= $data->transaction_no == '' ? 'Cash' : 'UPI/Debit Card/Credit Card/Cheque/Transfer' ?><br />
                                                        <?php if($data->activation_status == 0){ ?>
                                                            <?php if($data->transaction_no != ''){ ?>
                                                            Transaction ID : <?= $data->transaction_no ?><br />
                                                            Transaction Proof : <a
                                                                href="<?php echo base_url('../uploads/member/proof/'.$data->proof ) ?>"
                                                                target="_blank"><i class="fa fa-image h2"></i></a></br />
                                                            <?php } ?>
                                                            <button class="btn btn-success mb-3"
                                                                onclick="activateNow('<?=  $data->customer_id ?>')">Activate
                                                                Now</button>
                                                            <button class="btn btn-danger mb-3"
                                                                id="<?= $data->customer_id ?>"
                                                                onclick="removeUser(this.id)">Remove</button>
                                                        <?php }else if($data->activation_status == 1 AND $data->transaction_no != '' ){ ?>
                                                        Transaction ID : <?= $data->transaction_no ?><br />
                                                        Transaction Proof : <a
                                                            href="<?= $data->proof == '' ? '' : base_url('../uploads/member/proof/'.$data->proof ) ?>"
                                                            target="_blank"><i class="fa fa-image h2"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                    <!-- <td>
                                <button <?= $data->status == 1 ? '' : 'disabled' ?> class="btn btn-info" id="<?= $data->user_name.'/'.$data->customer_id.'/'.$package_id ?>" onclick="upgradePackage(this)">Upgrade</button>
                            </td> -->
                                                    <td>
                                                        <a href="<?php echo base_url('team/direct_sponsors/'.$data->customer_id) ?>"
                                                            class="btn btn-info">Sponsors</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                        <form id="edit_member_form"
                                            action="<?php echo base_url('team/member_details') ?>" method="POST">
                                            <input type="hidden" id="customer_id" name="customer_id">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordModalLabel">Passwords</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="password"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="upgradePackage" tabindex="-1" role="dialog" aria-labelledby="upgradePackageLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="upgradePackageLabel">Upgrade Package</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('team/upgrade_package') ?>" method="POST">
                            <div class="col-lg-12 mb-3">
                                <label for="">Customer Name</label>
                                <input type="text" id="cust__name" class="form-control" readonly>
                                <input type="hidden" id="cust__id" name="cust__id">
                                <input type="hidden" id="pre_pack__id" name="pre_pack__id">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="">Package Name</label>
                                <select id="pack__id" name="pack__id" class="form-control">
                                    <option value="" selected disabled>Choose Package</option>
                                    <?php foreach($PACKAGE as $data){ ?>
                                    <option value="<?= $data->package_id ?>"><?= $data->package_name ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success">Upgrade</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateRepurchase" tabindex="-1" role="dialog"
            aria-labelledby="updateRepurchaseLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateRepurchaseLabel">Update Repurchase BV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo base_url('team/upgrade_repurchase_bv') ?>" method="POST">
                            <div class="col-lg-12 mb-3">
                                <label for="">Right BV</label>
                                <input type="text" name="rbv" id="rbv" placeholder="BV" class="form-control" required>
                                <input type="hidden" id="bv_cust__id" name="bv_cust__id">
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label for="">Left BV</label>
                                <input type="text" name="lbv" id="lbv" placeholder="BV" class="form-control" required>
                            </div>

                            <div class="col-lg-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
        function showPassword(x) {
            let d = x.id.split('~')

            let dt = {
                'password': d[0],
                'c_password': d[1]
            }

            $.ajax({
                url: '<?php echo base_url('team/show_password') ?>',
                method: 'POST',
                data: dt,

                success: function(data) {
                    $('#passwordModal').modal('show')
                    $('#password').html(data)
                }
            })
        }

        function changeStatus(x) {
            let result = confirm('Are you sure you want to change member status!')

            if (result) {
                let d = x.id.split('/')

                let dt = {
                    'cid': d[0],
                    'status': d[1]
                }

                $.ajax({
                    url: '<?php echo base_url('team/change_status') ?>',
                    method: 'POST',
                    data: dt,

                    success: function(data) {
                        if (data == 1) {
                            alert('Status changed successfully.')
                            location.reload()
                        } else {
                            alert('Something went wrong. Try again')
                        }
                    }
                })
            }
        }

        editMemberDetails = function(x) {
            $('#customer_id').val(x)
            $('#edit_member_form').submit()
        }

        function activateNow(x) {
            let result = confirm('Are you sure you want to activate this member')
            if (result) {
                $.ajax({
                    url: '<?php echo base_url('activation/activate_member') ?>',
                    method: 'POST',
                    data: 'id=' + x,

                    success: function(data) {
                        if (data == 1) {
                            alert('Member activate successfully.')
                            location.reload()
                        } else {
                            alert('Something went wrong. Try again')
                        }
                    }
                })
            }
        }

        upgradePackage = function(x) {
            // let dt = x.id.split('/');
            // $('#cust__name').val(dt[0])
            // $('#cust__id').val(dt[1])
            // $('#pre_pack__id').val(dt[2])
            // $('#upgradePackage').modal('show')

            alert('Upgration is not available at this time. ');
        }

        updateRepurchaseBV = function(x) {
            let d = x.id.split('~')

            $('#bv_cust__id').val(d[0])
            $('#rbv').val(d[1])
            $('#lbv').val(d[2])

            $('#updateRepurchase').modal('show')
        }

        removeUser = function(x) {
            let result = confirm('Are you sure you want to delete this member?');
            if (result) {
                $.ajax({
                    method: 'POST',
                    url: '<?= base_url('team/remove_user') ?>',
                    data: {
                        id: x
                    },
                    success: function(data) {
                        if (data == 1) {
                            alert('Member removed successfully.');
                            location.reload();
                        } else {
                            alert('Something went wrong. Please try again.')
                        }
                    }
                })
            }
        }
        </script>