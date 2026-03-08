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
                                <li class="breadcrumb-item"><a href="#"><?= PROJECT_NAME ?></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>

            <input type="hidden" id="activationStatus" value="<?= $CUSTOMER_DETAILS[0]->status ?>" class="form-control">
            <div class="card mb-3 p-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-right">
                            <?php if($CUSTOMER_DETAILS[0]->status == 1){ ?>
                            <span class="badge badge-success">Active</span>
                            <?php } else { ?>
                            <span class="badge badge-warning">Inactive</span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <h5><b>ID Holder Name :</b> <?= $CUSTOMER_DETAILS[0]->name ?></h5>
                        <h5>
                            <?php
                                $rank = $CUSTOMER_DETAILS[0]->reward_rank_id;
                                $rank_achieve = '';
                                if($rank != 0){
                                    $rank_achieve = $this->Crud->ciRead("rank_master", "`id` = '$rank'")[0]->rank;
                                }else{
                                    $rank_achieve = '<span class="text-secondary">NOT ACHIEVE</span>';
                                }
                            ?>
                            <b>Rank :</b> <?= $rank_achieve ?>
                        </h5>
                        <h5>
                            <?php
                                $package = $CUSTOMER_DETAILS[0]->package_id;
                                $current_package = '';
                                if($package != 0){
                                    $current_package = $this->Crud->ciRead("package_master", "`package_id` = '$package'")[0]->package_name;
                                }else{
                                    $current_package = '<span class="text-secondary">NOT ACTIVE</span>';
                                }
                            ?>
                            <b>Package :</b> <?= $current_package ?><br /><br />
                        </h5>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <h5><b>ID Number :</b> <?= $CUSTOMER_DETAILS[0]->customer_id ?></h5>
                        <h5><b>Joining Date :</b>
                            <?= date('d M Y h:i A', strtotime($CUSTOMER_DETAILS[0]->registration_date)) ?></h5>
                        <h5><b>Activation Date :</b>
                            <?= $CUSTOMER_DETAILS[0]->activation_date == '' ? '<span class="text-secondary">NOT ACTIVE</span>' : date('d M Y h:i A', strtotime($CUSTOMER_DETAILS[0]->activation_date)) ?>
                        </h5>
                    </div>
                </div>
            </div>


            <?php
$total_points = $CUSTOMER_DETAILS[0]->total_points;

$ranks = [
    ["TEAM STAR",5],
    ["TEAM BUILDER",15],
    ["TEAM CONSULTANT",35],
    ["TEAM DIRECTOR",75],
    ["RUBY DIRECTOR",150],
    ["EMERALD DIRECTOR",400],
    ["SAPPHIRE DIRECTOR",900],
    ["DIAMOND DIRECTOR",1900],
    ["BLACK DIAMOND DIR",4400],
    ["BLUE DIAMOND DIR",9400],
    ["PINK DIAMOND DIR",19400],
    ["PRESIDENTIAL DIAMOND",44400],
    ["GLOBAL DIAMOND",94400],
    ["CROWN DIAMOND",194400],
];

$prev = 0;
?>

            <div class="card px-2 mb-3">
                <div class="row mt-2 mb-2">
                    <div class="col-lg-12">
                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Rank Name</th>
                                        <th>Volume Points</th>
                                        <th>Your Points</th>
                                        <th>Rank Status</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php foreach($ranks as $rank){ 
    $name = $rank[0];
    $limit = $rank[1];
    $volume = $limit - $prev;

    if($total_points >= $limit){
        $your_points = $volume;
        $status = '<span class="badge bg-success">Achieved</span>';
    }else{
        $your_points = max(0, $total_points - $prev);
        $status = '<span class="badge bg-secondary">Processing...</span>';
    }
?>

                                    <tr>
                                        <td><?= $name ?></td>
                                        <td><?= $volume ?></td>
                                        <td><?= $your_points ?></td>
                                        <td><?= $status ?></td>
                                    </tr>

                                    <?php $prev = $limit; } ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card px-2 mb-3">
                <div class="row mt-2 mb-2">
                    <div class="col-lg-12">
                        <marquee class="py-2 h5">
                            <?php foreach($NOTIFICATIONS as $data){ ?>
                            <i class="fa fa-star text-warning"></i>
                            <span><?= $data->notification ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php } ?>
                        </marquee>
                    </div>
                </div>
            </div>
            <div class="card mb-3 p-3">
                <h3 class="text-uppercase font-weight-bolder mb-4">Sponsor Link</h3>
                <div class="row">
                    <div class="col-lg-9">
                        <input type="text"
                            value="<?php echo site_url('registration?userid=' . $this->session->userdata('aiplUserId')); ?>"
                            class="form-control" id="referral-link">
                    </div>
                    <div class="col-lg-3">
                        <a href="<?php echo site_url('registration?userid=' . $this->session->userdata('aiplUserId')); ?>"
                            target="_blank" class="btn btn-success">Open Link</a>
                        <button class="btn btn-warning" onclick="copyText()">Copy</button>
                    </div>
                </div>
            </div>
            <div class="card mb-3 p-3">
                <h3 class="text-uppercase font-weight-bolder">Total Member</h3>
                <div class="row">
                    <div class="col-lg-4 mb-3">
                        <div class="card border-info p-3 text-center">
                            <h4>Total Member</h4>
                            <h2><?= $TOTAL_MEMBER ?></h2>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-3">
                        <div class="card border-success p-3 text-center">
                            <h4>Active Member</h4>
                            <h2><?= $TOTAL_ACTIVE_MEMBER ?></h2>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-3">
                        <div class="card border-primary p-3 text-center">
                            <h4>Inactive Member</h4>
                            <h2><?= $TOTAL_INACTIVE_MEMBER ?></h2>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <div class="card border-warning p-3 text-center">
                            <h4>Active Right</h4>
                            <h2><?= $TOTAL_ACTIVE_RIGHT_MEMBER ?></h2>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <div class="card border-warning p-3 text-center">
                            <h4>Inactive Right</h4>
                            <h2><?= $TOTAL_INACTIVE_RIGHT_MEMBER ?></h2>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <div class="card border-warning p-3 text-center">
                            <h4>Active Left</h4>
                            <h2><?= $TOTAL_ACTIVE_LEFT_MEMBER ?></h2>
                        </div>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <div class="card border-warning p-3 text-center">
                            <h4>Inactive Left</h4>
                            <h2><?= $TOTAL_INACTIVE_LEFT_MEMBER ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="activationModal" tabindex="-1" role="dialog" aria-labelledby="activationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="activationModalLabel">ACTIVATE NOW</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h4 class="text-danger">You account is not activated yet.</h4>
                                <a href="<?php echo base_url('products') ?>" class="btn btn-warning btn-lg mt-4"><i
                                        class="fa fa-shopping-cart"></i> Buy Product for
                                    Activation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
        $(document).ready(function() {

            var activation_status = $('#activationStatus').val();

            if (activation_status == 0) {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('dashboard/is_activation_request_sent') ?>',

                    success: function(response) {

                        if (response == 1) {

                            $('#activationModal').modal('show');

                        } else {

                            Swal.fire({
                                icon: 'info',
                                title: 'Request Already Sent',
                                text: 'You already sent activation request. Please wait for admin response.',
                                confirmButtonText: 'OK'
                            });

                            $('#activationModal').modal('hide');

                        }

                    },

                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'Something went wrong. Please try again later.'
                        });
                    }

                });

            }

        });


        function copyText() {

            var copyText = document.getElementById("referral-link");
            copyText.select();
            copyText.setSelectionRange(0, 99999);

            try {

                var successful = document.execCommand('copy');

                if (successful) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Copied!',
                        text: 'Referral link copied successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    });

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Copy Failed',
                        text: 'Unable to copy the link. Please try again.'
                    });

                }

            } catch (err) {

                console.error('Unable to copy link', err);

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unable to copy link.'
                });

            }

        }
        </script>