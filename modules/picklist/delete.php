<?php
include( '../../includes/header-min.php' );
$picklist_id = $_GET[ 'picklist_id' ];

if ( isset( $_GET[ 'picklist_id' ] ) && $_GET[ 'action' ] == 'delete_item' )
 {
    $qry = "delete from invt_picklist where picklist_id='$picklist_id'";
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