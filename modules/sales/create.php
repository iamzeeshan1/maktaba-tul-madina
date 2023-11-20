<?php
include("../../includes/header.php");

if(isset($_GET['item_id'])){
  $item_id=$_GET['item_id'];
  $query = fetch_data($link, "SELECT * from invt_products where item_id = '$item_id'");
  if(count($query)>0){
      $row = $query[0];
  }
}
else{
  $item_id='';
}
?> 
<div class="main-container container-fluid">
  <div class="inner-body">
    <!-- Page Header -->
    <div class="page-header">
      <div>
        <h2 class="main-content-title tx-24 mg-b-5">Sales</h2>
      </div>
      
    </div>
    <!-- End Page Header -->
    <!-- Row -->
    <div class="row row-sm">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card custom-card">
          <div class="card-body">
            <!-- <div><h6 class="main-content-label mb-3">Server side</h6></div> -->
            <form class="row g-3" action="save.php?item_id=<?=$item_id;?>" method="post">
                <div class="col-md-6">
                    <div class="mg-b-20">
                        <div class="input-group">
                            <div class="input-group-text border-end-0">
                                <i class="fe fe-calendar lh--9 op-6"></i>
                            </div>
                            <input class="form-control" id="datetimepicker"name="date"  placeholder="MM/DD/YYYY HH/MM/SS" type="text">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <label for="name" class="mg-b-10 form-label">Customer Name:</label>
                    <input class="form-control" id="name" type="text" name="name">
                    <div class="invalid-feedback"></div>
                </div>

                

                <div class="col-md-12 ">
                    <div class="form-group mb-0">
                        <label for="details" class="form-label">Product Details</label>
                        <textarea class="form-control tiny-mce" name="details" id="details" rows="4" ><?=(isset($row) && $row['details'] != '') ? $row['details'] : ''?></textarea>
                    </div>
                </div>
              <div class="col-lg-4">
                <label for="location_id" class="mg-b-10 form-label">Product Location</label>
                <select name="location_id" class="form-select" required onchange="fn_location(this.value)"  id="location_id">
                    <option value="">Select Location</option>
                    <?php 
                      $qry_location=fetch_data($link,"SELECT * FROM invt_locations order by location_name");
                      foreach($qry_location as $row_location){
                      $location_id=$row_location['location_id'];
                      $location_name=$row_location['location_name'];
                  
                      $selected = ($row['location_id'] == $location_id) ? 'selected' : '';
                    ?>
                    <option value="<?= $location_id;?>" <?= $selected; ?>><?= $location_name;?></option>
                    <?php }?>
                    <option  value="other" >Other</option>
                  </select>
                <div class="invalid-feedback"></div>
              </div>
              <div class="col-lg-4">
                <label for="category_id" class="mg-b-10 form-label">Product Category</label>
                <select name="category_id" class="form-select" required onchange="fn_category(this.value)"  id="category_id">
                    <option value="">Select Category</option>
                    <?php 
                      $qry_category=fetch_data($link,"SELECT * FROM invt_categorys order by category_name");
                      foreach($qry_category as $row_category){
                      $category_id=$row_category['category_id'];
                      $category_name=$row_category['category_name'];
                  
                      $selected = ($row['category_id'] == $category_id) ? 'selected' : '';
                    ?>
                    <option value="<?= $category_id;?>" <?= $selected; ?>><?= $category_name;?></option>
                    <?php }?>
                    <option  value="other" >Other</option>
                  </select>
                <div class="invalid-feedback"></div>
              </div>

              <div class="col-md-4">
                <label for="cost_price" class="form-label">Cost Price</label>
                <input type="text" class="form-control" id="cost_price" name="cost_price" value="<?=(isset($row) && $row['cost_price'] != '') ? $row['cost_price'] : ''?>" required>
                <div class="invalid-feedback"></div>
              </div>

              <div class="col-md-4">
                <label for="retail_price" class="form-label">Retail Price</label>
                <input type="text" class="form-control" id="retail_price" name="retail_price" value="<?=(isset($row) && $row['retail_price'] != '') ? $row['retail_price'] : ''?>" required>
                <div class="invalid-feedback"></div>
              </div>
              <div class="col-md-4">
                <label for="discount" class="form-label">Discount %</label>
                <input type="text" class="form-control" id="discount" name="discount" value="<?=(isset($row) && $row['discount'] != '') ? $row['discount'] : ''?>" required>
                <div class="invalid-feedback"></div>
              </div>
              <div class="col-md-4">
                <label for="quantity" class="form-label">Product Quantity</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="<?=(isset($row) && $row['quantity'] != '') ? $row['quantity'] : ''?>" required>
                <div class="invalid-feedback"></div>
              </div>
              <div class="col-md-12 ">
                <div class="form-group mb-0">
                <label for="details" class="form-label">Product Details</label>
                  <textarea class="form-control tiny-mce" name="details" id="details" rows="4" ><?=(isset($row) && $row['details'] != '') ? $row['details'] : ''?></textarea>
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
</div> 


<?php
include("../../includes/footer.php");
?>
