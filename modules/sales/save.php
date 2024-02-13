<?php 
    include("../../includes/header-min.php");
    
if (isset($_POST['ACTION']) && $_POST['ACTION'] == 'save') {
    $allRows = $_POST['allRows'];

    if (!empty($allRows) && is_array($allRows)) {
        $randomNumber = rand(1000, 9999);
        $invoice_number = 'INV-'.$randomNumber;
        foreach ($allRows as $rowData) {
            $customer_id = $rowData['customer_id'];
            $item_id = $rowData['item_id'];
            $date = $rowData['date'];
            $cost_price = $rowData['cost_price'];
            $retail_price = $rowData['retail_price'];
            $quantity = $rowData['quantity'];
            $location = $rowData['location'];
            $total = $rowData['total'];
            $discount_1 = $rowData['discount_1'];
            $discount_2 = $rowData['discount_2'];
            // Insert into invt_purchase table
            $query = add_data($link,"invt_sales",[
                'item_id'=>$item_id,
                'customer_id'=>$customer_id,
                'date'=>$date,
                'details'=>'',
                'quantity'=>$quantity,
                'location'=>$location,
                'cost_price'=> $cost_price,
                'retail_price'=>$retail_price,
                'discount_1'=>$discount_1,            
                'discount_2'=>$discount_2,
                'invoice_number'=>$invoice_number,
                'total'=> $total
            ],false);

            //minus quantity form total quantity
            $check_item = fetch_data($link,"select * from invt_purchase_details where item_id='$item_id' and loc_id = '$location'");
            $total = $check_item[0]['quantity'] - $quantity;
            update_data($link,'invt_purchase_details',['quantity' => $total],[ 'item_id' => $item_id,'loc_id' => $location],false);
       
            $res = array( 'status'=>'success', 'value'=>'Added Successfully!' );
            echo  json_encode( $res );
        
        }
    }
    
    $_SESSION['toast_type'] = "success";
    $_SESSION['toast_msg'] = "Added Successfully!";
    header("location:index.php");
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'edit'){
    extract($_POST);

    $sales_id = $_GET['sales_id']??0;
    $query = update_data($link,"invt_sales",[
        'item_id'=>$item_id,
        'customer_id'=>$customer_id,
        'date'=>$date,
        'details'=>$details,
        'quantity'=>$quantity,
        'location'=>$loc_id,
        'retail_price'=>$retail_price,
        'discount_1'=>$discount_1,            
        'discount_2'=>$discount_2,
        'cost_price'=> $cost_price,
        'total'=> $total
    ],['sales_id'=>$sales_id],false);

    //minus quantity form total quantity
    $check_item = fetch_data($link,"select * from invt_purchase_details where item_id='$item_id' and loc_id = '$loc_id'");
    
    if($old_quantity != $quantity){
        $total = $old_quantity + $check_item[0]['quantity'];
        $current = $total - $quantity;

        update_data($link,'invt_purchase_details',['quantity' => $current],[ 'item_id' => $item_id,'loc_id' => $loc_id],false);
    }

} 


    //else{
    //     $_SESSION['toast_type'] = "success";
    //     $_SESSION['toast_msg'] = "Added Successfully!";
    //     header("location:index.php");
    //     exit();
    // }
	

