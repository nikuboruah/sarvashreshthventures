<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    System Controls
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <?php $this->load->view('messages') ?>
            <form action="<?php echo base_url('content/update_system_controls') ?>" method="POST">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Admin Charge (in %)</label>
                            <input type="text" name="charge" value="<?= $DETAILS[0]->admIn_charge ?>" placeholder="Enter admin charge" class="form-control"
                                required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">TDS Charge (in %)</label>
                            <input type="text" name="tds" value="<?= $DETAILS[0]->tds ?>" placeholder="Enter TDS Charge" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Minimum Withdrawal (in Rs.)</label>
                            <input type="text" name="min_amt" value="<?= $DETAILS[0]->min_withdrawal_amt ?>" placeholder="Enter minimum withdrawal" class="form-control"
                                required>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="text-right">
                            <button type="submit" class="btn btn-info">Update Details</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>