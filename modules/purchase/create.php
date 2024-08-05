<?php
$page_title = "Purchase - Maktaba-Tul-Madina";
include("../../includes/header.php");

$randomNumber = rand(1000, 9999);
$doc_number = 'DOC-'.$randomNumber;
?>

<div class="main-container container-fluid">
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Purchase</h2>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="index.php" class="btn btn-white btn-icon-text my-2 me-2">
                        <i class="fe fe-arrow-left me-2"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Row -->
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <form id="purchase_form">
                            <input type="hidden" name="purchase_id" id="purchase_id">
                            <input type="hidden" name="ACTION" value="save_purchase">
                            <input type="hidden" name="invoice_number" id="invoice" value="">
                            <input type="hidden" name="row_id" id="row_id" value="0">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="mg-b-10 form-label"> Date:</label>
                                    <input type="date" id="date" name="date" value="<?=$current_date?>"
                                        class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <label for="supplier_id" class="mg-b-10 form-label">Supplier</label>
                                    <select name="supplier_id" required class="form-select form-control"
                                        data-parsley-required-message="Supplier is required" id="supplier_id">
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
                                <div class="col-md-3">
                                    <label class="mg-b-10 form-label">Invoice Number:</label>
                                    <input type="text" id="inv_num" name="inv_num" class="form-control" />
                                </div>
                                <div class="col-md-3">
                                    <label class="mg-b-10 form-label">Document Number:</label>
                                    <input type="text" id="doc_num" name="doc_num" class="form-control" value="<?=$doc_number?>" readonly />
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label for="product_id" class="mg-b-10 form-label">Products</label>
                                    <select name="product_id" required class="form-select form-control"
                                        onchange="get_details(this.value)"
                                        data-parsley-required-message="Product is required" id="product_id">
                                        <option value="">Select Products</option>
                                        <?php
                                        $qry_prod = fetch_data($link, "SELECT * FROM invt_products order by product_name");
                                        foreach ($qry_prod as $row_sup) {
                                            $product_id = $row_sup['item_id'];
                                            $product_name = $row_sup['product_name'];

                                            $selected = (isset($row) && $row['product_id'] == $product_id) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $product_id; ?>" <?= $selected; ?>><?= $product_name; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="mg-b-10 form-label"> Cost Price:</label>
                                    <input type="number" min="0" step="0.01" id="cost_price" required name="cost_price"
                                        data-parsley-required-message="Cost Price is required" class="form-control" />
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="mg-b-10 form-label"> Retail Price:</label>
                                    <input type="number" min="0" step="0.01" id="retail_price" required name="retail_price"
                                        data-parsley-required-message="Retail Price is required" class="form-control" />
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="mg-b-10 form-label">Quantity:</label>
                                    <input type="number" min="0" id="quantity" required name="quantity"
                                        data-parsley-required-message="Quantity is required" class="form-control" />
                                </div>
                                <div class="col-md-3 mt-3 " id="loc_id" >
                                    <label for="loc_id" class="mg-b-10 form-label">Locations:</label>
                                    <select name="loc_id" class="form-select form-control double-loc" required data-parsley-required-message="Location is required" id="loc_idd" onchange="add_location(this.value)">
                                        <option value="">Select Locations</option>
                                        <?php
                                        $qry_prod = fetch_data($link, "SELECT * FROM invt_locations order by loc_name");
                                        foreach ($qry_prod as $row_sup) {
                                            $loc_id = $row_sup['loc_id'];
                                            $loc_name = $row_sup['loc_name'];

                                        // $selected = ($row['loc_id'] == $loc_id) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $loc_id; ?>"><?= $loc_name; ?></option>
                                        <?php } ?>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 text-end">
                                    <button type="button" onclick="save_data(event)"
                                        class="btn btn-primary">ADD</button>
                                </div>
                            </div>
                            <div class="row mt-3 div-data d-none">
                                <div class="col-md-12 ">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-striped table-bordered text-wrap  no-footer dtr-inline mb-0"
                                            id="saved_purchase_table">
                                            <thead class="text-white">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Invoice</th>
                                                    <th>Document #</th>
                                                    <th>Supplier</th>
                                                    <th>Product</th>
                                                    <th>Location</th>
                                                    <th>Quantity</th>
                                                    <th>Cost Price</th>
                                                    <th>Retail Price</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="saved_pur_tbody">
                                            </tbody>
                                            <tfoot id="saved_pur_footer">
                                                <tr>
                                                    <td colspan="7"> Total:</td>
                                                    <td id="set_tfoot_cost_value" class="fw-bold"></td>
                                                    <td id="set_tfoot_retail_value" class="fw-bold"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label class="mg-b-10 form-label">Notes:</label>
                                    <textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn ripple btn-primary submit-btn d-none" id=""
                                        onclick="formSubmit()">Save <span
                                            class="ms-2 d-none spinner-border text-light spinner-border-sm preloader"
                                            id=""></span></button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row-->
    </div>
</div>

<?php include("modals.php"); ?>
<?php include("../../includes/footer.php"); ?>
<script src="functions/functions.js"></script>