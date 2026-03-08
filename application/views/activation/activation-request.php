<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-portlet__body card p-5 shadow border-0">
    <?php if($ACTIVATION == 2){ ?>
    <h5>Approved Activation</h5>
    <?php } else if($ACTIVATION == 3){ ?>
    <h5>Rejected Activation</h5>
    <?php } else { ?>
    <h5>Pending Activation</h5>
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
                <div class="col-lg-3">
                    <button class="btn btn-info">Submit</button>
                </div>
            </div>
            <div class="table-wrap">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Package Details</th>
                            <th>Amount</th>
                            <th>Proof</th>
                            <th>UTR No’s</th>
                            <th>Member Remark</th>
                            <th>Requested Date & Time</th>
                            <?php if($ACTIVATION == 2){ ?>
                            <th>Approved Date & Time</th>
                            <?php } else if($ACTIVATION == 3){ ?>
                            <th>Rejected Date & Time</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $id = 0; foreach($REQUEST as $data){ ?>
                        <tr>
                            <td><?= ++$id ?></td>
                            <td>
                              <?= $data->package_name.'<br/>&#8377;'.$data->package_amount ?>
                            </td>
                            <td>&#8377;<?= $data->paid_amount ?></td>
                            <td>
                            <button class="btn" onclick="showProof('../uploads/member/proof/<?= $data->proof ?>')"><i class="fa fa-file-image"></i></button>
                            </td>
                            <td><?= $data->utr_no ?></td>
                            <td><?= $data->remark ?></td>
                            <td><?= date('d M Y h:i A', strtotime($data->request_date)) ?></td>
                            <?php if($ACTIVATION == 2){ ?>
                            <td><?= date('d M Y h:i A', strtotime($data->approve_reject_date)) ?></td>
                            <?php } else if($ACTIVATION == 3){ ?>
                            <td><?= date('d M Y h:i A', strtotime($data->approve_reject_date)) ?></td>
                            <?php } ?>
                        </tr>
                      <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Proof -->
<div class="modal fade" id="proofModal" tabindex="-1" role="dialog" aria-labelledby="proofModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="proofModalTitle">Proof</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <img src="" alt="" id="p-img" style="width:100%;">
      </div>
    </div>
  </div>
</div>

<script>
    function showProof(x){
      $('#proofModal').modal('show')
      $('#p-img').prop('src', x)
    }
</script>