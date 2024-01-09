<?php 
    include("../../includes/header-min.php");
    // $added_by = $_SESSION['emp_id'];
    extract($_POST);

    $sales_id = $_GET['sales_id']??0;
    $discount_1 = $discount_1?$discount_1:'0';
    $discount_2 = $discount_2?$discount_2:'0';
//exit;
	if($sales_id>0){
		$query = update_data($link,"invt_sales",[
            'item_id'=>$item_id,
            'customer_id'=>$customer_id,
            'date'=>$date,
            'details'=>$details,
            'quantity'=>$quantity,
            'location'=>$location,
            'retail_price'=>$retail_price,
            'discount_1'=>$discount_1,            
            'discount_2'=>$discount_2,
            'cost_price'=> $cost_price,
            'total'=> $total
        ],['sales_id'=>$sales_id],false);

         // update producs quantity in invt_products

        //  $q1 = fetch_data($link,"select quantity from invt_products where item_id= '$item_id'");
        //  $quan = $q1[0]['quantity'];
        //  $avail = $quan - $quantity;
 
        //  $query = update_data($link,"invt_products",['avail'=>$avail],['item_id'=>$item_id],false);
        
	} else {
		$query = add_data($link,"invt_sales",[
            'item_id'=>$item_id,
            'customer_id'=>$customer_id,
            'date'=>$date,
            'details'=>$details,
            'quantity'=>$quantity,
            'location'=>$location,
            'cost_price'=> $cost_price,
            'retail_price'=>$retail_price,
            'discount_1'=>$discount_1,            
            'discount_2'=>$discount_2,
            'total'=> $total
        ],false);

        // update producs quantity in invt_products

        // $q1 = fetch_data($link,"select quantity from invt_products where item_id= '$item_id'");
        // $quan = $q1[0]['quantity'];
        // $avail = $quan - $sold;

        // $query = update_data($link,"invt_products",['avail'=>$avail],['item_id'=>$item_id],false);

        // $sales_id = $query;
    }


    // if($sales_id>0){
    //     $_SESSION['toast_type'] = "success";
    //     $_SESSION['toast_msg'] = "Updated Successfully!";
    //     header("location:index.php");
    //     exit();
    // } else{
    //     $_SESSION['toast_type'] = "success";
    //     $_SESSION['toast_msg'] = "Added Successfully!";
    //     header("location:index.php");
    //     exit();
    // }
	

