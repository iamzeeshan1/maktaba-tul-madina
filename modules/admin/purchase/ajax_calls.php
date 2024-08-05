<?php
include( '../../../includes/header-min.php' );
include( '../../../includes/phpmailer-fn-api.php' );

if ( isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] == 'change_status' )
 {
    $invoice_number = $_GET['inv_num'];
    $type = $_GET['type'];
    $chk = update_data( $link, 'invt_purchase', [
        'admin_request_status'=> $type
    ], [ 'invoice_number'=>$invoice_number ], false );


    $status=($type == 1)?'approved':'declined';
    $user = fetch_data($link,"SELECT users_detail.first_name FROM invt_purchase INNER JOIN users_detail ON invt_purchase.added_by=users_detail.user_id WHERE invoice_number = '$invoice_number' limit 1");


    $message = 'Hi '.$user[0]['first_name'].'<br><br>';
    
    $message .= '<p>Your request to edit the invoice number <strong>'.$invoice_number.'</strong> has been '.$status.' .</p><br><br>';
        
    $message .= 'Thanks<br>';
    $message .= 'System Generated Email<br><br>';

    $message = str_replace("&","(specail_character)",$message);
    send_mail('sairamaryum97@gmail.com', '', '', 'Request to Edit Invoice', $message,'','','');
    
    if ( $chk ) {
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