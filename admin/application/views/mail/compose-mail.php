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
                                <li class="breadcrumb-item"><a href="#">Compose Message</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Compose Message</h4>
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
                            <h4 class="card-title">Compose Message</h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <?php $this->load->view('messages'); ?>
                            <form id="mail-form" action="<?php echo base_url('mail/send_mail') ?>" method="POST">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Member ID</label>
                                            <input type="text" placeholder="Member ID" name="to" id="to"
                                                value="<?= $MEMBER_ID ?>" class="form-control" id="name" required>
                                            <small><span id="error_msg"></span></small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Subject</label>
                                            <select name="subject" id="subject" class="form-control" required>
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
                                            <textarea placeholder="Message" name="message" id="message" rows="2"
                                                class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-right">
                                    <div class="kt-portlet__foot">
                                        <div class="kt-form__actions">
                                            <button type="submit" name="sendMail" class="btn btn-primary">Send</button>
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
        $(document).on('input', '#to', function() {
            let member_id = $(this).val()

            $.ajax({
                url: '<?php echo base_url('mail/find_member_id') ?>',
                method: 'POST',
                data: 'member_id=' + member_id,

                success: function(data) {
                    if (data > 0) {
                        $('#error_msg').html(member_id + " Found").addClass(
                            'text-success').removeClass('text-danger')
                    } else {
                        $('#error_msg').html(member_id + " ID not found").addClass(
                            'text-danger').removeClass('text-success')
                    }
                }
            })
        })
        </script>

        <script>
        $(document).on('submit', '#mail-form', function() {
            $('#activationRequest').prop('disabled', true)
        })
        </script>