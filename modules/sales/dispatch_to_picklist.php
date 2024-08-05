<?php
$page_title = "Sales - Maktaba-Tul-Madina";
include("../../includes/header.php");
?>


<div class="main-container container-fluid">
  <div class="inner-body">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Sales Dispatched to Picklist</h2>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Row -->
    <div class="row row-sm">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card custom-card">
          <div class="card-body">
                <div class="table-responsive mb-4 mt-4" style="min-height:200px">
                    <table class="table table-bordered caption-top W-100 dataTables_length dataTable">
                        <thead class="table-light">
                            <th width="4%">Sr.No</th>
                            <th width="20%">Date</th>
                            <th width="20%">Product ID</th>
                            <th width="20%">Product Name</th>
                            <th width="20%">Customer</th>
                            <th width="20%">Quantity Sold</th>
                            <th width="20%">Assigned To</th>
                            <!-- <th width="20%">Status</th> -->
                            <th width="5%">Actions</th>
                        </thead>
                        <tbody>
                            
                            <?php 
                            $query = fetch_data($link,"SELECT invt_sales.*,invt_products.product_id,invt_products.product_name,invt_customers.customer_name,users_detail.first_name,users_detail.last_name FROM invt_sales LEFT JOIN invt_products ON invt_sales.item_id=invt_products.item_id LEFT JOIN invt_customers ON invt_customers.customer_id=invt_sales.customer_id LEFT JOIN users_detail ON users_detail.user_id=invt_sales.picklist_id where invt_sales.sale_type=1");

                                foreach($query as $key => $row_sol){
                                $sales_id = $row_sol['sales_id'];
                                if($row_sol['status'] == 'accepted'){
                                    $class="bg-success";
                                    $title="Accepted";
                                }elseif($row_sol['status'] == 'decline'){
                                    $class="bg-warning";
                                    $title="Decline";
                                }elseif($row_sol['status'] == 'pending'){
                                    $class="bg-primary";
                                    $title="Pending";
                                }
                            ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $row_sol['date'] ?></td>
                                <td><?= $row_sol['product_id'] ?></td>
                                <td><?= $row_sol['product_name'] ?></td>
                                <td><?= $row_sol['customer_name'] ?></td>
                                <td><?= $row_sol['quantity'] ?></td>
                                <td><?= $row_sol['picklist_id']?></td>
                                <!-- <td><span class="badge <?=$class?>"><?=$title?></span></td> -->
                                
                                <td>
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                          <i class="ti-menu sidemenu-icon menu-icon "></i>
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="edit.php?sales_id=<?= $sales_id?>">
                                                    <i class=" bx bx-edit"> Edit / View </i></a>
                                            </li>
                                            <?php if($row_sol['picklist_id'] != '' && $row_sol['status'] == 'accepted'){?>
                                              <li><a class="dropdown-item" href="invoice.php?invoice_number=<?= $row_sol['invoice_number']?>">
                                                    <i class=" bx bx-edit"> Generate Invoice </i></a>
                                               </li>
                                               
                                               <li><a class="dropdown-item" href="cust_invoice.php?invoice_number=<?= $row_sol['invoice_number']?>">
                                                    <i class=" bx bx-edit"> Customer Invoice </i></a>
                                               </li>
                                            <?php }
                                            else{?>
                                              <li><a class="dropdown-item" onclick="generate_picklist(<?=$sales_id?>)">
                                                    <i class=" bx bx-edit"> Generate Picklist </i></a>
                                               </li>
                                            <?php }?>
                                           
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Row-->
  </div>
</div> 

<?php include("modals.php"); ?>
<?php include("../../includes/footer.php"); ?>
<script src="<?= $app_path ?>assets/js/table-data.js"></script>

<script src="functions.js"></script>