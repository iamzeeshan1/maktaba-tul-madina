<?php
$page_title = "Picked Up - Maktaba-Tul-Madina";
include("../../includes/header.php");
$user_id = $_SESSION['mktb_user_id'];
?>
<div class="main-container container-fluid">
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Sales</h2>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card custom-card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="user_code" id="user_code" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <button type="button" onclick="show_record()" class="btn btn-primary  btn-icon-text text-white">Search</button>
                            <button type="button" onclick="reset_filter()" class="btn btn-primary btn-icon-text text-white">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Row -->
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12" id="records">
                
            </div>
        </div>
        <!-- End Row-->
    </div>
</div>
<?php include("../../includes/footer.php");?>
<script src="functions/functions.js"></script>

<script src="<?= $app_path ?>assets/js/table-data.js"></script>