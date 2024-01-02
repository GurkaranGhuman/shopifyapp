<?php
$_API_KEY = '18529c510a8d512fdc0b07f36998d8b5';
$_NGROK_URL = 'https://672b-223-178-211-123.ngrok-free.app';
$shop= $_GET['shop'];
$scopes = 'read_products,write_products,read_orders,write_orders';
$redirect_uri = $_NGROK_URL . '/testapp/token.php';
$nonce = bin2hex( random_bytes( 12 ) );
$accessmode = 'per-user';
$oauth_url = 'https://' . $shop . '/admin/oauth/authorize?client_id=' . $_API_KEY . '&scope=' . $scopes . '&redirect_uri=' . urlencode($redirect_uri) . '&state=' . $nonce . '&grant_options[]=' . $accessmode;
header("Location: " . $oauth_url);
exit();
?>