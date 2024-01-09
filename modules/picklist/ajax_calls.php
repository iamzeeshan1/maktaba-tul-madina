<?php
include( '../../includes/header-min.php' );
// $emp_id = $_SESSION[ 'emp_id' ];

if ( isset( $_POST[ 'ACTION' ] ) && $_POST[ 'ACTION' ] == 'picklist' ) {
    $picklist_id = $_POST[ 'picklist_id' ];

    $qry_uniq = fetch_data( $link, "SELECT * from invt_picklist where picklist_id='$picklist_id'" );
    $name = $qry_uniq[ 0 ][ 'name' ]??'';
    $picklist_id = $qry_uniq[ 0 ][ 'picklist_id' ]??'';

    $res = array( 'name'=>$name,'picklist_id'=>$picklist_id );
    echo json_encode( $res );

}

?>