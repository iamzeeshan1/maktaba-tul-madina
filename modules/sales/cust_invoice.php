<?php
$page_title = "Sale - Maktaba-Tul-Madina";
include("../../includes/header.php");
$invoice_number = $_GET['invoice_number']??0;
$currentDate = date("jS F, Y");

$query = fetch_data($link,"SELECT
invt_sales.*, 
invt_products.product_id,
invt_products.product_name,
invt_customers.*
FROM
invt_sales
LEFT JOIN
invt_products
ON 
    invt_sales.item_id = invt_products.item_id
LEFT JOIN
invt_customers
ON 
invt_customers.customer_id = invt_sales.customer_id where invt_sales.invoice_number = '$invoice_number' LIMIT 1");

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
                            <h2 class="main-content-label mb-1"><?=$query[0]['invoice_number']?></h2>
                            <div class="ms-auto">
                            
                                <p class="mb-1"><span class="font-weight-bold">Invoice Date :</span> <?=$currentDate?></p>
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
                                    <?=$query[0]['customer_name']?><br>
                                    <?=$query[0]['address']?><br>
                                    <?=$query[0]['city']?><br>
                                   <?=$query[0]['contact_number']?>
                                </address>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20%">Date</th>
                                        <th width="20%">Product ID</th>
                                        <th width="20%">Product Name</th>
                                        <th width="20%">QNTY</th>
                                        <th width="20%">Discount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                        $row_query = fetch_data($link, "SELECT
                                        invt_sales.*, 
                                        invt_products.product_id,
                                        invt_products.product_name,
                                        invt_customers.*
                                        FROM
                                        invt_sales
                                        LEFT JOIN
                                        invt_products
                                        ON 
                                            invt_sales.item_id = invt_products.item_id
                                        LEFT JOIN
                                        invt_customers
                                        ON 
                                        invt_customers.customer_id = invt_sales.customer_id where invt_sales.invoice_number = '$invoice_number'");
                                        $total = 0;
                                        $delivery=0;
                                        foreach($row_query as $row){
                                        $sales_id = $row['sales_id'];
                                        $total += $row['total'];
                                        $delivery = $row['delivery_fee'];
                                       
                                        if($row['discount_1'] == '0'){
                                            $discount = $row['discount_2'];
                                        }else{
                                            $discount = $row['discount_1'];
                                        }
                                   ?>
                                    <tr>
                                        <td><?=$row['date']?></td>
                                        <td class="tx-12"><?=$row['product_id']?></td>
                                        <td class="tx-12"><?=$row['product_name']?></td>
                                        <td class="tx-right"><?=$row['quantity']?></td>
                                        <td class="tx-right"><?=$discount?>%</td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="tx-right" colspan="4">Sub-Total</td>
                                        <td class="tx-right" id="total"><?=$total?></td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right" colspan="4">Delivery Fee</td>
                                        <td class="tx-right"><?=$delivery?></td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse" colspan="4">Total</td>
                                        <td class="tx-right">
                                            <?php $delivery_fee = floatval($delivery);
                                          $total = floatval($total);
                                            $grand_total = $total + $delivery_fee;?>
                                            <h4 class="tx-bold grand-total"><?=$grand_total?></h4>
                                        </td>
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
<script src="functions.js"></script>
			