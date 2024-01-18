<?php
include( '../../includes/header-min.php' );
$user_id = $_POST[ 'user_id' ]??0;
$pass  = crypt_pass($_POST['password']);
$fname = mysqli_real_escape_string($link, trim($_POST['fname']));
$lname = mysqli_real_escape_string($link, trim($_POST['lname']));
$user_name = trim($_POST['user_name']);
$email = mysqli_real_escape_string($link,$_POST['email']);


if ( $user_id>0 ) {
    $query = update_data( $link, 'users', [
        'user_name'=>$user_name,'user_password'=>$pass
    ], [ 'user_id'=>$user_id ], false );

    $query = update_data( $link, 'users_detail', [
        'first_name'=>$fname,'last_name'=>$lname,'user_email'=>$email
    ], [ 'user_id'=>$user_id ], false );

} else {
    // $check_uniq = fetch_data( $link, "select name from invt_picklist where name = '$name'" );
    // if ( count( $check_uniq )>0 ) {
    //     $res = array( 'status'=>'danger', 'value'=>'Name already exists' );
    //     echo  json_encode( $res );
    //     exit;
    // }
    $query = add_data( $link, 'users', [
        'user_name'=>$user_name,'user_password'=>$pass,'user_status'=>'1','user_role'=>'2'
    ], false );
    $latest_id = $query;
    $query = add_data( $link, 'users_detail', [
        'first_name'=>$fname,'last_name'=>$lname,'user_email'=>$email,'user_id'=>$latest_id
    ], false );
    //$picklist_id = $query;
}

if ( $user_id>0 ) {
    $res = array( 'status'=>'success', 'value'=>'Updated Successfully!' );
    echo  json_encode( $res );
} else {
    $res = array( 'status'=>'success', 'value'=>'Added Successfully!' );
    echo json_encode( $res );
}

