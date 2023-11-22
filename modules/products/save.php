<?php 
    include("../../includes/header-min.php");
    // $added_by = $_SESSION['emp_id'];
    extract($_POST);
    // print_r($_POST);
    // exit();
    if(isset($_GET['item_id']) && $_GET['item_id'] != '' ){
        $item_id = $_GET['item_id'];
    }else{
        $item_id = 0;
    }

	if($item_id>0){
		$query = update_data($link,"invt_products",[
            'product_id'=>$product_id,
            'rack_id'=>$rack_id,
            'section_id'=>$section_id,
            'location_id'=>$location_id,
            'category_id'=>$category_id,
            'cost_price'=>$cost_price,
            'retail_price'=> $retail_price,
            'discount'=> $discount, 
            'quantity'=> $quantity,
            'avail'=> $quantity,
            'details'=> $details
        ],['item_id'=>$item_id],false);
        
	} else {
		$query = add_data($link,"invt_products",[
            'product_id'=>$product_id,
            'rack_id'=>$rack_id,
            'section_id'=>$section_id,
            'location_id'=>$location_id,
            'category_id'=>$category_id,
            'cost_price'=>$cost_price,
            'retail_price'=> $retail_price,
            'discount'=> $discount, 
            'quantity'=> $quantity,
            'avail'=> $quantity,
            'details'=> $details
        ],false);
        $item_id = $query;
    }

	
    if($item_id>0){
        $_SESSION['toast_type'] = "success";
        $_SESSION['toast_msg'] = "Updated Successfully!";
        header("location:index.php");
        exit();
    } else{
        $_SESSION['toast_type'] = "success";
        $_SESSION['toast_msg'] = "Added Successfully!";
        header("location:index.php");
        exit();
    }
	

