<?php
$page_title = "Purchase - Maktaba-Tul-Madina";
include("../../includes/header.php");
$invoice_number = $_GET['id']??'';
$doc_num = return_title('document_num','invoice_number',$invoice_number,'invt_purchase',$link);
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
                            <div>
                                <!--<h2 class="main-content-label mb-2">Invoice<?//=$invoice_number?></h2>-->
                                <p class="mb-1"><span class="font-weight-bold">Invoice No:</span> <?=$invoice_number;?></p>
                                <p class="mb-1"><span class="font-weight-bold">Document No:</span> <?=$doc_num;?></p>
                            </div>
                            
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
include("../../includes/footer.php");
$ad = fetch_data($link,"select admin_request_status from invt_purchase where invoice_number='$invoice_number' limit 1 ");
?>
<script>
    var admin_req = '<?=$ad[0]['admin_request_status']?>';
</script>

<script src="functions/functions.js"></script>
