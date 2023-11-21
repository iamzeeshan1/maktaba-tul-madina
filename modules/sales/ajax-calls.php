<?php
include("../../includes/header-min.php");

$item_id = $_POST['item_id'];

$sql = "SELECT cost_price, discount, avail FROM invt_products WHERE item_id = $item_id";
$result = mysqli_query($link,$sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    echo json_encode($row);
} else {
    echo json_encode(array('error' => 'Product not found'));
}

?>