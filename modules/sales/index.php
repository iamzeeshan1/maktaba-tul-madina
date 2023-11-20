<?php

include("../../includes/header.php");
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
          <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
            <i class="fe fe-download me-2"></i> Import </button>
          <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
            <i class="fe fe-filter me-2"></i> Filter </button>
          <button type="button" class="btn btn-primary my-2 btn-icon-text">
            <i class="fe fe-download-cloud me-2"></i> Download Report </button>
            <a href="create.php">  <button type="button" class="btn btn-primary my-2 btn-icon-text">
            <i class="fe fe-download-cloud me-2"></i> Add New </button></a>
        </div>
      </div>
    </div>
    <!-- End Page Header -->
    <!-- Row -->
    <div class="row row-sm">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card custom-card">
          <div class="card-body">
                <div class="table-responsive mb-4 mt-4">
                    <table class="table table-bordered caption-top W-100 dataTables_length" id="prodTable">
                        <thead class="table-light">
                            <th width="4%">Sr.No</th>
                            <th width="20%">Date</th>
                            <th width="20%">Product ID</th>
                            <th width="20%">Quantity Sold</th>
                            <th width="5%">Actions</th>
                        </thead>
                        <tbody>
                            
                            <?php 
                            $srNo=1;
                            $query = fetch_data($link,"SELECT
                            *, 
                            invt_products.product_id
                            FROM
                            invt_sales
                            LEFT JOIN
                            invt_products
                            ON 
                                invt_sales.item_id = invt_products.item_id");

                                foreach($query as $row_sol){
                                $sales_id = $row_sol['sales_id'];
                            ?>
                            <tr>
                                <td><?=$srNo++?></td>
                                <td><?= $row_sol['date'] ?></td>
                                <td><?= $row_sol['product_id'] ?></td>
                                <td><?= $row_sol['sold'] ?></td>
                                
                                <td>
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-view-agenda-outline">Actions</i>
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="create.php?sales_id=<?= $sales_id?>">
                                                    <i class=" bx bx-edit"> Edit / View </i></a>
                                            </li>
                                            <li><a href="#" class="dropdown-item" onclick=" JSconfirm('delete.php?sales_id=<?= $sales_id ?>&action=delete_item')">
                                                    <i class=" bx bx-trash"> Delete</i></a></li>
                                           
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


<?php include("../../includes/footer.php"); 
?>
