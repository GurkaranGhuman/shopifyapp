<?php
include_once("includes/mysqldb.php");
$parameters = $_GET;

// to get the shop info
$query = "SELECT * FROM shops WHERE shop_url='" .$parameters['shop'] . "' LIMIT 1";
$result = $conn->query($query);

// check the number of existed rows
if($result->num_rows < 1) {
    header("Location: install.php?shop=" . $_GET['shop']);
    exit();
    echo "db is connected";
}

// use fetch assoc function
$storedata = $result->fetch_assoc();
echo print_r($storedata);


?>