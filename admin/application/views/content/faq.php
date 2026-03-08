<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <div class="d-flex">
            <div class="mr-auto p-2">
                <h5>FAQ's</h5>
            </div>
            <div class="p-2"><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addFaq">Add
                    New</button></div>
        </div>
        <hr>
        <?php $this->load->view('messages'); ?>
        <div class="row">
            <div class="col-sm">
                <div class="table-wrap">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Remove</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; foreach($faqs['faqs'] as  $key => $faq){ ?>
                            <tr>
                                <td class="text-center"><?= ++$i ?></td>
                                <td><?= $faq['question'] ?></td>
                                <td><?= $faq['answer'] ?></td>
                                <td>
                                    <?php if ($faq['status'] == 'active'): ?>
                                        <span class="badge badge-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Block</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success edit-faq" data-id="<?= $key ?>">Edit</button>
                                </td>
                                <td>
                                    <a href="<?php echo base_url("content/delete_faq/".$key); ?>"
                                        class="btn btn-sm btn-danger">Remove</a>
                                </td>
                                <td>
                                <?php if ($faq['status'] == 'active'): ?>
                                    <a href="<?php echo base_url('content/block/' . $key); ?>"><span
                                            class="btn btn-sm btn-danger">Block</span></a>
                                    <?php else: ?>
                                    <a href="<?php echo base_url('content/unblock/' . $key); ?>"> <span
                                            class="btn btn-sm btn-success">Active</span></a>
                                    <?php endif; ?>
                                </td>
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

<!-- Add FAQ -->
<div class="modal fade" id="addFaq" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Add New FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('content/add_faq') ?>" method="post">
                <div class="modal-body">
                    <div class="row px-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Question</label>
                                <input type="text" name="question" placeholder="Question" id="question"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Answer</label>
                                <textarea type="text" name="answer" rows="5" placeholder="Answer" id="answer"
                                    class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="block" selected>Blocked</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="addFAQ" class="btn btn-primary">Add FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit FAQ -->
<div class="modal fade" id="editFaq" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url('content/edit_faq/') ?>" method="post">
                <div class="modal-body" id="modal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="editFAQ" class="btn btn-primary">Update FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).on('click', '.edit-faq', function() {
    var id = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('content/view_faq') ?>',
        data: {
            id: id
        },

        success: function(data) {
            $('#editFaq').modal('show');
            $('#modal').html(data);
        }
    })
})
</script>