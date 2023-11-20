<?php
include("../../includes/header-min.php");

// Assume the product ID is sent via POST
$item_id = $_POST['item_id'];

// Query the database to get price and discount based on the product ID
$sql = "SELECT cost_price, discount FROM invt_products WHERE item_id = $item_id";
$result = mysqli_query($link,$sql);
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    // Output data as JSON
    echo json_encode($row);
} else {
    // Product not found
    echo json_encode(array('error' => 'Product not found'));
}

?>