<?php
include( '../../includes/header-min.php' );
//extract( $_POST );
// print_r($_POST);
// exit;
//$purchase_id = $_POST[ 'purchase_id' ] ?? 0;

// if ( $purchase_id>0 ) {
//     $query = update_data( $link, 'invt_purchase', [
//         'supplier_id'=>$supplier_id,
//         'date'=>$date,
//         'cost_price'=>$cost_price,
//         'retail_price'=>$retail_price,
//         'quantity'=> $quantity,
//         'location'=> $location,
//     ], [ 'purchase_id'=>$purchase_id ], false );

// } else {

//     $query = add_data( $link, 'invt_purchase', [
//         'supplier_id'=>$supplier_id,
//         'date'=>$date,
//         'cost_price'=>$cost_price,
//         'retail_price'=>$retail_price,
//         'location'=> $location,
//         'quantity'=> $quantity,
//     ], false );
//     //  $purchase_id = $query;
// }
if (isset($_POST['ACTION']) && $_POST['ACTION'] == 'save') {
    $allRows = $_POST['allRows'];

    if (!empty($allRows) && is_array($allRows)) {
        $randomNumber = rand(1000, 9999);
        $invoice_number = 'INV-'.$randomNumber;
        foreach ($allRows as $rowData) {

            $supplier_id = $rowData['supplier_id'];
            $item_id = $rowData['product_id'];
            $cost_price = $rowData['cost_price'];
            $retail_price = $rowData['retail_price'];
            $quantity = $rowData['quantity'];
            $location = $rowData['location'];

            // Insert into invt_purchase table
            $purchase_id = add_data($link, 'invt_purchase', [
                'supplier_id' => $supplier_id,
                'item_id' => $item_id,
                'date' => $rowData['date'],
                'cost_price' => $cost_price,
                'retail_price' => $retail_price,
                'invoice_number' => $invoice_number
            ], true);

            // Insert into invt_purchase_detail table
            $check_item = fetch_data($link,"select * from invt_purchase_details where item_id='$item_id' and loc_id = '$location'");
            if(count($check_item)>0){
                $total = $check_item[0]['quantity'] + $quantity;
                update_data($link,'invt_purchase_details',['quantity' => $total],[ 'item_id' => $item_id,'loc_id' => $location],false);
            }else{
                add_data($link, 'invt_purchase_details', [
                    'purchase_id' => $purchase_id,
                    'loc_id' => $location,
                    'quantity' => $quantity, 
                    'item_id' => $item_id
                ], false);
            }
        }
    }

    $res = array('status' => 'success', 'value' => 'Added Successfully!');
    echo json_encode($res);
}


if (isset($_POST['ACTION']) && $_POST['ACTION'] == 'edit') {
    extract( $_POST );
    $query = update_data( $link, 'invt_purchase', [
                'supplier_id'=>$supplier_id,
                'item_id'=>$item_idd,
                'date'=>$date,
                'cost_price'=>$cost_price,
                'retail_price'=>$retail_price,
            ], [ 'purchase_id'=>$purchase_id ], false );
 
             // Insert into invt_purchase_detail table
             $check_item = fetch_data($link,"select * from invt_purchase_details where purchase_id='$purchase_id'");
             if(count($check_item)>0){
                 //$total = $check_item[0]['quantity'] + $quantity;
                 update_data($link,'invt_purchase_details',['quantity' => $quantity,'loc_id'=>$location],[ 'purchase_id' => $purchase_id],false);
             }else{
                 add_data($link, 'invt_purchase_details', [
                     'purchase_id' => $purchase_id,
                     'loc_id' => $location,
                     'quantity' => $quantity, 
                     'item_id' => $item_idd
                 ], false);
             }
        $res = array( 'status'=>'success', 'value'=>'Updated Successfully!' );
        echo  json_encode( $res );
    
}
if (isset($_POST['ACTION']) && $_POST['ACTION'] == 'update_cost_price') {
    extract( $_POST );
    $query = update_data( $link, 'invt_purchase', [
                'cost_price'=>$cost_price
            ], [ 'purchase_id'=>$purchase_id ], false );
 
        $res = array( 'status'=>'success', 'value'=>'Updated Successfully!' );
        echo  json_encode( $res );
    
}
if (isset($_POST['ACTION']) && $_POST['ACTION'] == 'update_retail_price') {
    extract( $_POST );
    $query = update_data( $link, 'invt_purchase', [
                'retail_price'=>$retail_price
            ], [ 'purchase_id'=>$purchase_id ], false );
 
        $res = array( 'status'=>'success', 'value'=>'Updated Successfully!' );
        echo  json_encode( $res );
    
}
if (isset($_POST['ACTION']) && $_POST['ACTION'] == 'update_qnty') {
    extract( $_POST );
    $query = update_data( $link, 'invt_purchase', [
                'quantity'=>$quantity
            ], [ 'purchase_id'=>$purchase_id ], false );
 
        $res = array( 'status'=>'success', 'value'=>'Updated Successfully!' );
        echo  json_encode( $res );
    
}
// if ( $purchase_id>0 ) {
//     $res = array( 'status'=>'success', 'value'=>'Updated Successfully!' );
//     echo  json_encode( $res );
// } else {
//     $res = array( 'status'=>'success', 'value'=>'Added Successfully!' );
//     echo json_encode( $res );
// }

