<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
	<title><?= PROJECT_NAME ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= base_url('../') ?>portal_assets/images/favicon.ico">

       

     <!-- App css -->
     <link href="<?= base_url('../') ?>portal_assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="<?= base_url('../') ?>portal_assets/css/icons.min.css" rel="stylesheet" type="text/css" />
     <link href="<?= base_url('../') ?>portal_assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body id="body" class="auth-page" style="background-image: url('<?= base_url('../') ?>portal_assets/images/p-1.png'); background-size: cover; background-position: center center;">
   <!-- Log In page -->
    <div class="container-md">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mx-auto">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="text-center p-3">
                                        <a href="index.html" class="logo logo-admin">
                                            <img src="<?= base_url('../') ?>portal_assets/images/logo-sm.png" height="100" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-1 mb-1 fw-semibold text-dark font-18">Let's Get Started</h4>   
                                        <p class="text-muted  mb-0">Sign in to continue to Sarvashreshth Ventures.</p>  
                                    </div>
                                </div>
                                <div class="card-body pt-0"> 
									<?php
										if ($this->session->flashdata('danger')) {
											echo '<div class="alert alert-danger fade show mt-2" role="alert">
													<div class="alert-text">'.$this->session->flashdata('danger').'</div>
												</div>';
										}

										unset($_SESSION['danger']);
									?>                                   
                                    <form class="my-2" action="<?php echo site_url('authentication/processLogin'); ?>" method = "post">         
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="email">Registered Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">                               
                                        </div> 
            
                                        <div class="form-group">
                                            <label class="form-label" for="password">Password</label>                                            
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">                            
                                        </div> 
            
                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid mt-3">
                                                    <button class="btn btn-primary" type="submit">Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div>
                                            </div><!--end col--> 
                                        </div> <!--end form-group-->                           
                                    </form><!--end form-->
                                    
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-body-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <!-- vendor js -->
    
    <script src="<?= base_url('../') ?>portal_assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('../') ?>portal_assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url('../') ?>portal_assets/libs/feather-icons/feather.min.js"></script>
    <!-- App js -->
    <script src="<?= base_url('../') ?>portal_assets/js/app.js"></script>
    
</body>
</html>