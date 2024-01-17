<?php
include( '../../includes/header-min.php' );
$sales_id = $_GET['sales_id'];
$type = $_GET['type'];

if ( isset( $_GET[ 'sales_id' ] ) && $_GET[ 'action' ] == 'change_status' )
 {
    $chk = update_data( $link, 'invt_sales', [
        'status'=> $type,
    ], [ 'sales_id'=>$sales_id ], false );
    if ( $sales_id > 0) {
        $_SESSION[ 'toast_type' ] = 'success';
        $_SESSION[ 'toast_msg' ] = ' Status Change Successfully!';
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