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
                                <li class="breadcrumb-item"><a href="#">Support</a></li>
                                <li class="breadcrumb-item"><a href="#">Sent Messages</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Sent Messages</h4>
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
                            <h4 class="card-title">Sent Messages</h4>
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
                                                    <th class="text-center">#</th>
                                                    <th>Member ID</th>
                                                    <th>Subject</th>
                                                    <th>Message</th>
                                                    <th>Mail Sent On</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $id = 0; foreach($SENT as $sent){ ?>
                                                <tr>
                                                    <td class="text-center"><?= ++$id ?></td>
                                                    <td><?= $sent->to_customer_id ?></td>
                                                    <td><?= $sent->subject ?></td>
                                                    <td><?= $sent->msg ?></td>
                                                    <td><?= date('d M Y, h:i A', strtotime($sent->sent_date)) ?></td>
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