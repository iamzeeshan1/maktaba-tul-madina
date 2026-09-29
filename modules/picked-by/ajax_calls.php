<?php
include( '../../includes/header-min.php' );

if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'get_records' ) {
    $code = $_POST[ 'code' ];?>

    <div class="card custom-card">
        <div class="card-body">
            <div class="table-responsive mb-4 mt-4">
                <table class="table table-bordered caption-top W-100 dataTables_length" id="picked_by">
                    <thead class="table-light">
                        <th >Sr.No</th>
                        <th>Date</th>
                        <th >Invoice#</th>
                        <th>Quantity Sold</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th >Actions</th>
                    </thead>
                    <tbody>
                        
                        <?php 
                            $query = fetch_data($link,"SELECT invt_sales.*,SUM(invt_sales.quantity) as total_q,invt_products.product_id,invt_products.product_name FROM invt_sales LEFT JOIN invt_products ON invt_sales.item_id=invt_products.item_id  where invt_sales.picklist_id= '$code' group by invoice_number");
                            $total_q = 0;
                            foreach($query as $key => $row_sol){
                            $sales_id = $row_sol['sales_id'];
                            $invoice_number = $row_sol['invoice_number'];
                        ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $row_sol['date'] ?></td>
                            <td><?= $row_sol['invoice_number'] ?></td>
                            <td><?= $row_sol['total_q'] ?></td>
                            <td><?= $row_sol['picklist_id']?></td>
                            <td>
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
                                        <a class="dropdown-item" onclick=" JSconfirm('change-status.php?sales_id=<?= $sales_id ?>&invoice_number=<?= $invoice_number ?>&type=accepted&action=change_status','warning','Are you sure you want to Complete this Sale?')">Completed</a>
                                        <a class="dropdown-item" onclick=" JSconfirm('change-status.php?sales_id=<?= $sales_id ?>&invoice_number=<?= $invoice_number ?>&type=decline&action=change_status','warning','Are you sure you want to Decline this?')">Decline</a>
                                        <a class="dropdown-item" onclick=" JSconfirm('change-status.php?sales_id=<?= $sales_id ?>&invoice_number=<?= $invoice_number ?>&type=pending&action=change_status','warning','Are you sure you want to move this to pending?')">Pending</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti-menu sidemenu-icon menu-icon "></i>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="view_sales.php?invoice_number=<?= $invoice_number?>">
                                                <i class=" bx bx-edit"> View </i></a>
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
<?php } ?>