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
                                <li class="breadcrumb-item"><a href="#">Income & Payouts</a></li>
                                <li class="breadcrumb-item"><a href="#">
                                        My Earnings
                                    </a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">
                            My Earnings
                        </h4>
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
                            <h4 class="card-title">
                                My Earnings
                            </h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <?php $this->load->view('messages'); ?>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Added On</th>
                                                    <th>Income Name</th>
                                                    <th>Debit</th>
                                                    <th>Credit</th>
                                                    <th>Remark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $id = 0; $totalDebit = 0; $totalCredit = 0; foreach($EARNINGS as $data){
                                                    $totalDebit += $data->debit;
                                                    $totalCredit += $data->credit;
                                                ?>
                                                <tr>
                                                    <td><?= ++$id ?></td>
                                                    <td><?= date('d M Y', strtotime($data->vc_date)) ?></td>
                                                    <td>
                                                        <?php if($data->income_type_id == 1){ ?>
                                                        Fast Start Bonus 1
                                                        <?php }else if($data->income_type_id == 2){ ?>
                                                        Fast Start Bonus -2
                                                        <?php }else if($data->income_type_id == 3){ ?>
                                                        LEADERSHIP DUPLICATION BONUS -1
                                                        <?php }else if($data->income_type_id == 4){ ?>
                                                        LEADERSHIP DUPLICATION BONUS -2
                                                        <?php }else if($data->income_type_id == 5){ ?>
                                                        Team Sales Bonus
                                                        <?php } ?>
                                                    </td>
                                                    <td class="text-end"><?= number_format($data->debit,2) ?></td>
                                                    <td class="text-end"><?= number_format($data->credit,2) ?></td>
                                                    <td><?= $data->remark ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Total :</td>
                                                    <th class="text-end font-weight-bold">&#8377;<?= number_format($totalDebit,2) ?></th>
                                                    <th class="text-end font-weight-bold">&#8377;<?= number_format($totalCredit,2) ?></th>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>