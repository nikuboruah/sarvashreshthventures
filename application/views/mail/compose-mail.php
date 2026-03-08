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
                                <li class="breadcrumb-item"><a href="#">Compose Mail</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Compose Mail</h4>
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
                            <h4 class="card-title">Send New Mail</h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <?php $this->load->view("messages") ?>
                            <form id="send_mail_form" action="<?php echo base_url('mail/send_mail') ?>" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Subject</label>
                                            <select name="subject" id="" class="form-control" required>
                                                <option value="" selected disabled>Select an option</option>
                                                <option value="Bonus">Bonus</option>
                                                <option value="Withdrawal">Withdrawal</option>
                                                <option value="Rank">Rank</option>
                                                <option value="Deposit">Deposit</option>
                                                <option value="Profile Change">Profile Change</option>
                                                <option value="Activate New ID">Activate New ID</option>
                                                <option value="Registration">Registration</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label>Message</label>
                                            <textarea placeholder="Message" name="message" id="" rows="2"
                                                class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-right">
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <button type="submit" name="composeMail"
                                                class="btn btn-primary">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
        $(document).on('submit', '#send_mail_form', function() {
            $('#composeMail').prop('disabled', true)
        })
        </script>