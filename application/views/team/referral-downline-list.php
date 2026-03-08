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
                                <li class="breadcrumb-item"><a href="#">Genealogy</a></li>
                                <li class="breadcrumb-item"><a href="#">
                                        <?php if($PAGE_LIST == 1){ ?>
                                        Referral List
                                        <?php }else if($PAGE_LIST == 2){ ?>
                                        Downline List
                                        <?php } ?>
                                    </a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <?php if($PAGE_LIST == 1){ ?>
                            Referral List
                            <?php }else if($PAGE_LIST == 2){ ?>
                            Downline List
                            <?php } ?>
                        </h4>
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
                            <h4 class="card-title">
                                <?php if($PAGE_LIST == 1){ ?>
                                <h5>Referral List</h5>
                                <?php }else if($PAGE_LIST == 2){ ?>
                                <h5>Downline List</h5>
                                <?php } ?>
                            </h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm">
                                    <form action="" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="">From</label>
                                                <input type="date" name="from" value="<?= $FROM?$FROM:'' ?>" id=""
                                                    class="form-control" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="">To</label>
                                                <input type="date" name="to" value="<?= $TO?$TO:'' ?>" id=""
                                                    class="form-control" required>
                                            </div>

                                            <div class="col-lg-3 mt-4">
                                                <button type="submit" name="sendSubmit"
                                                    class="btn btn-info">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table" id="datatable_1">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th nowrap>Member Id</th>
                                                    <th>Member Name</th>
                                                    <th>Member Package</th>
                                                    <th>Status</th>
                                                    <th>Activation Date & Time</th>
                                                    <th>Registration Date & Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $id = 0; foreach($LIST as $list){
                                                    // Member package details
                                                    $package_id = $list->package_id;
                                                    $package = '';
                                                    if($package_id != ''){
                                                        $package = $this->Crud->ciRead("package_master", "`package_id` = '$package_id'")[0]->package_name;
                                                    }
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= ++$id; ?></td>
                                                    <td><?= $list->customer_id ?></td>
                                                    <td><?= $list->user_name ?></td>
                                                    <td><?= $package ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                            $statusText = '';
                                                            $statusClass = '';

                                                            if ($list->status == 0) {
                                                                $statusText = 'Pending';
                                                                $statusClass = 'badge bg-warning';
                                                            } else if ($list->status == 1) {
                                                                $statusText = 'Active';
                                                                $statusClass = 'badge bg-success';
                                                            } else if ($list->status == 2) {
                                                                $statusText = 'Upgrade';
                                                                $statusClass = 'badge bg-info';
                                                            } else {
                                                                $statusText = 'Blocked';
                                                                $statusClass = 'badge bg-danger';
                                                            }
                                                        ?>
                                                        <span class="<?php echo $statusClass; ?>">
                                                            <?php echo $statusText; ?>
                                                        </span>
                                                    </td>
                                                    <td><?= date('d M Y, h:i A', strtotime($list->registration_date)) ?>
                                                    </td>
                                                    <td><?= $list->activation_date == '' ? '' : date('d M Y, h:i A', strtotime($list->activation_date)) ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <form id="d_list_form"
                                            action="<?php echo base_url('team/view_downline_list') ?>" method="POST">
                                            <input type="hidden" id="memberid_d_list" name="memberid_d_list">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <script>
        function viewDownlineList(x) {
            $('#memberid_d_list').val(x)
            $('#d_list_form').submit()
        }
        </script>