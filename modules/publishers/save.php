<?php
include( '../../includes/header-min.php' );
extract( $_POST );
$publisher_id = $_POST[ 'publisher_id' ]??0;

if ( $publisher_id>0 ) {
    $query = update_data( $link, 'invt_publishers', [
        'pub_name'=>$pub_name ],['publisher_id'=>$publisher_id], false );

} else {
    $query = add_data( $link, 'invt_publishers', [
        'pub_name'=>$pub_name
    ], false );
    //$publisher_id = $query;
}
if($query){
    
    if ( $publisher_id>0 ) {
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

