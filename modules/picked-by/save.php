<?php
include( '../../includes/header-min.php' );
extract( $_POST );
$customer_id = $_POST[ 'customer_id' ] ?? 0;

if(isset($_GET['action']) && $_GET['action'] == 'edit'){
    extract($_POST);

    $sales_id = $_GET['sales_id']??0;
    $query = update_data($link,"invt_sales",[
        'quantity'=>$quantity
    ],['sales_id'=>$sales_id],false);

    //minus quantity form total quantity
    $check_item = fetch_data($link,"select * from invt_purchase_details where item_id='$item_id' and loc_id = '$loc_id'");
    
    if($old_quantity != $quantity){
        $total = $old_quantity + $check_item[0]['quantity'];
        $current = $total - $quantity;

        update_data($link,'invt_purchase_details',['quantity' => $current],[ 'item_id' => $item_id,'loc_id' => $loc_id],false);
    }

} 

if($sales_id>0){
    $_SESSION['toast_type'] = "success";
    $_SESSION['toast_msg'] = "Updated Successfully!";
    header("location:index.php");
    exit();
}

