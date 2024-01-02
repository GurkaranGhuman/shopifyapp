<?php
$api_key = '18529c510a8d512fdc0b07f36998d8b5';
$secret_key = 'ce0c8ec641f98356b4f792e3ed851477';
$parameters = $_GET;
$shop_url = $parameters['shop'];
$hamc = $parameters['hmac'];
$parameters = array_diff_key($parameters, array('hmac' => ''));
ksort($parameters);
$newhmac = hash_hmac('sha256', http_build_query($parameters), $secret_key);
if(hash_equals($hamc, $newhmac)) {
    $access_token_endpoint = 'https://' . $shop_url . '/admin/oauth/access_token';
    $var = array(
        "client_id" => $api_key,
        "client_secret" =>$secret_key,
        "code" => $parameters['code']
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $access_token_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, count($var));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($var));
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, true);
    echo print_r($response);
    
}
else{
    echo 'this is not coming from the shopify app';
}

?>