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
                        <h4 class="page-title">Members</h4>
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
                                Ranks
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
                                                    <th>Rank</th>
                                                    <th class="text-center">Value Points</th>
                                                    <th>Rank Achievement Bonus</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($RANK as $data){ ?>
                                                <tr>
                                                    <td><?= $data->rank ?></td>
                                                    <td class="text-center"><?= $data->value_points ?></td>
                                                    <td><?= $data->reward ?></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-info"
                                                            id="<?= $data->id.'~'.$data->reward ?>"
                                                            onclick="updateReward(this.id)">Update</button>
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

        <div class="modal fade" id="rewardModal" tabindex="-1" aria-labelledby="rewardModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rewardModalLabel">Update Reward</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?php echo base_url('rank/update_reward') ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Reward</label>
                                <input type="text" name="amt" id="amt" class="form-control">
                                <input type="hidden" id="rid" name="rid">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
        updateReward = function(x) {
            var id = x.split('~');
            $('#amt').val(id[1])
            $('#rid').val(id[0])
            $('#rewardModal').modal('show')
        }
        </script>