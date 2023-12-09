<?php
include( '../../includes/header-min.php' );
$supplier_id = $_GET[ 'supplier_id' ];

if ( isset( $_GET[ 'supplier_id' ] ) && $_GET[ 'action' ] == 'delete_item' )
 {
    $qry = "delete from invt_suppliers where supplier_id='$supplier_id'";
    $chk = insert_update_delete_data( $link, $qry );

    if ( $chk ) {
        $_SESSION[ 'toast_type' ] = 'success';
        $_SESSION[ 'toast_msg' ] = ' Deleted Successfully!';
        header( 'location:index.php' );
        exit();
    } else {
        $_SESSION[ 'toast_type' ] = 'danger';
        $_SESSION[ 'toast_msg' ] = 'Oops! Something went wrong!!';
        header( 'location:index.php' );
        exit();
    }
}

?>