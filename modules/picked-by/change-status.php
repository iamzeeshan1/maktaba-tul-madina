<?php
include( '../../includes/header-min.php' );
$user_id = $_SESSION['mktb_user_id'];
$sales_id = $_GET['sales_id'];
$type = $_GET['type'];

if ( isset( $_GET[ 'sales_id' ] ) && $_GET[ 'action' ] == 'change_status' )
 {
    $chk = update_data( $link, 'invt_sales', [
        'status'=> $type,'updated_on'=>get_datetime()
    ], [ 'sales_id'=>$sales_id ], false );

    $add = add_data($link,'notifications',['sales_id'=>$sales_id,'type'=>$type,'user_id'=>$user_id],false);
    
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