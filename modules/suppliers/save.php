<?php 
    include("../../includes/header-min.php");
    // $added_by = $_SESSION['emp_id'];
    extract($_POST);
    $supplier_id = $_POST['supplier_id']??0;
	if($supplier_id>0){
		$query = update_data($link,"invt_suppliers",[
            'supplier_name'=>$supplier_name,
            'email'=>$email,
            'address'=>$address,
            'contact_number'=>$contact_number,
            'details'=> $details
        ],['supplier_id'=>$supplier_id],false);
        
	} else {
        $check_uniq = fetch_data($link,"select email from invt_suppliers where email = '$email'");
        if(count($check_uniq)>0){
            $res = array('status'=>'danger','value'=>'Email already exists');
            echo  json_encode($res);
            exit;
        }
		$query = add_data($link,"invt_suppliers",[
            'supplier_name'=>$supplier_name,
            'email'=>$email,
            'address'=>$address,
            'contact_number'=>$contact_number,
            'details'=> $details
        ],false);
         //$supplier_id = $query;
    }
    
    if($supplier_id>0){
        $res = array('status'=>'success','value'=>'Updated Successfully!');
        echo  json_encode($res);
    } else{
        $res = array('status'=>'success','value'=>'Added Successfully!');
        echo json_encode($res);
    }
	

