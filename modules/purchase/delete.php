<?php
include( '../../includes/header-min.php' );
$id = $_GET[ 'id' ];

if ( isset( $_GET[ 'id' ] ) && $_GET[ 'action' ] == 'delete_item' )
 {
   

    $qry = "delete from invt_purchase where purchase_id='$id'";
    $chk = insert_update_delete_data( $link, $qry );
    
    $qry = "delete from invt_purchase_details where purchase_id='$id'";
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