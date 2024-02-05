<?php
include("../../includes/header.php");

if(isset($_GET['sales_id'])){
  $sales_id=$_GET['sales_id'];
  $query = fetch_data($link, "SELECT s.*,p.product_name,pd.quantity as total_quantity from invt_sales s Inner join invt_products p on s.item_id = p.item_id  Inner join invt_purchase_details pd on s.item_id = pd.item_id where s.sales_id = '$sales_id'");
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
                        <select name="item_id" class="form-control select2 select2-hidden-accessible"  id="item_id" onchange="get_product_details(this.value,'<?=$sales_id?>')" >
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
                    <div id="prod_details" class="col-lg-8">
                        <div class="row">
                        <div class="col-lg-6">
                            <label for="productName" class="mg-b-10 form-label">Product Name:</label>
                            <input type="text" id="productName" readonly name="productName" class="form-control" value="<?=$row['product_name']??'';?>">
                        </div>
                        <div class="col-lg-6">
                            <label for="loc_id" class="mg-b-10 form-label">Locations</label>
                            <select name="loc_id" class="form-control select2 select2-hidden-accessible"  id="loc_id" >
                            <option value="">Select Locations</option>
                            <?php
                            if($sales_id != ''){
                                $qry_loc=fetch_data($link,"SELECT * FROM invt_locations order by loc_id");
                                foreach($qry_loc as $row_loc){
                                $loc_id=$row_loc['loc_id'];
                                $loc_name=$row_loc['loc_name'];
                            
                                $selected = (isset($row) && $row['location'] == $loc_id) ? 'selected' : '';?>
                                <option value="<?= $loc_id;?>" <?= $selected; ?>><?= $loc_name;?></option>
                                <?php }?>
                            <?php }?>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="avail-quantity" class="mg-b-10 form-label">Available Quantity:</label>
                        <input class="form-control" id="avail-quantity" disabled name="avail-quantity" type="text" value="<?=$row['total_quantity']?>">
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="mg-b-10 form-label">Date:</label>
                        <input  class="form-control" id="date" name="date" type="date" value="<?= $row['date']??''?>">
                    </div>
                    <div class="col-lg-4">
                        <label for="name" class="mg-b-10 form-label">Customer Name:</label>
                        <select name="customer_id" class="form-control select2 select2-hidden-accessible"  id="customer_id" onchange="get_discount(this.value)" >
                            <option value="">Select Customer</option>
                            <?php 
                            $qry_customer=fetch_data($link,"SELECT * FROM invt_customers order by customer_name");
                            foreach($qry_customer as $row_customer){
                            $customer_id=$row_customer['customer_id'];
                            $customer_name=$row_customer['customer_name'];
                        
                            $selected = (isset($row) && $row['customer_id'] == $customer_id) ? 'selected' : '';
                            ?>
                            <option value="<?= $customer_id;?>" <?= $selected; ?>><?= $customer_name;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="quantity" class="mg-b-10 form-label">Quantity:</label>
                        <input  class="form-control" id="quantity" name="quantity" type="text" id="quantity" value="<?= $row['quantity']??'0'?>" onfocusout="check_quantity(this.value)">

                        <input type="hidden" name="old_quantity" id="old_quantity" value="<?= $row['quantity']?>">
                    </div>
                    
                    
                    <div class="col-md-4">
                        <label for="retail_price" class="form-label">Retaiil Price</label>
                        <input type="text"  class="form-control" id="retail_price" name="retail_price"  value="<?=$row['retail_price']??''?>" onfocusout="find_price(this.value)">
                    </div>
                    <div class="col-md-4">
                        <label for="discount_1" class="form-label">Discount 1 (%)</label>
                        <input type="text" readonly  class="form-control" id="discount_1" name="discount_1" value="<?=$row['discount_1']??''?>">
                    </div>
                    <div class="col-md-4">
                        <label for="discount_2" class="form-label">Discount 2 (%)</label>
                        <input type="text" class="form-control" id="discount_2" onfocusout="add_discount(this.value)" name="discount_2" value="<?= $row['discount_2']??''?>">
                    </div>
                    <div class="col-md-4">
                        <label for="cost_price" class="form-label">Cost Price</label>
                        <input type="text" readonly  class="form-control" id="cost_price" name="cost_price" readonly value="<?=$row['cost_price']??''?>">
                    </div>
                    <div class="col-md-4">
                        <label for="total" class="form-label">Total</label>
                        <input type="text"   class="form-control" id="total" name="total" readonly value="<?=$row['total']??''?>">
                    </div>
                    <div class="col-md-12 ">
                        <label for="details" class="form-label">Sale Details</label>
                        <textarea class="form-control tiny-mce" name="details" id="details" rows="4" ><?=$row['details']??''?></textarea>
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