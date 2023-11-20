<?php 
    include("../../includes/header-min.php");
    // $added_by = $_SESSION['emp_id'];
    extract($_POST);
    //print_r($_POST);
   // exit();
    if(isset($_GET['sales_id']) && $_GET['sales_id'] != '' ){
        $sales_id = $_GET['sales_id'];
    }else{
        $sales_id = 0;
    }

	if($sales_id>0){
		$query = update_data($link,"invt_sales",[
            'item_id'=>$item_id,
            'customer_name'=>$customer_name,
            'date'=>$date,
            'details'=>$details,
            'sold'=>$sold,
            'subtotal'=>$subtotal,
            'delivery'=> $delivery,
            'process_fee'=> $process_fee, 
            'other_amount'=> $other_amount,
            'total'=> $total
        ],['sales_id'=>$sales_id],false);

         // update producs quantity in invt_products

         $q1 = fetch_data($link,"select quantity from invt_products where item_id= '$item_id'");
         $quan = $q1[0]['quantity'];
         $avail = $quan - $sold;
 
         $query = update_data($link,"invt_products",['avail'=>$avail],['item_id'=>$item_id],false);
        
	} else {
		$query = add_data($link,"invt_sales",[
            'item_id'=>$item_id,
            'customer_name'=>$customer_name,
            'date'=>$date,
            'details'=>$details,
            'sold'=>$sold,
            'subtotal'=>$subtotal,
            'delivery'=> $delivery,
            'process_fee'=> $process_fee, 
            'other_amount'=> $other_amount,
            'total'=> $total
        ],false);

        // update producs quantity in invt_products

        $q1 = fetch_data($link,"select quantity from invt_products where item_id= '$item_id'");
        $quan = $q1[0]['quantity'];
        $avail = $quan - $sold;

        $query = update_data($link,"invt_products",['avail'=>$avail],['item_id'=>$item_id],false);

        $sales_id = $query;
    }


    if($sales_id>0){
        $_SESSION['toast_type'] = "success";
        $_SESSION['toast_msg'] = "Updated Successfully!";
        header("location:create.php?sales_id=$sales_id");
        exit();
    } else{
        $_SESSION['toast_type'] = "success";
        $_SESSION['toast_msg'] = "Added Successfully!";
        header("location:index.php");
        exit();
    }
	

