<?php
include( '../../includes/header-min.php' );
// $emp_id = $_SESSION[ 'emp_id' ];

if ( isset( $_POST[ 'ACTION' ] ) && $_POST[ 'ACTION' ] == 'language' ) {
    $language_id = $_POST[ 'language_id' ];

    $qry_uniq = fetch_data( $link, "SELECT * from invt_languages where language_id='$language_id'" );
    $lan_name = $qry_uniq[ 0 ][ 'lan_name' ]??'';

    $res = array( 'lan_name'=>$lan_name );
    echo json_encode( $res );

}

?>