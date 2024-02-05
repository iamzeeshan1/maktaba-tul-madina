<?php
$page_title = "Sale - Maktaba-Tul-Madina";
include("../../includes/header.php");
$invoice_number = $_GET['invoice_number'];
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
invt_customers.customer_id = invt_sales.customer_id where invt_sales.invoice_number = '$invoice_number' LIMIT 1 ");


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
                                        $process_fee = $row['process_fee']??0;
                                        $other_fee = $row['other_fee']??0;
                                        $grand_total = $row['grand_total'];
                                       
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
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4">
                                            <div class="invoice-notes">
                                                <label class="main-content-label tx-13">Notes</label>
                                              <textarea name="detaiils" id="" cols="100" rows="8" class="form-control" onfocusout="save_details(this.value,'<?=$invoice_number?>')"><?=$query[0]['invoice_details']??''?></textarea>
                                            </div><!-- invoice-notes -->
                                        </td>
                                        <td class="tx-right">Sub-Total</td>
                                        <td class="tx-right" colspan="2" id="total"><?=$total?></td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">Delivery Fee</td>
                                        <td class="tx-right" colspan="2"><input type="number" name="delivery" id="delivery" class="form-control" onfocusout="save_delivery(this.value,'<?=$invoice_number?>','<?=$total?>')" value="<?=$delivery?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">Processing Fee</td>
                                        <td class="tx-right" colspan="2"><input type="number" name="process" id="process" class="form-control" onfocusout="save_process(this.value,'<?=$invoice_number?>','<?=$total?>')" value="<?=$process_fee?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right">Other</td>
                                        <td class="tx-right" colspan="2"><input type="number" name="other" id="other" class="form-control" onfocusout="save_other(this.value,'<?=$invoice_number?>','<?=$total?>')" value="<?=$other_fee?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="tx-right tx-uppercase tx-bold tx-inverse" colspan="3">Total</td>
                                        <td class="tx-right">
                                            <h4 class="tx-bold grand-total"><?=$grand_total??$total?></h4>
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
			