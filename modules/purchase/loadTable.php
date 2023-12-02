<?php include('../../includes/header-min.php')?>
<div class="row row-sm">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive mb-4 mt-4">
                    <table class="table table-striped table-bordered text-nowrap dataTable no-footer dtr-inline"
                        id="prodTable">
                        <thead>
                            <th width="4%">Sr.No</th>
                            <th width="4%">Date</th>
                            <th width="20%">Supplier Name</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Cost Price</th>
                            <th width="10%">Retail Price</th>
                            <th width="10%">Location</th>
                            <th width="5%">Actions</th>
                        </thead>
                        <tbody>

                            <?php
                                $srNo = 1;
                                $query = fetch_data($link, "SELECT invt_purchase.*, invt_suppliers.supplier_name  FROM invt_purchase LEFT  JOIN invt_suppliers ON invt_purchase.supplier_id = invt_suppliers.supplier_id");

                                foreach ($query as $row_sol) {
                                    $purchase_id = $row_sol['purchase_id'];
                            ?>
                            <tr>
                                <td><?= $srNo++ ?></td>
                                <td><?= $row_sol['date'] ?></td>
                                <td><?= $row_sol['supplier_name'] ?></td>
                                <td><?= $row_sol['quantity'] ?></td>
                                <td><?= $row_sol['cost_price'] ?></td>
                                <td><?= $row_sol['retail_price'] ?></td>
                                <td><?= $row_sol['location'] ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-view-agenda-outline">Actions</i>
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" onclick="add_purchase(<?=$purchase_id;?>)">
                                                    <i class=" bx bx-edit"> Edit / View </i></a>
                                            </li>
                                            <li><a href="#" class="dropdown-item"
                                                    onclick=" JSconfirm('delete.php?purchase_id=<?= $purchase_id ?>&action=delete_item','warning','Delete functionality is not working yet')">
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