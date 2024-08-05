<?php
include( '../../includes/header-min.php' );
extract( $_POST );
$language_id = $_POST[ 'language_id' ]??0;

if ( $language_id>0 ) {
    $query = update_data( $link, 'invt_languages', [
        'lan_name'=>$lan_name ],['language_id'=>$language_id], false );

} else {
    $query = add_data( $link, 'invt_languages', [
        'lan_name'=>$lan_name
    ], false );
    //$language_id = $query;
}
if($query){
    
    if ( $language_id>0 ) {
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

