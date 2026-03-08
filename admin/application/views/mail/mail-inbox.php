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
                            <h4 class="card-title">Support Inbox</h4>
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
                                                    <th>Mail Received On</th>
                                                    <th class="text-center">Reply</th>
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
                                                        <button class="btn"
                                                            onclick="replyMail('<?= $inbox->from_customer_id ?>')"><i
                                                                class="fa fa-reply text-info"></i></button>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                        <form action="<?php echo base_url('mail/compose') ?>" method="POST"
                                            id="reply-mail">
                                            <input type="hidden" id="memId" name="memId">
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
        function replyMail(x) {
            $('#memId').val(x)
            $('#reply-mail').submit();
        }
        </script>