<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                            <div class="col-xl-12 mb-3 m-0 p-0">
                                <?php $this->load->view('messages') ?>
                                <h4>Contact Information</h4>
                                <hr>
                                <div class="m-2">
                                    <h5><span id="msg" class="text-success"></span></h5>
                                </div>
                                <form action="<?php echo base_url('content/changeContact') ?>" method="post">
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <div class="card p-2">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-2">
                                                        <div class="text-center">
                                                            <i class="fa fa-phone"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-10">
                                                        <input type="text" name="phone" pattern="[0-9]{10}"
                                                            minlength="10" maxlength="10"
                                                            value="<?= $CONTACT[0]->phone ?>" placeholder="Phone no 1"
                                                            id="phone" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-2">
                                            <div class="card p-2">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-2">
                                                        <div class="text-center">
                                                            <i class="fa fa-phone"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-10">
                                                        <input type="text" name="phone2" pattern="[0-9]{10}"
                                                            minlength="10" maxlength="10"
                                                            value="<?= $CONTACT[0]->phone2 ?>" placeholder="Phone no 2"
                                                            id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-2">
                                            <div class="card p-2">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-2">
                                                        <div class="text-center">
                                                            <i class="fa fa-envelope"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-10">
                                                        <input type="email" name="email"
                                                            value="<?= $CONTACT[0]->email ?>" placeholder="Mail 1" id=""
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-2">
                                            <div class="card p-2">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-2">
                                                        <div class="text-center">
                                                            <i class="fa fa-envelope"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-10">
                                                        <input type="email" name="email2"
                                                            value="<?= $CONTACT[0]->email2 ?>" placeholder="Mail 2"
                                                            id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-2">
                                            <div class="card p-2">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-1">
                                                        <div class="text-center">
                                                            <i class="fa fa-facebook-f"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-11">
                                                        <input type="text" name="facebook"
                                                            value="<?= $CONTACT[0]->facebook ?>"
                                                            placeholder="Facebook link" id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-2">
                                            <div class="card p-2">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-1">
                                                        <div class="text-center">
                                                            <i class="fa fa-instagram"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-11">
                                                        <input type="text" name="instagram"
                                                            value="<?= $CONTACT[0]->instagram ?>"
                                                            placeholder="Instagram link" id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-2">
                                            <div class="card p-2">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-1">
                                                        <div class="text-center">
                                                            <i class="fa fa-twitter"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-11">
                                                        <input type="text" name="twitter"
                                                            value="<?= $CONTACT[0]->twitter ?>"
                                                            placeholder="Twitter link" id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-2">
                                            <div class="card p-2">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-1">
                                                        <div class="text-center">
                                                            <i class="fa fa-youtube"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-11">
                                                        <input type="text" name="youtube"
                                                            value="<?= $CONTACT[0]->youtube_link ?>"
                                                            placeholder="Youtube link" id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-2">
                                            <div class="card p-2">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-1">
                                                        <div class="text-center">
                                                            <i class="fa fa-whatsapp"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-11">
                                                        <input type="text" name="whatsapp" pattern="[0-9]{10}"
                                                            minlength="10" maxlength="10"
                                                            value="<?= $CONTACT[0]->whatsapp ?>"
                                                            placeholder="Whatsapp no" id="" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-2">
                                            <div class="card p-2">
                                                <div class="row align-items-center justify-content-center">
                                                    <div class="col-1">
                                                        <div class="text-center">
                                                            <i class="fa fa-map-marker"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-11">
                                                        <textarea type="text" name="map" placeholder="Full Address"
                                                            id=""
                                                            class="form-control"><?= $CONTACT[0]->address ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="">
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-info">Update Information</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>