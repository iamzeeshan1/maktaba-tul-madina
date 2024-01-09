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
?>