<?php
$page_title = "Products - Maktaba-Tul-Madina";
include("../../includes/header.php");
?>


<div class="main-container container-fluid">
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Products</h2>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="create.php" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-plus me-2"></i> Add Product
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
                                    <th width="15%">Product ID</th>
                                    <th width="15%">Name</th>
                                    <th width="10%">Barcode</th>
                                    <th width="10%">Category</th>
                                    <th width="10%">Language</th>
                                    <th width="10%">Publisher</th>
                                    <th width="5%">Actions</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $srNo = 1;
                                        $query = fetch_data($link, "SELECT
                                        invt_products.*,
                                        invt_misc.misc_prod_name,
                                        invt_categories.category_name 
                                        FROM
                                        invt_products
                                        LEFT JOIN invt_misc ON invt_products.misc_id = invt_misc.misc_id
                                        LEFT JOIN invt_categories ON invt_products.category_id = invt_categories.category_id");

                                        foreach ($query as $row_sol) {
                                            $item_id = $row_sol['item_id'];
                                    ?>
                                    <tr>
                                        <td><?= $srNo++ ?></td>
                                        <td><a href="create.php?item_id=<?= $item_id ?>"><?= $row_sol['product_id'] ?></a>
                                        </td>
                                        <td><?= $row_sol['product_name'] ?></td>
                                        <td><?= $row_sol['barcode'] ?></td>
                                        <td><?= $row_sol['category_name'] ?></td>
                                        <td><?= $row_sol['language'] ?></td>
                                        <td><?= $row_sol['publisher'] ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" role="button" id="dropdownMenuLink"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-view-agenda-outline">Actions</i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li><a class="dropdown-item"
                                                            href="create.php?item_id=<?= $item_id ?>">
                                                        <i class=" bx bx-edit"> Edit / View </i></a>
                                                    </li>
                                                    <li><a href="#" class="dropdown-item"
                                                            onclick=" JSconfirm('delete.php?item_id=<?= $item_id ?>&action=delete_item')">
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
        <!-- End Row-->
    </div>
</div>


<?php include("../../includes/footer.php");
?>