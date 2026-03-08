<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>New Member Registration</h5>
    <hr>
    <span id="all_msg" class="text-danger"></span>
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-group">
                <label>Sponsor ID <span class="text-danger">*</span></label>
                <input type="text" placeholder="Sponsor ID" name="sponsorid" id="sponsorid" class="form-control"
                    required>
                <small><span id="sponsor_msg"></span></small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Downline ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Downline ID" name="downlineid" id="downlineid"
                    required>
                <small><span id="downline_msg"></span></small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Position <span class="text-danger">*</span></label>
                <select name="position" id="position" class="form-control" required>
                    <option value="" selected disabled>Select position</option>
                    <option value="0">Left</option>
                    <option value="1">Right</option>
                </select>
                <small><span id="position_msg"></span></small>
            </div>
        </div>

        <div class="col-md-3" style="display:none;">
            <div class="form-group">
                <label>Epin <span class="text-danger">*</span></label>
                <input type="text" placeholder="Epin" value="<?php echo epinValidator(); ?>" name="" id="epin"
                    class="form-control" readonly>
            </div>
        </div>

        <div class="col-md-3 d-none">
            <div class="form-group">
                <label>Member ID</label>
                <input type="text" placeholder="Epin" value="<?php echo generateUniqueID(); ?>" name="" id="memberid"
                    class="form-control" readonly>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Member Name <span class="text-danger">*</span></label>
                <input type="text" placeholder="Full Name" name="" id="mname" class="form-control" required>
            </div>
        </div>


        <div class="col-md-4">
            <div class="form-group">
                <label>Phone No <span class="text-danger">*</span></label>
                <input type="text" placeholder="Enter Phone no" minlength="10" maxlength="10" name="" id="mphone" class="form-control">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Email ID</label>
                <input type="email" placeholder="Enter Email ID" name="" id="mmail" class="form-control">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>PAN No. <span class="text-danger">*</span></label>
                <input type="text" placeholder="Enter PAN no" name="pan" id="pan" class="form-control">
                <small><span id="pan_msg"></span></small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Password <span class="text-danger">*</span></label>
                <input type="password" placeholder="Password" name="password" id="password" class="form-control"
                    required>
                <small><span id="p_msg"></span></small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Confirm Password <span class="text-danger">*</span></label>
                <input type="password" placeholder="Confirm password" name="cpassword" id="cpassword"
                    class="form-control" required>
                <small><span id="c_msg"></span></small>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label>Remark</label>
                <textarea placeholder="Remark" name="" id="remark" rows="1" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-12 text-right">
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="submit" id="addmember" class="btn btn-primary" onclick="addNewMember()">Register</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js
"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css
" rel="stylesheet">
<script>
$(document).on('input', '#sponsorid', function() {
    let sponsor_id = $(this).val()

    if (sponsor_id == '') {
        $('#sponsor_msg').html('').removeClass('text-success').removeClass('text-danger');
    } else {
        $.ajax({
            url: '<?php echo base_url('member/find_sponsor_id') ?>',
            method: 'POST',
            data: 'sponsor_id=' + sponsor_id,

            success: function(data) {
                if (data == 0) {
                    $('#sponsor_msg').html('Sponsor id not available').addClass('text-danger')
                        .removeClass('text-success');
                } else {
                    $('#sponsor_msg').html('Sponsor Name : '+data).addClass('text-success').removeClass(
                        'text-danger');
                }
            }
        })
    }
})

$(document).on('input', '#downlineid', function() {
    let sponsor_id = $(this).val()

    if (sponsor_id == '') {
        $('#downline_msg').html('').removeClass('text-success').removeClass('text-danger');
    } else {
        $.ajax({
            url: '<?php echo base_url('member/find_sponsor_id') ?>',
            method: 'POST',
            data: 'sponsor_id=' + sponsor_id,

            success: function(data) {
                if (data == 0) {
                    $('#downline_msg').html('Downline id not available').addClass('text-danger')
                        .removeClass('text-success');
                } else {
                    $('#downline_msg').html('Downline Name : '+data).addClass('text-success')
                        .removeClass('text-danger');
                    check_position_right(sponsor_id, 1)
                    check_position_left(sponsor_id, 0)
                }
            }
        })
    }
})

function check_position_right(id, position) {
    let d = {
        "downline_id": id,
        "position": position
    }

    $.ajax({
        url: '<?php echo base_url('member/check_position') ?>',
        method: 'POST',
        data: d,

        success: function(data) {
            if (data > 0) {
                $('#position option[value="1"]').prop('disabled', true);
            } else {
                $('#position option[value="1"]').prop('disabled', false);
            }
        }
    })
}

function check_position_left(id, position) {
    let d = {
        "downline_id": id,
        "position": position
    }

    $.ajax({
        url: '<?php echo base_url('member/check_position') ?>',
        method: 'POST',
        data: d,

        success: function(data) {
            if (data > 0) {
                $('#position option[value="0"]').prop('disabled', true);
            } else {
                $('#position option[value="0"]').prop('disabled', false);
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
        $('#p_msg').html('Password must contain at least one letter & one number').css('font-size','12px').addClass('text-danger');
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
                url: '<?php echo base_url('member/find_pan_number') ?>',
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

function addNewMember() {
    let sponsor = $('#sponsorid').val()
    let downline = $('#downlineid').val()
    let position = $('#position').val()
    let name = $('#mname').val()
    let pan = $('#pan').val()
    let password = $('#password').val()
    let cpassword = $('#cpassword').val()
    let epin = $('#epin').val()
    let memberid = $('#memberid').val()
    let phone = $('#mphone').val()
    let email = $('#mmail').val()
    let remark = $('#remark').val()

    if (sponsor == '' || downline == '' || position == '' || name == '' || pan == '' || password == '' || cpassword == '' || phone == '') {
        $('#all_msg').html('All * fields are required.')
        return
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
        "epin": epin,
        "memberid": memberid,
        "phone": phone,
        "email": email,
        "remark": remark,
    }

    $.ajax({
        url: '<?php echo base_url('member/add_new_member_admin') ?>',
        method: 'POST',
        data: d,

        success: function(data) {
            const tableHtml = `
                <table class="table table-borderless">
                    <tr>
                        <th colspan="2" class="text-center">Login Details</th>
                    </tr>
                    <tr>
                        <td class="text-left">User ID</td>
                        <td class="text-left">${memberid}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Name</td>
                        <td class="text-left">${name}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Password</td>
                        <td class="text-left">${password}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Transaction Password</td>
                        <td class="text-left">${password}</td>
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