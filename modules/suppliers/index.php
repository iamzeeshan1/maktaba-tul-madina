<?php
$page_title = "Suppliers - Maktaba-Tul-Madina";
include("../../includes/header.php");
?>


<div class="main-container container-fluid">
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Suppliers</h2>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a  class="btn btn-primary my-2 btn-icon-text" onclick="add_supplier('0')">
                        <i class="fe fe-plus me-2"></i> Add Supplier
                    </a>
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
                            <table class="table table-striped table-bordered text-nowrap dataTable no-footer dtr-inline"
                                id="prodTable">
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
                                        $srNo = 1;
                                        $query = fetch_data($link, "Select * from invt_suppliers");

                                        foreach ($query as $row_sol) {
                                            $supplier_id = $row_sol['supplier_id'];
                                    ?>
                                    <tr>
                                        <td><?= $srNo++ ?></td>
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
                                                            onclick=" JSconfirm('delete.php?supplier_id=<?= $supplier_id ?>&action=delete_item')">
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


<?php 
include("modals.php");
include("../../includes/footer.php");
?>
<script src="functions/functions.js"></script>