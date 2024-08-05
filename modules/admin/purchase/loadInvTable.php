<?php include('../../../includes/header-min.php');
$invoice_number = $_POST['inv'];
?>

<table class="table table-invoice table-bordered">
    <thead>
        <tr>
            <th class="wd-10p">Date</th>
            <th class="wd-20p">Document Number</th>
            <th class="wd-20p">Product</th>
            <th class="wd-10p tx-right">QNTY</th>
            <th class="wd-10p tx-right">Retail Price</th>
            <th class="wd-10p tx-right">Cost Price</th>
            <!-- <th class="wd-5p  edit_row">Actions</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        $row_query = fetch_data($link, "SELECT invt_purchase.*,invt_products.product_name, invt_suppliers.supplier_name,pd.quantity FROM invt_purchase inner JOIN invt_purchase_details pd ON invt_purchase.purchase_id = pd.purchase_id LEFT JOIN invt_suppliers ON invt_purchase.supplier_id = invt_suppliers.supplier_id LEFT JOIN invt_products ON invt_purchase.item_id = invt_products.item_id where invt_purchase.invoice_number = '$invoice_number'");
        $total_cost = 0;
        $total_retail = 0;
        $total_qty = 0;
        foreach($row_query as $row){
            $purchase_id = $row['purchase_id'];
            $total_cost += $row['cost_price'];
            $total_retail += $row['retail_price'];
            $total_qty += $row['quantity']; ?>
            <tr id="row-<?= $purchase_id ?>">
                <td><?= $row['date'] ?></td>
                <td><?= $row['document_num'] ?></td>
                <td><?= $row['product_name'] ?></td>
                <td class="tx-right" data-purchase-id="<?= $row['purchase_id'] ?>"><?= $row['quantity'] ?></td>
                <td class="tx-right" data-purchase-id="<?= $row['purchase_id'] ?>"><?= $row['retail_price'] ?></td>
                <td class="tx-right" data-purchase-id="<?= $row['purchase_id'] ?>"><?= $row['cost_price'] ?></td>
                <!-- <td class="edit_row tx-center">
                    <i class="zmdi zmdi-edit" onclick="editInvRow(<?//= $purchase_id ?>)"></i>
                </td> -->
            </tr>
        <?php } ?>
            <tr>
                <td class="tx-right" colspan="3"><strong>Total</strong></td>
                <td class="tx-right"><strong><?= $total_qty ?></strong></td>
                <td class="tx-right"><strong><?= $total_retail ?></strong></td>
                <td class="tx-right"><strong><?= $total_cost ?></strong></td>
            </tr>
    </tbody>
</table>