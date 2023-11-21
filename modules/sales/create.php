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
            <form class="row g-3" action="save.php?sales_id=<?=$sales_id;?>" method="post">

                <div class="col-lg-4">
                    <label for="item_id" class="mg-b-10 form-label">Product</label>
                    <select name="item_id" class="form-control select2 select2-hidden-accessible" required id="item_id" onchange="check(this.value)" >
                        <option value="">Select Product</option>
                        <?php 
                        $qry_prod=fetch_data($link,"SELECT * FROM invt_products order by product_id");
                        foreach($qry_prod as $row_prod){
                        $item_id=$row_prod['item_id'];
                        $product_id=$row_prod['product_id'];
                    
                        $selected = ($row['item_id'] == $item_id) ? 'selected' : '';
                        ?>
                        <option value="<?= $item_id;?>" <?= $selected; ?>><?= $product_id;?></option>
                        <?php }?>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="col-md-4">
                    <div class="mg-b-20">
                        <label for="name" class="mg-b-10 form-label">Date:</label>

                        <div class="input-group">
                            <div class="input-group-text border-end-0">
                                <i class="fe fe-calendar lh--9 op-6"></i>
                            </div>
                            <input required class="form-control" id="datetimepicker"name="date" type="date" value="<?=(isset($row) && $row['date'] != '') ? show_date($row['date']) : ''?>">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <label for="name" class="mg-b-10 form-label">Customer Name:</label>
                    <input class="form-control" id="name" type="text" name="customer_name" value="<?=(isset($row) && $row['customer_name'] != '') ? $row['customer_name'] : ''?>">
                    <div class="invalid-feedback"></div>
                </div>

                

                <div class="col-md-12 ">
                    <div class="form-group mb-0">
                        <label for="details" class="form-label">Sale Details</label>
                        <textarea class="form-control tiny-mce" name="details" id="details" rows="4" ><?=(isset($row) && $row['details'] != '') ? $row['details'] : ''?></textarea>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <label for="sold" class="form-label">Item Sold</label>
                    <input type="text" disabled required class="form-control" id="sold" name="sold"  value="<?=(isset($row) && $row['sold'] != '') ? $row['sold'] : ''?>">
                    <div class="invalid-feedback"></div>
                </div>
    
                <div class="col-md-4">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" readonly  class="form-control" id="price" name="price" value="<?=(isset($row) && $row['price'] != '') ? $row['price'] : ''?>">
                    <div class="invalid-feedback"></div>
                </div>
               
                <div class="col-md-4">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="text" readonly class="form-control" id="discount" name="discount" value="<?=(isset($row) && $row['discount'] != '') ? $row['discount'] : ''?>">
                    <div class="invalid-feedback"></div>
                </div>
                
                <div class="col-md-4">
                    <label for="subtotal" class="form-label">Subtotal</label>
                    <input type="text" readonly  class="form-control" id="subtotal" name="subtotal" required value="<?=(isset($row) && $row['subtotal'] != '') ? $row['subtotal'] : ''?>">
                    <div class="invalid-feedback"></div>
                </div>
                
                <div class="col-md-4">
                    <label for="delivery" class="form-label">Delivery Charges</label>
                    <input type="text"  class="form-control" id="delivery" name="delivery" required value="<?=(isset($row) && $row['delivery'] != '') ? $row['delivery'] : ''?>">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="col-md-4">
                    <label for="process_fee" class="form-label">Processing Fee</label>
                    <input type="text"   class="form-control" id="process_fee" name="process_fee" value="<?=(isset($row) && $row['process_fee'] != '') ? $row['process_fee'] : ''?>">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="col-md-4">
                    <label for="other_amount" class="form-label">Other amount</label>
                    <input type="text"   class="form-control" id="other_amount" name="other_amount" value="<?=(isset($row) && $row['other_amount'] != '') ? $row['other_amount'] : ''?>">
                    <div class="invalid-feedback"></div>
                </div>
                
                <div class="col-md-4">
                    <label for="total" class="form-label">Total Paid</label>
                    <input type="text"   class="form-control" id="total" name="total" readonly value="<?=(isset($row) && $row['total'] != '') ? $row['total'] : ''?>">
                    <div class="invalid-feedback"></div>
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
include("../../includes/footer.php");
?>
<script src="functions.js"></script>