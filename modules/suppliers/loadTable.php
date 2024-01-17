<?php include('../../includes/header-min.php');?>

<div class="row row-sm">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive mb-4 mt-4">
                    <table class="table table-striped table-bordered text-nowrap dataTable no-footer dtr-inline" id="Suptable">
                        <thead>
                            <th width="4%">Sr.No</th>
                            <th width="20%">Supplier Name</th>
                            <th width="10%">Email</th>
                            <th width="20%">Address</th>
                            <th width="10%">Number</th>
                            <th width="10%">Details</th>
                            <th width="5%">Actions</th>
                        </thead>
                        <tbody>

                            <?php
                                $query = fetch_data($link, "Select * from invt_suppliers");

                                foreach ($query as $key => $row_sol) {
                                    $supplier_id = $row_sol['supplier_id'];
                            ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $row_sol['supplier_name'] ?></td>
                                <td><?= $row_sol['email'] ?></td>
                                <td><?= $row_sol['address'] ?></td>
                                <td><?= $row_sol['contact_number'] ?></td>
                                <td><?= $row_sol['details'] ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-view-agenda-outline">Actions</i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" onclick="add_supplier(<?=$supplier_id;?>)">
                                                    <i class=" bx bx-edit"> Edit / View </i></a>
                                            </li>
                                            <li><a href="#" class="dropdown-item"
                                                    onclick=" JSconfirm('delete.php?supplier_id=<?= $supplier_id ?>&action=delete_item','warning','Are you sure you want to delete the supplier?')">
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