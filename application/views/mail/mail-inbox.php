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
                                <li class="breadcrumb-item"><a href="#">Inbox</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Inbox</h4>
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
                            <h4 class="card-title">My Inbox</h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
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
                                                    <th>Mail Received On</th>
                                                    <th>Reply</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $id = 0; foreach($INBOX as $inbox){ ?>
                                                <tr>
                                                    <td class="text-center"><?= ++$id ?></td>
                                                    <td><?= $inbox->from_customer_id ?></td>
                                                    <td><?= $inbox->subject ?></td>
                                                    <td><?= $inbox->msg ?></td>
                                                    <td><?= date('d M Y, h:i A', strtotime($inbox->sent_date)) ?></td>
                                                    <td class="text-center">
                                                        <a href="<?php echo base_url('mail/compose') ?>" class="btn"><i
                                                                class="fa fa-reply text-info"></i></a>
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