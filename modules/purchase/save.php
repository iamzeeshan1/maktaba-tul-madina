<?php
include( '../../includes/header-min.php' );
extract( $_POST );
$purchase_id = $_POST[ 'purchase_id' ] ?? 0;

if ( $purchase_id>0 ) {
    $query = update_data( $link, 'invt_purchase', [
        'supplier_id'=>$supplier_id,
        'date'=>$date,
        'cost_price'=>$cost_price,
        'retail_price'=>$retail_price,
        'quantity'=> $quantity,
        'location'=> $location,
    ], [ 'purchase_id'=>$purchase_id ], false );

} else {

    $query = add_data( $link, 'invt_purchase', [
        'supplier_id'=>$supplier_id,
        'date'=>$date,
        'cost_price'=>$cost_price,
        'retail_price'=>$retail_price,
        'location'=> $location,
        'quantity'=> $quantity,
    ], false );
    //  $purchase_id = $query;
}

if ( $purchase_id>0 ) {
    $res = array( 'status'=>'success', 'value'=>'Updated Successfully!' );
    echo  json_encode( $res );
} else {
    $res = array( 'status'=>'success', 'value'=>'Added Successfully!' );
    echo json_encode( $res );
}

