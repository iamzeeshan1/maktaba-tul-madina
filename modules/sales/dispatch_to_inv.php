<?php
$page_title = "Sales - Maktaba-Tul-Madina";
include("../../includes/header.php");
?>


<div class="main-container container-fluid">
  <div class="inner-body">
    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Sales Dispatched to Invoice</h2>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Row -->
    <div class="row row-sm">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card custom-card">
          <div class="card-body">
                <div class="table-responsive mb-4 mt-4" style="min-height:200px">
                    <table class="table table-bordered caption-top W-100 dataTables_length dataTable" id="dispatch_inv">
                        <thead class="table-light">
                            <th width="4%">Sr.No</th>
                            <th width="20%">Date</th>
                            <th width="20%">Customer</th>
                            <th width="20%">Quantity Sold</th>
                            <th width="20%">Total Retail Price 2</th>
                            <!-- <th width="20%">Picked By</th>-->
                            <th width="20%">Status</th> 
                            <th width="5%">Actions</th>
                        </thead>
                        <tbody>
                            
                            <?php 
                            $query = fetch_data($link,"SELECT invt_sales.*,SUM(invt_sales.quantity) as total_q,SUM(invt_sales.cost_price) as total_p,invt_products.product_id,invt_products.product_name,invt_customers.customer_name,users_detail.first_name,users_detail.last_name FROM invt_sales LEFT JOIN invt_products ON invt_sales.item_id=invt_products.item_id LEFT JOIN invt_customers ON invt_customers.customer_id=invt_sales.customer_id LEFT JOIN users_detail ON users_detail.user_id=invt_sales.picklist_id where invt_sales.status='accepted' group by invt_sales.invoice_number");

                                foreach($query as $key => $row_sol){
                                $sales_id = $row_sol['sales_id'];
                                if($row_sol['status'] == 'accepted'){
                                    $class="bg-success";
                                    $title="Completed";
                                }
                            ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $row_sol['date'] ?></td>
                                <td><?= $row_sol['customer_name'] ?></td>
                                <td><?= $row_sol['total_q'] ?></td>
                                <td><?= $row_sol['total_p'] ?></td>
                                <!-- <td><?= $row_sol['first_name'] . ' '.$row_sol['last_name'] ??''?></td> -->
                                <td><span class="badge <?=$class?>"><?=$title?></span></td>
                                
                                <td>
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                          <i class="ti-menu sidemenu-icon menu-icon "></i>
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                          <li><a class="dropdown-item" href="invoice.php?invoice_number=<?= $row_sol['invoice_number']?>">
                                                <i class=" bx bx-edit"> Generate Invoice </i></a>
                                            </li>
                                            
                                            <li><a class="dropdown-item" href="cust_invoice.php?invoice_number=<?= $row_sol['invoice_number']?>">
                                                <i class=" bx bx-edit"> Customer Invoice </i></a>
                                            </li>
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

<?php include("../../includes/footer.php"); ?>
<script src="<?= $app_path ?>assets/js/table-data.js"></script>
<script src="functions.js?v=1.2"></script>