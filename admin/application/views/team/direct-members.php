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
                                <li class="breadcrumb-item"><a href="#">Direct Sponsors</a></li>
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
                            <h4 class="card-title">Direct Sponsors of <?= $this->uri->segment(3); ?></h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <?php $this->load->view('messages'); ?>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-responsive">
                                        <table class="table" id="datatable_1">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th nowrap>Member ID</th>
                                                    <th>Member Name</th>
                                                    <th>Position</th>
                                                    <th>Member Package</th>
                                                    <th>Activation Date & Time</th>
                                                    <th>Registration Date & Time</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $id = 0; foreach($DIRECT as $data){
                                                    $package_id = $data->package_id;
                                                    if($package_id == ''){
                                                        $package_name = '<span class="text-warning">Not Activate yet</span>';
                                                    }else{
                                                        $get_package = $this->Crud->ciRead("package_master", "`package_id` = '$package_id'");
                                                        $package_name = $get_package[0]->package_name;
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?= ++$id ?></td>
                                                    <td><?= $data->customer_id ?></td>
                                                    <td><?= $data->name ?></td>
                                                    <td><?= $data->position == 0 ? 'Left' : 'Right' ?></td>
                                                    <td><?= $package_name ?></td>
                                                    <td><?= date('d-m-Y', strtotime($data->activation_date)) ?></td>
                                                    <td><?= date('d-m-Y', strtotime($data->registration_date)) ?></td>
                                                    <td>
                                                        <?php if($data->status == 0){ ?>
                                                        <span class="badge bg-warning">Not Active</span>
                                                        <?php }else if($data->status == 1){ ?>
                                                        <span class="badge bg-success">Active</span>
                                                        <?php }else if($data->status == 2){ ?>
                                                        <span class="badge bg-danger">Blocked</span>
                                                        <?php }else { ?>
                                                        <span class="badge bg-success">Upgrade</span>
                                                        <?php } ?>
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
            </div>
        </div>