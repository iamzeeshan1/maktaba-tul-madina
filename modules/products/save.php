<?php
include( '../../includes/header-min.php' );

extract( $_POST );

$item_id = $_POST[ 'itm_id' ] ?? 0;
if(isset($_POST[ 'category_id' ]) && $_POST[ 'category_id' ] == 3){

    $misc_id = $_POST[ 'misc_id' ];
    $language = '';
    $publisher='';
}else{
    $misc_id = '0';
}

if($product_id == ''){
    $random_number = rand(10000, 99999);
    $product_id = "010" . $random_number;
}
if ( $item_id>0 ) {
    // $query = update_data( $link, 'invt_products', [
    //     'product_id'=>$product_id,
    //     'barcode'=>$barcode,
    //     'product_name'=>$product_name,
    //     'misc_id'=>$misc_id,
    //     'category_id'=>$category_id,
    //     'language'=>$language,
    //     'publisher'=> $publisher,

    // ], [ 'item_id'=>$item_id ], false );
    $query = "UPDATE `invt_products`
    SET
    `product_id`= '$product_id',
     `barcode`= '$barcode',
     `product_name`= '$product_name',
     `misc_id`= '$misc_id',
     `category_id`= '$category_id',
     `language_id`= '$language',
     `publisher_id`=  '$publisher'
    WHERE
    `item_id` = $item_id";

} else {
    // $query = add_data( $link, 'invt_products', [
    //     'product_id'=>$product_id,
    //     'barcode'=>$barcode,
    //     'product_name'=>$product_name,
    //     'misc_id'=>$misc_id,
    //     'category_id'=>$category_id,
    //     'language'=>$language,
    //     'publisher'=> $publisher,

    // ], false );
    $query = " INSERT INTO `invt_products` (
        `product_id`,
        `barcode`,
        `product_name`,
        `misc_id`,
        `category_id`,
        `language_id`,
        `publisher_id`
    ) VALUES (
        '$product_id',
        '$barcode',
        '$product_name',
        '$misc_id',
        '$category_id',
        '$language',
        '$publisher'
    )";
}
$chk = mysqli_query($link,$query);

if($chk){
    if ( $item_id>0 ) {
        $_SESSION[ 'toast_type' ] = 'success';
        $_SESSION[ 'toast_msg' ] = 'Updated Successfully!';
        header( 'location:index.php' );
        exit();
    } else {
        $_SESSION[ 'toast_type' ] = 'success';
        $_SESSION[ 'toast_msg' ] = 'Added Successfully!';
        header( 'location:index.php' );
        exit();
    }
}else{
     $_SESSION[ 'toast_type' ] = 'danger';
    $_SESSION[ 'toast_msg' ] = 'Something went wrong';
    header( 'location:index.php' );
    exit();
}
