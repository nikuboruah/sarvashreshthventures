<div class="kt-portlet__body card p-5 shadow border-0">
    <?php if($STATUS == 1){ ?>
    <h5>All Members</h5>
    <?php }else if($STATUS == 2){ ?>
    <h5>Pending Members</h5>
    <?php }else if($STATUS == 3){ ?>
    <h5>Active Members</h5>
    <?php }else if($STATUS == 4){ ?>
    <h5>Blocked Members</h5>
    <?php } ?>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <div class="row mb-3">
                <div class="col-lg-3">
                    <input type="date" name="" id="" class="form-control">
                </div>
                <div class="col-lg-3">
                    <input type="date" name="" id="" class="form-control">
                </div>
                <?php if($STATUS == 1){ ?>
                <div class="col-lg-3">
                    <select name="" id="" class="form-control">
                        <option value="0">All Members</option>
                        <option value="1">Pending Members</option>
                        <option value="2">Active Members</option>
                        <option value="3">Blocked Members</option>
                    </select>
                </div>
                <?php } ?>
                <div class="col-lg-3">
                    <button class="btn btn-info">Submit</button>
                </div>
            </div>
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th nowrap>Member Details</th>
                            <th nowrap>Sponsor Details</th>
                            <th nowrap>Downline Details</th>
                            <th nowrap>Activated By</th>
                            <th>Status</th>
                            <th>Activation Date & Time</th>
                            <th>Registration Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $id = 0; foreach($TEAM as $data){ ?>
                        <tr>
                            <td><?= ++$id ?></td>
                            <td nowrap style="font-size:12px;">
                                Member Id : ,<br />
                                Member Name : ,<br />
                                Member Number : ,<br />
                                Member Package : ,<br />
                                PAN :
                            </td>
                            <td nowrap style="font-size:12px;">
                                Sponsor Id : ,<br />
                                Sponsor Name : ,<br />
                                Sponsor Package :
                            </td>
                            <td nowrap style="font-size:12px;">
                                Downline Id : ,<br />
                                Downline Name : ,<br />
                                Downline Package :
                            </td>
                            <td nowrap style="font-size:12px;">
                                Member Id : ,<br />
                                Member Name :
                            </td>
                            <td></td>
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

<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Passwords</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Account Password : </b> </p>
                <p><b>Transaction Password : </b> </p>
            </div>
        </div>
    </div>
</div>