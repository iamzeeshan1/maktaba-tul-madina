<?php
$page_title = "Purchase - Maktaba-Tul-Madina";
include("../../includes/header.php");
$purchase_id = $_GET['id']??0;

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
                            <h2 class="main-content-label mb-1">#INV0678</h2>
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
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice table-bordered">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">Date</th>
                                        <th class="wd-20p">Supplier</th>
                                        <th class="wd-20p">Product</th>
                                        <th class="tx-center">QNTY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $row_query = fetch_data($link, "SELECT invt_purchase.*,invt_products.product_name, invt_suppliers.supplier_name  FROM invt_purchase LEFT  JOIN invt_suppliers ON invt_purchase.supplier_id = invt_suppliers.supplier_id LEFT  JOIN invt_products ON invt_purchase.item_id = invt_products.item_id where invt_purchase.purchase_id = $purchase_id");
                                        $purchase_id = $row_query[0]['purchase_id'];
                                    ?>
                                    <tr>
                                        <td><?= $row_query[0]['date'] ?></td>
                                        <td><?= $row_query[0]['supplier_name'] ?></td>
                                        <td><?= $row_query[0]['product_name'] ?></td>
                                        <td class="tx-right"><?= $row_query[0]['quantity'] ?></td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="tx-right" colspan="3">Cost Price</td>
                                        <td class="tx-right" ><?= $row_query[0]['cost_price'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right" colspan="3">Retail Price</td>
                                        <td class="tx-right" ><?= $row_query[0]['retail_price'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn ripple btn-info mb-1" onclick="javascript:window.print();"><i class="fe fe-printer me-1"></i> Print Invoice</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
</div>
<?php 
include("../../includes/footer.php");
?>
			