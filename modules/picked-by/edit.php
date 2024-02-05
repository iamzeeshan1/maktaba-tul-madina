<?php
include("../../includes/header.php");

if(isset($_GET['sales_id'])){
  $sales_id=$_GET['sales_id'];
  $query = fetch_data($link, "SELECT s.*,p.product_name,pd.quantity as total_quantity, pd.loc_id from invt_sales s Inner join invt_products p on s.item_id = p.item_id  Inner join invt_purchase_details pd on s.item_id = pd.item_id where s.sales_id = '$sales_id'");
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
                <form class="row g-3" method="post" action="save.php?action=edit&sales_id=<?=$sales_id?>">
                    <div class="col-lg-4">
                        <label for="item_id" class="mg-b-10 form-label">Product ID</label>
                        <select name="item_id" class="form-control select2 select2-hidden-accessible"  id="item_id" readonly >
                        <option value="">Select Product</option>
                        <?php 
                          $id = $row['item_id'];
                          $qry_prod=fetch_data($link,"SELECT * FROM invt_products where item_id = $id order by product_id");
                          $product_id = $qry_prod[0]['product_id'];
                        ?>
                        <option value="<?= $item_id;?>" selected><?= $product_id;?></option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="productName" class="mg-b-10 form-label">Product Name:</label>
                        <input type="text" id="productName" readonly name="productName" class="form-control" value="<?=$row['product_name']??'';?>">
                    </div>
                    <div class="col-lg-4">
                        <label for="loc_id" class="mg-b-10 form-label">Locations</label>
                        <select name="loc_id" class="form-control "  id="loc_id" readonly>
                          <option value="">Select Locations</option>
                          <?php
                            $loc_id=$row['loc_id'];
                            $qry_loc=fetch_data($link,"SELECT * FROM invt_locations where loc_id = $loc_id");
                            $loc_name=$qry_loc[0]['loc_name'];
                          ?>
                          
                          <option value="<?= $loc_id;?>" selected><?= $loc_name;?></option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="avail-quantity" class="mg-b-10 form-label">Available Quantity:</label>
                        <input class="form-control" id="avail-quantity" disabled name="avail-quantity" type="text" value="<?=$row['total_quantity']?>">
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="mg-b-10 form-label">Date:</label>
                        <input  class="form-control" readonly id="date" name="date" type="date" value="<?= $row['date']??''?>">
                    </div>
                    <div class="col-md-4">
                        <label for="quantity" class="mg-b-10 form-label">Quantity:</label>
                        <input  class="form-control" id="quantity" name="quantity" type="text" id="quantity" value="<?= $row['quantity']??'0'?>" onfocusout="check_quantity(this.value)">

                        <input type="hidden" name="old_quantity" id="old_quantity" value="<?= $row['quantity']?>">
                        <input type="hidden" name="item_id" id="item_id" value="<?= $row['item_id']?>">
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