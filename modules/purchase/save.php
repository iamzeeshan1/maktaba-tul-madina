<?php
include( '../../includes/header-min.php' );
$user_id = $_SESSION['mktb_user_id'];

if (isset($_POST['ACTION']) && $_POST['ACTION'] == 'save') {
    $allRows = $_POST['allRows'];
    $notes = $_POST['notes'];

    if (!empty($allRows) && is_array($allRows)) {
        $randomNumber = rand(1000, 9999);
        $inv_number = 'INV-'.$randomNumber;
        foreach ($allRows as $rowData) {
           $invoice_number = ($rowData['inv_num'] != '')?$rowData['inv_num']:$inv_number;

            $supplier_id = $rowData['supplier_id'];
            $item_id = $rowData['product_id'];
            $cost_price = $rowData['cost_price'];
            $retail_price = $rowData['retail_price'];
            $quantity = $rowData['quantity'];
            $location = $rowData['location'];
            $doc_num = $rowData['doc_num'];

            // Insert into invt_purchase table
            $purchase_id = add_data($link, 'invt_purchase', [
                'supplier_id' => $supplier_id,
                'item_id' => $item_id,
                'date' => $rowData['date'],
                'cost_price' => $cost_price,
                'retail_price' => $retail_price,
                'invoice_number' => $invoice_number,
                'notes' => $notes,
                'document_num' => $doc_num,
                'added_by'=> $user_id,
                'added_on'=> get_datetime()

            ], true);

            add_data($link, 'invt_purchase_details', [
                'purchase_id' => $purchase_id,
                'loc_id' => $location,
                'quantity' => $quantity, 
                'item_id' => $item_id,
            ], false);

           // Insert into invt_item_quantity table
            $check_item = fetch_data($link,"select * from invt_item_quantity where item_id='$item_id' and loc_id = '$location'");
            if(count($check_item)>0){
                $total = $check_item[0]['quantity'] + $quantity;
                update_data($link,'invt_item_quantity',['quantity' => $total],[ 'item_id' => $item_id,'loc_id' => $location],false);
            }else{
                add_data($link, 'invt_item_quantity', [
                    'loc_id' => $location,
                    'quantity' => $quantity, 
                    'item_id' => $item_id
                ], false);
            }

        }
    }

    $res = array('status' => 'success', 'value' => 'Added Successfully!');
    echo json_encode($res);
}

if (isset($_POST['ACTION']) && $_POST['ACTION'] == 'edit') {
    extract( $_POST );
    $query = update_data( $link, 'invt_purchase', [
                'supplier_id'=>$supplier_id,
                'item_id'=>$item_idd,
                'date'=>$date,
                'cost_price'=>$cost_price,
                'retail_price'=>$retail_price,
                'document_num'=>$doc_num,
            ], [ 'purchase_id'=>$purchase_id ], false );
 
             // Insert into invt_purchase_detail table
             $check_item = fetch_data($link,"select * from invt_purchase_details where purchase_id='$purchase_id'");
             if(count($check_item)>0){
                $prev_q = $check_item[0]['quantity'];
                $prev_loc = $check_item[0]['loc_id'];
                 update_data($link,'invt_purchase_details',['quantity' => $quantity,'loc_id'=>$location],[ 'purchase_id' => $purchase_id],false);
             }else{
                 add_data($link, 'invt_purchase_details', [
                     'purchase_id' => $purchase_id,
                     'loc_id' => $location,
                     'quantity' => $quantity, 
                     'item_id' => $item_idd
                 ], false);
             }

                // Update into invt_item_quantity table
                if($location == $prev_loc){ //only quantity is updated

                  $check_item_quantity = fetch_data($link,"select * from invt_item_quantity where item_id='$item_idd' and loc_id = '$location'");
                    if(count($check_item_quantity)>0){
                        $totall = $check_item_quantity[0]['quantity'] - $prev_q;
                        $final_q = $totall + $quantity;
                        update_data($link,'invt_item_quantity',['quantity' => $final_q],[ 'item_id' => $item_idd,'loc_id' => $location],false);
                    }
                }else if($quantity == $prev_q){ //only loc is updated

                    // first minus the quantity from previous location 
                    $q2 = fetch_data($link,"select * from invt_item_quantity where item_id='$item_idd' and loc_id = '$prev_loc'");
                    if(count($q2)>0){
                        $total = $q2[0]['quantity'] - $prev_q;
                        update_data($link,'invt_item_quantity',['quantity' => $total],[ 'item_id' => $item_idd,'loc_id' => $prev_loc],false);
                    }

                    // now check if product already exist on that loc..update that row else add new 
                    $q1 = fetch_data($link,"select * from invt_item_quantity where item_id='$item_idd' and loc_id = '$location'");
                    if(count($q1)>0){
                         $total = $q1[0]['quantity'] + $quantity;
                         update_data($link,'invt_item_quantity',['quantity' => $total],[ 'item_id' => $item_idd,'loc_id' => $location],false);
                    }else{

                        add_data($link, 'invt_item_quantity', [
                             'loc_id' => $location,
                             'quantity' => $quantity, 
                             'item_id' => $item_idd
                         ], false);
                    }
                }else if($quantity != $prev_q && $location != $prev_loc){
                    //add quantity to new location..
                    $check_item_quantity = fetch_data($link,"select * from invt_item_quantity where item_id='$item_idd' and loc_id = '$location' ");
                    if(count($check_item_quantity)>0){
                        $total = $check_item_quantity[0]['quantity']  + $quantity;
                        update_data($link,'invt_item_quantity',['quantity' => $total],[ 'item_id' => $item_idd,'loc_id' => $location],false);
                    }else{
                        add_data($link, 'invt_item_quantity', [
                            'loc_id' => $location,
                            'quantity' => $quantity, 
                            'item_id' => $item_idd
                        ], false);
                    }

                    // Minus quantity from previous loc 
                    $check_item_loc = fetch_data($link,"select * from invt_item_quantity where item_id='$item_idd' and loc_id = '$prev_loc'");
                    if(count($check_item_loc)>0){
                        $total = $check_item_loc[0]['quantity'] - $prev_q;
                        update_data($link,'invt_item_quantity',['quantity' => $total],[ 'item_id' => $item_idd,'loc_id' => $prev_loc],false);
                    }
                }
        $res = array( 'status'=>'success', 'value'=>'Updated Successfully!' );
        echo  json_encode( $res );
    
}
