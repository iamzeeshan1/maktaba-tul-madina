<?php
include( '../../includes/header-min.php' );
// $emp_id = $_SESSION[ 'emp_id' ];

if ( isset( $_POST[ 'ACTION' ] ) && $_POST[ 'ACTION' ] == 'region' ) {
    $region_id = $_POST[ 'region_id' ];

    $qry_uniq = fetch_data( $link, "SELECT * from invt_regions where region_id='$region_id'" );
    $region_name = $qry_uniq[ 0 ][ 'region_name' ]??'';

    $res = array( 'region_name'=>$region_name );
    echo json_encode( $res );

}

?>