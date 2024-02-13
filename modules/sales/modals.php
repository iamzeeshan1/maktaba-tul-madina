<!-- Picklist-->
<div class="modal fade" id="picklist_Modal"  tabindex="-1" aria-labelledby="picklist_Modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Picklist</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='picklist_form'>
                <input type="hidden" name="sales_id" id="sales_id" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="supplier_name" class="form-label"> Date:</label>
                            <input type="text" id="date" name="date" class="form-control" readonly />
                        </div>
                        <div class="col-md-6">
                            <label for="cust_name" class="form-label"> Customer Name:</label>
                            <input type="text" id="customer_name" name="cust_name" class="form-control" readonly/>
                        </div>
                        <div class="col-md-6 mt-1">
                             <label for="product_name" class="form-label"> Item Name:</label>
                            <input type="text" id="product_name" name="item_name" class="form-control" readonly/>
                        </div>
                        <div class="col-md-6 mt-1">
                             <label for="quantity" class="form-label"> Item Quantity:</label>
                            <input type="text" id="quantity" name="quantity" class="form-control" readonly/>
                        </div>
                        <div class="col-md-6 mt-1">
                             <label for="location" class="form-label"> Item Location:</label>
                            <select name="location" class="form-select" disabled  id="location">
                            <label for="loc_id" class="mg-b-10 form-label">Locations:</label>
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
                       
                        <div class="col-md-12 mt-2">
                            <label for="picklist_id" class="mg-b-10 form-label">Picked By</label>
                            <select name="picklist_id" class="form-select select2" required  id="picklist_id">
                            <option value="">Select Person</option>
                            <?php
                                $qry_category = fetch_data($link, "SELECT * from users inner join users_detail on users.user_id=users_detail.user_id where users.user_role='2'");
                                foreach ($qry_category as $row_category) {
                                $picklist_id = $row_category['user_id'];
                                $fname = $row_category['first_name'];
                                $lname = $row_category['last_name'];

                                // $selected = (isset($row) && $row['picklist_id'] == $picklist_id) ? 'selected' : '';
                            ?>
                            <option value="<?= $picklist_id; ?>" ><?= $fname.' '.$lname; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-12 mt-1">
                            <label for="details" class="form-label">Details</label>
                            <textarea class="form-control tiny-mce" name="details" id="details" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn ripple btn-primary submit-btn" id="" onclick="formSubmit()">Save <span class="ms-2 d-none spinner-border text-light spinner-border-sm preloader" id="" ></span></button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>