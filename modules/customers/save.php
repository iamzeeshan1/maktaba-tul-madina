<?php 
    include("../../includes/header-min.php");
    // $added_by = $_SESSION['emp_id'];
    extract($_POST);
    // print_r($_POST);
    // exit();
    if(isset($_POST['customer_id']) && $_POST['customer_id'] != '' ){
        $customer_id = $_POST['customer_id'];
    }else{
        $customer_id = 0;
    }

	if($customer_id>0){
		$query = update_data($link,"invt_customers",[
            'customer_name'=>$customer_name,
            'city'=>$city,
            'address'=>$address,
            'date'=>$date,
            'contact_number'=>$contact_number,
            'open_balance'=> $open_balance,
            'discount'=> $discount,
            'details'=> $details
        ],['customer_id'=>$customer_id],false);
        
	} else {
		$query = add_data($link,"invt_customers",[
            'customer_name'=>$customer_name,
            'city'=>$city,
            'address'=>$address,
            'date'=>$date,
            'contact_number'=>$contact_number,
            'open_balance'=> $open_balance,
            'discount'=> $discount, 
            'details'=> $details
        ],false);
         $customer_id = $query;
    }

	
    if($customer_id>0){
        $res = array('status'=>'success','value'=>'Updated Successfully!');
        echo  json_encode($res);
    } else{
        $res = array('status'=>'success','value'=>'Added Successfully!');
        echo json_encode($res);
    }
	

