<?php
$page_title = "Customers - Maktaba-Tul-Madina";
include("../../includes/header.php");

if (isset($_GET['customer_id'])) {
  $customer_id = $_GET['customer_id'];
  $query = fetch_data($link, "SELECT * from invt_customers where customer_id = '$customer_id'");
  if (count($query) > 0) {
    $row = $query[0];
  }
} else {
  $customer_id = '';
}
?>
<div class="main-container container-fluid">
  <div class="inner-body">
    <!-- Page Header -->
    <div class="page-header">
      <div>
        <h2 class="main-content-title tx-24 mg-b-5">Customers</h2>
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
            <!-- <div><h6 class="main-content-label mb-3">Server side</h6></div> -->
            <form class="row g-3"  method="post" id="custForm">
              <input type="hidden" name="customer_id" value="<?= $customer_id; ?>">

              <div class="col-md-4">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" value="<?= (isset($row) && $row['customer_name'] != '') ? $row['customer_name'] : '' ?>" name="customer_name" required>
              </div>

              <div class="col-md-4">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" value="<?= (isset($row) && $row['city'] != '') ? $row['city'] : '' ?>" required>
              </div>

              <div class="col-md-4">
                <label for="address" class="form-label">Customer Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= (isset($row) && $row['address'] != '') ? $row['address'] : '' ?>" required>
              </div>

              <div class="col-md-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?= (isset($row) && $row['date'] != '') ? $row['date'] : '' ?>" required>
              </div>

              <div class="col-md-3">
                <label for="discount" class="form-label">Discount %</label>
                <input type="text" class="form-control" id="discount" name="discount" value="<?= (isset($row) && $row['discount'] != '') ? $row['discount'] : '' ?>" required>
              </div>

              <div class="col-md-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="number" class="form-control" id="contact_number" name="contact_number" value="<?= (isset($row) && $row['contact_number'] != '') ? $row['contact_number'] : '' ?>" required>
              </div>

              <div class="col-md-3">
                <label for="open_balance" class="form-label">Opening Balance</label>
                <input type="text" class="form-control" id="open_balance" name="open_balance" value="<?= (isset($row) && $row['open_balance'] != '') ? $row['open_balance'] : '' ?>" required>
              </div>

              <div class="col-md-12 ">
                <label for="details" class="form-label">Notes</label>
                <textarea class="form-control tiny-mce" name="details" id="details" rows="4"><?= (isset($row) && $row['details'] != '') ? $row['details'] : '' ?></textarea>
              </div>

              <div class="col-12">
                <button class="btn ripple btn-main-primary" type="submit" id="submit-btn"  onclick="saveForm()">Save&nbsp;<img src="loader.gif" alt="" id="preloader" class="d-none" style="width:15px"></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Row-->
  </div>
</div>


<?php include("../../includes/footer.php"); ?>
<script src="functions/functions.js"></script>