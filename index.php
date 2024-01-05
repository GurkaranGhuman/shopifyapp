<?php
include_once("includes/mysqldb.php");
include_once("includes/shopify.php");

// access class
$shopify = new Shopify();
$parameters = $_GET;

// // to get the shop info
$query = "SELECT * FROM shops WHERE shop_url='" .$parameters['shop'] . "' LIMIT 1";
$result = $conn->query($query);

// // check the number of existed rows
if($result->num_rows < 1) {
    header("Location: install.php?shop=" . $_GET['shop']);
    exit();
}

// // use fetch assoc function
$storedata = $result->fetch_assoc();

$shopify->set_url($parameters['shop']);
$shopify->set_token($storedata['access_token']);
echo $shopify->get_url();
echo '<br />';
echo $shopify->get_token();
$products = $shopify->restapi('/admin/api/2024-01/products.json', array(), 'GET');
echo print_r($products['body']);

// $shop = $shopify->restapi('/admin/api/2021-04/shop.json', array(), 'GET');
$response = json_decode($products['body'], true);

if(array_key_exists('errors', $response)){
    echo '<br/>';
    echo 'token is not fetched' . $response['errors'];
    header("Location: install.php?shop=" . $_GET['shop']);
    exit();
}
// $access_scopes = $shopify->restapi('/admin/oauth/access_scoped.json', array(), 'GET');
// $response = json_decode($access_scopes['body'], true);
// echo print_r($response);
?>