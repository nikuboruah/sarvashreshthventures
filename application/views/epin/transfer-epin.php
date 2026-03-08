<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="kt-portlet__body card p-5 shadow border-0">
    <h5>Transfer Epin</h5>
    <hr>
    <?php $this->load->view('messages'); ?>

    <div class="row">
        <div class="col-sm">
            <div class="row mb-3">
                <div class="col-lg-3 mb-3">
                    <label for="">Choose Package</label>
                    <select name="package" id="package" class="form-control">
                        <option value="" selected disabled>Select a package</option>
                    </select>
                </div>
                <div class="col-lg-3 mb-3">
                    <label for="">Available Epin</label>
                    <input type="number" name="epin" id="epin" min="0" placeholder="Available Epin" class="form-control"
                        readonly>
                </div>
                <div class="col-lg-3 mb-3">
                    <label for="">Customer ID</label>
                    <input type="number" name="epin" id="epin" min="0" placeholder="Customer ID" class="form-control">
                </div>
                <div class="col-lg-3 mb-3">
                    <label for="">Transfer Epin No</label>
                    <input type="number" name="epin" id="epin" min="0" placeholder="Epin no" class="form-control">
                </div>
                <div class="col-lg-12 mb-3">
                    <button class="btn btn-info">Transfer</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>