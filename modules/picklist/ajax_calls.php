<?php
include( '../../includes/header-min.php' );
// $emp_id = $_SESSION[ 'emp_id' ];

if ( isset( $_POST[ 'ACTION' ] ) && $_POST[ 'ACTION' ] == 'picklist' ) {
    $user_id = $_POST[ 'user_id' ];

    $qry_uniq = fetch_data( $link, "SELECT * from users inner join users_detail on users.user_id=users_detail.user_id where users.user_id='$user_id'" );
    $fname = $qry_uniq[ 0 ][ 'first_name' ]??'';
    $lname = $qry_uniq[ 0 ][ 'last_name' ]??'';
    $user_name = $qry_uniq[ 0 ][ 'user_name' ]??'';
    $user_id = $qry_uniq[ 0 ][ 'user_id' ]??'';
    $user_email = $qry_uniq[ 0 ][ 'user_email' ]??'';

    $res = array( 'fname'=>$fname,'lname'=>$lname,'user_name'=>$user_name,'user_email'=>$user_email,'user_id'=>$user_id );
    echo json_encode( $res );

}

?>