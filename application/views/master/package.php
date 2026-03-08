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
                                <li class="breadcrumb-item"><a href="#">Package</a></li>
                                <li class="breadcrumb-item"><a href="#">All Packages</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">All Package</h4>
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
                            <h4 class="card-title">All Packages</h4>
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
                                                    <th nowrap>Package Name</th>
                                                    <th class="text-center" nowrap>BV</th>
                                                    <th class="text-center" nowrap>Team Sales Bonus(%)</th>
                                                    <th class="text-center" nowrap>Weekly Capping</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=0;
                                                    foreach($pack as $pk){
                                                        $edit=$pk['package_id']."~".$pk['package_name']."~".$pk['pv'].
                                                        "~".$pk['referral_income_percentage']."~".$pk['matching_income_percentage']."~".$pk['weekly_capping'];
                                    
                                                ?>
                                                <tr>
                                                    <td><?=++$i?></td>
                                                    <td class="text-left"><?=$pk['package_name']?></td>
                                                    <td class="text-center"><span><?=$pk['pv']?></span></td>
                                                    <td class="text-center">
                                                        <span><?=$pk['matching_income_percentage']?>%</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span>&#8377;<?=$pk['weekly_capping']?></span>
                                                    </td>
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