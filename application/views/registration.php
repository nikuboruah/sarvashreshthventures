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
    <link rel="shortcut icon" href="<?= base_url('') ?>portal_assets/images/favicon.ico">

       

     <!-- App css -->
     <link href="<?= base_url('') ?>portal_assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
     <link href="<?= base_url('') ?>portal_assets/css/icons.min.css" rel="stylesheet" type="text/css" />
     <link href="<?= base_url('') ?>portal_assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>
<?php
$ref = isset($_GET['userid']) ? $_GET['userid'] : '';
?>
<body id="body" class="auth-page" style="background-image: url('<?= base_url('') ?>portal_assets/images/p-1.png'); background-size: cover; background-position: center center;">
   <!-- Log In page -->
    <div class="container-md">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="card-body mt-3">
                    <div class="row">
                        <div class="col-lg-4 mx-auto">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="text-center p-3">
                                        <a href="index.html" class="logo logo-admin">
                                            <img src="<?= base_url('') ?>portal_assets/images/logo-sm.png" height="100" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 fw-semibold text-dark font-18">Let's Get Started</h4>   
                                        <p class="text-muted  mb-0">Sign up to continue to <?= PROJECT_NAME ?>.</p>  
                                    </div>
                                </div>
                                <div class="card-body pt-0">                                    
                                    <form class="my-4" action="">            
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="sponsorid">Sponsor ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="sponsorid" name="sponsorid" placeholder="Sponsor ID" value="<?= $ref ?>" <?= $ref != '' ? 'readonly' : '' ?> required>
                                            
                                            <small><span id="sponsor_msg"></span></small>
                                            <?php if($ref == ''){ ?>
                                            <p style="font-size: 12px;"><small>Don't have Sponsor ID? To get Sponsor ID <span class="text-info" style="cursor: pointer;" onclick="setDefaultId()"><u>Click here</u></span></small></p>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label class="form-label" for="username">Position <span class="text-danger">*</span></label>
                                            <select name="position" id="position" class="form-control" required>
                                                <option value="" selected disabled>Select position</option>
                                                <option value="0">Left</option>
                                                <option value="1">Right</option>
                                            </select>
                                            <small><span id="position_msg"></span></small>                              
                                        </div>

                                        <div class="form-group mb-2">
                                            <label>Downline ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Downline ID" name="downlineid"
                                                id="downlineid" required>
                                            <small><span id="downline_msg"></span></small>                    
                                        </div>

                                        <div class="form-group mb-2">
                                            <label>Member ID</label>
                                            <input type="text" placeholder="" value="<?php echo generateUniqueID(); ?>" name="" id="memberid" class="form-control" readonly>                    
                                        </div>

                                        <div class="form-group mb-2">
                                            <label>Member Name <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Full Name" name="" id="mname" class="form-control" required>                  
                                        </div>

                                        <div class="form-group mb-2">
                                            <label>Phone No <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Phone no" minlength="10" maxlength="10" name="" id="mphone" class="form-control">                
                                        </div>

                                        <div class="form-group mb-2">
                                            <label>Email ID</label>
                                            <input type="email" placeholder="Enter Email ID" name="" id="mmail" class="form-control">                
                                        </div>

                                        <div class="form-group mb-2">
                                            <label>PAN No.</label>
                                            <input type="text" placeholder="Enter PAN no" name="pan" id="pan" class="form-control">
                                            <small><span id="pan_msg"></span></small>              
                                        </div>

                                        <div class="form-group mb-2">
                                            <label>Remark</label>
                                            <textarea placeholder="Remark" name="" id="remark" rows="3" class="form-control"></textarea>            
                                        </div>
            
                                        <div class="form-group mb-2">
                                            <label>Password <span class="text-danger">*</span></label>
                                            <input type="password" placeholder="Password" name="password" id="password" class="form-control"
                                                required>
                                            <small><span id="p_msg"></span></small>                            
                                        </div> 

                                        <div class="form-group mb-2">
                                             <label>Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" placeholder="Confirm password" name="cpassword" id="cpassword"
                                                class="form-control" required>
                                            <small><span id="c_msg"></span></small>                            
                                        </div>
            
                                        <div class="form-group row mt-3">
                                            <div class="col-12">
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input" type="checkbox" id="customSwitchSuccess" required>
                                                    <label class="form-check-label" for="customSwitchSuccess">By registering you agree to the Sarvashreshth Ventures <a target="_blank" href="<?= base_url('terms_and_condition') ?>" class="text-primary">Terms of Conditions</a></label>
                                                </div>
                                            </div><!--end col--> 
                                        </div><!--end form-group--> 
            
                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid mt-3">
                                                    <button type="submit" id="addmember" class="btn btn-primary" onclick="addNewMember()">Register <i class="fas fa-sign-up-alt ms-1"></i></button>
                                                </div>
                                            </div><!--end col--> 
                                        </div> <!--end form-group-->                           
                                    </form><!--end form-->
                                    <div class="m-3 text-center text-muted">
                                        <p class="mb-0">Already have an account ? <a href="<?= base_url('user') ?>" class="text-primary ms-2"><u>Log in</u></a></p>
                                        <p class="mb-0"><a href="<?php echo base_url('/') ?>" class="text-warning ms-2"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp;<b>Back to Website</b></a></p>
                                    </div>
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-body-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <!-- vendor js -->
    
    <script src="<?= base_url('') ?>portal_assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('') ?>portal_assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url('') ?>portal_assets/libs/feather-icons/feather.min.js"></script>
    <!-- App js -->
    <script src="<?= base_url('') ?>portal_assets/js/app.js"></script>
    
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js
"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css
" rel="stylesheet">
<script>
$('#position').prop('disabled', true);
$(document).ready(function() {
    let sponsor_id = $('#sponsorid').val()

    if (sponsor_id != '') {
        $.ajax({
            url: '<?php echo base_url('find_sponsor_id') ?>',
            method: 'POST',
            data: 'sponsor_id=' + sponsor_id,

            success: function(data) {
                if (data == 0) {
                    $('#sponsor_msg').html('Sponsor id not available').addClass('text-danger')
                        .removeClass('text-success');
                    $('#position').prop('disabled', true);
                } else {
                    $('#sponsor_msg').html(data).addClass('text-success')
                        .removeClass(
                            'text-danger');
                    $('#position').prop('disabled', false);
                }
            }
        })
    }
})

setDefaultId = function() {
    $('#sponsorid').val('SSVT100000')
    findSponsor()
}

$(document).on('input', '#sponsorid', function() {
    findSponsor();
})

function findSponsor() {
    let sponsor_id = $('#sponsorid').val()

    if (sponsor_id == '') {
        $('#sponsor_msg').html('').removeClass('text-success').removeClass('text-danger');
    } else {
        $.ajax({
            url: '<?php echo base_url('find_sponsor_id') ?>',
            method: 'POST',
            data: 'sponsor_id=' + sponsor_id,

            success: function(data) {
                if (data == 0) {
                    $('#sponsor_msg').html('Sponsor id not available').addClass('text-danger')
                        .removeClass('text-success');
                    $('#position').prop('disabled', true);
                } else {
                    $('#sponsor_msg').html('Sponsor Name : ' + data).addClass('text-success')
                        .removeClass(
                            'text-danger');
                    $('#position').prop('disabled', false);
                }
            }
        })
    }
}

$(document).on('change', '#position', function() {
    let sponsorid = $('#sponsorid').val()
    let position = $(this).val()
    $('#position_msg').html('');
    $.ajax({
        url: '<?php echo base_url('check_placement') ?>',
        method: 'POST',
        data: {
            sponsor: sponsorid,
            position: position
        },

        success: function(data) {
            $('#downlineid').val(data)
        }
    })
})

$(document).on('change', '#downlineid', function() {
    let sponsor_id = $(this).val();
    let position = $('#position').val();

    if (sponsor_id == '') {
        $('#downline_msg').html('').removeClass('text-success').removeClass('text-danger');
    } else {
        $.ajax({
            url: '<?php echo base_url('find_sponsor_id') ?>',
            method: 'POST',
            data: 'sponsor_id=' + sponsor_id,

            success: function(data) {
                if (data == 0) {
                    $('#downline_msg').html('Downline id : ' + sponsor_id + ' not available')
                        .addClass('text-danger')
                        .removeClass('text-success');
                    $('#downlineid').val('')
                } else {
                    check_position(sponsor_id, position)
                }
            }
        })
    }
})

function check_position(id, position) {
    let d = {
        "downline_id": id,
        "position": position
    }

    $.ajax({
        url: '<?php echo base_url('check_position') ?>',
        method: 'POST',
        data: d,

        success: function(data) {
            alert(data)
            if (data > 0) {
                $('#position').val('');
                $('#downlineid').val('');
                $('#position_msg').html('Position not available.').addClass('text-danger').removeClass(
                    'text-success')
            } else {
                $('#position_msg').html('Position available.').addClass('text-success').removeClass(
                    'text-danger')
            }
        }
    })
}

$(document).on('input', "#password", function() {
    let password = $(this).val()
    let c_password = $('#cpassword').val()
    let alphanumericRegex = /^(?=.*[a-zA-Z])(?=.*\d)/;

    if (!alphanumericRegex.test(password)) {
        $('#cpassword').val('');
        $('#p_msg').html('Password must contain at least one letter & one number').css('font-size', '12px')
            .addClass('text-danger');
        return;
    }

    $('#p_msg').html('').removeClass('text-danger');

    if (password == '') {
        $('#cpassword').val('')
        $('#c_msg').html('').removeClass('text-danger').removeClass('text-success')
        return
    }

    if (password != c_password) {
        $('#cpassword').val('')
        $('#c_msg').html('').removeClass('text-danger').removeClass('text-success')
        return
    }
})

$(document).on('input', "#cpassword", function() {
    let password = $('#password').val()
    let c_password = $(this).val()

    if (password == '') {
        $('#p_msg').html('Password is required.').addClass('text-danger').removeClass('text-success')
        return
    }

    if (password == c_password) {
        $('#c_msg').html('Password matched.').removeClass('text-danger').addClass('text-success')
    } else {
        $('#c_msg').html('Password didn\'t match.').addClass('text-danger').removeClass('text-success')
    }
})

$(document).on('change', '#pan', function(e) {
    let regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/;
    let pan_no = $(this).val()

    if (pan_no.length == 10) {
        if (pan_no.match(regExp)) {
            $.ajax({
                url: '<?php echo base_url('find_pan_number') ?>',
                method: 'POST',
                data: 'pan=' + pan_no,

                success: function(data) {
                    if (data == 0) {
                        $('#pan_msg').html('PAN number available').addClass('text-success')
                            .removeClass('text-danger')
                    } else {
                        $('#pan_msg').html('PAN no already used').addClass('text-danger')
                            .removeClass('text-success')
                    }
                }
            })
        } else {
            $('#pan_msg').html('Not a valid PAN number').addClass('text-danger').removeClass('text-success')
            e.preventDefault()
        }
    } else {
        $('#pan_msg').html('Please enter a valid PAN number.').addClass('text-danger').removeClass(
            'text-success');
        e.preventDefault()
    }
})

function addNewMember(x) {
    let sponsor = $('#sponsorid').val()
    let downline = $('#downlineid').val()
    let position = $('#position').val()
    let name = $('#mname').val()
    let pan = $('#pan').val()
    let password = $('#password').val()
    let cpassword = $('#cpassword').val()
    let memberid = $('#memberid').val()
    let phone = $('#mphone').val()
    let email = $('#mmail').val()
    let remark = $('#remark').val()

    if (sponsor == '' || downline == '' || position == '' || name == '' || password == '' || cpassword == '' || phone == '') {
        $('#all_msg').html('All * fields are required.')
        return
    }

    // Check Terms & Conditions checkbox
    if (!$('#customSwitchSuccess').is(':checked')) {
        $('#all_msg').html('You must agree to the Terms of Use.');
        return;
    }

    $('#all_msg').html('')

    if ($("span#sponsor_msg").hasClass('text-danger')) {
        $('#sponsorid').css('border', '1px solid red');
        return;
    }
    $('#sponsorid').css('border', '1px solid green');

    if ($("span#downline_msg").hasClass('text-danger')) {
        $('#downlineid').css('border', '1px solid red');
        return;
    }
    $('#downlineid').css('border', '1px solid green');

    if ($("span#pan_msg").hasClass('text-danger')) {
        $('#pan').css('border', '1px solid red');
        return;
    }
    $('#pan').css('border', '1px solid green');

    if ($("span#p_msg").hasClass('text-danger')) {
        $('#password').css('border', '1px solid red');
        return;
    }

    $('#password').css('border', '1px solid green');

    if ($("span#c_msg").hasClass('text-danger')) {
        $('#cpassword').css('border', '1px solid red');
        return;
    }
    $('#cpassword').css('border', '1px solid green');

    $('#addmember').prop('disabled', true);

    let d = {
        "sponsor": sponsor,
        "downline": downline,
        "position": position,
        "name": name,
        "pan": pan,
        "password": password,
        "cpassword": cpassword,
        "memberid": memberid,
        "phone": phone,
        "email": email,
        "remark": remark,
    }

    $.ajax({
        url: '<?php echo base_url('add_new_member_user') ?>',
        method: 'POST',
        data: d,

        success: function(data) {
            const tableHtml = `
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2" class="text-center">Login Details</th>
                    </tr>
                    <tr>
                        <th style="text-align: left;">User ID</th>
                        <td style="text-align: left;">${memberid}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Name</th>
                        <td style="text-align: left;">${name}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Password</th>
                        <td style="text-align: left;">${password}</td>
                    </tr>
                    <tr>
                        <th style="text-align: left;">Transaction Password</th>
                        <td style="text-align: left;">${password}</td>
                    </tr>
                </table>
            `;
            if (data == 1) {
                Swal.fire({
                    title: 'Congratulation your registration is completed',
                    html: tableHtml,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    location.reload();
                });
            } else {
                Swal.fire({
                    title: 'Warning',
                    text: 'Something went wrong. Try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(function() {
                    location.reload();
                });
            }
        }
    })
}
</script>