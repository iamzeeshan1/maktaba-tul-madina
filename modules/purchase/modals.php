<!-- purchase-->
<div class="modal flip" id="purchase_Modal"  tabindex="-1" aria-labelledby="purchase_Modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Purchase Item</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='purchase_form' class="needs-validation" novalidate>
                <input type="hidden" name="purchase_id" id="purchase_id" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="mg-b-10 form-label"> Date:</label>
                            <input type="date" id="date" name="date" class="form-control" required/>
                        </div>
                        <div class="col-md-6">
                            <label for="supplier_id" class="mg-b-10 form-label">Supplier</label>
                            <select name="supplier_id" class="form-select select2"  required  id="supplier_id">
                                <option value="">Select Supplier</option>
                                <?php
                                $qry_sup = fetch_data($link, "SELECT * FROM invt_suppliers order by supplier_name");
                                foreach ($qry_sup as $row_sup) {
                                    $supplier_id = $row_sup['supplier_id'];
                                    $supplier_name = $row_sup['supplier_name'];

                                    $selected = ($row['supplier_id'] == $supplier_id) ? 'selected' : '';
                                ?>
                                    <option value="<?= $supplier_id; ?>" <?= $selected; ?>><?= $supplier_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="mg-b-10 form-label"> Cost Price:</label>
                            <input type="text" id="cost_price" name="cost_price" class="form-control" required/>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="mg-b-10 form-label"> Retail Price:</label>
                            <input type="text" id="retail_price" name="retail_price" class="form-control" required/>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="mg-b-10 form-label">Quantity:</label>
                            <input type="text" id="quantity" name="quantity" class="form-control" required/>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label class="mg-b-10 form-label">Location:</label>
                            <input type="text" id="location" name="location" class="form-control" required/>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn ripple btn-primary" id="submit-btn" onclick="formSubmit()">Save <img src="loader.gif" alt="" id="preloader" class="d-none" style="width:15px"></button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>