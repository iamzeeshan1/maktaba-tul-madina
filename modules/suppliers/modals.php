<!-- Supplier-->
<div class="modal flip" id="supplier_Modal"  tabindex="-1" aria-labelledby="supplier_Modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Supplier</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='supplier_form' class="needs-validation" novalidate>
                <input type="hidden" name="supplier_id" id="supplier_id" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label> Supplier Name:</label>
                            <input type="text" id="supplier_name" name="supplier_name" class="form-control" required/>
                        </div>
                        <div class="col-md-6">
                            <label> Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required/>
                        </div>
                        <div class="col-md-6">
                            <label> Address:</label>
                            <input type="text" id="address" name="address" class="form-control" required/>
                        </div>
                        <div class="col-md-6">
                            <label> Contact:</label>
                            <input type="text" id="contact_number" name="contact_number" class="form-control" required/>
                        </div>
                        <div class="col-md-12 ">
                            <div class="form-group mb-0">
                                <label for="details" class="form-label">Details</label>
                                <textarea class="form-control tiny-mce" name="details" id="details" rows="4"><?= (isset($row) && $row['details'] != '') ? $row['details'] : '' ?></textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn ripple btn-primary" id="submit-btn" onclick="formSubmit()">Save <img src="<?=$app_path?>assets/img/loader.gif" alt="" id="preloader" class="d-none" style="width:15px"></button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>