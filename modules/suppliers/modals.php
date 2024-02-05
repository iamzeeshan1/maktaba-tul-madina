<!-- Supplier-->
<div class="modal fade" id="supplier_Modal"  tabindex="-1" aria-labelledby="supplier_Modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Supplier</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='supplier_form'>
                <input type="hidden" name="supplier_id" id="supplier_id" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="supplier_name" class="form-label"> Supplier Name:</label>
                            <input type="text" id="supplier_name" name="supplier_name" class="form-control"/>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label"> Email:</label>
                            <input type="email" id="email" name="email" class="form-control"/>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label for="address" class="form-label"> Address:</label>
                            <input type="text" id="address" name="address" class="form-control"/>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label for="contact_number" class="form-label"> Contact:</label>
                            <input type="text" id="contact_number" name="contact_number" class="form-control"/>
                        </div>
                        <div class="col-md-12 mt-1">
                            <label for="details" class="form-label">Details</label>
                            <textarea class="form-control tiny-mce" name="details" id="details" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn ripple btn-primary submit-btn" id="" onclick="formSubmit()">Save <span class="ms-2 d-none spinner-border text-light spinner-border-sm preloader" id="" ></span></button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>