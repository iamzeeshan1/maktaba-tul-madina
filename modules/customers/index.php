<?php
$page_title = "Customers - Maktaba-Tul-Madina";
include("../../includes/header.php");
?>


<div class="main-container container-fluid">
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Customers</h2>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="create.php" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-plus me-2"></i> Add Customer
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
                                    <th width="10%">Date</th>
                                    <th width="20%">Customer Name</th>
                                    <th width="20%">Address</th>
                                    <th width="10%">City</th>
                                    <th width="10%">Discount%</th>
                                    <th width="10%">Number</th>
                                    <th width="10%">Opening Balance</th>
                                    <th width="10%">Details</th>
                                    <th width="5%">Actions</th>
                                </thead>
                                <tbody>

                                    <?php
                                        $srNo = 1;
                                        $query = fetch_data($link, "Select * from invt_customers");

                                        foreach ($query as $row_sol) {
                                            $customer_id = $row_sol['customer_id'];
                                    ?>
                                    <tr>
                                        <td><?= $srNo++ ?></td>
                                        <td><?= $row_sol['date'] ?></td>
                                        <td><a href="create.php?customer_id=<?= $customer_id ?>"><?= $row_sol['customer_name'] ?></a>
                                        </td>
                                        <td><?= $row_sol['address'] ?></td>
                                        <td><?= $row_sol['city'] ?></td>
                                        <td><?= $row_sol['discount'] ?></td>
                                        <td><?= $row_sol['contact_number'] ?></td>
                                        <td><?= $row_sol['open_balance'] ?></td>
                                        <td><?= $row_sol['details'] ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" role="button" id="dropdownMenuLink"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-view-agenda-outline">Actions</i>
                                                </a>

                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li><a class="dropdown-item"
                                                            href="create.php?customer_id=<?= $customer_id ?>">
                                                            <i class=" bx bx-edit"> Edit / View </i></a>
                                                    </li>
                                                    <li><a href="#" class="dropdown-item"
                                                            onclick=" JSconfirm('delete.php?customer_id=<?= $customer_id ?>&action=delete_item','warning','Delete functionality is not working yet')">
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