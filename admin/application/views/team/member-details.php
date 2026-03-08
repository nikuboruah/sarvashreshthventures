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
                                <li class="breadcrumb-item"><a href="#">Members</a></li>
                                <li class="breadcrumb-item"><a href="#">Member Details</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Members</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-lg-12">
                    <?php $this->load->view('messages'); ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Member Details</h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <?php $this->load->view('messages'); ?>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="table-wrap">
                                        <form action="<?php echo base_url('team/edit_customer_details') ?>"
                                            method="POST">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">Basic Information</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td><input type="text" name="name"
                                                                value="<?= $CUSTOMER_DETAILS[0]->user_name ?>"
                                                                class="form-control" required></td>
                                                        <input type="hidden" name="customer_id" id="customer_id"
                                                            value="<?= $CUSTOMER_DETAILS[0]->customer_id ?>">
                                                    </tr>
                                                    <tr>
                                                        <td>Phone</td>
                                                        <td><input type="text" name="phone"
                                                                value="<?= $CUSTOMER_DETAILS[0]->user_phone ?>"
                                                                class="form-control" required></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Email</td>
                                                        <td><input type="text" name="email"
                                                                value="<?= $CUSTOMER_DETAILS[0]->user_email ?>"
                                                                class="form-control"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Address</td>
                                                        <td><textarea type="text" name="address" class="form-control"
                                                                required><?= $CUSTOMER_DETAILS[0]->address ?></textarea>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>PAN No</td>
                                                        <td>
                                                            <input type="text" name="pan" id="pan"
                                                                value="<?= $CUSTOMER_DETAILS[0]->pan ?>"
                                                                class="form-control" required>
                                                            <span id="pan_msg"></span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Nominee</td>
                                                        <td><input type="text" name="nominee"
                                                                value="<?= $CUSTOMER_DETAILS[0]->phone2 ?>"
                                                                class="form-control"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>Relation</td>
                                                        <td><input type="text" name="relation"
                                                                value="<?= $CUSTOMER_DETAILS[0]->email2 ?>"
                                                                class="form-control"></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-right" colspan="2">
                                                            <button type="submit" id="detailsButton"
                                                                class="btn btn-success">Update</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-6 mb-3">
                                    <form action="<?php echo base_url('team/update_bank_details') ?>" method="POST">
                                        <div class="table-wrap">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">Bank Information</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Account Number</td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                value="<?= $BANK[0]->ac_no ?>" name="acc_no">
                                                            <input type="hidden" name="cust_id"
                                                                value="<?= $BANK[0]->customer_id ?>">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>IFSC</td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                value="<?= $BANK[0]->ifsc_code ?>" name="ifsc">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Bank Name</td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                value="<?= $BANK[0]->bank_name ?>" name="bank_name">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Account Holder’s Name</td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                value="<?= $BANK[0]->payee_name ?>" name="acc_holder">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="text-right">
                                                                <button type="submit"
                                                                    class="btn btn-success">Update</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
        $(document).on('change', '#pan', function() {
            let pan = $(this).val()
            let cust_id = $('#customer_id').val()

            $.ajax({
                url: '<?php echo base_url('team/find_pan_no') ?>',
                method: 'POST',
                data: {
                    pan: pan,
                    customer: cust_id
                },

                success: function(data) {
                    if (data == 1) {
                        $('#pan_msg').html('PAN no already exist.').addClass(
                            'text-danger').removeClass(
                            'text-success').css('font-size', '12px');
                        $('#detailsButton').prop('disabled', true)
                    } else {
                        $('#pan_msg').html('PAN no available.').addClass(
                            'text-success').removeClass(
                            'text-danger').css('font-size', '12px');
                        $('#detailsButton').prop('disabled', false)
                    }
                }
            })
        })
        </script>