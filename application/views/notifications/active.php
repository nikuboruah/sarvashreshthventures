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
                                <li class="breadcrumb-item"><a href="#">Notifications</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Notifications</h4>
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
                            <h4 class="card-title">Notifications</h4>
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
                                                    <th style="width:50px;">#</th>
                                                    <th class="w-25">Added on</th>
                                                    <th class="w-100">Notification</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                            $i=0;
                            foreach ($NOTIFICATIONS as $notification) {
                            ?>
                                                <tr>
                                                    <td><?=++$i?></td>
                                                    <td><?=$notification['ad'] ?></td>
                                                    <td><?=$notification['notification'] ?></td>
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