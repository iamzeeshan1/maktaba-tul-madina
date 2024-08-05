<?php
include( '../../includes/header-min.php' );
$language_id = $_GET[ 'language_id' ];

if ( isset( $_GET[ 'language_id' ] ) && $_GET[ 'action' ] == 'delete_item' )
 {
    $qry = "delete from invt_languages where language_id='$language_id'";
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