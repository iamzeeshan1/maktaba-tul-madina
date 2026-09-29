<?php
$page_title = "Sales - Maktaba-Tul-Madina";
include("../../includes/header.php");

if(isset($_GET['sales_id'])){
  $sales_id=$_GET['sales_id'];
  $query = fetch_data($link, "SELECT * from invt_sales Inner join invt_products on invt_sales.item_id = invt_products.item_id where invt_sales.sales_id = '$sales_id'");
  if(count($query)>0){
      $row = $query[0];
  }
}
else{
  $sales_id='';
}
$current_date = date('Y-m-d');

?>
<style>
    .fixTableHead { 
        overflow-y: auto; 
        height: 250px; 
    } 
    .fixTableHead thead th { 
        position: sticky; 
        top: 0; 
    }
</style>
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
                        <div class="position-relative">
                            <form  id="salesForm" >
                                <div class="row g-3 position-sticky top-0">
                                    <div class="col-lg-3">
                                        <label for="item_id" class="mg-b-10 form-label">Product ID</label>
                                        <select name="item_id" class="form-control select2 select2-hidden-accessible"
                                            id="item_id" required onchange="get_product_details(this.value)">
                                            <option value="">Select Product</option>
                                            <?php 
                                            $qry_prod=fetch_data($link,"SELECT DISTINCT pr.item_id, pr.* FROM invt_products pr inner join invt_purchase ip on pr.item_id = ip.item_id order by product_id");
                                            foreach($qry_prod as $row_prod){
                                                $item_id=$row_prod['item_id'];
                                                $product_id=$row_prod['product_id'];
                                            
                                                $selected = (isset($row) && $row['item_id'] == $item_id) ? 'selected' : '';
                                                ?>
                                                <option value="<?= $item_id;?>" <?= $selected; ?>><?= $product_id;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="productName" class="mg-b-10 form-label">Product Name:</label>
                                        <select name="productName" class="form-control select2 select2-hidden-accessible" required
                                            id="productName" onchange="get_prod_id_location(this.value)">
                                            <option value="">Select Product</option>
                                            <?php 
                                            $qry_prod=fetch_data($link,"SELECT  DISTINCT pr.item_id, pr.* FROM invt_products pr inner join invt_purchase ip on pr.item_id = ip.item_id order by product_name");
                                            foreach($qry_prod as $row_prod){
                                            $item_id=$row_prod['item_id'];
                                            $product_name=$row_prod['product_name'];
                                        
                                            $selected = (isset($row) && $row['item_id'] == $item_id) ? 'selected' : '';
                                            ?>
                                            <option value="<?= $item_id;?>" <?= $selected; ?>><?= $product_name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="loc_id" class="mg-b-10 form-label">Locations</label>
                                        <select name="loc_id" class="form-control select2 select2-hidden-accessible" id="loc_id" required
                                            onchange="get_quantity(this.value)">'>
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
                                    <div class="col-md-3">
                                        <label for="avail-quantity" class="mg-b-10 form-label">Available Quantity:</label>
                                        <input class="form-control" id="avail-quantity" disabled name="avail-quantity"
                                            type="text" value="">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="name" class="mg-b-10 form-label">Date:</label>
                                        <input class="form-control" id="date" name="date" type="date"
                                            value="<?= $row['date']??$current_date?>">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="name" class="mg-b-10 form-label">Customer Name:</label>
                                        <select name="customer_id" required class="form-control select2 select2-hidden-accessible"
                                            id="customer_id" onchange="get_discount(this.value)">
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
                                    <div class="col-md-3">
                                        <label for="quantity" class="mg-b-10 form-label">Quantity:</label>
                                        <input class="form-control" id="quantity" name="quantity" required  type="number"
                                            value="<?= $row['quantity']??''?>" data-parsley-required-message="Quantity is required" onfocusout="check_quantity(this.value)">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="retail_price" class="form-label">Retaiil Price</label>
                                        <input type="number" class="form-control" id="retail_price" name="retail_price"
                                            value="<?=$row['retail_price']??''?>" required step="0.01" onfocusout="find_price(this.value)">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="discount_1" class="form-label">Discount 1 (%)</label>
                                        <input type="number" readonly class="form-control" id="discount_1" name="discount_1"
                                            value="<?=$row['discount_1']??''?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="discount_2" class="form-label">Discount 2 (%)</label>
                                        <input type="number" class="form-control" id="discount_2" step="0.01"
                                            onfocusout="add_discount(this.value)" name="discount_2"
                                            value="<?= $row['discount_2']??''?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cost_price" class="form-label">Retail Price 2</label>
                                        <input type="text" readonly class="form-control" id="cost_price" name="cost_price"
                                             value="<?=$row['cost_price']??''?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="total" class="form-label">Total</label>
                                        <input type="text" class="form-control" id="total" name="total" readonly
                                            value="<?=$row['total']??''?>">
                                    </div>
                                    <div class="col-6">
                                        <button class="btn ripple btn-main-primary d-none" onclick=" saleSubmit(1)" id="saleBtn"
                                            type="submit">Save</button>
                                        <!-- <div class="dropdown dropup  d-none"  id="saleBtn">
                                            <button aria-expanded="false" aria-haspopup="true" class="ripple btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" type="button">Save<i class="fas fa-caret-down ms-1"></i></button>
                                            <div class="dropdown-menu tx-13">
                                                <a class="dropdown-item" onclick=" saleSubmit(1)">Dispatch to Picklist </a>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <button type="button" id="add_btn" onclick="save_data(event)"
                                            class="btn btn-primary">ADD</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="row">
                            
                        </div>
                        <!-- table -->
                        <div class="row mt-3 d-none" id="table_row">
                            <div class="col-md-12">
                                <p><strong class="me-1">Customer:</strong><span id="cust_data"></span></p>
                                <div class="fixTableHead">
                                    <table class="table table-striped table-bordered text-wrap no-footer dtr-inline  mb-0"
                                        id="saved_sale">
                                        <thead  style="background: #2b2b53;">
                                            <tr>
                                                <th class="text-white">Date</th>
                                                <th class="text-white">Product ID</th>
                                                <th class="text-white" width="20%">Product Name</th>
                                                <th class="text-white">Location</th>
                                                <th class="text-white">Quantity Sold</th>
                                                <th class="text-white">Retail Price</th>
                                                <th class="text-white">Retail Price 2</th>
                                                <th class="text-white">Discount 1</th>
                                                <th class="text-white">Discount 2</th>
                                                <th class="text-white">Before Discount Total</th>
                                                <th class="text-white">Discounted Total</th>
                                                <th class="text-white"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="saved">
                                        </tbody>
                                        <tfoot id="saved_pur_footer">
                                            <tr>
                                                <td colspan="4"> Total:</td>
                                                <td id="q_total" class="fw-bold"></td>
                                                <td id="set_tfoot_retail_value" class="fw-bold"></td>
                                                <td id="set_tfoot_cost_value" class="fw-bold"></td>
                                                <td></td>
                                                <td></td>
                                                <td id="set_tfoot_total_value" class="fw-bold"></td>
                                                <td id="set_tfoot_dis_value" class="fw-bold"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3 hidden-div" id="hide_notes">
                                <label for="details" class="form-label">Sale Details</label>
                                <textarea class="form-control" name="details" id="details" rows="4"></textarea>
                            </div>
                            <div class="col-12 mt-3" id="show_notes_btn">
                                <button class="btn ripple btn-main-primary btn-sm" type="button"   onclick="showNotes()">Add Notes</button>
                            </div>
                            <div class="col-12 hidden-div " id="hide_notes_btn" >
                                <button class="btn ripple btn-main-primary btn-sm" type="button"  onclick="hideNotes()">Hide Notes</button>
                            </div>
                        </div>
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