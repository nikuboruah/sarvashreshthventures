<?php
    $userid = $this->session->userdata("aiplUserId");
    $sql = $this->db->query("SELECT * FROM `contact_info` WHERE `customer_id` = '$userid'");
    $isExist = $sql->num_rows();
    $info = $sql->result();
?>
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
                                <li class="breadcrumb-item"><a href="#">Profile</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profile</h4>
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
                            <h4 class="card-title">Update Profile</h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <?php $this->load->view('messages') ?>
                            <div class="row" style="margin-top: 1em;">
                                <div class="col-lg-4 mb-3 mb-5">
                                    <div class="profile-image text-center">
                                        <?php $userid = $this->session->userdata("aiplUserId"); ?>
                                        <img src="<?php echo base_url('uploads/profile/'.$userid.'.png') ?>"
                                            style="height:100px; width:100px; border:1px solid #ccc; padding: 5px; border-radius:5px;" alt="/">
                                        <br />
                                        <a href="javascript:void(0);" class="btn btn-info mt-2 mb-4" data-bs-toggle="modal"
                                            data-bs-target="#editProfile">Change profile
                                            photo</a>

                                            <div class="mt-3">
                                                <h4>Customer ID : <?= $DETAILS[0]->customer_id ?></h4>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <?php
                                        if($isExist > 0){
                                    ?>
                                    <form action="<?php echo base_url('settings/updateProfileDetails') ?>"
                                        method="post">
                                        <div class="row">
                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text" placeholder=""
                                                        value="<?= $DETAILS[0]->user_name ?>" name="u_name"
                                                        class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="">Phone</label>
                                                    <input type="text" placeholder="Phone no" pattern="[0-9]{10}"
                                                        minlength="10" maxlength="10"
                                                        value="<?= $DETAILS[0]->user_phone ?>" name="u_phone"
                                                        class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="text" placeholder="Email"
                                                        value="<?= $info[0]->email ?>" name="u_mail"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="">Nominee Name</label>
                                                    <input type="text" placeholder="Nominee name"
                                                        value="<?= $info[0]->phone2 ?>" name="u_phone2"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="">Nominee Relation</label>
                                                    <input type="text" placeholder="Nominee relation"
                                                        value="<?= $info[0]->email2 ?>" name="u_mail2"
                                                        class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="">Address</label>
                                                    <textarea name="u_address" placeholder="Address" id="" rows="1"
                                                        class="form-control"
                                                        required><?= $info[0]->address ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-info">Update Details</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php }else{ ?>
                                    <form action="<?php echo base_url('settings/updateProfile') ?>" method="post">
                                        <div class="row">
                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text" placeholder=""
                                                        value="<?= $DETAILS[0]->user_name ?>" name="u_name"
                                                        class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="">Phone</label>
                                                    <input type="text" placeholder="Phone no" pattern="[0-9]{10}"
                                                        minlength="10" maxlength="10"
                                                        value="<?= $DETAILS[0]->user_phone ?>" name="u_phone"
                                                        class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="text" placeholder="Email" value="<?= $DETAILS[0]->user_email ?>" name="u_mail"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="">Nominee Name</label>
                                                    <input type="text" placeholder="Nominee name" value=""
                                                        name="u_phone2" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="">Nominee Relation</label>
                                                    <input type="text" placeholder="Nominee relation" name="u_mail2"
                                                        class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 mb-3">
                                                <div class="form-group">
                                                    <label for="">Address</label>
                                                    <textarea name="u_address" placeholder="Address" id="" rows="1"
                                                        class="form-control" required></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-info">Add Details</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="editProfileLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileLabel">Update Profile</h5>
                    </div>
                    <form action="<?php echo base_url('Settings/changeProfile') ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="file" name="profile" id="profile" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#printButton').click(function() {
                var myDiv = $('#print-id').html();
                var printWindow = window.open('', '', 'height=500,width=800');
                printWindow.document.write('<html><head><title>Print Div</title>');
                printWindow.document.write('</head><body>');
                printWindow.document.write(myDiv);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            });
        });
        </script>