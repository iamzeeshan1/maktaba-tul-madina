<!-- purchase-->
<div class="modal fade" id="purchase_Modal"  tabindex="-1" aria-labelledby="purchase_Modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Purchase Item</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='purchase_form'>
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
                        <div class="col-md-12 mt-2">
                            <label for="product_id" class="mg-b-10 form-label">Products</label>
                            <select name="product_id" class="form-select select2"  required  id="product_id">
                                <option value="">Select Products</option>
                                <?php
                                $qry_prod = fetch_data($link, "SELECT * FROM invt_products order by product_name");
                                foreach ($qry_prod as $row_sup) {
                                    $product_id = $row_sup['product_id'];
                                    $product_name = $row_sup['product_name'];

                                    $selected = ($row['product_id'] == $product_id) ? 'selected' : '';
                                ?>
                                    <option value="<?= $product_id; ?>" <?= $selected; ?>><?= $product_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label"> Cost Price:</label>
                            <input type="text" id="cost_price" name="cost_price" class="form-control" required/>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label"> Retail Price:</label>
                            <input type="text" id="retail_price" name="retail_price" class="form-control" required/>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label">Quantity:</label>
                            <input type="text" id="quantity" name="quantity" class="form-control" required/>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label">Location:</label>
                            <input type="text" id="location" name="location" class="form-control" required/>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 text-end mt-2">
                            <button type="button" id="add_btn" onclick="save_data()" class="btn btn-primary">ADD</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div >
                                <table class="table table-striped table-bordered text-nowrap dataTable no-footer dtr-inline d-none" id="saved_purchase">
                                    <thead class="text-white">
                                        <tr>
                                            <th>Date</th>
                                            <th>Supplier</th>
                                            <th>Product</th>
                                            <th>Cost Price</th>
                                            <th>Retail Price</th>
                                            <th>Quantity</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody class="saved">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn ripple btn-primary submit-btn d-none" id="" onclick="formSubmit()">Save <span class="ms-2 d-none spinner-border text-light spinner-border-sm preloader" id="" ></span></button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT PURCHASE  -->
<div class="modal fade" id="edit_purchase_Modal"  tabindex="-1" aria-labelledby="edit_purchase_Modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Purchase Item</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='edit_purchase_form'>
                <input type="hidden" name="purchase_id" id="purchase_idd" >
                <input type="hidden" name="ACTION" value="edit" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="mg-b-10 form-label"> Date:</label>
                            <input type="date" id="datee" name="date" class="form-control" required/>
                        </div>
                        <div class="col-md-6">
                            <label for="supplier_idd" class="mg-b-10 form-label">Supplier</label>
                            <select name="supplier_id" class="form-select select2"  required  id="supplier_idd">
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
                        <div class="col-md-12 mt-2">
                            <label for="item_idd" class="mg-b-10 form-label">Products</label>
                            <select name="item_idd" class="form-select select2"  required  id="item_idd">
                                <option value="">Select Products</option>
                                <?php
                                $qry_prod = fetch_data($link, "SELECT * FROM invt_products order by product_name");
                                foreach ($qry_prod as $row_sup) {
                                    $product_id = $row_sup['product_id'];
                                    $product_name = $row_sup['product_name'];

                                    //$selected = ($row['item_id'] == $product_id) ? 'selected' : '';
                                ?>
                                    <option value="<?= $product_id; ?>" ><?= $product_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label"> Cost Price:</label>
                            <input type="text" id="cost_pricee" name="cost_price" class="form-control" required/>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label"> Retail Price:</label>
                            <input type="text" id="retail_pricee" name="retail_price" class="form-control" required/>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label">Quantity:</label>
                            <input type="text" id="quantityy" name="quantity" class="form-control" required/>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="mg-b-10 form-label">Location:</label>
                            <input type="text" id="locationn" name="location" class="form-control" required/>
                        </div>

                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn ripple btn-primary edit-submit-btn" id="" onclick="editFormSubmit()">Save <span class="ms-2 d-none spinner-border text-light spinner-border-sm preloader" id="" ></span></button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>