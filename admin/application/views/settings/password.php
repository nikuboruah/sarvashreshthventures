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
                                <li class="breadcrumb-item"><a href="#">Password</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Password</h4>
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
                            <h4 class="card-title">Update Password</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-body login-card-body">
                                <?php $this->load->view('messages') ?>
                                <div class="row align-items-center" style="margin-top: 1em;">
                                    <div class="col-lg-6 mb-3">
                                        <div class="card shadow border-0">
                                            <div class="card-header">
                                                <h4>Account Password</h4>
                                            </div>
                                            <div class="card-body">
                                                <form action="<?php echo site_url('settings/changePassword'); ?>"
                                                    method="post">
                                                    <div class="mb-3">
                                                        <label for="">Current Password</label>
                                                        <input type="password" required name="password"
                                                            class="form-control"
                                                            value="<?php echo set_value('password'); ?>"
                                                            placeholder="Current Password">
                                                    </div>
                                                    <label for="">New Password</label>
                                                    <div class="mb-3">
                                                        <input type="password" required id="password"
                                                            name="new_password" class="form-control"
                                                            value="<?php echo set_value('new_password'); ?>"
                                                            placeholder="New Password">
                                                        <span id="p_msg"></span>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="viewPassword" onclick="viewPassword1()">
                                                            <label class="form-check-label" for="viewPassword">
                                                                <small>View Password</small>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="change" id="panelPassword"
                                                        class="btn btn-primary">Change account
                                                        password</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <div class="card shadow border-0">
                                            <div class="card-header">
                                                <h4>Transaction Password</h4>
                                            </div>
                                            <div class="card-body">
                                                <form
                                                    action="<?php echo site_url('settings/changeTransactionPassword'); ?>"
                                                    method="post">
                                                    <div class="mb-3">
                                                        <label for="">Current Transaction Password</label>
                                                        <input type="password" required name="t_password"
                                                            class="form-control"
                                                            value="<?php echo set_value('password'); ?>"
                                                            placeholder="Current Transaction Password">
                                                    </div>
                                                    <label for="">New Transaction Password</label>
                                                    <div class="mb-3">
                                                        <input type="password" required id="t__password"
                                                            name="t__password" class="form-control"
                                                            placeholder="New Password">
                                                        <span id="t_msg"></span>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="viewTPassword" onclick="viewPassword()">
                                                            <label class="form-check-label" for="viewPassword">
                                                                <small>View Password</small>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="change" id="transactionPassword"
                                                        class="btn btn-info">Change transaction password</button>
                                                </form>
                                            </div>
                                        </div>
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
        $('#panelPassword').prop('disabled', true)
        $('#transactionPassword').prop('disabled', true)

        function viewPassword1() {
            let passwordInput = document.getElementById("password");
            let checkbox = document.getElementById("viewPassword");

            if (checkbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }

        function viewPassword() {
            let passwordInput2 = document.getElementById("t__password");
            let checkbox2 = document.getElementById("viewTPassword");

            if (checkbox2.checked) {
                passwordInput2.type = "text";
            } else {
                passwordInput2.type = "password";
            }
        }

        $(document).on('input', "#password", function() {
            let password = $(this).val()
            let alphanumericRegex = /^(?=.*[a-zA-Z])(?=.*\d)/;
            let minLength = 8;

            if (password.length < minLength || !alphanumericRegex.test(password)) {
                $('#cpassword').val('');
                $('#p_msg').html(
                        `Password must be at least ${minLength} characters long and contain at least one letter & one number`
                    ).css('font-size', '12px')
                    .addClass('text-danger');
                $('#panelPassword').prop('disabled', true)
                return;
            }
            $('#panelPassword').prop('disabled', false)
            $('#p_msg').html('').removeClass('text-danger');
        })

        $(document).on('input', "#t__password", function() {
            let password = $(this).val()
            let alphanumericRegex = /^(?=.*[a-zA-Z])(?=.*\d)/;
            let minLength = 8;

            if (password.length < minLength || !alphanumericRegex.test(password)) {
                $('#cpassword').val('');
                $('#t_msg').html(
                        `Password must be at least ${minLength} characters long and contain at least one letter & one number`
                    ).css('font-size', '12px')
                    .addClass('text-danger');
                $('#transactionPassword').prop('disabled', true)
                return;
            }
            $('#transactionPassword').prop('disabled', false)
            $('#t_msg').html('').removeClass('text-danger');
        })
        </script>