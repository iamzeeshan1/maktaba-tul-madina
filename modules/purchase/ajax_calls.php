<?php
include( '../../includes/header-min.php' );
include( '../../includes/phpmailer-fn-api.php' );

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
    $doc_num = $qry_uniq[ 0 ][ 'document_num' ]??'';

    $res = array( 'supplier_id'=>$supplier_id, 'item_id'=>$item_id, 'date'=>$date, 'cost_price'=>$cost_price, 'retail_price'=>$retail_price, 'quantity'=>$quantity, 'location'=>$location, 'doc_num'=>$doc_num );
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
    // $dropdown_class .= "<label for='loc_idd' class='mg-b-10 form-label'>Location</label>";
    // $dropdown_class .= "<select name='loc_id' class='form-select' id='loc_idd'  onchange='add_location(this.value)'>";
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
    //$dropdown_class .= '</select>';
    echo $dropdown_class;
}

if(isset($_POST['ACTION']) && $_POST['ACTION'] =='get_details'){
    $product_id = $_POST['product_id'];

    $get = fetch_data($link,"SELECT invt_purchase_details.loc_id,invt_purchase_details.quantity,invt_purchase.cost_price,invt_purchase.retail_price FROM invt_purchase INNER JOIN invt_purchase_details ON invt_purchase.purchase_id=invt_purchase_details.purchase_id WHERE invt_purchase.item_id='$product_id'");

    $cost_price = $get[ 0 ][ 'cost_price' ]??'';
    $retail_price = $get[ 0 ][ 'retail_price' ]??'';
    $location = $get[ 0 ][ 'loc_id' ]??'';
   
    $res = array('cost_price'=>$cost_price, 'retail_price'=>$retail_price, 'location'=>$location );
    echo json_encode( $res );
}

if(isset($_POST['ACTION']) && $_POST['ACTION'] =='user_request_edit'){
    $inv_num = $_POST['inv_num'];
    $user = fetch_data($link,"SELECT users_detail.first_name FROM invt_purchase INNER JOIN users_detail ON invt_purchase.added_by=users_detail.user_id WHERE invoice_number = '$inv_num' limit 1");

    update_data($link,"invt_purchase",['user_request_status'=>'1'],['invoice_number'=>$inv_num],false);



    $message = 'Hi <br><br>';
	
    $message .= '<p>'.$user[0]['first_name'].' Requested to edit the invoice number <strong>'.$inv_num.'</strong>.</p><br><br>';
      
    $message .= 'Thanks<br>';
    $message .= 'System Generated Email<br><br>';

    $message = str_replace("&","(specail_character)",$message);
    send_mail('aazaz.raza@dawateislamiuk.net', '', '', 'Request to Edit Invoice', $message,'','','');

}

if(isset($_POST['ACTION']) && $_POST['ACTION'] =='save_invoice_changes'){
    $purchase_id = $_POST['p_id'];
    $cost_price = $_POST['cost'];
    $retail_price = $_POST['retail'];
    $quantity = $_POST['quantity'];

    $old_data = fetch_data($link,"SELECT invt_purchase_details.quantity,invt_purchase_details.loc_id,invt_purchase.item_id FROM invt_purchase INNER JOIN invt_purchase_details ON invt_purchase.purchase_id=invt_purchase_details.purchase_id");

    $oldQ = $old_data[0]['quantity'];
    $loc_id = $old_data[0]['loc_id'];
    $item_id = $old_data[0]['item_id'];

    update_data($link,"invt_purchase",['cost_price'=>$cost_price,'retail_price'=>$retail_price],['purchase_id'=>$purchase_id],false);

    //quantity
    $total_q = fetch_data($link,"SELECT * FROM `invt_item_quantity` WHERE item_id=$item_id and loc_id=$loc_id");
    $qty = $total_q[0]['quantity'];
    $update_total = $oldQ - $qty;
    $update_total = $quantity + $update_total;

    update_data($link,"invt_item_quantity",['quantity'=>$update_total],['item_id'=>$item_id,'loc_id'=>$loc_id],false);

    update_data($link,"invt_purchase_details",['quantity'=>$update_total],['purchase_id'=>$purchase_id],false);

    return 'success';
}
?>