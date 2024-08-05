<?php
$page_title = "Purchase - Maktaba-Tul-Madina";
include("../../includes/header.php");
$s_date = $_POST['start_date']??'';
$e_date = $_POST['end_date']??'';
?>
<div class="main-container container-fluid">
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Purchase</h2>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a class="btn btn-primary my-2 btn-icon-text text-white" href="create.php">
                        <i class="fe fe-plus me-2"></i> Purchase Item
                    </a>
                </div>
            </div>
        </div>
        <div class="card custom-card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?=$s_date?>">
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?=$e_date?>">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary  btn-icon-text text-white">Submit</button>
                            <button type="button" onclick="reset_filter()" class="btn btn-primary btn-icon-text text-white">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Row -->
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="table-responsive mb-4">
                            <table class="table table-striped table-bordered text-nowrap  no-footer dtr-inline dataTables" >
                                <thead>
                                    <th width="4%">Sr.No</th>
                                    <th width="20%">Supplier Name</th>
                                    <th width="20%">Supplier Invoice</th>
                                    <th width="20%">Document No</th>
                                    <th width="20%">Master Notes</th>
                                    <th width="10%">Cost Price</th>
                                    <th width="10%">Created Date</th>
                                    <th width="10%">Created By</th>
                                    <th width="5%">Actions</th>
                                </thead>
                                <tbody>

                                    <?php
                                    $s_filter = ($s_date != '')?" and invt_purchase.date >= '$s_date'":'';
                                    $e_filter = ($e_date != '')?" and invt_purchase.date < '$e_date'":'';
                                
                                    $query = fetch_data($link, "SELECT SUM(invt_purchase.cost_price) AS total_cost_price,prod.product_name,invt_suppliers.supplier_name,pd.quantity,pd.loc_id,loc.loc_name,invt_purchase.document_num,invt_purchase.invoice_number,invt_purchase.notes,invt_purchase.added_by,invt_purchase.added_on,invt_purchase.date,invt_purchase.user_request_status,invt_purchase.purchase_id,invt_purchase.item_id FROM invt_purchase LEFT JOIN invt_suppliers ON invt_purchase.supplier_id=invt_suppliers.supplier_id INNER JOIN invt_purchase_details AS pd ON invt_purchase.purchase_id=pd.purchase_id INNER JOIN invt_locations AS loc ON pd.loc_id=loc.loc_id INNER JOIN invt_products AS prod ON invt_purchase.item_id=prod.item_id WHERE invt_purchase.purchase_id >0 $s_filter $e_filter GROUP BY invt_purchase.invoice_number ORDER BY invt_purchase.purchase_id DESC");

                                    foreach ($query as $key => $row_sol) {
                                        $user_name = return_title('first_name','user_id',$row_sol['added_by'],'users_detail',$link);
                                        ?>
                                        <tr>
                                            <td><?= $key+1 ?></td>
                                            <td><a class="cursor-pointer" href="invoice.php?id=<?=$row_sol['invoice_number']?>"><?=$row_sol['supplier_name']?></a></td>
                                            <td><a class="cursor-pointer" href="invoice.php?id=<?=$row_sol['invoice_number']?>"><?=$row_sol['invoice_number']?></a></td>
                                            <td><a class="cursor-pointer" href="invoice.php?id=<?=$row_sol['invoice_number']?>"><?=$row_sol['document_num']?></a></td>
                                            <td><?=$row_sol['notes']?></td>
                                            <td><?=$row_sol['total_cost_price']?></td>
                                            <td><?=$row_sol['date']?></td>
                                            <td><?=$user_name?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" role="button" id="dropdownMenuLink"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ti-menu sidemenu-icon menu-icon "></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <li><a class="dropdown-item" href="invoice.php?id=<?=$row_sol['invoice_number']?>">
                                                                <i class=" bx bx-edit"> Invoice </i></a>
                                                        </li>
                                                        <?php if(($row_sol['added_by'] == $_SESSION['mktb_user_id']) && $row_sol['user_request_status'] == 0):?>
                                                            <li><a class="dropdown-item" id="btn-req-<?=$row_sol['invoice_number']?>" onclick="request_edit('<?=$row_sol['invoice_number']?>')">
                                                                    <i class=" bx bx-edit"> Request Edit </i></a>
                                                            </li>
                                                        <?php endif; ?>
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
<?php 
include("modals.php");
include("../../includes/footer.php");
?>

<script src="functions/functions.js"></script>