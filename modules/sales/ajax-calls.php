<?php
include("../../includes/header-min.php");
// $item_id = $_POST['item_id'];

// $sql = "SELECT p.cost_price, p.discount, p.avail, invt_sales.sold FROM invt_products p LEFT JOIN invt_sales ON p.item_id = invt_sales.item_id WHERE p.item_id = $item_id";
// $result = mysqli_query($link,$sql);
// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     echo json_encode($row);
// } else {
//     echo json_encode(array('error' => 'Product not found'));
// }
 if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'get_discount'){
    $customer_id = $_POST['cust_id'];
    $get = fetch_data($link,"select discount from invt_customers where customer_id = $customer_id");
    $discount = $get[0]['discount'];
    echo $discount;
 }
 if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'save_delivery')
 {
   $sales_id = $_POST['sales_id'];
   $delivery = $_POST['delivery'];
   $grand = $_POST['grand'];
   $update = update_data($link,"invt_sales",['delivery_fee'=>$delivery,'grand_total'=>$grand],['sales_id'=>$sales_id],false);

   echo "success";

 }
 if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'save_process')
 {
   $sales_id = $_POST['sales_id'];
   $process = $_POST['process'];
   $grand = $_POST['grand'];
   $update = update_data($link,"invt_sales",['process_fee'=>$process,'grand_total'=>$grand],['sales_id'=>$sales_id],false);

   echo "success";

 }
 if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'save_other')
 {
   $sales_id = $_POST['sales_id'];
   $other = $_POST['other'];
   $grand = $_POST['grand'];
   $update = update_data($link,"invt_sales",['other_fee'=>$other,'grand_total'=>$grand],['sales_id'=>$sales_id],false);

   echo "success";

 }

 if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'save_details')
 {
   $sales_id = $_POST['sales_id'];
   $value = $_POST['value'];
   $update = update_data($link,"invt_sales",['invoice_details'=>$value],['sales_id'=>$sales_id],false);

   echo "success";

 }

 if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'picklist')
 {
   $sales_id = $_POST['sales_id'];
   $qry_uniq = fetch_data($link,"SELECT
   invt_sales.*, 
   invt_picklist.`name`, 
   invt_products.product_name, 
   invt_customers.customer_name
 FROM
   invt_sales
   LEFT JOIN
   invt_picklist
   ON 
     invt_sales.picklist_id = invt_picklist.picklist_id
   LEFT JOIN
   invt_products
   ON 
     invt_sales.item_id = invt_products.item_id
   LEFT JOIN
   invt_customers
   ON 
     invt_sales.customer_id = invt_customers.customer_id where invt_sales.sales_id = '$sales_id' ");

    $date = $qry_uniq[ 0 ][ 'date' ]??'';
    $customer_name = $qry_uniq[ 0 ][ 'customer_name' ]??'';
    $product_name = $qry_uniq[ 0 ][ 'product_name' ]??'';
    $quantity = $qry_uniq[ 0 ][ 'quantity' ]??'';
    $location = $qry_uniq[ 0 ][ 'location' ]??'';
    $details = $qry_uniq[ 0 ][ 'details' ]??'';
    $picklist_id = $qry_uniq[ 0 ][ 'picklist_id' ]??'';
    $res = array( 'date'=>$date, 'customer_name'=>$customer_name, 'product_name'=>$product_name, 'quantity'=>$quantity,'location'=>$location, 'details'=>$details,'picklist_id'=>$picklist_id );
    echo json_encode( $res );

 }
?>