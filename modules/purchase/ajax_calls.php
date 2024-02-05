<?php
include( '../../includes/header-min.php' );

if ( isset( $_POST[ 'ACTION' ] ) && $_POST[ 'ACTION' ] == 'purchase' ) {
    $purchase_id = $_POST[ 'purchase_id' ];

    $qry_uniq = fetch_data( $link, "SELECT * from invt_purchase p  inner join invt_purchase_details pd  on p.purchase_id = pd.purchase_id inner join invt_locations loc on pd.loc_id=loc.loc_id  where p.purchase_id='$purchase_id'" );
    $supplier_id = $qry_uniq[ 0 ][ 'supplier_id' ]??'';
    $item_id = $qry_uniq[ 0 ][ 'item_id' ]??'';
    $date = $qry_uniq[ 0 ][ 'date' ]??'';
    $cost_price = $qry_uniq[ 0 ][ 'cost_price' ]??'';
    $retail_price = $qry_uniq[ 0 ][ 'retail_price' ]??'';
    $quantity = $qry_uniq[ 0 ][ 'quantity' ]??'';
    $location = $qry_uniq[ 0 ][ 'loc_id' ]??'';

    $res = array( 'supplier_id'=>$supplier_id, 'item_id'=>$item_id, 'date'=>$date, 'cost_price'=>$cost_price, 'retail_price'=>$retail_price, 'quantity'=>$quantity, 'location'=>$location );
    echo json_encode( $res );

}

if ( isset( $_POST[ 'ACTION' ] ) && $_POST[ 'ACTION' ] == 'add_new_loc' ) {
    $name = validate_string( $link, $_POST[ 'name' ] );
    $qry_uniq = fetch_data( $link, "SELECT loc_name from invt_locations where loc_name='$name'" );
    if ( count( $qry_uniq ) > 0 ) {
        echo 'loc_error';
        exit();
    } else {
        $qry = add_data( $link, 'invt_locations', [ 'loc_name'=>$name ], false );
    }
    //ajax response
    $dropdown_class = '';
    $dropdown_class .= "<label for='loc_idd' class='mg-b-10 form-label'>Location</label>";
    $dropdown_class .= "<select name='loc_id' class='form-select' id='loc_idd'";
    $dropdown_class .= '<option  selected>Select- </option>';
    $sql = fetch_data( $link, 'Select * from invt_locations' );
    foreach ( $sql as $row_q )
    {
        $selected = ( $name == $row_q[ 'loc_name' ] ) ? 'selected' : '';

        $id = $row_q[ 'loc_id' ];
        $loc_name = $row_q[ 'loc_name' ];
        $dropdown_class .= "<option value='".$id."' ".$selected.'>'.$loc_name.'</option>';
    }
    $dropdown_class .= "<option value='other'>Other</option>";
    $dropdown_class .= '</select>';
    echo $dropdown_class;
}

?>