<!-- RACK MODAL -->
<div class="modal flip" id="rackModal"  tabindex="-1" aria-labelledby="rackModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Rack</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='rack_form' class="needs-validation" novalidate>
                <input type="hidden" name="ACTION" value="add_new_rack">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label> Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required/>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn ripple btn-primary" onclick="formSubmit('rack_form','','#rackModal')">Save</button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SECTION MODAL -->
<div class="modal flip" id="sectionModal"  tabindex="-1" aria-labelledby="sectionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Section</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='section_form' class="needs-validation" novalidate>
                <input type="hidden" name="ACTION" value="add_new_section">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label> Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required/>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn ripple btn-primary" onclick="formSubmit('section_form','','#sectionModal')">Save</button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- location MODAL -->
<div class="modal flip" id="locationModal"  tabindex="-1" aria-labelledby="locationModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add location</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='location_form' class="needs-validation" novalidate>
                <input type="hidden" name="ACTION" value="add_new_location">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label> Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required/>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn ripple btn-primary" onclick="formSubmit('location_form','','#locationModal')">Save</button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- category MODAL -->
<div class="modal flip" id="categoryModal"  tabindex="-1" aria-labelledby="categoryModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add category</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
            </div>
            <form id='category_form' class="needs-validation" novalidate>
                <input type="hidden" name="ACTION" value="add_new_category">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label> Name:</label>
                            <input type="text" id="name" name="name" class="form-control" required/>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn ripple btn-primary" onclick="formSubmit('category_form','','#categoryModal')">Save</button>
                    <button type="button" class="btn ripple btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>