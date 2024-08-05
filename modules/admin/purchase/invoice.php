<?php
$page_title = "Purchase - Maktaba-Tul-Madina";
include("../../../includes/header.php");
$invoice_number = $_GET['id']??'';

?>

<div class="main-container container-fluid">
    <div class="inner-body">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Invoice</h2>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="d-lg-flex">
                            <h2 class="main-content-label mb-1">#<?=$invoice_number?></h2>
                            <div class="ms-auto">
                                <?php $currentDate = date("jS F, Y");?>
                                <p class="mb-1"><span class="font-weight-bold">Invoice Date :</span> <?=$currentDate;?></p>
                            </div>
                        </div>
                        <hr class="mg-b-40">
                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <p class="h3">Invoice Form:</p>
                                <address>
                                    Street Address<br>
                                    State, City<br>
                                    Region, Postal Code<br>
                                    yourdomain@example.com
                                </address>
                            </div>
                            <div class="col-lg-6 text-end">
                                <p class="h3">Invoice To:</p>
                                <address>
                                    Street Address<br>
                                    State, City<br>
                                    Region, Postal Code<br>
                                    ypurdomain@example.com
                                </address>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40 " id="loadInvTable" data-id="<?=$invoice_number?>">
                       
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn ripple btn-info mb-1" onclick="printPage()"><i class="fe fe-printer me-1"></i> Print Invoice</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
</div>
<?php 
include("../../../includes/footer.php");
?>
<script src="functions/functions.js"></script>
<script>
var admin_req = '<?=$row['admin_request_status']??0?>';
</script>