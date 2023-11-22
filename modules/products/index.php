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
              <table class="table table-bordered caption-top W-100 dataTables_length datatable" id="prodTable">
                <thead class="table-light">
                  <th width="4%">Sr.No</th>
                  <th width="20%">Product ID</th>
                  <th width="20%">Quantity</th>
                  <th width="10%">Rack</th>
                  <th width="10%">Section</th>
                  <th width="10%">Category</th>
                  <th width="10%">Location</th>
                  <th width="10%">Retail Price</th>
                  <th width="10%">Cost Price</th>
                  <th width="10%">Discount</th>
                  <th width="5%">Actions</th>
                </thead>
                <tbody>

                  <?php
                  $srNo = 1;
                  $query = fetch_data($link, "SELECT p.item_id,p.product_id,p.cost_price,p.retail_price,p.details,p.discount,p.quantity,p.avail,invt_sections.section_name,invt_locations.location_name,invt_racks.rack_name,invt_categories.category_name FROM invt_products p LEFT JOIN invt_sections ON p.section_id=invt_sections.section_id LEFT JOIN invt_locations ON p.location_id=invt_locations.location_id LEFT JOIN invt_racks ON p.rack_id=invt_racks.rack_id LEFT JOIN invt_categories ON p.category_id=invt_categories.category_id");

                  foreach ($query as $row_sol) {
                    $item_id = $row_sol['item_id'];
                  ?>
                    <tr>
                      <td><?= $srNo++ ?></td>
                      <td><a href="create.php?item_id=<?= $item_id ?>"><?= $row_sol['product_id'] ?></a></td>
                      <td><?= $row_sol['avail'] ?></td>
                      <td><?= $row_sol['rack_name'] ?></td>
                      <td><?= $row_sol['section_name'] ?></td>
                      <td><?= $row_sol['category_name'] ?></td>
                      <td><?= $row_sol['location_name'] ?></td>
                      <td><?= $row_sol['retail_price'] ?></td>
                      <td><?= $row_sol['cost_price'] ?></td>
                      <td><?= $row_sol['discount'] ?></td>
                      <td>
                        <div class="dropdown">
                          <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-view-agenda-outline">Actions</i>
                          </a>

                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="create.php?item_id=<?= $item_id ?>">
                                <i class=" bx bx-edit"> Edit / View </i></a>
                            </li>
                            <li><a href="#" class="dropdown-item" onclick=" JSconfirm('delete.php?item_id=<?= $item_id ?>&action=delete_item')">
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