<?php
include( '../../includes/header-min.php' );
$user_id = $_GET[ 'user_id' ];

if ( isset( $_GET[ 'user_id' ] ) && $_GET[ 'action' ] == 'delete_item' )
 {
    $qry = "delete from users where user_id='$user_id'";
    $chk = insert_update_delete_data( $link, $qry );

    $qry = "delete from users_detail where user_id='$user_id'";
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