<?php
include( '../../includes/header-min.php' );
extract( $_POST );
$region_id = $_POST[ 'region_id' ]??0;

if ( $region_id>0 ) {
    $query = update_data( $link, 'invt_regions', [
        'region_name'=>$region_name ],['region_id'=>$region_id], false );

} else {
    $query = add_data( $link, 'invt_regions', [
        'region_name'=>$region_name
    ], false );
    //$region_id = $query;
}
if($query){
    
    if ( $region_id>0 ) {
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

