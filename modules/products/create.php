<?php
include("../../includes/header.php");
?> <div class="main-container container-fluid">
  <div class="inner-body">
    <!-- Page Header -->
    <div class="page-header">
      <div>
        <h2 class="main-content-title tx-24 mg-b-5">Products</h2>
      </div>
      <div class="d-flex">
        <div class="justify-content-center">
          <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
            <i class="fe fe-download me-2"></i> Import </button>
          <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
            <i class="fe fe-filter me-2"></i> Filter </button>
          <button type="button" class="btn btn-primary my-2 btn-icon-text">
            <i class="fe fe-download-cloud me-2"></i> Download Report </button>
        </div>
      </div>
    </div>
    <!-- End Page Header -->
    <!-- Row -->
    <div class="row row-sm">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card custom-card">
          <div class="card-body">
            <!-- <div><h6 class="main-content-label mb-3">Server side</h6></div> -->
            <form class="row g-3">
              <div class="col-md-4">
                <label for="validationServer01" class="form-label">Product ID</label>
                <input type="text" class="form-control is-valid" id="txt_id" value="Mark" name="txt_id" required>
                <div class="valid-feedback"> Looks good! </div>
              </div>
              <div class="col-lg-4">
                <p class="mg-b-10">Product Rack</p>
                <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                  <option label="Choose one"></option>
                  <option value="Firefox"> Firefox </option>
                </select>
              </div>
              <div class="col-lg-4">
                <p class="mg-b-10">Product Section</p>
                <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                  <option label="Choose one"></option>
                  <option value="Firefox"> Firefox </option>
                </select>
              </div>
              <div class="col-lg-4">
                <p class="mg-b-10">Product Location</p>
                <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                  <option label="Choose one"></option>
                  <option value="Firefox"> Firefox </option>
                </select>
              </div>
              <div class="col-lg-4">
                <p class="mg-b-10">Product Category</p>
                <select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                  <option label="Choose one"></option>
                  <option value="Firefox"> Firefox </option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="validationServer02" class="form-label">Cost Price</label>
                <input type="text" class="form-control is-valid" id="validationServer02" value="Otto" required>
                <div class="valid-feedback"> Looks good! </div>
              </div>
              <div class="col-md-4">
                <label for="validationServer02" class="form-label">Retail Price</label>
                <input type="text" class="form-control is-valid" id="validationServer02" value="Otto" required>
                <div class="valid-feedback"> Looks good! </div>
              </div>
              <div class="col-md-4">
                <label for="validationServer02" class="form-label">Discount %</label>
                <input type="text" class="form-control is-valid" id="validationServer02" value="Otto" required>
                <div class="valid-feedback"> Looks good! </div>
              </div>
              <div class="col-md-12 ">
                <div class="form-group mb-0">
                  <p class="mg-b-10">Product Details</p>
                  <textarea class="form-control tiny-mce" name="example-textarea-input" rows="4" placeholder="text here.."></textarea>
                </div>
              </div>
              <div class="col-12">
                <button class="btn ripple btn-main-primary" type="submit">Submit form</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Row-->
  </div>
</div> <?php
include("../../includes/footer.php");
?>