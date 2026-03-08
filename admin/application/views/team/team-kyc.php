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
                                <li class="breadcrumb-item"><a href="#">Orders</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Team KYC</h4>
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
                            <h4 class="card-title">
                                Team KYC
                            </h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <?php $this->load->view('messages'); ?>
                            <div class="row">
                                <div class="col-sm">
                                     <div class="table-responsive">
                                        <table class="table" id="datatable_1">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th nowrap>Member Details</th>
                                                    <th nowrap>Account No</th>
                                                    <th nowrap>Bank Name</th>
                                                    <th>IFSC</th>
                                                    <th>Account Holder</th>
                                                    <th>KYC Status</th>
                                                    <th>Action</th>
                                                    <th>Updated Date</th>
                                                    <th>Approve/Reject Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $id = 0; foreach($KYC as $data){ ?>
                                                <tr>
                                                    <td class="text-center"><?= ++$id ?></td>
                                                    <td nowrap style="font-size:12px;">
                                                        Member Name : <?= $data->user_name ?><br />
                                                        Member ID : <?= $data->customer_id ?>
                                                    </td>
                                                    <td> <?= $data->ac_no ?></td>
                                                    <td> <?= $data->bank_name ?></td>
                                                    <td> <?= $data->ifsc_code ?></td>
                                                    <td> <?= $data->payee_name ?></td>
                                                    <td class="text-center">
                                                        <?= date('d M Y h:i A', strtotime($data->added_date)) ?></td>
                                                    <td class="text-center">
                                                        <?= $data->updated_date == '' ? '--' : date('d M Y h:i A', strtotime($data->updated_date)) ?>
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>