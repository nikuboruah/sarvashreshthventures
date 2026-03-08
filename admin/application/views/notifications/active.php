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
                                <li class="breadcrumb-item"><a href="#">Notification</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">All NNotifications</h4>
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
                            <h4 class="card-title">All NNotifications</h4>
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
                                                    <th>Title</th>
                                                    <th>Show until</th>

                                                    <th>Added on</th>
                                                    <th>Status</th>
                                                    <th><?=($status==1?"Action":"")?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                            $i=0;
                            foreach ($NOTIFICATIONS as $notification) {
                            ?>
                                                <tr>
                                                    <td class="text-center"><?=++$i?></td>
                                                    <td><?=$notification['notification'] ?></td>
                                                    <td><?=$notification['ud'] ?></td>
                                                    <td><?=$notification['ad'] ?></td>
                                                    <td class="text-center">
                                                        <?php if($notification['status']==1) { ?>
                                                        <span class="badge bg-success">Active</span>
                                                    </td>
                                                    <?php } else {?>
                                                    <span class="badge bg-danger">Inactive</span></td>
                                                    <?php } ?>
                                                    <td class="text-center">
                                                        <?php if($notification['status']==1) { ?>
                                                        <a href="<?php echo site_url('notifications/disableNotification/' . $notification['id']); ?>"
                                                            class="btn btn-info btn-xs">Disable</a>

                                                        <?php }else{ echo '--';} ?>
                                                    </td>
                                                </tr>
                                                <?php
                            }
                            ?>
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