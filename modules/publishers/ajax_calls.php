<?php
include( '../../includes/header-min.php' );
// $emp_id = $_SESSION[ 'emp_id' ];

if ( isset( $_POST[ 'ACTION' ] ) && $_POST[ 'ACTION' ] == 'publisher' ) {
    $publisher_id = $_POST[ 'publisher_id' ];

    $qry_uniq = fetch_data( $link, "SELECT * from invt_publishers where publisher_id='$publisher_id'" );
    $pub_name = $qry_uniq[ 0 ][ 'pub_name' ]??'';

    $res = array( 'pub_name'=>$pub_name );
    echo json_encode( $res );

}

?>