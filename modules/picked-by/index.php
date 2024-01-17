<?php
$page_title = "Picked Up - Maktaba-Tul-Madina";
include("../../includes/header.php");
?>
<div class="main-container container-fluid">
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Picked Up</h2>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Row -->
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="table-responsive mb-4 mt-4">
                            <table class="table table-bordered caption-top W-100 dataTables_length dataTable" id="saleTable">
                                <thead class="table-light">
                                    <th width="4%">Sr.No</th>
                                    <th width="5%">Invoice#</th>
                                    <th width="20%">Product ID</th>
                                    <th width="20%">Customer</th>
                                    <th width="20%">Quantity Sold</th>
                                    <th width="20%">Date</th>
                                    <th width="20%">Picked By</th>
                                    <th width="20%">Status</th>
                                    <th width="5%">Actions</th>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                        $query = fetch_data($link,"SELECT
                                        invt_sales.*,
                                        invt_products.product_id,
                                        invt_customers.customer_name,
                                        users_detail.first_name as f_name,
                                        users_detail.last_name as l_name 
                                        FROM
                                        invt_sales
                                        LEFT JOIN invt_products ON invt_sales.item_id = invt_products.item_id
                                        LEFT JOIN invt_customers ON invt_customers.customer_id = invt_sales.customer_id
                                        INNER JOIN users ON invt_sales.picklist_id = users.user_id
                                        INNER JOIN users_detail ON users.user_id = users_detail.user_id");

                                        foreach($query as $key => $row_sol){
                                        $sales_id = $row_sol['sales_id'];
                                    ?>
                                    <tr>
                                        <td><?= $key+1 ?></td>
                                        <td><?= $row_sol['invoice_number'] ?></td>
                                        <td><?= $row_sol['product_id'] ?></td>
                                        <td><?= $row_sol['customer_name'] ?></td>
                                        <td><?= $row_sol['quantity'] ?></td>
                                        <td><?= $row_sol['date'] ?></td>
                                        <td><?= $row_sol['f_name'].' '.$row_sol['l_name'] ??''?></td>
                                        <td>
                                            <?php
                                                if($row_sol['status'] == 'accepted'){
                                                    $class="btn-success";
                                                    $title="Accepted";
                                                }elseif($row_sol['status'] == 'decline'){
                                                    $class="btn-warning";
                                                    $title="Decline";
                                                }elseif($row_sol['status'] == 'pending'){
                                                    $class="btn-primary";
                                                    $title="Pending";
                                                }
                                            ?>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true" class="ripple btn <?= $class ?> dropdown-toggle" data-bs-toggle="dropdown" type="button"><?= $title?><i class="fas fa-caret-down ms-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item" onclick=" JSconfirm('change-status.php?sales_id=<?= $sales_id ?>&type=accepted&action=change_status','warning','Are you sure you want to Accept this?')">Accepted</a>
                                                    <a class="dropdown-item" onclick=" JSconfirm('change-status.php?sales_id=<?= $sales_id ?>&type=decline&action=change_status','warning','Are you sure you want to Decline this?')">Decline</a>
                                                    <a class="dropdown-item" onclick=" JSconfirm('change-status.php?sales_id=<?= $sales_id ?>&type=pending&action=change_status','warning','Are you sure you want to move this to pending?')">Pending</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-view-agenda-outline">Actions</i>
                                                </a>

                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li><a class="dropdown-item" href="create.php?sales_id=<?= $sales_id?>">
                                                            <i class=" bx bx-edit"> Edit / View </i></a>
                                                    </li>
                                                    <?php if($row_sol['picklist_id'] != ''){?>
                                                    <li><a class="dropdown-item" href="invoice.php?sales_id=<?= $sales_id?>">
                                                            <i class=" bx bx-edit"> Generate Invoice </i></a>
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
<?php include("../../includes/footer.php");?>
<script src="<?= $app_path ?>assets/js/table-data.js"></script>