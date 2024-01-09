<?php
include( '../../includes/header-min.php' );
extract( $_POST );
$picklist_id = $_POST[ 'picklist_id' ]??0;

if ( $picklist_id>0 ) {
    $query = update_data( $link, 'invt_picklist', [
        'name'=>$name
    ], [ 'picklist_id'=>$picklist_id ], false );

} else {
    $check_uniq = fetch_data( $link, "select name from invt_picklist where name = '$name'" );
    if ( count( $check_uniq )>0 ) {
        $res = array( 'status'=>'danger', 'value'=>'Name already exists' );
        echo  json_encode( $res );
        exit;
    }
    $query = add_data( $link, 'invt_picklist', [
        'name'=>$name,
    ], false );
    //$picklist_id = $query;
}

if ( $picklist_id>0 ) {
    $res = array( 'status'=>'success', 'value'=>'Updated Successfully!' );
    echo  json_encode( $res );
} else {
    $res = array( 'status'=>'success', 'value'=>'Added Successfully!' );
    echo json_encode( $res );
}

