
<!-- EDIT PURCHASE  -->
<div class="modal fade" id="edit_purchase_Modal"  tabindex="-1" aria-labelledby="edit_purchase_Modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Purchase Item</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='edit_purchase_form'>
                <input type="hidden" name="purchase_id" id="purchase_idd" >
                <input type="hidden" name="row_id" id="row_idd" value="0">
                <input type="hidden" name="ACTION" value="edit" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="mg-b-10 form-label"> Date:</label>
                            <input type="date" id="datee" name="date" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label for="supplier_idd" class="mg-b-10 form-label">Supplier</label>
                            <select name="supplier_id" class="form-select select2" required  data-parsley-required-message="Supplier is required"  id="supplier_idd">
                                <option value="">Select Supplier</option>
                                <?php
                                $qry_sup = fetch_data($link, "SELECT * FROM invt_suppliers order by supplier_name");
                                foreach ($qry_sup as $row_sup) {
                                    $supplier_id = $row_sup['supplier_id'];
                                    $supplier_name = $row_sup['supplier_name'];

                                    //$selected = ($row['supplier_id'] == $supplier_id) ? 'selected' : '';
                                ?>
                                    <option value="<?= $supplier_id; ?>"><?= $supplier_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label">Invoice Number:</label>
                            <input type="text" id="inv_number"  name="inv_number" class="form-control" />
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label">Document Number:</label>
                            <input type="text" id="doc_number"  name="doc_number" class="form-control" />
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="item_idd" class="mg-b-10 form-label">Products</label>
                            <select name="item_idd" class="form-select select2" required  data-parsley-required-message="Product is required"   id="item_idd">
                                <option value="">Select Products</option>
                                <?php
                                $qry_prod = fetch_data($link, "SELECT * FROM invt_products order by product_name");
                                foreach ($qry_prod as $row_sup) {
                                    $product_id = $row_sup['item_id'];
                                    $product_name = $row_sup['product_name'];

                                    //$selected = ($row['item_id'] == $product_id) ? 'selected' : '';
                                ?>
                                    <option value="<?= $product_id; ?>" ><?= $product_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label"> Cost Price:</label>
                            <input type="number" min="0" step="0.1" id="cost_pricee"  name="cost_price" required  data-parsley-required-message="Cost is required" class="form-control" />
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label"> Retail Price:</label>
                            <input type="number" min="0" step="0.1" id="retail_pricee" name="retail_price" required  data-parsley-required-message="Retail Price is required" class="form-control" />
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label">Quantity:</label>
                            <input type="number" min="0" id="quantityy" name="quantity" required  data-parsley-required-message="Quantity is required" class="form-control" />
                        </div>
                        <div class="col-md-6 mt-2 ">
                            <label class="mg-b-10 form-label">Location:</label>
                            <select name="location" class="form-select form-control double-loc" required  data-parsley-required-message="Location is required"  id="location_id" onchange="add_location(this.value)">
                                <option value="">Select Locations</option>
                                <?php
                                $qry_prod = fetch_data($link, "SELECT * FROM invt_locations order by loc_name");
                                foreach ($qry_prod as $row_sup) {
                                    $loc_id = $row_sup['loc_id'];
                                    $loc_name = $row_sup['loc_name'];

                                    $selected = ($row['loc_id'] == $loc_id) ? 'selected' : '';
                                ?>
                                    <option value="<?= $loc_id; ?>" <?= $selected; ?>><?= $loc_name; ?></option>
                                <?php } ?>
                                <option value="other">Other</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn ripple btn-primary edit-submit-btn" id="" onclick="edit_data(event)">Save <span class="ms-2 d-none spinner-border text-light spinner-border-sm preloader" id="" ></span></button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- loc MODAL -->
<div class="modal flip" id="locModal"  tabindex="-1" aria-labelledby="locModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Location</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='loc_form' class="needs-validation" novalidate>
                <input type="hidden" name="ACTION" value="add_new_loc">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label> Name:</label>
                            <input type="text" id="name" name="name" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn ripple btn-primary">Save</button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal flip" id="invModal"  tabindex="-1" aria-labelledby="invModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Location</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='loc_form' class="needs-validation" novalidate>
                <input type="hidden" name="ACTION" value="add_new_loc">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label> Name:</label>
                            <input type="text" id="name" name="name" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                        <button type="button" class="btn ripple btn-info mb-1" onclick="printModal();"><i class="fe fe-printer me-1"></i> Print Invoice</button>
                    </div>
            </form>
        </div>
    </div>
</div>