<?php include('../../includes/header-min.php');
$invoice_number = $_POST['inv'];
?>

<table class="table table-invoice table-bordered">
    <thead>
        <tr>
            <th class="wd-20p">Date</th>
            <th class="wd-20p">Product</th>
            <th class="wd-20p">QNTY</th>
            <th class="wd-20p">Retail Price</th>
            <th class="wd-20p tx-right">Cost Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $row_query = fetch_data($link, "SELECT invt_purchase.*,invt_products.product_name, invt_suppliers.supplier_name  FROM invt_purchase LEFT  JOIN invt_suppliers ON invt_purchase.supplier_id = invt_suppliers.supplier_id LEFT  JOIN invt_products ON invt_purchase.item_id = invt_products.item_id where invt_purchase.invoice_number = '$invoice_number'");
            $total = 0;
            foreach($row_query as $row){
            $purchase_id = $row['purchase_id'];
            $total += $row['cost_price'];
            
        ?>
        <tr>
            <td><?= $row['date'] ?></td>
            <td><?= $row['product_name'] ?></td>
            <td data-purchase-id="<?= $row['purchase_id'] ?>"> <?= $row['quantity'] ?></td>
            <td data-purchase-id="<?= $row['purchase_id'] ?>"><?= $row['retail_price'] ?></td>
            <td class="tx-right" data-purchase-id="<?= $row['purchase_id'] ?>" ><?= $row['cost_price'] ?></td>
        

        </tr>
        <?php  
            } ?>
        <tr></tr>
        <tr>
            <td class="tx-right" colspan="4"><strong>Total</strong></td>
            <td class="tx-right"><strong><?=$total?></strong></td>
        </tr>
    </tbody>
</table>