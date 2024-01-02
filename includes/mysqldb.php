<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'testapp_db';

$conn = mysqli_connect($server, $username, $password, $database);
if(!$conn){
    die("Eroor" . mysqli_connect_error());
}