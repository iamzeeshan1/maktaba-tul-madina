<?php
$page_title = "Products - Maktaba-Tul-Madina";
include("../../includes/header.php");

if (isset($_GET['item_id'])) {
  $item_id = $_GET['item_id'];
  $query = fetch_data($link, "SELECT * from invt_products where item_id = '$item_id'");
  if (count($query) > 0) {
    $row = $query[0];
  }
} else {
  $item_id = '';
}
?>
<div class="main-container container-fluid">
  <div class="inner-body">
    <!-- Page Header -->
    <div class="page-header">
      <div>
        <h2 class="main-content-title tx-24 mg-b-5">Products</h2>
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
            <form class="row g-3" action="save.php?item_id=<?= $item_id; ?>" method="post">
              <div class="col-md-4">
                <label for="product_id" class="form-label">Product ID</label>
                <input type="text" class="form-control" id="product_id" value="<?= $row['product_id']?? ''; ?>" name="product_id" required>
              </div>
              <div class="col-md-4">
                <label for="barcode" class="form-label">Product Barcode</label>
                <input type="text" class="form-control" id="barcode" value="<?= $row['barcode']?? ''; ?>" name="barcode" required>
              </div>

              <div class="col-md-4">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" value="<?= $row['product_name']?? ''; ?>" name="product_name" required>
              </div>

              <div class="col-lg-4">
                <label for="category_id" class="mg-b-10 form-label">Product Category</label>
                <select name="category_id" class="form-select select2 modules/sales/create.php" required onchange="fn_category(this.value)" id="category_id">
                  <option value="">Select Category</option>
                  <?php
                    $qry_category = fetch_data($link, "SELECT * FROM invt_categories order by category_name");
                    foreach ($qry_category as $row_category) {
                      $category_id = $row_category['category_id'];
                      $category_name = $row_category['category_name'];

                      $selected = ($row['category_id'] == $category_id) ? 'selected' : '';
                  ?>
                  <option value="<?= $category_id; ?>" <?= $selected; ?>><?= $category_name; ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-lg-4 d-none" id="misc_div">
                <label for="misc_id" class="mg-b-10 form-label">Miscellaneous Products</label>
                <select name="misc_id" class="form-select" id="misc_id" onchange="fn_misc(this.value)">
                  <option value="">Select</option>
                  <?php
                    $qry_misc = fetch_data($link, "SELECT * FROM invt_misc order by misc_prod_name");
                    foreach ($qry_misc as $row_misc) {
                      $misc = $row_misc['misc_id'];
                      $misc_name = $row_misc['misc_prod_name'];

                      $selected = ($row['misc'] == $misc) ? 'selected' : '';
                  ?>
                  <option value="<?= $misc; ?>" <?= $selected; ?>><?= $misc_name; ?></option>
                  <?php } ?>
                  <option value="other">Other</option>
                </select>
              </div>

              <div class="col-lg-4" id="language_div">
                <label for="language" class="mg-b-10 form-label">Languages</label>
                <select name="language" class="form-select" id="language">
                  <option value="">Select Language</option>
                  <option value="urdu">Urdu</option>
                  <option value="english">English</option>
                </select>
              </div>

              <div class="col-md-4" id="publisher_div">
                <label for="publisher" class="form-label">Publisher Name</label>
                <input type="text" class="form-control" id="publisher" name="publisher" value="<?= $row['publisher'] ??''; ?>">
              </div>

              <div class="col-12">
                <button class="btn ripple btn-main-primary" type="submit">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Row-->
  </div>
</div>

<?php
include("modals.php");
?>
<?php
include("../../includes/footer.php");
?>
<script src="functions/functions.js"></script>