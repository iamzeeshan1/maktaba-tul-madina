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
  $customer_id = 0;
}
$randomNumber = rand(1000, 9999);
$customerID = 'customer-'.$randomNumber;
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
            <form class="row g-3"  method="post" id="custForm">
              <input type="hidden" name="customer_id" value="<?= $customer_id; ?>">
              <div class="col-md-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?= $row['date']??$current_date; ?>">
              </div>
              <div class="col-md-3">
                <label for="customer_id" class="form-label">Customer ID</label>
                <input type="text" class="form-control" readonly id="cust_id" value="<?= $customerID; ?>" name="cust_id">
              </div>
              <div class="col-md-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" required id="customer_name" value="<?= $row['customer_name']?? ''; ?>" name="customer_name">
              </div>
              <div class="col-md-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" required class="form-select">
                  <option value="">Select Gender</option>
                  <option value="1" <?=(isset($row) && $row['gender']==1)?'selected':''?>>Male</option>
                  <option value="2" <?=(isset($row) && $row['gender']==2)?'selected':''?>>Female</option>
                </select>
              </div>
              <div class="col-md-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?= $row['contact_number']??''; ?>">
              </div>
              <div class="col-md-3">
                <label for="address" class="form-label">Customer Address</label>
                <input type="text" class="form-control" required id="address" name="address" value="<?= $row['address']??'';?>">
              </div>
              <div class="col-md-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" value="<?= $row['city'] ??'' ;?>">
              </div>
              <div class="col-md-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" id="country" name="country" value="<?= $row['country'] ??'' ;?>">
              </div>
              <div class="col-md-3">
                <label for="region_id" class="form-label">Region</label>
                <select name="region_id" id="region_id" class="form-select">
                  <option value="">Select Region</option>
                  <?php 
                  $reg = fetch_data($link,"select * from invt_regions");
                  foreach($reg as $row_reg){
                    $selected = (isset($row) && $row['region_id']==$row_reg['region_id'])?'selected':'';
                    echo "<option value='$row_reg[region_id]' $selected>$row_reg[region_name]</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-3">
                <label for="discount" class="form-label">Discount %</label>
                <input type="text" class="form-control" id="discount" name="discount" value="<?=$row['discount']??0; ?>">
              </div>
              <div class="col-md-3">
                <label for="open_balance" class="form-label">Opening Balance</label>
                <input type="text" class="form-control" id="open_balance" name="open_balance" value="<?=$row['open_balance']??0; ?>">
              </div>
              <div class="col-md-12  hidden-div" id="hide_notes">
                <label for="details" class="form-label">Notes</label>
                <textarea class="form-control tiny-mce" name="details" id="details"rows="4"><?= $row['details']??''; ?></textarea>
              </div>
              <div class="col-12 " id="show_notes_btn">
                <button class="btn ripple btn-main-primary btn-sm" type="button"   onclick="showNotes()">Add Notes</button>
              </div>
              <div class="col-12 hidden-div " id="hide_notes_btn" >
                <button class="btn ripple btn-main-primary btn-sm" type="button"  onclick="hideNotes()">Hide Notes</button>
              </div>
              <div class="col-12">
                <button class="btn ripple btn-main-primary" type="submit" id="submit-btn"  onclick="saveForm()">Save  <span class="ms-2 d-none spinner-border text-light spinner-border-sm" id="preloader" ></span></button>
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