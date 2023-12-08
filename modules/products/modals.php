
<!-- Misc MODAL -->
<div class="modal flip" id="miscModal"  tabindex="-1" aria-labelledby="miscModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Miscellaneous Product</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='misc_form' class="needs-validation" novalidate>
                <input type="hidden" name="ACTION" value="add_new_misc_prod">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label> Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn ripple btn-primary" onclick="formSubmit('misc_form','','#miscModal')">Save</button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
