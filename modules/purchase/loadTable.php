<?php include('../../includes/header-min.php')?>
<div class="row row-sm">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive mb-4 mt-4">
                    <table class="table table-striped table-bordered text-nowrap  no-footer dtr-inline" id="purTable">
                        <thead>
                            <th width="4%">Sr.No</th>
                            <th width="4%">Date</th>
                            <th width="20%">Supplier Name</th>
                            <th width="10%">Cost Price</th>
                            <th width="10%">Retail Price</th>
                            <th width="5%">Actions</th>
                        </thead>
                        <tbody>

                            <?php
                                $query = fetch_data($link, "SELECT
                                invt_purchase.*, 
                                SUM(retail_price) AS total_retail_price, 
                                SUM(cost_price) AS total_cost_price, 
                                invt_suppliers.supplier_name
                                FROM
                                invt_purchase
                                LEFT JOIN
                                invt_suppliers
                                ON 
                                    invt_purchase.supplier_id = invt_suppliers.supplier_id 
                                GROUP BY
                                invoice_number;");

                                foreach ($query as $key => $row_sol) {
                                    $purchase_id = $row_sol['purchase_id'];
                                    $invoice = $row_sol['invoice_number'];
                            ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $row_sol['date'] ?></td>
                                <td><?= $row_sol['supplier_name'] ?></td>
                                <td><?= $row_sol['total_cost_price'] ?></td>
                                <td><?= $row_sol['total_retail_price'] ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-view-agenda-outline">Actions</i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <!-- <li><a class="dropdown-item" onclick="edit_purchase(<?//=$purchase_id;?>)">
                                                    <i class=" bx bx-edit"> Edit / View </i></a>
                                            </li> -->
                                            <li><a class="dropdown-item" href="invoice.php?id=<?=$invoice?>">
                                                    <i class=" bx bx-edit"> Invoice </i></a>
                                            </li>
                                            <li><a href="#" class="dropdown-item"
                                                    onclick=" JSconfirm('delete.php?id=<?= $invoice ?>&action=delete_item','warning','Are you sure you want to delete this purchase?')">
                                                    <i class=" bx bx-trash"> Delete</i></a>
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