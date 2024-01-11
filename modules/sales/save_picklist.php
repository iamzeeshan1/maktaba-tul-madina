<?php 
    include("../../includes/header-min.php");

    $sales_id = $_POST['sales_id']??0;
    $picklist_id = $_POST['picklist_id'];
    //generate invoice number
    
    $get = fetch_data($link,"select * from invt_sales where sales_id=$sales_id");
    if($get[0]['invoice_number'] == ''){
        $count =$get[0]['sales_id'] + 100;
        $invoice = 'INV'.$count;
        $query = update_data($link,"invt_sales",[
            'invoice_number'=>$invoice
        ],['sales_id'=>$sales_id],false);

    }
	if($sales_id>0){
		$query = update_data($link,"invt_sales",[
            'picklist_id'=>$picklist_id
        ],['sales_id'=>$sales_id],false);

      
	} 


    if($sales_id>0){
        $res = array( 'status'=>'success', 'value'=>'Updated Successfully!' );
        echo  json_encode( $res );
    } else {
        $res = array( 'status'=>'success', 'value'=>'Added Successfully!' );
        echo json_encode( $res );
    }
	

