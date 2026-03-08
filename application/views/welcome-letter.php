<style>
.kt-portlet__body {
    background: url(<?php echo base_url('assets/images/welcome-letter.jpg') ?>);
    background-size: cover;
    background-repeat: no-repeat;
}

.content-box {
    padding: 80px;
}
</style>
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
                                <li class="breadcrumb-item"><a href="#">Welcome Letter</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Welcome Letter</h4>
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
                            <h4 class="card-title">Welcome Letter</h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <div class="content-box">
                                <?= file_get_contents(FCPATH . "admin/content/welcome-latter.txt") ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>