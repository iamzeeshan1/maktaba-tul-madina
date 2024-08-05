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
   $invoice_number = $_POST['invoice_number'];
   $delivery = $_POST['delivery'];
   $grand = $_POST['grand'];
   $update = update_data($link,"invt_sales",['delivery_fee'=>$delivery,'grand_total'=>$grand],['invoice_number'=>$invoice_number],false);

   echo "success";

 }
 if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'save_process')
 {
   $invoice_number = $_POST['invoice_number'];
   $process = $_POST['process'];
   $grand = $_POST['grand'];
   $update = update_data($link,"invt_sales",['process_fee'=>$process,'grand_total'=>$grand],['invoice_number'=>$invoice_number],false);

   echo "success";

 }
 if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'save_other')
 {
   $invoice_number = $_POST['invoice_number'];
   $other = $_POST['other'];
   $grand = $_POST['grand'];
   $update = update_data($link,"invt_sales",['other_fee'=>$other,'grand_total'=>$grand],['invoice_number'=>$invoice_number],false);

   echo "success";

 }

 if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'save_details')
 {
   $invoice_number = $_POST['invoice_number'];
   $value = $_POST['value'];
   $update = update_data($link,"invt_sales",['invoice_details'=>$value],['invoice_number'=>$invoice_number],false);

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

if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'get_product_name_location'){
  $item_id = $_POST['item_id'];
  $type = 'product_name';
  echo  get_details($link,$item_id,$type);
}
 if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'get_loc_quantity'){
  $loc_id = $_POST['loc_id'];
  $item_id = $_POST['item_id'];
  $data = fetch_data($link, "SELECT quantity FROM invt_item_quantity where loc_id='$loc_id' and item_id = '$item_id'");
  echo $quantity = $data[0]['quantity']??'0';

 }
if(isset($_POST['ACTION']) && $_POST['ACTION'] == 'get_product_id_location'){
  $item_id = $_POST['item_id'];
  $type = 'product_id';
  echo get_details($link,$item_id,$type);
}

function get_details($link,$item_id,$type){
  $data = fetch_data($link, "SELECT DISTINCT prod.product_name,prod.product_id,prod.item_id,loc.loc_name,loc.loc_id,p.retail_price,invt_item_quantity.quantity,MAX(invt_item_quantity.quantity) OVER (PARTITION BY prod.item_id) AS max_quantity FROM invt_purchase AS p INNER JOIN invt_products AS prod ON p.item_id=prod.item_id INNER JOIN invt_purchase_details AS pd ON p.purchase_id=pd.purchase_id INNER JOIN invt_locations AS loc ON pd.loc_id=loc.loc_id INNER JOIN invt_item_quantity ON loc.loc_id=invt_item_quantity.loc_id AND prod.item_id=invt_item_quantity.item_id WHERE prod.item_id=$item_id");

  $response = array();

  foreach ($data as $row) {
    $prodArray= ($type == 'product_name')?$row['product_name']:$row['product_id'];
    $productid = $row['product_id'];
    $locationName = $row['loc_name'];
    $locationId = $row['loc_id'];
    $retail_price = $row['retail_price'];
    $max_q = $row['max_quantity'];
    $quantity = $row['quantity'];

    if (!isset($response[$prodArray])) {
        $response[$prodArray] = array();
    }

    $response[$prodArray][] = array('name' => $locationName, 'id' => $locationId, 'max_q' => $max_q, 'quantity' => $quantity);
  }


  $products = fetch_data($link,"SELECT  DISTINCT pr.item_id, pr.* FROM invt_products pr inner join invt_purchase ip on pr.item_id = ip.item_id order by product_name");
  // Build HTML response
  $htmlResponseProduct = '<option value="">Select Product </option>';
  foreach ($products as $prod) {
    $selected = ($prod['item_id'] == $item_id)?'selected':'';
    if($type == 'product_name'){
      $htmlResponseProduct .= '<option value="' . htmlspecialchars($prod['item_id']) . '"' . $selected . ' >' . htmlspecialchars($prod['product_name']) . '</option>';
    }else{
      $htmlResponseProduct .= '<option value="' . htmlspecialchars($prod['item_id']) . '"' . $selected . ' >' . htmlspecialchars($prod['product_id']) . '</option>';
    }

  }

  $htmlResponseLocation = '<option value="">Select Location </option>';
  foreach ($response[$prodArray] as $location) {
      $selected = ($location['quantity'] == $location['max_q'])?'selected':'';
      $htmlResponseLocation .= '<option data-bs-toggle="tooltip" data-bs-html="true"  title="' . $location['quantity'] .  '" value="' . htmlspecialchars($location['id']) .  '"' . $selected . '>' . htmlspecialchars($location['name']) . '</option>';
  }
  
  // Convert the response to JSON
  return json_encode(array('productSelect' => $htmlResponseProduct, 'locationSelect' => $htmlResponseLocation, 'retail_price' => $retail_price, 'quantity' => $max_q));
}
?>