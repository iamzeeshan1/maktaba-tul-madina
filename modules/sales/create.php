<?php
include("../../includes/header.php");

if(isset($_GET['sales_id'])){
  $sales_id=$_GET['sales_id'];
  $query = fetch_data($link, "SELECT * from invt_sales where sales_id = '$sales_id'");
  if(count($query)>0){
      $row = $query[0];
  }
}
else{
  $sales_id='';
}
?> 
<div class="main-container container-fluid">
  <div class="inner-body">
    <!-- Page Header -->
    <div class="page-header">
      <div>
        <h2 class="main-content-title tx-24 mg-b-5">Sales</h2>
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
            <form class="row g-3" action="save.php?sales_id=<?=$sales_id;?>" method="post" id="salesForm">
              <div class="col-lg-4">
                <label for="item_id" class="mg-b-10 form-label">Product</label>
                <select name="item_id" class="form-control select2 select2-hidden-accessible" required id="item_id" onchange="check(this.value,'<?=$sales_id?>')" >
                    <option value="">Select Product</option>
                    <?php 
                    $qry_prod=fetch_data($link,"SELECT * FROM invt_products order by product_id");
                    foreach($qry_prod as $row_prod){
                    $item_id=$row_prod['item_id'];
                    $product_id=$row_prod['product_id'];
                
                    $selected = (isset($row) && $row['item_id'] == $item_id) ? 'selected' : '';
                    ?>
                    <option value="<?= $item_id;?>" <?= $selected; ?>><?= $product_id;?></option>
                    <?php }?>
                </select>
              </div>
              <div class="col-md-4">
                <label for="name" class="mg-b-10 form-label">Date:</label>
                <input required class="form-control" id="datetimepicker" name="date" type="date" value="<?= $row['date']??''?>">
              </div>
              <div class="col-lg-4">
                <label for="name" class="mg-b-10 form-label">Customer Name:</label>
                <input class="form-control" id="name" type="text" name="customer_name" value="<?=$row['customer_name']??''?>">
              </div>
              <div class="col-md-12 ">
                <label for="details" class="form-label">Sale Details</label>
                <textarea class="form-control tiny-mce" name="details" id="details" rows="4" ><?=$row['details']??''?></textarea>
              </div>
              <div class="col-md-4">
                <label for="sold" class="form-label">Item Sold</label>
                <input type="text" disabled required class="form-control" id="sold" name="sold"  value="<?=$row['sold']??''?>">
              </div>
              <div class="col-md-4">
                <label for="price" class="form-label">Price</label>
                <input type="text" readonly  class="form-control" id="price" name="price" value="<?=$row['price']??''?>">
              </div>
              <div class="col-md-4">
                <label for="discount" class="form-label">Discount</label>
                <input type="text" readonly class="form-control" id="discount" name="discount" value="<?= $row['discount']??''?>">
              </div>
              <div class="col-md-4">
                <label for="subtotal" class="form-label">Subtotal</label>
                <input type="text" readonly  class="form-control" id="subtotal" name="subtotal" value="<?= $row['subtotal'] ??''?>">
              </div>
              <div class="col-md-4">
                <label for="delivery" class="form-label">Delivery Charges</label>
                <input type="text"  class="form-control" id="delivery" name="delivery" required value="<?= $row['delivery']??''?>">
              </div>
              <div class="col-md-4">
                <label for="process_fee" class="form-label">Processing Fee</label>
                <input type="text"   class="form-control" id="process_fee" name="process_fee" value="<?= $row['process_fee']??''?>">
              </div>
              <div class="col-md-4">
                <label for="other_amount" class="form-label">Other amount</label>
                <input type="text"   class="form-control" id="other_amount" name="other_amount" value="<?= $row['other_amount']??''?>">
              </div>
              <div class="col-md-4">
                <label for="total" class="form-label">Total Paid</label>
                <input type="text"   class="form-control" id="total" name="total" readonly value="<?=$row['total']??''?>">
              </div>
              <div class="col-12">
                <button class="btn ripple btn-main-primary" id="saleBtn" type="submit">Save</button>
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
include("../../includes/footer.php");
?>
<script>
  var sales_id = '<?=$sales_id?>';
</script>
<script src="functions.js"></script>