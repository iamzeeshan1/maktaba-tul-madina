<?php
include( '../../includes/header-min.php' );

if ( isset( $_POST[ 'ACTION' ] ) && $_POST[ 'ACTION' ] == 'purchase' ) {
    $purchase_id = $_POST[ 'purchase_id' ];

    $qry_uniq = fetch_data( $link, "SELECT * from invt_purchase where purchase_id='$purchase_id'" );
    $supplier_id = $qry_uniq[ 0 ][ 'supplier_id' ]??'';
    $date = $qry_uniq[ 0 ][ 'date' ]??'';
    $cost_price = $qry_uniq[ 0 ][ 'cost_price' ]??'';
    $retail_price = $qry_uniq[ 0 ][ 'retail_price' ]??'';
    $quantity = $qry_uniq[ 0 ][ 'quantity' ]??'';
    $location = $qry_uniq[ 0 ][ 'location' ]??'';

    $res = array( 'supplier_id'=>$supplier_id, 'date'=>$date, 'cost_price'=>$cost_price, 'retail_price'=>$retail_price, 'quantity'=>$quantity, 'location'=>$location );
    echo json_encode( $res );

}

?>