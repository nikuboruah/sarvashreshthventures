<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor card">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <?php $this->load->view('messages'); ?>
        <h3>Product Details</h3>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Product Description</th>
                            <td><?= $products[0]->product_description ?></td>
                        </tr>
                        <tr>
                            <th>Manufacturer Details</th>
                            <td><?= $products[0]->manufacturer ?></td>
                        </tr>
                        <tr>
                            <th>Packer Details</th>
                            <td><?= $products[0]->packer_details ?></td>
                        </tr>
                        <tr>
                            <th>Importer Details</th>
                            <td><?= $products[0]->importer_details ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>