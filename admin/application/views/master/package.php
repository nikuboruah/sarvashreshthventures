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
                                <li class="breadcrumb-item"><a href="#">Add Package</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Package Master</h4>
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
                            <h4 class="card-title">Add New Package</h4>
                            <p class="text-muted mb-0"><code class="highlighter-rouge">*</code> Fields are required
                            </p>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">

                            <?php $this->load->view('messages'); ?>
                            <div class="row">
                                <div class="col-lg-6 mt-3">
                                    <label for="">Package Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter package name"
                                        id="packagename">
                                </div>

                                <div class="col-lg-6 mt-3">
                                    <label for="">BV <span class="text-danger">*</span></label>
                                    <input type="number" placeholder="BV" class="form-control" id="bv">
                                </div>

                                <div class="col-lg-6 mt-3">
                                    <label for="">Team Sales Bonus(in %) <span class="text-danger">*</span></label>
                                    <input type="number" placeholder="Bonus in %" class="form-control"
                                        id="matching_income_m">
                                </div>

                                 <div class="col-lg-6 mt-3">
                                    <label for="">Lesserleg Volume (BV)<span class="text-danger">*</span></label>
                                    <input type="number" placeholder="Lesserleg Volume" class="form-control"
                                        id="lesserleg">
                                </div>

                                <div class="col-lg-6 mt-3">
                                    <label for="">Weekly Capping <span class="text-danger">*</span></label>
                                    <input type="number" placeholder="Weekly capping" class="form-control"
                                        id="weekly_capping">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <button class="btn btn-success mt-4" onclick="add_package();">Create
                                        Package</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
        add_package = function() {

            let packagename = $("#packagename").val().trim();
            let bv = $("#bv").val().trim();
            let matching_income_m = $("#matching_income_m").val().trim();
            let weekly_capping = $("#weekly_capping").val().trim();
            let lesserleg = $("#lesserleg").val();

            // Validation
            if (packagename == "") {
                Swal.fire("Warning", "Package Name is required.", "warning");
                $("#packagename").focus();
                return;
            }

            if (bv == "" || bv <= 0) {
                Swal.fire("Warning", "Valid BV is required.", "warning");
                $("#bv").focus();
                return;
            }

            if (matching_income_m == "" || matching_income_m < 0) {
                Swal.fire("Warning", "Team Sales Bonus is required.", "warning");
                $("#matching_income_m").focus();
                return;
            }

            if (weekly_capping == "" || weekly_capping < 0) {
                Swal.fire("Warning", "Weekly Capping is required.", "warning");
                $("#weekly_capping").focus();
                return;
            }

            if (lesserleg == "") {
                Swal.fire("Warning", "Lesserleg Volume is required.", "warning");
                return;
            }

            // Disable button to prevent double click
            $(".btn-success").prop("disabled", true);

            var d = {
                "p_name": packagename,
                "bv": bv,
                "matching_income_p": matching_income_m,
                "lesserleg":lesserleg,
                "weekly_capping": weekly_capping
            };

            $.ajax({
                url: "<?=base_url('package/addPackage')?>",
                type: "POST",
                dataType: "TEXT",
                data: d,

                success: function(data) {

                    $(".btn-success").prop("disabled", false);

                    if (data == 0) {
                        Swal.fire({
                            icon: "error",
                            title: "Duplicate Package",
                            text: "Package name already exists."
                        });
                    } else {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Package Added Successfully",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                },

                error: function(xhr) {
                    $(".btn-success").prop("disabled", false);
                    Swal.fire("Error", "Something went wrong. Please try again.", "error");
                }
            });
        }
        </script>