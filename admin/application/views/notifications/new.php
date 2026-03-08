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
                        <h4 class="page-title">New Notification</h4>
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
                            <h4 class="card-title">Add New Notifications</h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <?php $this->load->view('messages'); ?>

                            <form method="post" autocomplete="off"
                                action="<?php echo site_url('notifications/addnotification'); ?>">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="notification">Notification (*)</label>
                                        <input type="text" name="notification" class="form-control"
                                            placeholder="Notification" id="notification" required>
                                    </div>
                                    <div class="col-sm-4 mt-4">
                                        <label>Notification for</label>
                                        <select id="added_for" class='form-control' name="added_for">
                                            <option value="0" selected>All</option>
                                            <option value="2">User</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-4 mt-4" id="mid">
                                        <label>User ID</label>
                                        <input type="text" name="member_id" id="member_id" placeholder="Enter user id"
                                            class="form-control">
                                        <small><span id="mid_msg"></span></small>
                                    </div>

                                    <div class="col-lg-4 mt-4">
                                        <label for="show_until">Show Until (*)</label>
                                        <input type="date" min="<?php echo date('Y-m-d'); ?>" name="show_until"
                                            class="form-control" id="show_until" required>
                                    </div>
                                    <div class="col-lg-12 mt-5">
                                        <button style="float: right;" type="submit" class="btn btn-success mt-2"
                                            name="addNotification" onclick="add_notification();">Add
                                            Notification</button>
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
        $('#mid').hide()

        $(document).on('change', '#added_for', function() {
            var added_for = $(this).val()
            if (added_for == 2) {
                $('#mid').show()
                $('#member_id').prop('required', true)
            } else {
                $('#member_id').val('')
                $('#mid').hide()
                $('#member_id').prop('required', false)
            }
        })

        $(document).on('input', '#member_id', function() {
            var member_id = $(this).val()

            $.ajax({
                url: '<?php echo base_url('notifications/find_memberid') ?>',
                method: 'POST',
                data: 'mid=' + member_id,

                success: function(data) {
                    if (data == 1) {
                        $('#mid_msg').html('Member ID available.').addClass(
                                'text-success')
                            .removeClass('text-danger')
                    } else {
                        $('#mid_msg').html('Member ID not available.').addClass(
                                'text-danger')
                            .removeClass('text-success')
                    }
                }
            })
        })
        </script>