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
                                <li class="breadcrumb-item"><a href="#">Packages</a></li>
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
                            <h4 class="card-title">Package Details </h4>
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <?php $this->load->view('messages'); ?>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-responsive">
                                        <table class="table" id="datatable_1">
                                            <thead class="thead-light">
                                                <th>#</th>
                                                <th nowrap>Package Name</th>
                                                <th nowrap>BV</th>
                                                <th nowrap>Team Sales Bonus(%)</th>
                                                <th nowrap>Lesserleg Volume (BV)</th>
                                                <th nowrap>Weekly Capping</th>
                                                <th nowrap>Added On</th>
                                                <th nowrap>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=0;
                                                    foreach($pack as $pk){
                                                        $edit=$pk['package_id']."~".$pk['package_name']."~".$pk['pv'].
                                                        "~".$pk['matching_income_percentage']."~".$pk['weekly_capping']."~".$pk['lesserleg_volume'];
                                    
                                                ?>
                                                <tr>
                                                    <td><?=++$i?></td>
                                                    <td class="text-left"><?=$pk['package_name']?></td>
                                                    <td><span><?=$pk['pv']?></span></td>
                                                    <td><span><?=$pk['matching_income_percentage']?>%</span></td>
                                                    <td><span><?=$pk['lesserleg_volume']?> BV</span></td>
                                                    <td><span>&#8377;<?=$pk['weekly_capping']?></span></td>
                                                    <td>
                                                        <span><?= date('d/m/Y', strtotime($pk['entry_date']))?></span>
                                                    </td>
                                                    <td nowrap>
                                                        <button class="btn btn-sm btn-success" id="<?=$edit;?>"
                                                            onclick="edit_package(this)">Edit</button>

                                                        <?php if($pk['status'] == 1){?>
                                                        <button class="btn btn-sm btn-warning"
                                                            id="<?=$pk['package_id']."~2"?>"
                                                            onclick="change_package_status(this)">Block</button>
                                                        <?php }else{ ?>
                                                        <button class="btn btn-sm btn-info"
                                                            id="<?=$pk['package_id']."~1"?>"
                                                            onclick="change_package_status(this)">Unblock</button>
                                                        <?php } ?>
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



        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Package</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row px-4">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="">Package Name</label>
                                    <input type="text" class="form-control" id="packagename">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="">BV</label>
                                    <input type="number" min=0 class="form-control" id="pv">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="">Team Sales Bonus(in %)</label>
                                    <input type="number" min=0 class="form-control" id="matching_income_m">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="">Lesserleg Volume (BV)<span class="text-danger">*</span></label>
                                <input type="number" placeholder="Lesserleg Volume" class="form-control" id="lesserleg">
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="">Weekly Capping</label>
                                    <input type="number" min=0 class="form-control" id="weekly_capping">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="update_package()">Save
                            changes</button>
                    </div>
                    <input type="text" hidden id="packageId">
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
        function edit_package(x) {
            var p = x.id.split("~");

            $("#packageId").val(p[0]);
            $("#packagename").val(p[1]);
            $("#pv").val(p[2]);
            $("#matching_income_m").val(p[3]);
            $("#weekly_capping").val(p[4]);
            $("#lesserleg").val(p[5]);

            $("#editModal").modal("show");
        }


        update_package = function() {

            let packagename = $("#packagename").val().trim();
            let pv = $("#pv").val().trim();
            let matching_income = $("#matching_income_m").val().trim();
            let weekly_capping = $("#weekly_capping").val().trim();
            let packageId = $("#packageId").val();
            let lesserleg = $("#lesserleg").val();

            // Validation
            if (packagename == "") {
                Swal.fire("Warning", "Package Name is required.", "warning");
                return;
            }

            if (pv == "" || pv < 0) {
                Swal.fire("Warning", "Valid BV is required.", "warning");
                return;
            }

            if (matching_income == "" || matching_income < 0) {
                Swal.fire("Warning", "Valid Team Sales Bonus is required.", "warning");
                return;
            }

            if (weekly_capping == "" || weekly_capping < 0) {
                Swal.fire("Warning", "Valid Weekly Capping is required.", "warning");
                return;
            }

            if (lesserleg == "") {
                Swal.fire("Warning", "Lesserleg Volume is required.", "warning");
                return;
            }

            $(".btn-primary").prop("disabled", true);

            var d = {
                "p_name": packagename,
                "pv": pv,
                "matching_income_p": matching_income,
                "lesserleg": lesserleg,
                "weekly_capping": weekly_capping,
                "packageId": packageId
            };

            $.ajax({
                url: "<?=base_url('package/edit_package')?>",
                type: "POST",
                dataType: "TEXT",
                data: d,

                success: function(data) {

                    $(".btn-primary").prop("disabled", false);

                    Swal.fire({
                        icon: "success",
                        title: "Updated",
                        text: "Package updated successfully",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.reload();
                    });
                },

                error: function() {
                    $(".btn-primary").prop("disabled", false);
                    Swal.fire("Error", "Something went wrong. Try again.", "error");
                }
            });
        };


        change_package_status = function(x) {

            var p_id = x.id.split("~");

            Swal.fire({
                title: "Are you sure?",
                text: "You want to change package status?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel"
            }).then((result) => {

                if (result.isConfirmed) {

                    var dt = {
                        "id": p_id[0],
                        "status": p_id[1]
                    };

                    $.ajax({
                        url: "<?=base_url('package/changePackageStatus')?>",
                        method: "POST",
                        data: dt,

                        success: function() {

                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "Package status changed successfully",
                                confirmButtonText: "OK"
                            }).then(() => {
                                window.location.reload();
                            });
                        },

                        error: function() {
                            Swal.fire("Error", "Something went wrong.", "error");
                        }
                    });
                }
            });
        };
        </script>