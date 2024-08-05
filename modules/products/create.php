<?php
$page_title = "Products - Maktaba-Tul-Madina";
include("../../includes/header.php");

if (isset($_GET['item_id'])) {
  $item_id = $_GET['item_id'];
  $query = fetch_data($link, "SELECT invt_products.*,invt_publishers.pub_name,invt_languages.lan_name FROM invt_products left JOIN invt_publishers ON invt_products.publisher_id=invt_publishers.publisher_id left JOIN invt_languages ON invt_products.language_id=invt_languages.language_id where invt_products.item_id = '$item_id'");
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
                        <form class="row g-3" action="save.php" method="post" id="productForm">
                            <input type="hidden" name="itm_id" value="<?=$item_id;?>">
                            <div class="col-md-4">
                                <label for="product_id" class="form-label">Product ID</label>
                                <input type="text" class="form-control" id="product_id"
                                    value="<?= $row['product_id']?? ''; ?>" required onfocusout="chech_prod_id(this.value)" name="product_id">
                            </div>
                            <div class="col-md-4">
                                <label for="barcode" class="form-label">Product Barcode</label>
                                <input type="text" class="form-control" id="barcode" onfocusout="chech_prod_bar(this.value)" value="<?= $row['barcode']?? ''; ?>" name="barcode">
                            </div>

                            <div class="col-md-4">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="product_name"
                                    value="<?= $row['product_name']?? ''; ?>" required onfocusout="chech_prod_name(this.value)" name="product_name">
                            </div>

                            <div class="col-lg-4">
                                <label for="category_id" class="mg-b-10 form-label">Product Category</label>
                                <select name="category_id" class="form-select select2" 
                                    onchange="fn_category(this.value)"  id="category_id">
                                    <option value="">Select Category</option>
                                    <?php
                                        $qry_category = fetch_data($link, "SELECT * FROM invt_categories order by category_name");
                                        foreach ($qry_category as $row_category) {
                                        $category_id = $row_category['category_id'];
                                        $category_name = $row_category['category_name'];

                                        $selected = (isset($row) && $row['category_id'] == $category_id) ? 'selected' : '';
                                    ?>
                                    <option value="<?= $category_id; ?>" <?= $selected; ?>><?= $category_name; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-4 d-none" id="misc_div">
                                <label for="misc_id" class="mg-b-10 form-label">Miscellaneous Products</label>
                                <select name="misc_id" class="form-select select2" id="misc_id"
                                    onchange="fn_misc(this.value)">
                                    <option value="">Select</option>
                                    <?php
                                    $qry_misc = fetch_data($link, "SELECT * FROM invt_misc order by misc_prod_name");
                                    foreach ($qry_misc as $row_misc) {
                                        $misc = $row_misc['misc_id'];
                                        $misc_name = $row_misc['misc_prod_name'];

                                        $selected = ($row['misc_id'] == $misc) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $misc; ?>" <?= $selected; ?>><?= $misc_name; ?></option>
                                    <?php } ?>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-lg-4" id="language_div">
                                <label for="language" class="mg-b-10 form-label">Languages</label>
                                <select name="language" class="form-select select2" id="language">
                                    <option value="">Select</option>
                                    <?php
                                    $qry_lan = fetch_data($link, "SELECT * FROM invt_languages order by lan_name");
                                    foreach ($qry_lan as $row_lan) {
                                        $language_id = $row_lan['language_id'];
                                        $lan_name = $row_lan['lan_name'];

                                        $selected = ($row['language_id'] == $language_id) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $language_id; ?>" <?= $selected; ?>><?= $lan_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4" id="publisher_div">
                                <label for="publisher" class="form-label">Publisher Name</label>
                                <select name="publisher" class="form-select select2" id="publisher">
                                    <option value="">Select</option>
                                    <?php
                                    $qry_pub = fetch_data($link, "SELECT * FROM invt_publishers order by pub_name");
                                    foreach ($qry_pub as $row_pub) {
                                        $publisher_id = $row_pub['publisher_id'];
                                        $pub_name = $row_pub['pub_name'];

                                        $selected = ($row['publisher_id'] == $publisher_id) ? 'selected' : '';
                                        ?>
                                        <option value="<?= $publisher_id; ?>" <?= $selected; ?>><?= $pub_name; ?></option>
                                    <?php } ?>
                                </select>
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

<?php include("modals.php");?>
<?php include("../../includes/footer.php"); ?>
<script src="functions/functions.js"></script>
<script>
    var miscc_id = '<?= $row['misc_id']??''?>';
</script>