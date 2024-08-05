<?php
include( '../../includes/header-min.php' );
extract( $_POST );
$user_id = $_SESSION['mktb_user_id'];
$customer_id = $_POST[ 'customer_id' ] ?? 0;

if ( $customer_id>0 ) {
    $query = update_data( $link, 'invt_customers', [
        'customer_name'=>$customer_name,
        'customerID'=>$cust_id,
        'city'=>$city,
        'address'=>$address,
        'region_id'=>$region_id,
        'gender'=>$gender,
        'date'=>$date,
        'contact_number'=>$contact_number,
        'open_balance'=> $open_balance,
        'discount'=> $discount,
        'details'=> $details
    ], [ 'customer_id'=>$customer_id ], false );

} else {
    $query = add_data( $link, 'invt_customers', [
        'customer_name'=>$customer_name,
        'customerID'=>$cust_id,
        'city'=>$city,
        'address'=>$address,
        'region_id'=>$region_id,
        'gender'=>$gender,
        'date'=>$date,
        'contact_number'=>$contact_number,
        'open_balance'=> $open_balance,
        'discount'=> $discount,
        'details'=> $details,
        'added_by'=> $user_id
    ], false );
}

if($query){

    if ( $customer_id>0 ) {
        $res = array( 'status'=>'success', 'value'=>'Updated Successfully!' );
        echo  json_encode( $res );
    } else {
        $res = array( 'status'=>'success', 'value'=>'Added Successfully!' );
        echo json_encode( $res );
    }
}else{
      $res = array( 'status'=>'danger', 'value'=>'Something went wrong' );
        echo json_encode( $res );
}

