<?php
include( '../../includes/header-min.php' );
// $emp_id = $_SESSION[ 'emp_id' ];

if ( isset( $_POST[ 'ACTION' ] ) && $_POST[ 'ACTION' ] == 'supplier' ) {
    $supplier_id = $_POST[ 'supplier_id' ];

    $qry_uniq = fetch_data( $link, "SELECT * from invt_suppliers where supplier_id='$supplier_id'" );
    $supplier_name = $qry_uniq[ 0 ][ 'supplier_name' ]??'';
    $email = $qry_uniq[ 0 ][ 'email' ]??'';
    $address = $qry_uniq[ 0 ][ 'address' ]??'';
    $contact_number = $qry_uniq[ 0 ][ 'contact_number' ]??'';
    $details = $qry_uniq[ 0 ][ 'details' ]??'';

    $res = array( 'supplier_name'=>$supplier_name, 'email'=>$email, 'address'=>$address, 'contact_number'=>$contact_number, 'details'=>$details );
    echo json_encode( $res );

}

?>