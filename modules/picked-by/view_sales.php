<?php
$page_title = "Picked Up - Maktaba-Tul-Madina";
include("../../includes/header.php");
$user_id = $_SESSION['mktb_user_id'];
$invoice_number = $_GET['invoice_number'];
?>
<div class="main-container container-fluid">
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Sales for <?=$invoice_number?>:</h2>
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
            <div class="col-xl-12 col-lg-12 col-md-12" >
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered caption-top W-100 dataTables_length" id="picked_by">
                                <thead class="table-light">
                                    <th>Sr.No</th>
                                    <th>Date</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Quantity Sold</th>
                                    <!-- <th>Status</th> -->
                                    <th >Actions</th>
                                </thead>
                                <tbody>
                                    
                                    <?php 
                                        $query = fetch_data($link,"SELECT invt_sales.*,invt_products.product_id,invt_products.product_name FROM invt_sales LEFT JOIN invt_products ON invt_sales.item_id=invt_products.item_id where invoice_number='$invoice_number'");
                                        $total_q = 0;
                                        foreach($query as $key => $row_sol){
                                        $sales_id = $row_sol['sales_id'];
                                        $invoice_number = $row_sol['invoice_number'];
                                    ?>
                                    <tr>
                                        <td><?= $key+1 ?></td>
                                        <td><?= $row_sol['date'] ?></td>
                                        <td><?= $row_sol['product_id'] ?></td>
                                        <td><?= $row_sol['product_name'] ?></td>
                                        <td><?= $row_sol['quantity'] ?></td>
                                        <!-- <td>
                                            <?php
                                                if($row_sol['status'] == 'accepted'){
                                                    $class="btn-success";
                                                    $title="Completed";
                                                }elseif($row_sol['status'] == 'decline'){
                                                    $class="btn-warning";
                                                    $title="Decline";
                                                }elseif($row_sol['status'] == 'pending'){
                                                    $class="btn-primary";
                                                    $title="Pending";
                                                }
                                            ?>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true" class="ripple btn btn-sm <?= $class ?> dropdown-toggle" data-bs-toggle="dropdown" type="button"><?= $title?><i class="fas fa-caret-down ms-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    <a class="dropdown-item" onclick=" JSconfirm('change-status.php?sales_id=<?= $sales_id ?>&type=accepted&action=change_status','warning','Are you sure you want to Accept this?')">Completed</a>
                                                    <a class="dropdown-item" onclick=" JSconfirm('change-status.php?sales_id=<?= $sales_id ?>&type=decline&action=change_status','warning','Are you sure you want to Decline this?')">Decline</a>
                                                    <a class="dropdown-item" onclick=" JSconfirm('change-status.php?sales_id=<?= $sales_id ?>&type=pending&action=change_status','warning','Are you sure you want to move this to pending?')">Pending</a>
                                                </div>
                                            </div>
                                        </td> -->
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti-menu sidemenu-icon menu-icon "></i>
                                                </a>

                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li><a class="dropdown-item" href="edit.php?sales_id=<?= $sales_id?>">
                                                            <i class=" bx bx-edit"> Edit </i></a>
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
<?php include("../../includes/footer.php");?>
<script src="functions/functions.js"></script>

<script src="<?= $app_path ?>assets/js/table-data.js"></script>