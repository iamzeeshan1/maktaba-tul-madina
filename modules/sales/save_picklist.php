<?php 
    include("../../includes/header-min.php");

    $invoice_number = $_POST['invoice_number']??'';
    // $picklist_id = $_POST['picklist_id'];
    $picklist_code = $_POST['picklist_code'];
    //generate invoice number
    
    $get = fetch_data($link,"select * from invt_sales where invoice_number='$invoice_number'");
    if($get[0]['invoice_number'] == ''){
        $sales_id = $get[0]['sales_id'];
        $count =$get[0]['sales_id'] + 100;
        $invoice = 'INV'.$count;
        $query = update_data($link,"invt_sales",[
            'invoice_number'=>$invoice
        ],['sales_id'=>$sales_id],false);

    }
	if($invoice_number!=''){
		$query = update_data($link,"invt_sales",[
            'picklist_id'=>$picklist_code
        ],['invoice_number'=>$invoice_number],false);

      
	} 


  
    $res = array( 'status'=>'success', 'value'=>'Added Successfully!' );
    echo json_encode( $res );
    
	

