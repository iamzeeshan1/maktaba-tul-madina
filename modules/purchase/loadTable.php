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
                            <th width="20%">Produuct Name</th>
                            <th width="10%">Cost Price</th>
                            <th width="10%">Retail Price</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Location</th>
                            <th width="5%">Actions</th>
                        </thead>
                        <tbody>

                            <?php
                                $query = fetch_data($link, "SELECT
                                invt_purchase.*,
                                prod.product_name,
                                invt_suppliers.supplier_name,
                                pd.quantity,
                                pd.loc_id,
                                loc.loc_name
                                FROM
                                invt_purchase
                                LEFT JOIN
                                invt_suppliers
                                ON 
                                invt_purchase.supplier_id = invt_suppliers.supplier_id 
                                inner JOIN
                                invt_purchase_details pd
                                ON 
                                invt_purchase.purchase_id = pd.purchase_id 
                                inner JOIN
                                invt_locations loc
                                ON 
                                pd.loc_id = loc.loc_id 
                                inner JOIN
                                invt_products prod
                                ON 
                                invt_purchase.item_id = prod.item_id 

                                ");

                                foreach ($query as $key => $row_sol) {
                                    $purchase_id = $row_sol['purchase_id'];
                                    $invoice = $row_sol['invoice_number'];
                            ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $row_sol['date'] ?></td>
                                <td><?= $row_sol['supplier_name'] ?></td>
                                <td><?= $row_sol['product_name'] ?></td>
                                <td><?= $row_sol['cost_price'] ?></td>
                                <td><?= $row_sol['retail_price'] ?></td>
                                <td><?= $row_sol['quantity'] ?></td>
                                <td><?= $row_sol['loc_name'] ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti-menu sidemenu-icon menu-icon "></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" onclick="edit_purchase(<?=$purchase_id;?>)">
                                                    <i class=" bx bx-edit"> Edit / View </i></a>
                                            </li>
                                            <li><a class="dropdown-item" href="invoice.php?id=<?=$invoice?>">
                                                    <i class=" bx bx-edit"> Invoice </i></a>
                                            </li>
                                            <li><a href="#" class="dropdown-item"
                                                    onclick=" JSconfirm('delete.php?id=<?= $purchase_id ?>&action=delete_item','warning','Are you sure you want to delete this purchase?')">
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