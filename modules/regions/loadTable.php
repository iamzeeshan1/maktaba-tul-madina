<?php include('../../includes/header-min.php');?>

<div class="row row-sm">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-nowrap dataTable no-footer dtr-inline" id="regiontable">
                        <thead>
                            <th width="4%">Sr.No</th>
                            <th width="20%">Region Name</th>
                            <th width="5%">Actions</th>
                        </thead>
                        <tbody>

                            <?php
                                $query = fetch_data($link, "Select * from invt_regions");

                                foreach ($query as $key => $row_sol) {
                                    $region_id = $row_sol['region_id'];
                            ?>
                            <tr>
                                <td><?= $key+1 ?></td>
                                <td><?= $row_sol['region_name'] ?></td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" role="button" id="dropdownMenuLink"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti-menu sidemenu-icon menu-icon "></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" onclick="add_region(<?=$region_id;?>)">
                                                    <i class=" bx bx-edit"> Edit / View </i></a>
                                            </li>
                                            <li><a href="#" class="dropdown-item"
                                                    onclick=" JSconfirm('delete.php?region_id=<?= $region_id ?>&action=delete_item','warning','Are you sure you want to delete the region?')">
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