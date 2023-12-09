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
                    <a  class="btn btn-primary my-2 btn-icon-text text-white" onclick="add_supplier('0')">
                        <i class="fe fe-plus me-2"></i> Add Supplier
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <!-- Row -->
        <div id="loadTable"></div>
        <!-- End Row-->
    </div>
</div>
<?php 
include("modals.php");
include("../../includes/footer.php");
?>
<script src="functions/functions.js"></script>