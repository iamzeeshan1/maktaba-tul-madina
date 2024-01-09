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
        foreach ($allRows as $rowData) {
            $date = $rowData['date'];
            $supplier_id = $rowData['supplier_id'];
            $item_id = $rowData['product_id'];
            $cost_price = $rowData['cost_price'];
            $retail_price = $rowData['retail_price'];
            $quantity = $rowData['quantity'];
            $location = $rowData['location'];
            $query = add_data( $link, 'invt_purchase', [
                        'supplier_id'=>$supplier_id,
                        'item_id'=>$item_id,
                        'date'=>$date,
                        'cost_price'=>$cost_price,
                        'retail_price'=>$retail_price,
                        'location'=> $location,
                        'quantity'=> $quantity,
                    ], false );
        }
    } 
    $res = array( 'status'=>'success', 'value'=>'Added Successfully!' );
    echo json_encode( $res );
} 

if (isset($_POST['ACTION']) && $_POST['ACTION'] == 'edit') {
    extract( $_POST );
    $query = update_data( $link, 'invt_purchase', [
                'supplier_id'=>$supplier_id,
                'item_id'=>$item_idd,
                'date'=>$date,
                'cost_price'=>$cost_price,
                'retail_price'=>$retail_price,
                'quantity'=> $quantity,
                'location'=> $location,
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

