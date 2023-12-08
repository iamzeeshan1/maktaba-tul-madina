<?php 
    include("../../includes/header-min.php");

    extract($_POST);
    // print_r($_POST);
    // exit;
    $item_id = $_GET['item_id'] ?? 0;

	if($item_id>0){
		$query = update_data($link,"invt_products",[
            'product_id'=>$product_id,
            'barcode'=>$barcode,
            'product_name'=>$product_name,
            'misc_id'=>$misc_id,
            'category_id'=>$category_id,
            'language'=>$language,
            'publisher'=> $publisher,
            
        ],['item_id'=>$item_id],false);
        
	} else {
		$query = add_data($link,"invt_products",[
            'product_id'=>$product_id,
            'barcode'=>$barcode,
            'product_name'=>$product_name,
            'misc_id'=>$misc_id,
            'category_id'=>$category_id,
            'language'=>$language,
            'publisher'=> $publisher,
            
        ],false);
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
	

